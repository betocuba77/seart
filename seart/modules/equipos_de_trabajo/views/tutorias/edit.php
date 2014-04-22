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

if (isset($equipos_de_trabajo))
{
	$equipos_de_trabajo = (array) $equipos_de_trabajo;
}
$id = isset($equipos_de_trabajo['equipo_id']) ? $equipos_de_trabajo['equipo_id'] : '';

?>
<div class="admin-box">
	<h3>Equipos de Trabajo</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('nombre') ? 'error' : ''; ?>">
				<?php echo form_label('Nombre del Equipo'. lang('bf_form_label_required'), 'equipos_de_trabajo_nombre', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='equipos_de_trabajo_nombre' type='text' name='equipos_de_trabajo_nombre' maxlength="100" value="<?php echo set_value('equipos_de_trabajo_nombre', isset($equipos_de_trabajo['nombre']) ? $equipos_de_trabajo['nombre'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('nombre'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('descripcion') ? 'error' : ''; ?>">
				<?php echo form_label('Descripcion', 'equipos_de_trabajo_descripcion', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'equipos_de_trabajo_descripcion', 'id' => 'equipos_de_trabajo_descripcion', 'rows' => '5', 'cols' => '80', 'value' => set_value('equipos_de_trabajo_descripcion', isset($equipos_de_trabajo['descripcion']) ? $equipos_de_trabajo['descripcion'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('descripcion'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('equipos_de_trabajo_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/tutorias/equipos_de_trabajo', lang('equipos_de_trabajo_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Equipos_de_Trabajo.Tutorias.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('equipos_de_trabajo_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('equipos_de_trabajo_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>