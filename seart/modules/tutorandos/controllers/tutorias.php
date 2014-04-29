<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * tutorias controller
 */
class tutorias extends Admin_Controller{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct(){
		parent::__construct();

		$this->auth->restrict('Tutorandos.Tutorias.View');
		$this->load->model('tutorandos_model', null, true);
		$this->lang->load('tutorandos');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'tutorias/_sub_nav');

		Assets::add_module_js('tutorandos', 'tutorandos.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index($filter='all', $offset=0){

		// Filters
		if (preg_match('{first_letter-([A-Z])}', $filter, $matches)){
			$filter_type = 'first_letter';
			$first_letter = $matches[1];
		} elseif (preg_match('{role_id-([0-9]*)}', $filter, $matches)) {
			$filter_type = 'role_id';
			$role_id = (int) $matches[1];
		} else {
			$filter_type = $filter;
		}
		$where = array('tutorandos.deleted' => 0);
		switch($filter_type) {
			case 'entrevistados':
				$where['tutorandos.entrevistado'] = 1;
				break;

			case 'noentrevistados':
				$where['tutorandos.entrevistado'] = 0;
				break;

			case 'first_letter':
				$where['SUBSTRING( LOWER(apellido), 1, 1)='] = $first_letter;
				break;

			case 'all':
				// Nothing to do
				break;

			default:
				show_404("tutorandos/index/$filter/");
		}

		$this->tutorandos_model->limit($this->limit, $offset)->where($where);
		$records = $this->tutorandos_model->find_all();

		// Deleting anything?
		if (isset($_POST['delete'])){
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked)){
				$result = FALSE;
				foreach ($checked as $pid){
					$result = $this->tutorandos_model->delete($pid);
				}

				if ($result){
					Template::set_message(count($checked) .' '. lang('tutorandos_delete_success'), 'success');
				} else {
					Template::set_message(lang('tutorandos_delete_failure') . $this->tutorandos_model->error, 'error');
				}
			}
		}

		
		// Pagination
		$this->load->library('pagination');
		
		$total_tutorandos = $this->tutorandos_model->count_all();

		$this->pager['base_url'] = site_url(SITE_AREA ."/tutorias/tutorandos/index/$filter/");
		$this->pager['total_rows'] = $total_tutorandos;
		$this->pager['per_page'] = $this->limit;
		$this->pager['uri_segment']	= 6;

		$this->pagination->initialize($this->pager);

		Template::set('index_url', site_url(SITE_AREA .'/tutorias/tutorandos/index/') .'/');
		Template::set('filter_type', $filter_type);

		Template::set('records', $records);
		Template::set('toolbar_title', 'Gesti&oacute;n de Tutorandos');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Tutorandos object.
	 *
	 * @return void
	 */
	public function create(){
		$this->auth->restrict('Tutorandos.Tutorias.Create');

		if (isset($_POST['save'])){
			if ($insert_id = $this->save_tutorandos()){
				// Log the activity
				log_activity($this->current_user->id, lang('tutorandos_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'tutorandos');

				Template::set_message(lang('tutorandos_create_success'), 'success');
				redirect(SITE_AREA .'/tutorias/tutorandos');
			} else {
				Template::set_message(lang('tutorandos_create_failure') . $this->tutorandos_model->error, 'error');
			}
		}
		Assets::add_module_js('tutorandos', 'tutorandos.js');
		$this->load->model('carreras/carreras_model');		
		
		foreach ($this->carreras_model->find_all() as $value) {
			$carreras[$value->carrera_id] = $value->nombre;
		}		
		foreach ($this->carreras_model->find_all_planes() as $value) {
			$planes[$value->plan_id] = $value->anio_plan.' ±±'.$value->version;
		}
		Template::set('carreras', $carreras );
		Template::set('planes', $planes);
		Template::set('provincias', $this->tutorandos_model->find_all_by_tabla('provincias'));
		Template::set('localidades', $this->tutorandos_model->find_all_by_tabla('localidades'));
		Template::set('departamentos', $this->tutorandos_model->find_all_by_tabla('departamentos'));
		Template::set('paises', $this->tutorandos_model->find_all_by_tabla('paises'));
		Template::set('barrios', $this->tutorandos_model->find_all_by_tabla('barrios'));

		Template::set('toolbar_title', lang('tutorandos_create') . ' Tutorando');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Tutorandos data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('tutorandos_invalid_id'), 'error');
			redirect(SITE_AREA .'/tutorias/tutorandos');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Tutorandos.Tutorias.Edit');

			if ($this->save_tutorandos('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('tutorandos_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'tutorandos');

				Template::set_message(lang('tutorandos_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('tutorandos_edit_failure') . $this->tutorandos_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Tutorandos.Tutorias.Delete');

			if ($this->tutorandos_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('tutorandos_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'tutorandos');

				Template::set_message(lang('tutorandos_delete_success'), 'success');

				redirect(SITE_AREA .'/tutorias/tutorandos');
			}
			else
			{
				Template::set_message(lang('tutorandos_delete_failure') . $this->tutorandos_model->error, 'error');
			}
		}
		Template::set('tutorandos', $this->tutorandos_model->find($id));
		Template::set('toolbar_title', lang('tutorandos_edit') .' Tutorandos');
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
	private function save_tutorandos($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['tutorando_id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['nombre']        = $this->input->post('tutorandos_nombre');
		$data['apellido']        = $this->input->post('tutorandos_apellido');
		$data['dni']        = $this->input->post('tutorandos_dni');
		$data['fecha_nacimiento']        = $this->input->post('tutorandos_fecha_nacimiento') ? $this->input->post('tutorandos_fecha_nacimiento') : '0000-00-00';
		$data['sexo']        = $this->input->post('tutorandos_sexo');
		//$data['telefono_fijo']        = $this->input->post('tutorandos_telefono_fijo');
		//$data['telefono_movil']        = $this->input->post('tutorandos_telefono_movil');
		$data['email']        = $this->input->post('tutorandos_email');
		$data['domicilio']        = $this->input->post('tutorandos_domicilio');
		$data['barrio']        = $this->input->post('tutorandos_barrio');
		$data['localidad']        = $this->input->post('tutorandos_localidad');
		$data['departamento']        = $this->input->post('tutorandos_departamento');
		$data['provincia']        = $this->input->post('tutorandos_provincia');
		$data['pais']        = $this->input->post('tutorandos_pais');
		$data['carrera']        = $this->input->post('tutorandos_carrera');
		$data['lu']        = $this->input->post('tutorandos_lu');
		$data['anio_ingreso']        = $this->input->post('tutorandos_anio_ingreso');
		$data['colegio_secundario']        = $this->input->post('tutorandos_colegio_secundario');
		$data['orientacion']        = $this->input->post('orientacion');
		$data['anio_egreso']        = $this->input->post('anio_egreso');

		if ($type == 'insert')
		{
			$id = $this->tutorandos_model->insert($data);

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
			$return = $this->tutorandos_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}