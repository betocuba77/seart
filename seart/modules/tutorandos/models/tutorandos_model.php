<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tutorandos_model extends BF_Model {

	protected $table_name	= "tutorandos";
	protected $key			= "tutorando_id";
	protected $soft_deletes	= true;
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
			"field"		=> "tutorandos_nombre",
			"label"		=> "Nombres",
			"rules"		=> "required|max_length[60]"
		),
		array(
			"field"		=> "tutorandos_apellido",
			"label"		=> "Apellido",
			"rules"		=> "required|max_length[60]"
		),
		array(
			"field"		=> "tutorandos_dni",
			"label"		=> "DNI",
			"rules"		=> "required|is_natural|max_length[8]"
		),
		array(
			"field"		=> "tutorandos_fecha_nacimiento",
			"label"		=> "Fecha de Nacimiento",
			"rules"		=> "required"
		),
		array(
			"field"		=> "tutorandos_sexo",
			"label"		=> "Sexo",
			"rules"		=> "required|max_length[1]"
		),
		array(
			"field"		=> "tutorandos_telefono_fijo",
			"label"		=> "Telefono Fijo",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "tutorandos_telefono_movil",
			"label"		=> "Telefono Movil",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "tutorandos_email",
			"label"		=> "Correo Electronico",
			"rules"		=> "required|valid_email|max_length[100]"
		),
		array(
			"field"		=> "tutorandos_domicilio",
			"label"		=> "Domicilio",
			"rules"		=> "required|max_length[150]"
		),
		array(
			"field"		=> "tutorandos_barrio",
			"label"		=> "Barrio",
			"rules"		=> "required|max_length[11]"
		),
		array(
			"field"		=> "tutorandos_localidad",
			"label"		=> "Localidad",
			"rules"		=> "required|max_length[11]"
		),
		array(
			"field"		=> "tutorandos_departamento",
			"label"		=> "Departamento",
			"rules"		=> "required|max_length[11]"
		),
		array(
			"field"		=> "tutorandos_provincia",
			"label"		=> "Provincia",
			"rules"		=> "required|max_length[11]"
		),
		array(
			"field"		=> "tutorandos_pais",
			"label"		=> "Pais",
			"rules"		=> "required|max_length[11]"
		),
		array(
			"field"		=> "tutorandos_carrera",
			"label"		=> "Carrera",
			"rules"		=> "required|max_length[11]"
		),
		array(
			"field"		=> "tutorandos_lu",
			"label"		=> "LU",
			"rules"		=> "required|max_length[10]"
		),
		array(
			"field"		=> "tutorandos_anio_ingreso",
			"label"		=> "Ingreso",
			"rules"		=> "required|max_length[4]"
		),
		array(
			"field"		=> "tutorandos_colegio_secundario",
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
			"rules"		=> "required|max_length[150]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------

	public function find_all(){			
		$this->db->select('tutorando_id, tutorandos.nombre, apellido, telefono_movil, tutorandos.email as correo, surname, id');
		$this->db->from('users');
		$query = $this->db->join('tutorandos','users.id = tutorandos.tutor')->get();
		
		return $query->result();
	}

	// Consulta para recuperar datos que se establecen como valores fijos
	public function find_all_by_tabla($valor){
		$query = $this->db->get($valor);
		foreach ($query->result() as $value) {
			$arreglo[$value->id] = $value->nombre;
		}		
		return $arreglo;
	}
}
