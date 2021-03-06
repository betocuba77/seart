<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Preguntas_model extends BF_Model {

	protected $table_name	= "preguntas";
	protected $key			= "pregunta_id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";

	protected $log_user 	= FALSE;

	protected $set_created	= true;
	protected $set_modified = true;
	protected $created_field = "created_on";
	protected $modified_field = "modified_on";

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
	protected $validation_rules 		= array(
		array(
			"field"		=> "preguntas_descripcion",
			"label"		=> "Descripcion",
			"rules"		=> "required"
		),
		array(
			"field"		=> "preguntas_factor",
			"label"		=> "Factor",
			"rules"		=> "max_length[1]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------
	
	public function insert($data, $respuestas){
		// Se inserta las preguntas sin los tipos de respuesta y se recupera el id
		
		$id = parent::insert($data);
		//echo $id; exit;
		if (!empty($respuestas)) {
			foreach ($respuestas as $value) {
				
				$this->db->set('pregunta_id', $id);
				$this->db->set('descripcion', $value);	
				$this->db->set('riesgo', rand(0,1));				
				$this->db->insert('tipos_pregunta');				
			}			
		}
		return $id;
	}

	public function find_respuestas($id){
		$query = $this->db->from('tipos_pregunta')->where('pregunta_id', $id)->get();
		if ($query->num_rows()> 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function update($id, $data, $respuestas){
		foreach ($respuestas as $key => $value) {
			$respuesta = array('pregunta_id' => $id, 'descripcion' => $value);
			$this->db->where('tipo_respuesta_id', $key);
			$this->db->update('tipos_respuesta', $respuesta);
		}
		return parent::update($id, $data);
	}
}
