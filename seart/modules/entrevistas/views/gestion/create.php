<?php

if (isset($entrevistas)) {
	$entrevistas = (array) $entrevistas;
}
$id = isset($entrevistas['entrevista_id']) ? $entrevistas['entrevista_id'] : '';

?>
<div class="admin-box">
	<h3>Entrevistas</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<?php // Change the values in this array to populate your dropdown as required
				echo form_dropdown('tutor_id', $tutores, set_value('tutor_id', isset($entrevistas['tutor_id']) ? $entrevistas['tutor_id'] : ''), 'Entrevistador');
				echo form_dropdown('tutorando_id', $tutorandos, set_value('tutorando_id', isset($entrevistas['tutorando_id']) ? $entrevistas['tutorando_id'] : ''), 'Entrevistado');
				echo form_dropdown('plantilla_id', $plantillas, set_value('plantilla_id', isset($entrevistas['plantilla_id']) ? $entrevistas['plantilla_id'] : ''), 'Plantilla');

			?>
			<div class="control-group <?php echo form_error('fecha') ? 'error' : ''; ?>">
				<?php echo form_label('Fecha'. lang('bf_form_label_required'), 'fecha', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='fecha' type='text' name='fecha'  value="<?php echo set_value('fecha', isset($entrevistas['fecha']) ? $entrevistas['fecha'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('fecha'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('entrevistas_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/gestion/entrevistas', lang('entrevistas_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>