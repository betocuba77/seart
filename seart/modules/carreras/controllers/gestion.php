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

		$this->auth->restrict('Carreras.Gestion.View');
		$this->load->model('carreras_model', null, true);
		$this->lang->load('carreras');
		
		Template::set_block('sub_nav', 'gestion/_sub_nav');

		Assets::add_module_js('carreras', 'carreras.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()	{

		// Deleting anything?
		if (isset($_POST['delete'])){
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked)){
				$result = FALSE;
				foreach ($checked as $pid){
					$result = $this->carreras_model->delete($pid);
				}

				if ($result){
					Template::set_message(count($checked) .' '. lang('carreras_delete_success'), 'success');
				} else {
					Template::set_message(lang('carreras_delete_failure') . $this->carreras_model->error, 'error');
				}
			}
		}

		$records = $this->carreras_model->find_all();		
		Template::set('records', $records);
		Template::set('toolbar_title', 'Gesti&oacute;n de Carreras');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Carreras object.
	 *
	 * @return void
	 */
	public function create() {
		$this->auth->restrict('Carreras.Gestion.Create');

		if (isset($_POST['save'])) {			
			if ($insert_id = $this->save_carreras()){
				// Log the activity
				log_activity($this->current_user->id, lang('carreras_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'carreras');

				Template::set_message(lang('carreras_create_success'), 'success');
				redirect(SITE_AREA .'/gestion/carreras');
			} else {
				Template::set_message(lang('carreras_create_failure') . $this->carreras_model->error, 'error');
			}
		}
		foreach ($this->carreras_model->find_all_planes() as  $value) {
			$planes[$value->plan_id] = $value->anio_plan.' '.$value->version; 
		}
		Assets::add_module_js('carreras', 'carreras.js');
		Template::set('planes', $planes );
		Template::set('toolbar_title', lang('carreras_create') . ' Carrera');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Carreras data.
	 *
	 * @return void
	 */
	public function edit(){
		$id = $this->uri->segment(5);

		if (empty($id)){
			Template::set_message(lang('carreras_invalid_id'), 'error');
			redirect(SITE_AREA .'/gestion/carreras');
		}

		if (isset($_POST['save'])){
			$this->auth->restrict('Carreras.Gestion.Edit');

			if ($this->save_carreras('update', $id)){
				// Log the activity
				log_activity($this->current_user->id, lang('carreras_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'carreras');

				Template::set_message(lang('carreras_edit_success'), 'success');
			} else {
				Template::set_message(lang('carreras_edit_failure') . $this->carreras_model->error, 'error');
			}
		}
		else if (isset($_POST['delete'])) {
			$this->auth->restrict('Carreras.Gestion.Delete');

			if ($this->carreras_model->delete($id)) {
				// Log the activity
				log_activity($this->current_user->id, lang('carreras_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'carreras');

				Template::set_message(lang('carreras_delete_success'), 'success');

				redirect(SITE_AREA .'/gestion/carreras');
			} else {
				Template::set_message(lang('carreras_delete_failure') . $this->carreras_model->error, 'error');
			}
		}

		foreach ($this->carreras_model->find_all_planes() as  $value) {
			$planes[$value->plan_id] = $value->anio_plan.' '.$value->version; 
		}
		
			
		Template::set('planes', $planes );		
		Template::set('carreras', $this->carreras_model->find($id));
		Template::set('toolbar_title', lang('carreras_edit') .' Carreras');
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
	private function save_carreras($type='insert', $id=0){
		if ($type == 'update'){
			$_POST['carrera_id'] = $id;
		}		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['nombre']        = $this->input->post('nombre');
		$data['plan'] =  $this->input->post('plan');
		$data['facultad']   = $this->input->post('facultad');

		if ($type == 'insert'){
			$id = $this->carreras_model->insert($data);
			if (is_numeric($id)){
				$return = $id;
			} else {
				$return = FALSE;
			}
		} elseif ($type == 'update'){
			$return = $this->carreras_model->update($id, $data);
		}
		//echo $id; exit;
		return $return;
	}

	//--------------------------------------------------------------------


}