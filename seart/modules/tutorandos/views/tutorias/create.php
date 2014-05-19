<?php

if (isset($tutorandos)){
	$tutorandos = (array) $tutorandos;
}
$id = isset($tutorandos['tutorando_id']) ? $tutorandos['tutorando_id'] : '';

?>
<div class="admin-box">	
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
			<legend>Datos Personales</legend>
			<!--Nombre del tutorando-->
			<div class="control-group <?php echo form_error('nombre') ? 'error' : ''; ?>">
				<?php echo form_label('Nombres'. lang('bf_form_label_required'), 'nombre', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='nombre' type='text' name='nombre' maxlength="60" value="<?= set_value('nombre') ?>" />
					<span class='help-inline'><?php echo form_error('nombre'); ?></span>
				</div>
			</div>
			<!--Apellido del tutorando-->
			<div class="control-group <?php echo form_error('apellido') ? 'error' : ''; ?>">
				<?php echo form_label('Apellido'. lang('bf_form_label_required'), 'apellido', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='apellido' type='text' name='apellido' maxlength="60" value="<?php echo set_value('apellido'); ?>" />
					<span class='help-inline'><?php echo form_error('apellido'); ?></span>
				</div>
			</div>
			<!--DNI-->
			<div class="control-group <?php echo form_error('dni') ? 'error' : ''; ?>">
				<?php echo form_label('DNI'. lang('bf_form_label_required'), 'dni', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='dni' type='text' name='dni' maxlength="8" value="<?php echo set_value('dni'); ?>" />
					<span class='help-inline'><?php echo form_error('dni'); ?></span>
				</div>
			</div>
			<!--Fecha de Nacimiento-->
			<div class="control-group <?php echo form_error('fecha_nacimiento') ? 'error' : ''; ?>">
				<?php echo form_label('Fecha de Nacimiento'. lang('bf_form_label_required'), 'fecha_nacimiento', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='fecha_nacimiento' type='text' name='fecha_nacimiento'  value="<?php echo set_value('fecha_nacimiento'); ?>" />
					<span class='help-inline'><?php echo form_error('fecha_nacimiento'); ?></span>
				</div>
			</div>

			<?php // Sexo
				$options = array(
					'm' => 'Masculino',
					'f' => 'Femenino',
				);
				echo form_dropdown('sexo', $options, set_value('sexo'), 'Sexo');
			?>
			
			<div class="control-group <?php echo form_error('telefono_fijo') ? 'error' : ''; ?>">
				<?php echo form_label('Telefono Fijo', 'telefono_fijo', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='telefono_fijo' type='text' name='telefono_fijo' maxlength="10" value="<?php echo set_value('telefono_fijo'); ?>" />
					<span class='help-inline'><?php echo form_error('telefono_fijo'); ?></span>
				</div>
			</div>
			<!--Telefono Movil-->
			<div class="control-group <?php echo form_error('telefono_movil') ? 'error' : ''; ?>">
				<?php echo form_label('Telefono Movil', 'telefono_movil', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='telefono_movil' type='text' name='telefono_movil' maxlength="10" value="<?php echo set_value('telefono_movil'); ?>" />
					<span class='help-inline'><?php echo form_error('telefono_movil'); ?></span>
				</div>
			</div>
			<!-- Correo Electronico -->
			<div class="control-group <?php echo form_error('email') ? 'error' : ''; ?>">
				<?php echo form_label('Correo Electr&oacute;nico'. lang('bf_form_label_required'), 'email', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='email' type='text' name='email' value="<?php echo set_value('email'); ?>" />
					<span class='help-inline'><?php echo form_error('email'); ?></span>
				</div>
			</div>
		</fieldset>
		<!--Datos del domicilio actual-->
		<fieldset>	
			<legend>Domicilio Actual</legend>
			<div class="control-group <?php echo form_error('calle') ? 'error' : ''; ?>">
				<?php echo form_label('Calle'. lang('bf_form_label_required'), 'calle', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='calle' type='text' name='calle' value="<?php echo set_value('calle'); ?>" />
					<span class='help-inline'><?php echo form_error('calle'); ?></span>
				</div>
			</div>

			<?php // Change the values in this array to populate your dropdown as required
				echo form_dropdown('barrio_id', $barrios, set_value('barrio_id'), 'Barrio');
				echo form_dropdown('localidad_id', $localidades, set_value('localidad_id'), 'Localidad');
				echo form_dropdown('departamento_id', $departamentos, set_value('departamento_id'), 'Departamento');
				echo form_dropdown('provincia_id', $provincias, set_value('provincia_id'), 'Provincia');
				echo form_dropdown('pais_id', $paises, set_value('pais_id'), 'Pa&iacute;s');
			?>
		</fieldset>
		<fieldset>
			<legend>Datos Acad&eacute;micos - Nivel Universitario</legend>
			<?php // Lista de tutores
				echo form_dropdown('tutor_id', $tutores, set_value('tutor_id'), 'Tutor');
				// Lista de carreras
				echo form_dropdown('carrera_id', $carreras, set_value('carrera_id'), 'Carrera');							
			?>
			<!--LU-->
			<div class="control-group <?php echo form_error('lu') ? 'error' : ''; ?>">
				<?php echo form_label('LU'. lang('bf_form_label_required'), 'lu', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='lu' type='text' name='lu' value="<?php echo set_value('lu'); ?>" />
					<span class='help-inline'><?php echo form_error('lu'); ?></span>
				</div>
			</div>
			<!--Año de Ingreso-->
			<div class="control-group <?php echo form_error('anio_ingreso') ? 'error' : ''; ?>">
				<?php echo form_label('Año de Ingreso'. lang('bf_form_label_required'), 'anio_ingreso', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='anio_ingreso' type='text' name='anio_ingreso' maxlength="4" value="<?php echo set_value('anio_ingreso'); ?>" />
					<span class='help-inline'><?php echo form_error('anio_ingreso'); ?></span>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Datos Acad&eacute;micos - Nivel Secundario</legend>
			<!--Colegio secundario-->
			<div class="control-group <?php echo form_error('colegio_secundario') ? 'error' : ''; ?>">
				<?php echo form_label('Colegio Secundario'. lang('bf_form_label_required'), 'colegio_secundario', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='colegio_secundario' type='text' name='colegio_secundario' maxlength="150" value="<?php echo set_value('colegio_secundario'); ?>" />
					<span class='help-inline'><?php echo form_error('colegio_secundario'); ?></span>
				</div>
			</div>
			<!--Orientacion nivel secundario-->
			<div class="control-group <?php echo form_error('orientacion') ? 'error' : ''; ?>">
				<?php echo form_label('Orientacion'. lang('bf_form_label_required'), 'orientacion', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='orientacion' type='text' name='orientacion' maxlength="150" value="<?php echo set_value('orientacion'); ?>" />
					<span class='help-inline'><?php echo form_error('orientacion'); ?></span>
				</div>
			</div>
			<!--Año de Egreso secundario-->
			<div class="control-group <?php echo form_error('anio_egreso') ? 'error' : ''; ?>">
				<?php echo form_label('Año de Egreso'. lang('bf_form_label_required'), 'anio_egreso', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='anio_egreso' type='text' name='anio_egreso' maxlength="4" value="<?php echo set_value('anio_egreso'); ?>" />
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