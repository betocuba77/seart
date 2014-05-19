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
		Template::set('toolbar_title', 'Gestion de Entrevistas');
		Template::render();
	}

	//--------------------------------------------------------------------

	public function entrevistar($entrevista, $entrevistador, $entrevistado){
		//echo '<pre>'; print_r($preguntas = $this->entrevistas_model->find_preguntas($entrevista)); echo '</pre>'; exit;

		$preguntas = $this->entrevistas_model->find_preguntas($entrevista);
		//echo '<pre>'; print_r($preguntas); echo '</pre>'; exit;
		if ($this->input->post('save')) {
			//echo '<pre>'; print_r($this->input->post()); echo '</pre>'; exit;
			if ($this->save_entrevista($entrevistador, $entrevistado)) {
				Template::set_message('Respuesta registradas con exito', 'success');
				redirect(SITE_AREA .'/analisis/entrevistas');
			} else {
				Template::set('Las respuestas no fueron registradas'. $this->entrevistas_model->error, 'error');
			}
		}
		// Se recupera los datos del tutor
		$this->load->model('users/user_model');
		$this->load->model('tutorandos/tutorandos_model');
		
		//echo '<pre>'; print_r($preguntas = $this->tutorandos_model->find($entrevistado)); echo '</pre>'; exit;
		Template::set('tutor', $this->user_model->find($entrevistador));
		Template::set('tutorando', $this->tutorandos_model->find($entrevistado));
		Template::set('preguntas', $preguntas = $this->entrevistas_model->find_preguntas($entrevista));
		Template::set('toolbar_title', 'Formulario de Entrevista');
		Template::render();
	}
	//--------------------------------------------------------------------

	public function riesgos($entrevistador , $entrevistado){
		$this->load->model('users/user_model');
		$this->load->model('tutorandos/tutorandos_model');

		Template::set('resultados', $this->entrevistas_model->analisis_riesgos($entrevistado));
		Template::set('tutor', $this->user_model->find($entrevistador));
		Template::set('tutorando', $this->tutorandos_model->find($entrevistado));
		//echo '<pre>'; print_r($this->user_model->find($entrevistador)); echo '</pre>'; exit;
		Template::set('toolbar_title', 'An&aacute;lisis de Riesgos');
		Template::render();
	}
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
	private function save_entrevista($entrevistado){
		// Recorremos el array de respuestas seleccionadas
		foreach ($this->input->post() as $value => $key)  {
			// Se toma el primer caracter recibido, si es r entonces se evalua las respuestas
			$letra = substr($value, 0, 1);
			$respuesta_id = substr($value, 1);
			if ($letra == 'r') {
				$crudo = array(
					'tutorando_id' => $entrevistado , 
					'respuesta_id' => $respuesta_id, 
					'respuesta' => $key);

				//echo '<pre>'; print_r($crudo); echo '</pre>'; exit;
				// Guardamos el resultado en la tabla respuestas
				$this->entrevistas_model->insert_respuesta_crudo($crudo);

				// recorremos el arreglo de las opciones de respuesta de cada respuesta
				foreach ($this->input->post("$respuesta_id") as $valor => $clave) {
					$opciones = array(
						'tutorando_id' => $entrevistado,
						'respuesta_id' => $respuesta_id,
						'tipo_respuesta_id' => $clave);

					// Guardamos en la tabla tipos_respuesta
					$this->entrevistas_model->insert_respuesta_opciones($opciones);
				}
				//echo '<pre>'; print_r($opciones); echo '</pre>'; exit;			

			}			
		}

		return TRUE;		
	}

	//--------------------------------------------------------------------


}