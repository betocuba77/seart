<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * tutorias controller
 */
class tutorias extends Admin_Controller
{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct(){
		parent::__construct();

		$this->auth->restrict('Equipos_de_Trabajo.Tutorias.View');
		$this->load->model('equipos_de_trabajo_model', null, true);
		$this->lang->load('equipos_de_trabajo');
		
		Template::set_block('sub_nav', 'tutorias/_sub_nav');

		Assets::add_module_js('equipos_de_trabajo', 'equipos_de_trabajo.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index(){

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->equipos_de_trabajo_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('equipos_de_trabajo_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('equipos_de_trabajo_delete_failure') . $this->equipos_de_trabajo_model->error, 'error');
				}
			}
		}

		$records = $this->equipos_de_trabajo_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Gestión de Equipos de Trabajo');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Equipos de Trabajo object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Equipos_de_Trabajo.Tutorias.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_equipos_de_trabajo())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('equipos_de_trabajo_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'equipos_de_trabajo');

				Template::set_message(lang('equipos_de_trabajo_create_success'), 'success');
				redirect(SITE_AREA .'/tutorias/equipos_de_trabajo');
			}
			else
			{
				Template::set_message(lang('equipos_de_trabajo_create_failure') . $this->equipos_de_trabajo_model->error, 'error');
			}
		}
		Assets::add_module_js('equipos_de_trabajo', 'equipos_de_trabajo.js');

		Template::set('toolbar_title', lang('equipos_de_trabajo_create') . ' Equipos de Trabajo');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Equipos de Trabajo data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('equipos_de_trabajo_invalid_id'), 'error');
			redirect(SITE_AREA .'/tutorias/equipos_de_trabajo');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Equipos_de_Trabajo.Tutorias.Edit');

			if ($this->save_equipos_de_trabajo('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('equipos_de_trabajo_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'equipos_de_trabajo');

				Template::set_message(lang('equipos_de_trabajo_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('equipos_de_trabajo_edit_failure') . $this->equipos_de_trabajo_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Equipos_de_Trabajo.Tutorias.Delete');

			if ($this->equipos_de_trabajo_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('equipos_de_trabajo_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'equipos_de_trabajo');

				Template::set_message(lang('equipos_de_trabajo_delete_success'), 'success');

				redirect(SITE_AREA .'/tutorias/equipos_de_trabajo');
			}
			else
			{
				Template::set_message(lang('equipos_de_trabajo_delete_failure') . $this->equipos_de_trabajo_model->error, 'error');
			}
		}
		Template::set('equipos_de_trabajo', $this->equipos_de_trabajo_model->find($id));
		Template::set('toolbar_title', lang('equipos_de_trabajo_edit') .' Equipos de Trabajo');
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
	private function save_equipos_de_trabajo($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['equipo_id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['nombre']        = $this->input->post('equipos_de_trabajo_nombre');
		$data['descripcion']        = $this->input->post('equipos_de_trabajo_descripcion');

		if ($type == 'insert')
		{
			$id = $this->equipos_de_trabajo_model->insert($data);

			if (is_numeric($id))
			{
				$return = $id;
			}
			else
			{
				$return = FALSE;
			}
		}
		elseif ($type == 'update')
		{
			$return = $this->equipos_de_trabajo_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}