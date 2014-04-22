<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_carreras extends Migration
{
	/**
	 * The name of the database table
	 *
	 * @var String
	 */
	private $table_name = 'carreras';

	/**
	 * The table's fields
	 *
	 * @var Array
	 */
	private $fields = array(
		'carrera_id' => array(
			'type' => 'INT',
			'constraint' => 11,
			'auto_increment' => TRUE,
		),
		'nombre' => array(
			'type' => 'VARCHAR',
			'constraint' => 60,
			'null' => FALSE,
		),
		'facultad' => array(
			'type' => 'CHAR',
			'constraint' => 1,
			'null' => FALSE,
		),
	);

	/**
	 * Install this migration
	 *
	 * @return void
	 */
	public function up()
	{
		$this->dbforge->add_field($this->fields);
		$this->dbforge->add_key('carrera_id', true);
		$this->dbforge->create_table($this->table_name);
	}

	//--------------------------------------------------------------------

	/**
	 * Uninstall this migration
	 *
	 * @return void
	 */
	public function down()
	{
		$this->dbforge->drop_table($this->table_name);
	}

	//--------------------------------------------------------------------

}