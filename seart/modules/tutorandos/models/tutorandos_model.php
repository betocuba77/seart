<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tutorandos_model extends BF_Model {

	protected $table_name	= "tutorandos";
	protected $key			= "tutorando_id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";

	protected $log_user 	= FALSE;

	protected $set_created	= true;
	protected $set_modified = true;
	protected $created_field = "creado";
	protected $modified_field = "modificado";

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
			"field"		=> "nombre",
			"label"		=> "Nombres",
			"rules"		=> "required|max_length[60]"
		),
		array(
			"field"		=> "apellido",
			"label"		=> "Apellido",
			"rules"		=> "required|max_length[60]"
		),
		array(
			"field"		=> "dni",
			"label"		=> "DNI",
			"rules"		=> "required|is_natural|max_length[8]"
		),
		array(
			"field"		=> "fecha_nacimiento",
			"label"		=> "Fecha de Nacimiento",
			"rules"		=> "required"
		),
		array(
			"field"		=> "sexo",
			"label"		=> "Sexo",
			"rules"		=> "max_length[1]"
		),
		array(
			"field"		=> "telefono_fijo",
			"label"		=> "Telefono Fijo",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "telefono_movil",
			"label"		=> "Telefono Movil",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "email",
			"label"		=> "Correo Electronico",
			"rules"		=> "required|valid_email|max_length[100]"
		),
		array(
			"field"		=> "calle",
			"label"		=> "Calle",
			"rules"		=> "required"
		),		
		array(
			"field"		=> "lu",
			"label"		=> "LU",
			"rules"		=> "required|max_length[10]"
		),
		array(
			"field"		=> "anio_ingreso",
			"label"		=> "Año de Ingreso",
			"rules"		=> "required|max_length[4]"
		),
		array(
			"field"		=> "colegio_secundario",
			"label"		=> "Colegio Secundario",
			"rules"		=> "required|max_length[150]"
		),
		array(
			"field"		=> "orientacion",
			"label"		=> "Orientacion",
			"rules"		=> "required|max_length[150]"
		),
		array(
			"field"		=> "anio_egreso",
			"label"		=> "Año de Egreso",
			"rules"		=> "required|max_length[4]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------
	// Consulta de todos los datos de los tutores
	public function find_all_tutores(){
		$query = $this->db->from('users')->where('role_id', 7)->get();
		foreach ($query->result() as $row) {
			$tutor[$row->id] = $row->surname.' '.$row->name;
		}
		return $tutor;
	}
	
	// Consulta de los datos seleccionados de todos los tutorandos
	public function find_all(){			
		$this->db->select('tutorando_id, tutorandos.nombre, apellido, telefono_movil, tutorandos.email as correo, surname, id');
		$this->db->from('users');
		$query = $this->db->join('tutorandos','users.id = tutorandos.tutor_id','inner')->get();
		
		return $query->result();
	}
	
	// Consulta de los datos de un tutorando
	public function find($id){
		// Seleccion de elementos a recuperar
		$this->db->select('tutorandos.nombre, apellido, fecha_nacimiento, dni, telefono_movil, telefono_fijo, email, carreras.nombre as carrera_nombre,
			colegio_secundario, anio_egreso, orientacion, tutorando_id, tutorandos.lu, anio_ingreso, anio_egreso, calle' );
		
		$this->db->from('tutorandos');
		$this->db->where('tutorandos.tutorando_id', $id);
		// Union de las tablas tutorandos y carreras
		$this->db->join('carreras', 'carreras.carrera_id = tutorandos.carrera_id', 'left');
		// Union de las tablas tutorandos y domicilios
		$query = $this->db->join('domicilios','tutorandos.tutorando_id = domicilios.persona_id', 'left')->get();
		if($query->num_rows()>0){
			return $query->result();
		} else {
			return FALSE;
		}
	}
	// Consulta de datos de diferentes tablas, la cual el nombre de cada tabla se recibe como parametro
	// Se retorna un arreglo asociativo de clave => valor
	public function find_all_by_tabla($valor){
		
		$query = $this->db->get($valor);
		foreach ($query->result() as $value) {
			$arreglo[$value->id] = $value->nombre;
		}		
		return $arreglo;
	}
	
	// Insertar datos del tutorando en conjunto con sus datos de domicilio
	public function insert($data, $datos_domicilio){		
		
		$id = parent::insert($data);
		$domicilio = array(
				'persona_id' => $id,
				'calle' => $datos_domicilio['calle'],
				'barrio_id' => $datos_domicilio['barrio_id'],
				'localidad_id' => $datos_domicilio['localidad_id'],
				'departamento_id' => $datos_domicilio['departamento_id'],
				'provincia_id' => $datos_domicilio['provincia_id'],
				'pais_id' => $datos_domicilio['pais_id']
			);		
		
		$id = $this->db->insert('domicilios', $domicilio);		
		return $id;
	}
	
	// Actualiza datos
	public function update($id, $data, $datos_domicilio){
		// Actualizamos los datos de domicilio
		$domicilio = array(
				'persona_id' => $id,
				'calle' => $datos_domicilio['calle'],
				'barrio_id' => $datos_domicilio['barrio_id'],
				'localidad_id' => $datos_domicilio['localidad_id'],
				'departamento_id' => $datos_domicilio['departamento_id'],
				'provincia_id' => $datos_domicilio['provincia_id'],
				'pais_id' => $datos_domicilio['pais_id']
			);	
		$this->db->update('domicilios', $domicilio, array('persona_id' => $id));
		
		// actualizamos los datos personales
		$this->db->where('tutorando_id', $id);
		return $this->db->update($this->table_name, $data);
	}
	
	// Borrar los datos del tutorando en conjunto con los de domicilio
	public function delete($id){
		// Borra el registro domicilio del tutorando
		$this->db->delete('domicilios', array('persona_id' => $id));
		
		// Borra los datos del tutorando
		return parent::delete($id);
	}
}
