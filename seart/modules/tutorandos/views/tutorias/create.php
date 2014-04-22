<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

if (isset($tutorandos)){
	$tutorandos = (array) $tutorandos;
}
$id = isset($tutorandos['tutorando_id']) ? $tutorandos['tutorando_id'] : '';

?>
<div class="admin-box">	
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
			<legend>Datos Personales</legend>
			<div class="control-group <?php echo form_error('nombre') ? 'error' : ''; ?>">
				<?php echo form_label('Nombres'. lang('bf_form_label_required'), 'tutorandos_nombre', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tutorandos_nombre' type='text' name='tutorandos_nombre' maxlength="60" value="<?php echo set_value('tutorandos_nombre', isset($tutorandos['nombre']) ? $tutorandos['nombre'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nombre'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('apellido') ? 'error' : ''; ?>">
				<?php echo form_label('Apellido'. lang('bf_form_label_required'), 'tutorandos_apellido', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tutorandos_apellido' type='text' name='tutorandos_apellido' maxlength="60" value="<?php echo set_value('tutorandos_apellido', isset($tutorandos['apellido']) ? $tutorandos['apellido'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('apellido'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('dni') ? 'error' : ''; ?>">
				<?php echo form_label('DNI'. lang('bf_form_label_required'), 'tutorandos_dni', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tutorandos_dni' type='text' name='tutorandos_dni' maxlength="8" value="<?php echo set_value('tutorandos_dni', isset($tutorandos['dni']) ? $tutorandos['dni'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('dni'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('fecha_nacimiento') ? 'error' : ''; ?>">
				<?php echo form_label('Fecha de Nacimiento'. lang('bf_form_label_required'), 'tutorandos_fecha_nacimiento', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tutorandos_fecha_nacimiento' type='text' name='tutorandos_fecha_nacimiento'  value="<?php echo set_value('tutorandos_fecha_nacimiento', isset($tutorandos['fecha_nacimiento']) ? $tutorandos['fecha_nacimiento'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('fecha_nacimiento'); ?></span>
				</div>
			</div>

			<?php // Change the values in this array to populate your dropdown as required
				$options = array(
					'm' => 'Masculino',
					'f' => 'Femenino',
				);

				echo form_dropdown('tutorandos_sexo', $options, set_value('tutorandos_sexo', isset($tutorandos['sexo']) ? $tutorandos['sexo'] : ''), 'Sexo'. lang('bf_form_label_required'));
			?>

			<div class="control-group <?php echo form_error('telefono_fijo') ? 'error' : ''; ?>">
				<?php echo form_label('Telefono Fijo', 'tutorandos_telefono_fijo', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tutorandos_telefono_fijo' type='text' name='tutorandos_telefono_fijo' maxlength="10" value="<?php echo set_value('tutorandos_telefono_fijo', isset($tutorandos['telefono_fijo']) ? $tutorandos['telefono_fijo'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('telefono_fijo'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('telefono_movil') ? 'error' : ''; ?>">
				<?php echo form_label('Telefono Movil', 'tutorandos_telefono_movil', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tutorandos_telefono_movil' type='text' name='tutorandos_telefono_movil' maxlength="10" value="<?php echo set_value('tutorandos_telefono_movil', isset($tutorandos['telefono_movil']) ? $tutorandos['telefono_movil'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('telefono_movil'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('email') ? 'error' : ''; ?>">
				<?php echo form_label('Correo Electronico'. lang('bf_form_label_required'), 'tutorandos_email', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tutorandos_email' type='text' name='tutorandos_email' maxlength="100" value="<?php echo set_value('tutorandos_email', isset($tutorandos['email']) ? $tutorandos['email'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('email'); ?></span>
				</div>
			</div>
		</fieldset>
		<fieldset>	
			<legend>Domicilio Actual</legend>
			<div class="control-group <?php echo form_error('domicilio') ? 'error' : ''; ?>">
				<?php echo form_label('Calle'. lang('bf_form_label_required'), 'tutorandos_domicilio', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tutorandos_domicilio' type='text' name='tutorandos_domicilio' maxlength="150" value="<?php echo set_value('tutorandos_domicilio', isset($tutorandos['domicilio']) ? $tutorandos['domicilio'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('domicilio'); ?></span>
				</div>
			</div>

			<?php // Change the values in this array to populate your dropdown as required
				echo form_dropdown('tutorandos_barrio', $barrios, set_value('tutorandos_barrio', isset($tutorandos['barrio']) ? $tutorandos['barrio'] : ''), 'Barrio'. lang('bf_form_label_required'));
				echo form_dropdown('tutorandos_localidad', $localidades, set_value('tutorandos_localidad', isset($tutorandos['localidad']) ? $tutorandos['localidad'] : ''), 'Localidad'. lang('bf_form_label_required'));
				echo form_dropdown('tutorandos_departamento', $departamentos, set_value('tutorandos_departamento', isset($tutorandos['departamento']) ? $tutorandos['departamento'] : ''), 'Departamento'. lang('bf_form_label_required'));
				echo form_dropdown('tutorandos_provincia', $provincias, set_value('tutorandos_provincia', isset($tutorandos['provincia']) ? $tutorandos['provincia'] : ''), 'Provincia'. lang('bf_form_label_required'));
				echo form_dropdown('tutorandos_pais', $paises, set_value('tutorandos_pais', isset($tutorandos['pais']) ? $tutorandos['pais'] : ''), 'Pa&iacute;s'. lang('bf_form_label_required'));
			?>
		</fieldset>
		<fieldset>
			<legend>Datos Acad&eacute;micos - Nivel Universitario</legend>
			<?php // Change the values in this array to populate your dropdown as required			
				echo form_dropdown('tutorandos_carrera', $carreras, set_value('tutorandos_carrera', isset($tutorandos['carrera']) ? $tutorandos['carrera'] : ''), 'Carrera'. lang('bf_form_label_required'));
			?>

			<div class="control-group <?php echo form_error('lu') ? 'error' : ''; ?>">
				<?php echo form_label('LU'. lang('bf_form_label_required'), 'tutorandos_lu', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tutorandos_lu' type='text' name='tutorandos_lu' maxlength="10" value="<?php echo set_value('tutorandos_lu', isset($tutorandos['lu']) ? $tutorandos['lu'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('lu'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('anio_ingreso') ? 'error' : ''; ?>">
				<?php echo form_label('Año de Ingreso'. lang('bf_form_label_required'), 'tutorandos_anio_ingreso', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tutorandos_anio_ingreso' type='text' name='tutorandos_anio_ingreso' maxlength="4" value="<?php echo set_value('tutorandos_anio_ingreso', isset($tutorandos['anio_ingreso']) ? $tutorandos['anio_ingreso'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('anio_ingreso'); ?></span>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Datos Acad&eacute;micos - Nivel Secundario</legend>
			<div class="control-group <?php echo form_error('colegio_secundario') ? 'error' : ''; ?>">
				<?php echo form_label('Colegio Secundario'. lang('bf_form_label_required'), 'tutorandos_colegio_secundario', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='tutorandos_colegio_secundario' type='text' name='tutorandos_colegio_secundario' maxlength="150" value="<?php echo set_value('tutorandos_colegio_secundario', isset($tutorandos['colegio_secundario']) ? $tutorandos['colegio_secundario'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('colegio_secundario'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('orientacion') ? 'error' : ''; ?>">
				<?php echo form_label('Orientacion'. lang('bf_form_label_required'), 'orientacion', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='orientacion' type='text' name='orientacion' maxlength="150" value="<?php echo set_value('orientacion', isset($tutorandos['orientacion']) ? $tutorandos['orientacion'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('orientacion'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('anio_egreso') ? 'error' : ''; ?>">
				<?php echo form_label('Año de Egreso'. lang('bf_form_label_required'), 'anio_egreso', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='anio_egreso' type='text' name='anio_egreso' maxlength="150" value="<?php echo set_value('anio_egreso', isset($tutorandos['anio_egreso']) ? $tutorandos['anio_egreso'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('anio_egreso'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('tutorandos_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/tutorias/tutorandos', lang('tutorandos_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>