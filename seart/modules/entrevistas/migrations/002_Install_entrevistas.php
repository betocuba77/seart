<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_entrevistas extends Migration
{
	/**
	 * The name of the database table
	 *
	 * @var String
	 */
	private $table_name = 'entrevistas';

	/**
	 * The table's fields
	 *
	 * @var Array
	 */
	private $fields = array(
		'entrevista_id' => array(
			'type' => 'INT',
			'constraint' => 11,
			'auto_increment' => TRUE,
		),
		'entrevistador' => array(
			'type' => 'BIGINT',
			'constraint' => 20,
			'null' => FALSE,
		),
		'entrevistado' => array(
			'type' => 'INT',
			'constraint' => 11,
			'null' => FALSE,
		),
		'fecha' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
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
		$this->dbforge->add_key('entrevista_id', true);
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