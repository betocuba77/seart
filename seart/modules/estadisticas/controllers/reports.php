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
/*
		$datos=array(407,300); // pueden ser los datos a mostrar
		$labels=array("Realizadas","No Realizadas"); //pueden ser los tutores

		$data['title'] = "Using JpGraph from CodeIgniter 1.5";        
        $data['heading'] = "Example 0 in JpGraph 2.1.4";        

        // Setup Chart
        $ydata = array(11,3,8,12,5,1,9,13,5,7); // this should come from the model        
        //$graph = linechart($ydata, 'This is a Line Chart');  // add more parameters to plugin function as required
        $graph = $this->jpgraph->linechart($ydata, 'This is a Line Chart');
        // File locations
        // Could possibly add to config file if necessary
        $graph_temp_directory = 'tmp';  // in the webroot (add directory to .htaccess exclude)
        $graph_file_name = 'test.png';    

        $graph_file_location = $graph_temp_directory . '/' . $graph_file_name;

        $graph->Stroke('./'.$graph_file_location);  // create the graph and write to file

        $data['graph'] = $graph_file_location;*/
        
/*
		$grafico = new Graph(500, 400, 'auto'); //tamaño de la gráfica
		$grafico->SetScale("textlin"); //para que muestre los nros del eje y como enteros, también puede ser textlin
		$grafico->title->Set("Cantidad gral. de entrevistas realizadas"); // es el nombre del gráfico
		$grafico->xaxis->title->Set("ESTADO DE ENTREVISTAS"); // parámetro x
		$grafico->xaxis->SetTickLabels($labels);
		$grafico->yaxis->title->Set("CANTIDAD"); // parámetro y

		$barplot1 =new BarPlot($datos); //los datos que queremos graficar
		$barplot1->SetFillGradient("#BE81F7", "#E3CEF6", GRAD_HOR); //colores en las barras y degradado horizaontal
		$barplot1->SetWidth(30); // 30 pixeles de ancho para cada barra

		$grafico->Add($barplot1); // añade el gráfico
		$grafico->Stroke(); // la traza the graph and write to file
*/
        
        
        //Template::set('grafico', $data);
		Template::set('toolbar_title', 'Estadísticas');
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