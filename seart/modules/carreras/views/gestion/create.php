<?php

$validation_errors = validation_errors();

if (isset($carreras)){
	$carreras = (array) $carreras;
}
$id = isset($carreras['carrera_id']) ? $carreras['carrera_id'] : '';

?>
<div class="admin-box">
	<h3>Carreras</h3>	
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
			<!--Nombre de la Carrera-->
			<div class="control-group <?php echo form_error('nombre') ? 'error' : ''; ?>">
				<?php echo form_label('Nombre'. lang('bf_form_label_required'), 'nombre', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='nombre' type='text' name='nombre' maxlength="60" value="<?php echo set_value('nombre', isset($carreras['nombre']) ? $carreras['nombre'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nombre'); ?></span>
				</div>
			</div>

			<?php // Change the values in this array to populate your dropdown as required
				$planes = array(
					2007 => '2007',
					2008 => '2008',
					2010 => '2010',
					2013 => '2013',
				);
				echo form_dropdown('plan', $planes, set_value('plan', isset($carreras['plan']) ? $carreras['plan'] : ''), 'Plan de Estudio');				
			?>

			<?php // Change the values in this array to populate your dropdown as required
				$options = array(
					0 => 'Facultad de Ingenier&iacute;a',
					1 => 'Facultad de Ciencias Agrarias',
					2 => 'Facultad de Humanidades y Ciencias Sociales',
					3 => 'Facultad de Ciencias Econ&oacute;micas',
				);

				echo form_dropdown('facultad', $options, set_value('facultad', isset($carreras['facultad']) ? $carreras['facultad'] : ''), 'Facultad');
			?>
			

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('carreras_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/gestion/carreras', lang('carreras_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>