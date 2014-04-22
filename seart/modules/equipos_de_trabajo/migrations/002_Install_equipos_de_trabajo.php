<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_equipos_de_trabajo extends Migration
{
	/**
	 * The name of the database table
	 *
	 * @var String
	 */
	private $table_name = 'equipos_de_trabajo';

	/**
	 * The table's fields
	 *
	 * @var Array
	 */
	private $fields = array(
		'equipo_id' => array(
			'type' => 'INT',
			'constraint' => 11,
			'auto_increment' => TRUE,
		),
		'nombre' => array(
			'type' => 'VARCHAR',
			'constraint' => 100,
			'null' => FALSE,
		),
		'descripcion' => array(
			'type' => 'TEXT',
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
		$this->dbforge->add_key('equipo_id', true);
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