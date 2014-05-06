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

if (isset($entrevistas))
{
	$entrevistas = (array) $entrevistas;
}
$id = isset($entrevistas['entrevista_id']) ? $entrevistas['entrevista_id'] : '';

?>
<div class="admin-box">
	<h3>Entrevistas</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<?php // Change the values in this array to populate your dropdown as required
				$options = array(
					20 => 20,
				);

				echo form_dropdown('entrevistas_entrevistador', $options, set_value('entrevistas_entrevistador', isset($entrevistas['entrevistador']) ? $entrevistas['entrevistador'] : ''), 'Entrevistador');
			?>

			<?php // Change the values in this array to populate your dropdown as required
				$options = array(
					11 => 11,
				);

				echo form_dropdown('entrevistas_entrevistado', $options, set_value('entrevistas_entrevistado', isset($entrevistas['entrevistado']) ? $entrevistas['entrevistado'] : ''), 'Entrevistado');
			?>

			<div class="control-group <?php echo form_error('fecha') ? 'error' : ''; ?>">
				<?php echo form_label('Fecha'. lang('bf_form_label_required'), 'entrevistas_fecha', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='entrevistas_fecha' type='text' name='entrevistas_fecha'  value="<?php echo set_value('entrevistas_fecha', isset($entrevistas['fecha']) ? $entrevistas['fecha'] : ''); ?>" />
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