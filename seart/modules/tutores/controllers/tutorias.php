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

		$this->auth->restrict('Tutores.Tutorias.View');
		$this->load->model('tutores_model');
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
	public function index($filter='all', $offset=0){
		
		$this->auth->restrict('Tutores.Tutorias.View');		

		// Actions done, now display the view
		$where = array('users.deleted' => 0);

		// Filtros
		if (preg_match('{first_letter-([A-Z])}', $filter, $matches)){
			$filter_type = 'first_letter';
			$first_letter = $matches[1];
		} else {
			$filter_type = $filter;
		}

		switch($filter_type) {			

			case 'first_letter':
				$where['SUBSTRING( LOWER(surname), 1, 1)='] = $first_letter;
				break;
			case 'all':
				// Nothing to do
				break;
			default:
				show_404("users/index/$filter/");
		}

		// Fetch the users to display
		$this->tutores_model->limit($this->limit, $offset)->where($where);				

		// Pagination
		$this->load->library('pagination');
		
		$total_tutores = $this->tutores_model->count_all();

		$this->pager['base_url'] = site_url(SITE_AREA ."/tutorias/tutores/index/$filter/");
		$this->pager['total_rows'] = $total_tutores;
		$this->pager['per_page'] = $this->limit;
		$this->pager['uri_segment']	= 6;

		$this->pagination->initialize($this->pager);

		Template::set('index_url', site_url(SITE_AREA .'/tutorias/tutores/index/') .'/');
		Template::set('filter_type', $filter_type);

		// se recuperan a todos los tutores, rol=7
		Template::set('tutores',$this->tutores_model->find_all());		
		Template::set('toolbar_title', 'Gesti&oacute;n de Tutores');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Tutores object.
	 *
	 * @return void
	 */
	public function create(){
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
	public function edit(){
		$id = $this->uri->segment(5);

		if (empty($id)){
			Template::set_message(lang('tutores_invalid_id'), 'error');
			redirect(SITE_AREA .'/tutorias/tutores');
		}

		Template::set('toolbar_title', lang('tutores_edit') .' Tutores');
		Template::render();
	}

	//--------------------------------------------------------------------



}