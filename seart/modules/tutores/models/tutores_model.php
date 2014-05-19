<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
 
class Tutores_model extends BF_Model{

	/**
	 * Name of the table
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected $table_name = 'users';

	/**
	 * Name of the roles table
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected $carreras_table = 'carreras';

	/**
	 * Use soft deletes or not
	 *
	 * @access protected
	 *
	 * @var bool
	 */
	protected $soft_deletes = TRUE;	
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct(){
		parent::__construct();

	}//end __construct()

	//--------------------------------------------------------------------

	/**
	 * Returns all user records, and their associated role information.
	 *
	 * @access public
	 *
	 * @return bool An array of objects with each user's information.
	 */
	public function find_all(){
		if (empty($this->selects)){
			$this->select($this->table_name . '.*, nombre');
		}

		$this->db->where('users.role_id', 7);
		$this->db->join($this->carreras_table, $this->carreras_table . '.carrera_id = ' . $this->table_name . '.carrera', 'left');

		return parent::find_all();

	}//end find_all()

	/**
	 * Counts all users in the system.
	 *
	 * @access public
	 *
	 * @param bool $get_deleted If FALSE, will only return active users. If TRUE, will return both deleted and active users.
	 *
	 * @return int An INT with the number of users found.
	 */
	public function count_all($get_deleted = FALSE){
		$this->db->where('role_id', 7);
		if ($get_deleted){
			// Get only the deleted users
			$this->db->where($this->table_name . '.deleted !=', 0);
		} else {
			$this->db->where($this->table_name . '.deleted', 0);
		}

		return $this->db->count_all_results($this->table_name);

	}//end count_all()

}//end User_model
