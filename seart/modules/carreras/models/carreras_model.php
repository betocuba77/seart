<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Carreras_model extends BF_Model {

	protected $table_name	= "carreras";
	protected $key			= "carrera_id";
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
	protected $validation_rules = array(
		array(
			"field"		=> "nombre",
			"label"		=> "Nombre",
			"rules"		=> "required|max_length[60]"
		)
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------

	public function find_all(){
		$this->db->from('plan_carrera');
		$this->db->join('carreras', 'carreras.carrera_id = plan_carrera.carrera_id', 'left');
		$query = $this->db->join('planes_de_estudio','planes_de_estudio.plan_id = plan_carrera.plan_id', 'left')->get();
		
		//echo '<pre>'; print_r($query->result()); echo '</pre>'; exit;
		return $query->result();
	}

	public function find_all_asociativo(){
		$query = $this->db->get($this->table_name);
		foreach ($query->result() as $value) {
			$arreglo[$value->carrera_id] = $value->nombre; 
		}
		return $arreglo;
	}

	public function find_all_planes(){
		$query = $this->db->from('planes_de_estudio')->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function insert($data){
		// Verifico que el nombre de carrera ya no exista.
		if ($this->db->from('carreras')->where('nombre', $data['nombre'])->get()->num_rows() > 0) {
			// recupero el id
			$row = $this->db->from('carreras')->where('nombre', $data['nombre'])->get()->row();			
			$id = $row->carrera_id;
		} else {
			$this->db->set('nombre', $data['nombre']);
			$this->db->set('facultad', $data['facultad']);
			$this->db->insert('carreras');
			$id = $this->db->insert_id();	
		}
		
		// Insertamos los datos en la tabla realacionada
		$this->db->set('plan_id', $data['plan']);
		$this->db->set('carrera_id', $id);
		$ids = $this->db->insert('plan_carrera');

		//echo $ids; exit;
		return $ids;
	}

	public function update($id, $data){
		

	}

	public function find($id){
		$this->db->select('nombre, facultad, carreras.carrera_id, planes_de_estudio.plan_id, anio_plan, version, plan_carrera_id');
		$this->db->from('carreras');
		$this->db->where('plan_carrera_id', $id);
		$this->db->join('plan_carrera', 'carreras.carrera_id = plan_carrera.carrera_id', 'left');
		$query = $this->db->join('planes_de_estudio','planes_de_estudio.plan_id = plan_carrera.plan_id', 'left')->get();
		
		return $query->result();
	}

}
