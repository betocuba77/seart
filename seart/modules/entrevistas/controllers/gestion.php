<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * gestion controller
 */
class gestion extends Admin_Controller{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct(){
		parent::__construct();

		$this->auth->restrict('Entrevistas.Gestion.View');
		$this->load->model('entrevistas_model', null, true);
		$this->load->model('preguntas/preguntas_model');
		$this->lang->load('entrevistas');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'gestion/_sub_nav');

		Assets::add_module_js('entrevistas', 'entrevistas.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index(){

		// Deleting anything?
		if (isset($_POST['delete'])){
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked)){
				$result = FALSE;
				foreach ($checked as $pid){
					$result = $this->entrevistas_model->delete($pid);
				}

				if ($result){
					Template::set_message(count($checked) .' '. lang('entrevistas_delete_success'), 'success');
				} else {
					Template::set_message(lang('entrevistas_delete_failure') . $this->entrevistas_model->error, 'error');
				}
			}
		}

		$records = $this->entrevistas_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Gestión de Entrevistas');
		Template::render();
	}

	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function plantillas(){

		// Deleting anything?
		if (isset($_POST['delete'])){
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked)){
				$result = FALSE;
				foreach ($checked as $pid){
					$result = $this->entrevistas_model->delete_plantilla($pid);
				}

				if ($result){
					Template::set_message(count($checked) .' '. lang('entrevistas_delete_success'), 'success');
				} else {
					Template::set_message(lang('entrevistas_delete_failure') . $this->entrevistas_model->error, 'error');
				}
			}
		}

		$records = $this->entrevistas_model->find_all_plantillas();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Plantillas');
		Template::render();
	}

	//--------------------------------------------------------------------
	public function create_plantilla(){
		if (isset($_POST['save'])) {
			if ($insert_id = $this->save_plantilla()) {
				// Log the activity
				//log_activity($this->current_user->id, lang('entrevistas_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'entrevistas');

				Template::set_message('Plantilla creada', 'success');
				redirect(SITE_AREA .'/gestion/entrevistas/plantillas');
			} else {
				Template::set_message('No se puedo guardar la plantilla' . $this->entrevistas_model->error, 'error');
			}
		}

		$records = $this->preguntas_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Nueva Plantilla');
		Template::render();
	}

	/**
	 * Creates a Entrevistas object.
	 *
	 * @return void
	 */
	public function create(){
		$this->auth->restrict('Entrevistas.Gestion.Create');

		if (isset($_POST['save'])){
			if ($insert_id = $this->save_entrevistas()){
				// Log the activity
				log_activity($this->current_user->id, lang('entrevistas_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'entrevistas');

				Template::set_message(lang('entrevistas_create_success'), 'success');
				redirect(SITE_AREA .'/gestion/entrevistas');
			} else {
				Template::set_message(lang('entrevistas_create_failure') . $this->entrevistas_model->error, 'error');
			}
		}

		// Recupero los entrevistadores (tutores) y los entrevistados
		$this->load->model('tutorandos/tutorandos_model');
		$this->load->model('users/user_model');
		$this->load->model('entrevistas/entrevistas_model');
		foreach ($this->tutorandos_model->find_all() as $tutorando) {
			$tutorandos[$tutorando->tutorando_id] = $tutorando->apellido.' '.$tutorando->nombre;
		}
		foreach ($this->entrevistas_model->find_all_plantillas() as $plantilla) {
			$plantillas[$plantilla->plantilla_id] = $plantilla->anio;
		}
		foreach ($this->user_model->find_all() as $tutor) {
			if ($tutor->role_id == 7) {
				$tutores[$tutor->id] = $tutor->surname.' '.$tutor->name;
			}			
		}
		
		Template::set('plantillas', $plantillas);
		Template::set('tutores', $tutores);
		Template::set('tutorandos', $tutorandos);
		Assets::add_module_js('entrevistas', 'entrevistas.js');
		// Recuperar a los tutores
		Template::set('toolbar_title', lang('entrevistas_create') . ' Entrevistas');
		Template::render();
	}

	//--------------------------------------------------------------------

	/**
	 * Allows editing of Entrevistas data.
	 *
	 * @return void
	 */
	public function edit(){
		$id = $this->uri->segment(5);

		if (empty($id)){
			Template::set_message(lang('entrevistas_invalid_id'), 'error');
			redirect(SITE_AREA .'/gestion/entrevistas');
		}

		if (isset($_POST['save'])){
			$this->auth->restrict('Entrevistas.Gestion.Edit');

			if ($this->save_entrevistas('update', $id)){
				// Log the activity
				log_activity($this->current_user->id, lang('entrevistas_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'entrevistas');

				Template::set_message(lang('entrevistas_edit_success'), 'success');
			} else {
				Template::set_message(lang('entrevistas_edit_failure') . $this->entrevistas_model->error, 'error');
			}
		} else if (isset($_POST['delete'])) {
			$this->auth->restrict('Entrevistas.Gestion.Delete');

			if ($this->entrevistas_model->delete($id)) {
				// Log the activity
				log_activity($this->current_user->id, lang('entrevistas_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'entrevistas');

				Template::set_message(lang('entrevistas_delete_success'), 'success');

				redirect(SITE_AREA .'/gestion/entrevistas');
			} else {
				Template::set_message(lang('entrevistas_delete_failure') . $this->entrevistas_model->error, 'error');
			}
		}
		Template::set('entrevistas', $this->entrevistas_model->find($id));
		Template::set('toolbar_title', lang('entrevistas_edit') .' Entrevistas');
		Template::render();
	}

	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/**
	 * Summary
	 *
	 * @param String $type Either "insert" or "update"
	 * @param Int	 $id	The ID of the record to update, ignored on inserts
	 *
	 * @return Mixed    An INT id for successful inserts, TRUE for successful updates, else FALSE
	 */
	private function save_entrevistas($type='insert', $id=0) {
		if ($type == 'update') {
			$_POST['entrevista_id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['entrevistador']        = $this->input->post('tutor_id');
		$data['entrevistado']        = $this->input->post('tutorando_id');
		$data['plantilla']        = $this->input->post('plantilla_id');
		$data['fecha']        = $this->input->post('fecha') ? $this->input->post('fecha') : '0000-00-00';

		//echo '<pre>'; print_r($data); echo '</pre>', exit;
		if ($type == 'insert') {
			$id = $this->entrevistas_model->insert($data);

			if (is_numeric($id)) {
				$return = $id;
			} else {
				$return = FALSE;
			}
		} elseif ($type == 'update') {
			$return = $this->entrevistas_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------
	private function save_plantilla($type='insert', $id=0){
		if ($type == 'update') {
			$_POST['plantilla_id'] = $id;
		}
		//echo '<pre>'; print_r($this->input->post()); echo '</pre>'; exit;
		// make sure we only pass in the fields we want		
		$data = array('anio' => $this->input->post('anio'), 'descripcion' => $this->input->post('descripcion'));		
		$preguntas = $this->input->post('checked');

		if ($type == 'insert') {
			$id = $this->entrevistas_model->insert_plantilla($data, $preguntas);

			if (is_numeric($id)) {
				$return = $id;
			} else {
				$return = FALSE;
			}
		} elseif ($type == 'update') {
			$return = $this->entrevistas_model->update($id, $data);
		}

		return $return;	
	}


}