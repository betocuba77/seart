<?php

$validation_errors = validation_errors();

if (isset($carreras)){
	$carreras = (array) $carreras;
}
$id = isset($carreras[0]->plan_carrera_id) ? $carreras[0]->plan_carrera_id : '';

?>
<div class="admin-box">
	<h3>Carreras</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('nombre') ? 'error' : ''; ?>">
				<?php echo form_label('Nombre'. lang('bf_form_label_required'), 'nombre', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='nombre' type='text' name='nombre' maxlength="60" value="<?php echo set_value('nombre', isset($carreras[0]->nombre) ? $carreras[0]->nombre : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nombre'); ?></span>
				</div>
			</div>
			<?php
				echo form_dropdown('plan', $planes, set_value('plan', isset($carreras[0]->plan_id) ? $carreras[0]->plan_id : ''), 'Plan de Estudio');				
			?>

			<?php // Change the values in this array to populate your dropdown as required
				$options = array(
					0 => 'Facultad de Ingenier&iacute;a',
					1 => 'Facultad de Ciencias Agrarias',
					2 => 'Facultad de Humanidades y Ciencias Sociales',
					3 => 'Facultad de Ciencias Econ&oacute;micas',
				);

				echo form_dropdown('facultad', $options, set_value('facultad', isset($carreras[0]->facultad) ? $carreras[0]->facultad : ''), 'Facultad');
			?>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('carreras_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/gestion/carreras', lang('carreras_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Carreras.Gestion.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('carreras_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('carreras_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>