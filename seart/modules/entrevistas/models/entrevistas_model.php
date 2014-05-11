<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Entrevistas_model extends BF_Model {

	protected $table_name	= "entrevistas";
	protected $key			= "entrevista_id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";

	protected $log_user 	= FALSE;

	protected $set_created	= false;
	protected $set_modified = false;

	/*
		Customize the operations of the model without recreating the insert, update,
		etc methods by adding the method names to act as callbacks here.
	 */
	protected $before_insert 	= array();
	protected $after_insert 	= array();
	protected $before_update 	= array();
	protected $after_update 	= array();
	protected $before_find 		= array();
	protected $after_find 		= array();
	protected $before_delete 	= array();
	protected $after_delete 	= array();

	/*
		For performance reasons, you may require your model to NOT return the
		id of the last inserted row as it is a bit of a slow method. This is
		primarily helpful when running big loops over data.
	 */
	protected $return_insert_id 	= TRUE;

	// The default type of element data is returned as.
	protected $return_type 			= "object";

	// Items that are always removed from data arrays prior to
	// any inserts or updates.
	protected $protected_attributes = array();

	/*
		You may need to move certain rules (like required) into the
		$insert_validation_rules array and out of the standard validation array.
		That way it is only required during inserts, not updates which may only
		be updating a portion of the data.
	 */
	
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------
	
	public function insert_plantilla($data, $preguntas){

		// Insertamos los datos de la plantilla
		$id = $this->db->insert('plantillas',$data);
		if (is_array($preguntas)) {
			foreach ($preguntas as $key => $value) {
				$pregunta = array('pregunta_id' => $value, 'plantilla_id' => $id);				
				$this->db->insert('plantilla_pregunta', $pregunta);
			}
		}

		return $id;
	}

	public function find_all_plantillas(){
		return $this->db->get('plantillas')->result();
	}

	public function find_all(){
		$query = 'SELECT u.name, u.surname, t.nombre, t.apellido, e.entrevista_id, u.role_id, e.fecha FROM st_users as u, st_entrevistas as e, st_tutorandos as t WHERE u.id = e.entrevistador AND t.tutorando_id = e.entrevistado AND u.role_id = 7'; 
		$query = $this->db->query($query);

		return $query->result();
	}

	public function find_all_tutorandos($id){
		$query = 'SELECT u.name, u.surname, t.nombre, t.apellido, e.entrevista_id, t.tutorando_id, u.id, u.role_id, e.fecha FROM st_users as u, st_entrevistas as e, st_tutorandos as t WHERE u.id = e.entrevistador AND t.tutorando_id = e.entrevistado AND u.role_id = 7 AND u.id ='.$id; 
		$query = $this->db->query($query);

		return $query->result();	
	}

	// funcion que recupera las preguntas de determinada entrevvista
	public function preguntas($id){

	}
}
