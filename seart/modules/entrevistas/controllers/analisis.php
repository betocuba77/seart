<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * analisis controller
 */
class analisis extends Admin_Controller{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct(){
		parent::__construct();

		$this->auth->restrict('Entrevistas.Analisis.View');
		$this->load->model('entrevistas_model', null, true);
		$this->lang->load('entrevistas');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'analisis/_sub_nav');

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
		if (isset($_POST['delete'])) {
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked)) {
				$result = FALSE;
				foreach ($checked as $pid) {
					$result = $this->entrevistas_model->delete($pid);
				}

				if ($result) {
					Template::set_message(count($checked) .' '. lang('entrevistas_delete_success'), 'success');
				} else {
					Template::set_message(lang('entrevistas_delete_failure') . $this->entrevistas_model->error, 'error');
				}
			}
		}

		$id = $this->current_user->id;
		$records = $this->entrevistas_model->find_all_tutorandos($id);

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Entrevistas');
		Template::render();
	}

	//--------------------------------------------------------------------

	public function entrevistar($entrevista, $entrevistador, $entrevistado){
		//echo '<pre>'; print_r($preguntas = $this->entrevistas_model->find_preguntas($entrevista)); echo '</pre>'; exit;

		$preguntas = $this->entrevistas_model->find_preguntas($entrevista);
		//echo '<pre>'; print_r($preguntas); echo '</pre>'; exit;
		if ($this->input->post('save')) {
			//echo '<pre>'; print_r($this->input->post()); echo '</pre>'; exit;
			foreach ($preguntas as $pregunta) {
				if ($pregunta['pregunta_id'] == $this->input->post($pregunta['pregunta_id'])) {
					if ($pregunta['tipo_respuesta_id'] == 1) {
						$aux = array('repuesta_id' => $pregunta['pregunta_id'],
									'tutorando_id' => $entrevistado,
									 'tipo_respuesta_id' => $this->input->post($pregunta['pregunta_id']));
						echo '<pre>'; print_r($aux); echo '</pre>'; exit;
						$this->entrevistas_model->insert_respuesta($aux);
					}
				}	
			}
		}
		// Se recupera los datos del tutor
		$this->load->model('users/user_model');
		$this->load->model('tutorandos/tutorandos_model');
		
		//echo '<pre>'; print_r($preguntas = $this->entrevistas_model->find_preguntas($entrevista)); echo '</pre>'; exit;
		Template::set('tutor', $this->user_model->find($entrevistador));
		Template::set('tutorando', $this->tutorandos_model->find($entrevistado));
		Template::set('preguntas', $preguntas = $this->entrevistas_model->find_preguntas($entrevista));
		Template::set('toolbar_title', 'Formulario de Entrevista');
		Template::render();
	}
	/**
	 * Creates a Entrevistas object.
	 *
	 * @return void
	 */
	public function create(){
		$this->auth->restrict('Entrevistas.Analisis.Create');

		if (isset($_POST['save'])) {
			if ($insert_id = $this->save_entrevistas()){
				// Log the activity
				log_activity($this->current_user->id, lang('entrevistas_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'entrevistas');

				Template::set_message(lang('entrevistas_create_success'), 'success');
				redirect(SITE_AREA .'/analisis/entrevistas');
			} else {
				Template::set_message(lang('entrevistas_create_failure') . $this->entrevistas_model->error, 'error');
			}
		}
		Assets::add_module_js('entrevistas', 'entrevistas.js');

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

		if (empty($id)) {
			Template::set_message(lang('entrevistas_invalid_id'), 'error');
			redirect(SITE_AREA .'/analisis/entrevistas');
		}

		if (isset($_POST['save'])) {
			$this->auth->restrict('Entrevistas.Analisis.Edit');

			if ($this->save_entrevistas('update', $id)){
				// Log the activity
				log_activity($this->current_user->id, lang('entrevistas_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'entrevistas');

				Template::set_message(lang('entrevistas_edit_success'), 'success');
			} else {
				Template::set_message(lang('entrevistas_edit_failure') . $this->entrevistas_model->error, 'error');
			}
		} else if (isset($_POST['delete'])) {
			$this->auth->restrict('Entrevistas.Analisis.Delete');

			if ($this->entrevistas_model->delete($id)) {
				// Log the activity
				log_activity($this->current_user->id, lang('entrevistas_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'entrevistas');

				Template::set_message(lang('entrevistas_delete_success'), 'success');

				redirect(SITE_AREA .'/analisis/entrevistas');
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
	private function save_entrevistas($type='insert', $id=0){
		if ($type == 'update') {
			$_POST['entrevista_id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['entrevistador']        = $this->input->post('entrevistas_entrevistador');
		$data['entrevistado']        = $this->input->post('entrevistas_entrevistado');
		$data['fecha']        = $this->input->post('entrevistas_fecha') ? $this->input->post('entrevistas_fecha') : '0000-00-00';

		if ($type == 'insert') {
			$id = $this->entrevistas_model->insert($data);

			if (is_numeric($id)) {
				$return = $id;
			} else {
				$return = FALSE;
			}
		} elseif ($type == 'update'){
			$return = $this->entrevistas_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}