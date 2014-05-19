<?php
if (isset($tutorandos)) {
	$tutorandos = (array) $tutorandos;
}
$id = isset($tutorandos['tutorando_id']) ? $tutorandos['tutorando_id'] : '';

?>
<div class="admin-box">
	<h3>Tutorandos</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
			<legend>Datos personales</legend>
			<div class="control-group <?php echo form_error('nombre') ? 'error' : ''; ?>">
				<?php echo form_label('Nombres'. lang('bf_form_label_required'), 'nombre', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='nombre' type='text' name='nombre' maxlength="60" value="<?php echo set_value('nombre', isset($tutorandos[0]->nombre) ? $tutorandos[0]->nombre : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nombre'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('apellido') ? 'error' : ''; ?>">
				<?php echo form_label('Apellido'. lang('bf_form_label_required'), 'apellido', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='apellido' type='text' name='apellido' maxlength="60" value="<?php echo set_value('apellido', isset($tutorandos[0]->apellido) ? $tutorandos[0]->apellido : ''); ?>" />
					<span class='help-inline'><?php echo form_error('apellido'); ?></span>
				</div>
			</div>
			<!--DNI-->
			<div class="control-group <?php echo form_error('dni') ? 'error' : ''; ?>">
				<?php echo form_label('DNI'. lang('bf_form_label_required'), 'dni', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='dni' type='text' name='dni' maxlength="8" value="<?php echo set_value('dni', isset($tutorandos[0]->dni) ? $tutorandos[0]->dni : ''); ?>" />
					<span class='help-inline'><?php echo form_error('dni'); ?></span>
				</div>
			</div>
			<!--Fecha de Nacimiento-->
			<div class="control-group <?php echo form_error('fecha_nacimiento') ? 'error' : ''; ?>">
				<?php echo form_label('Fecha de Nacimiento'. lang('bf_form_label_required'), 'fecha_nacimiento', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='fecha_nacimiento' type='text' name='fecha_nacimiento'  value="<?php echo set_value('fecha_nacimiento', isset($tutorandos[0]->fecha_nacimiento) ? $tutorandos[0]->fecha_nacimiento : ''); ?>" />
					<span class='help-inline'><?php echo form_error('fecha_nacimiento'); ?></span>
				</div>
			</div>

			<?php // Change the values in this array to populate your dropdown as required
				$options = array(
					'm' => 'Masculino',
					'f' => 'Femenino',
				);

				echo form_dropdown('sexo', $options, set_value('sexo', isset($tutorandos['sexo']) ? $tutorandos['sexo'] : ''), 'Sexo');
			?>

			<div class="control-group <?php echo form_error('telefono_fijo') ? 'error' : ''; ?>">
				<?php echo form_label('Telefono Fijo', 'telefono_fijo', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='telefono_fijo' type='text' name='telefono_fijo' maxlength="10" value="<?php echo set_value('telefono_fijo', isset($tutorandos[0]->telefono_fijo) ? $tutorandos[0]->telefono_fijo : ''); ?>" />
					<span class='help-inline'><?php echo form_error('telefono_fijo'); ?></span>
				</div>
			</div>
			<!--Telefono Movil-->
			<div class="control-group <?php echo form_error('telefono_movil') ? 'error' : ''; ?>">
				<?php echo form_label('Telefono Movil', 'telefono_movil', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='telefono_movil' type='text' name='telefono_movil' maxlength="10" value="<?php echo set_value('telefono_movil', isset($tutorandos[0]->telefono_movil) ? $tutorandos[0]->telefono_movil : ''); ?>" />
					<span class='help-inline'><?php echo form_error('telefono_movil'); ?></span>
				</div>
			</div>
			<!--Correo electronico-->
			<div class="control-group <?php echo form_error('email') ? 'error' : ''; ?>">
				<?php echo form_label('Correo Electronico'. lang('bf_form_label_required'), 'email', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='email' type='text' name='email' maxlength="100" value="<?php echo set_value('email', isset($tutorandos[0]->email) ? $tutorandos[0]->email : ''); ?>" />
					<span class='help-inline'><?php echo form_error('email'); ?></span>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Domicilio Actual</legend>
			<div class="control-group <?php echo form_error('calle') ? 'error' : ''; ?>">
				<?php echo form_label('Domicilio'. lang('bf_form_label_required'), 'calle', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='calle' type='text' name='calle' maxlength="150" value="<?php echo set_value('calle', isset($tutorandos[0]->calle) ? $tutorandos[0]->calle : ''); ?>" />
					<span class='help-inline'><?php echo form_error('calle'); ?></span>
				</div>
			</div>

			<?php // Datos relacionados al domicilio
				echo form_dropdown('barrio_id', $barrios, set_value('barrio_id', isset($tutorandos[0]->barrio_id) ? $tutorandos[0]->barrio_id : ''), 'Barrio');
				echo form_dropdown('localidad_id', $localidades, set_value('localidad_id', isset($tutorandos[0]->localidad_id) ? $tutorandos[0]->localidad_id : ''), 'Localidad');
				echo form_dropdown('departamento_id', $departamentos, set_value('departamento_id', isset($tutorandos[0]->departamento_id) ? $tutorandos[0]->departamento_id : ''), 'Departamento');
				echo form_dropdown('provincia_id', $provincias, set_value('provincia_id', isset($tutorandos[0]->provincia_id) ? $tutorandos[0]->provincia_id : ''), 'Provincia');
				echo form_dropdown('pais_id', $paises, set_value('pais_id', isset($tutorandos[0]->pais_id) ? $tutorandos[0]->pais_id : ''), 'Pais');
			?>			

			</fieldset>
			<fieldset>

			<?php 
				// Lista de tutores
				echo form_dropdown('tutor_id', $tutores, set_value('tutor_id', isset($tutorandos[0]->tutor_id) ? $tutorandos[0]->tutor_id : ''), 'Tutor');
				// LIsta de carreras
				echo form_dropdown('carrera_id', $carreras, set_value('carrera_id', isset($tutorandos[0]->carrera_id) ? $tutorandos[0]->carrera_id : ''), 'Carrera'. lang('bf_form_label_required'));
			?>
		
			<legend>Datos Académicos - Nivel Universitario</legend>
			<div class="control-group <?php echo form_error('lu') ? 'error' : ''; ?>">
				<?php echo form_label('LU'. lang('bf_form_label_required'), 'lu', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='lu' type='text' name='lu' maxlength="10" value="<?php echo set_value('lu', isset($tutorandos[0]->lu) ? $tutorandos[0]->lu : ''); ?>" />
					<span class='help-inline'><?php echo form_error('lu'); ?></span>
				</div>
			</div>
			<!--Año de ingreso-->
			<div class="control-group <?php echo form_error('anio_ingreso') ? 'error' : ''; ?>">
				<?php echo form_label('Ingreso'. lang('bf_form_label_required'), 'anio_ingreso', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='anio_ingreso' type='text' name='anio_ingreso' maxlength="4" value="<?php echo set_value('anio_ingreso', isset($tutorandos[0]->anio_ingreso) ? $tutorandos[0]->anio_ingreso : ''); ?>" />
					<span class='help-inline'><?php echo form_error('anio_ingreso'); ?></span>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Datos Académicos - Nivel Secundario</legend>
			<!--Colegio secundario-->
			<div class="control-group <?php echo form_error('colegio_secundario') ? 'error' : ''; ?>">
				<?php echo form_label('Colegio Secundario'. lang('bf_form_label_required'), 'colegio_secundario', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='colegio_secundario' type='text' name='colegio_secundario' maxlength="150" value="<?php echo set_value('colegio_secundario', isset($tutorandos[0]->colegio_secundario) ? $tutorandos[0]->colegio_secundario : ''); ?>" />
					<span class='help-inline'><?php echo form_error('colegio_secundario'); ?></span>
				</div>
			</div>
			<!--Orientacion secundaria-->
			<div class="control-group <?php echo form_error('orientacion') ? 'error' : ''; ?>">
				<?php echo form_label('Orientacion'. lang('bf_form_label_required'), 'orientacion', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='orientacion' type='text' name='orientacion' maxlength="150" value="<?php echo set_value('orientacion', isset($tutorandos[0]->orientacion) ? $tutorandos[0]->orientacion : ''); ?>" />
					<span class='help-inline'><?php echo form_error('orientacion'); ?></span>
				</div>
			</div>
			<!--Año de egreso secundario-->
			<div class="control-group <?php echo form_error('anio_egreso') ? 'error' : ''; ?>">
				<?php echo form_label('Año de Egreso'. lang('bf_form_label_required'), 'anio_egreso', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='anio_egreso' type='text' name='anio_egreso' maxlength="4" value="<?php echo set_value('anio_egreso', isset($tutorandos[0]->anio_egreso) ? $tutorandos[0]->anio_egreso : ''); ?>" />
					<span class='help-inline'><?php echo form_error('anio_egreso'); ?></span>
				</div>
			</div>
			
			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('tutorandos_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/tutorias/tutorandos', lang('tutorandos_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Tutorandos.Tutorias.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('tutorandos_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('tutorandos_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>