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

		$this->auth->restrict('Preguntas.Gestion.View');
		$this->load->model('preguntas_model', null, true);
		$this->lang->load('preguntas');
		
		Template::set_block('sub_nav', 'gestion/_sub_nav');

		Assets::add_module_js('preguntas', 'preguntas.js');
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
				foreach ($checked as $pid) {
					$result = $this->preguntas_model->delete($pid);
				}

				if ($result) {
					Template::set_message(count($checked) .' '. lang('preguntas_delete_success'), 'success');
				} else {
					Template::set_message(lang('preguntas_delete_failure') . $this->preguntas_model->error, 'error');
				}
			}
		}

		$records = $this->preguntas_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Preguntas');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Preguntas object.
	 *
	 * @return void
	 */
	public function create() {
		$this->auth->restrict('Preguntas.Gestion.Create');
		//echo '<pre>'; print_r($this->input->post()); echo '</pre>'; exit;
		if (isset($_POST['save'])) {
			if ($insert_id = $this->save_preguntas()) {
				// Log the activity
				log_activity($this->current_user->id, lang('preguntas_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'preguntas');

				Template::set_message(lang('preguntas_create_success'), 'success');
				redirect(SITE_AREA .'/gestion/preguntas');
			} else {
				Template::set_message(lang('preguntas_create_failure') . $this->preguntas_model->error, 'error');
			}
		}

		Assets::add_module_js('preguntas', 'preguntas.js');
		Template::set('toolbar_title', lang('preguntas_create') . ' Preguntas');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Preguntas data.
	 *
	 * @return void
	 */
	public function edit() {
		$id = $this->uri->segment(5);

		if (empty($id)) {
			Template::set_message(lang('preguntas_invalid_id'), 'error');
			redirect(SITE_AREA .'/gestion/preguntas');
		}

		if (isset($_POST['save'])) {
			$this->auth->restrict('Preguntas.Gestion.Edit');

			if ($this->save_preguntas('update', $id)){
				// Log the activity
				log_activity($this->current_user->id, lang('preguntas_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'preguntas');

				Template::set_message(lang('preguntas_edit_success'), 'success');
			} else {
				Template::set_message(lang('preguntas_edit_failure') . $this->preguntas_model->error, 'error');
			}
		} else if (isset($_POST['delete'])) {
			$this->auth->restrict('Preguntas.Gestion.Delete');

			if ($this->preguntas_model->delete($id)) {
				// Log the activity
				log_activity($this->current_user->id, lang('preguntas_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'preguntas');

				Template::set_message(lang('preguntas_delete_success'), 'success');

				redirect(SITE_AREA .'/gestion/preguntas');
			} else {
				Template::set_message(lang('preguntas_delete_failure') . $this->preguntas_model->error, 'error');
			}
		}
		Template::set('preguntas', $this->preguntas_model->find($id));
		Template::set('toolbar_title', lang('preguntas_edit') .' Preguntas');
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
	private function save_preguntas($type='insert', $id=0){
		if ($type == 'update'){
			$_POST['pregunta_id'] = $id;
		}

		// make sure we only pass in the fields we want
		//echo '<pre>'; print_r($this->input->post()); echo '</pre>'; exit;

		$data = array();
		$data['descripcion']        = $this->input->post('preguntas_descripcion');
		$data['factor']        = $this->input->post('preguntas_factor');
		$data['tipo_respuesta'] = $this->input->post('tipo_respuesta');
		$respuestas = $this->input->post('campo');
		
		if ($type == 'insert') {
			$id = $this->preguntas_model->insert($data, $respuestas);

			if (is_numeric($id)) {
				$return = $id;
			} else {
				$return = FALSE;
			}
		} elseif ($type == 'update') {
			$return = $this->preguntas_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}