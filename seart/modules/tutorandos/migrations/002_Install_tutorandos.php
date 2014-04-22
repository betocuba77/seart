<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_tutorandos extends Migration
{
	/**
	 * The name of the database table
	 *
	 * @var String
	 */
	private $table_name = 'tutorandos';

	/**
	 * The table's fields
	 *
	 * @var Array
	 */
	private $fields = array(
		'tutorando_id' => array(
			'type' => 'INT',
			'constraint' => 11,
			'auto_increment' => TRUE,
		),
		'nombre' => array(
			'type' => 'VARCHAR',
			'constraint' => 60,
			'null' => FALSE,
		),
		'apellido' => array(
			'type' => 'VARCHAR',
			'constraint' => 60,
			'null' => FALSE,
		),
		'dni' => array(
			'type' => 'INT',
			'constraint' => 8,
			'null' => FALSE,
		),
		'fecha_nacimiento' => array(
			'type' => 'DATE',
			'null' => FALSE,
			'default' => '0000-00-00',
		),
		'sexo' => array(
			'type' => 'CHAR',
			'constraint' => 1,
			'null' => FALSE,
		),
		'telefono_fijo' => array(
			'type' => 'INT',
			'constraint' => 10,
			'null' => FALSE,
		),
		'telefono_movil' => array(
			'type' => 'INT',
			'constraint' => 10,
			'null' => FALSE,
		),
		'email' => array(
			'type' => 'VARCHAR',
			'constraint' => 100,
			'null' => FALSE,
		),
		'domicilio' => array(
			'type' => 'VARCHAR',
			'constraint' => 150,
			'null' => FALSE,
		),
		'barrio' => array(
			'type' => 'INT',
			'constraint' => 11,
			'null' => FALSE,
		),
		'localidad' => array(
			'type' => 'INT',
			'constraint' => 11,
			'null' => FALSE,
		),
		'departamento' => array(
			'type' => 'INT',
			'constraint' => 11,
			'null' => FALSE,
		),
		'provincia' => array(
			'type' => 'INT',
			'constraint' => 11,
			'null' => FALSE,
		),
		'pais' => array(
			'type' => 'INT',
			'constraint' => 11,
			'null' => FALSE,
		),
		'carrera' => array(
			'type' => 'INT',
			'constraint' => 11,
			'null' => FALSE,
		),
		'lu' => array(
			'type' => 'VARCHAR',
			'constraint' => 10,
			'null' => FALSE,
		),
		'anio_ingreso' => array(
			'type' => 'CHAR',
			'constraint' => 4,
			'null' => FALSE,
		),
		'colegio_secundario' => array(
			'type' => 'VARCHAR',
			'constraint' => 150,
			'null' => FALSE,
		),
			'deleted' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				'default' => '0',
			),
		'creado' => array(
			'type' => 'datetime',
			'default' => '0000-00-00 00:00:00',
		),
		'modificado' => array(
			'type' => 'datetime',
			'default' => '0000-00-00 00:00:00',
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
		$this->dbforge->add_key('tutorando_id', true);
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