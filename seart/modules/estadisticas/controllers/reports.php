<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * reports controller
 */
class reports extends Admin_Controller{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct(){
		parent::__construct();
		$this->load->library('jpgraph');
		$this->auth->restrict('Estadisticas.Reports.View');
		$this->lang->load('estadisticas');
		
		Template::set_block('sub_nav', 'reports/_sub_nav');

		Assets::add_module_js('estadisticas', 'estadisticas.js');
		Assets::add_module_js('estadisticas', 'morris.js');
		Assets::add_module_css('estadisticas', 'morris.css');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index(){

		Template::set('toolbar_title', 'Entrevistas realizadas');
		Template::render();
	}

	public function entrevistas_tutor(){

		Template::set('toolbar_title', 'Entrevistas por tutor');
		Template::render();
	}

	public function tutorandos_riesgos(){

		Template::set('toolbar_title', 'Riesgos de tutorandos');
		Template::render();
	}

	public function riesgos_institucionales(){

		Template::set('toolbar_title', 'Indicadores de riesgos');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Estadisticas object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Estadisticas.Reports.Create');

		Assets::add_module_js('estadisticas', 'estadisticas.js');

		Template::set('toolbar_title', lang('estadisticas_create') . ' Estadisticas');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Estadisticas data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('estadisticas_invalid_id'), 'error');
			redirect(SITE_AREA .'/reports/estadisticas');
		}

		Template::set('toolbar_title', lang('estadisticas_edit') .' Estadisticas');
		Template::render();
	}

	//--------------------------------------------------------------------



}