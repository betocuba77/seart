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
	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Tutores.Tutorias.View');
		$this->lang->load('tutores');
		
		Template::set_block('sub_nav', 'tutorias/_sub_nav');

		Assets::add_module_js('tutores', 'tutores.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		Template::set('toolbar_title', 'Manage Tutores');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Tutores object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Tutores.Tutorias.Create');

		Assets::add_module_js('tutores', 'tutores.js');

		Template::set('toolbar_title', lang('tutores_create') . ' Tutores');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Tutores data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('tutores_invalid_id'), 'error');
			redirect(SITE_AREA .'/tutorias/tutores');
		}

		Template::set('toolbar_title', lang('tutores_edit') .' Tutores');
		Template::render();
	}

	//--------------------------------------------------------------------



}