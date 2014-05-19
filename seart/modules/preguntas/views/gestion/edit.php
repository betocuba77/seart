<?php
if (isset($preguntas)) {
	$preguntas = (array) $preguntas;
}
$id = isset($preguntas['pregunta_id']) ? $preguntas['pregunta_id'] : '';

?>
<div class="admin-box">
	<h3>Preguntas</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('descripcion') ? 'error' : ''; ?>">
				<?php echo form_label('Descripcion'. lang('bf_form_label_required'), 'preguntas_descripcion', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'preguntas_descripcion', 'id' => 'preguntas_descripcion', 'rows' => '5', 'cols' => '80', 'value' => set_value('preguntas_descripcion', isset($preguntas['descripcion']) ? $preguntas['descripcion'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('descripcion'); ?></span>
				</div>
			</div>

			<?php // Change the values in this array to populate your dropdown as required
				$factores = array( 1 => 'Vocacional', 2 => 'Académico', 3 => 'Económico', 4 => 'Personal');
				echo form_dropdown('preguntas_factor', $factores, set_value('preguntas_factor', isset($preguntas['factor']) ? $preguntas['factor'] : ''), 'Factor');
			?>

			<?php $i = 0;  foreach ($respuestas as $respuesta) { ?>
				<div class="control-group">
					<label class="control-label">Opción de respuesta: <?= ++$i ?> </label>
					<div class="controls">
						<input style="width:60%" type="text" name="respuestas[<?=  $respuesta->tipo_respuesta_id ?>]" value="<?= $respuesta->descripcion ?>">
					</div>
				</div>		
			<?php }	?>
			
			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('preguntas_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/gestion/preguntas', lang('preguntas_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Preguntas.Gestion.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('preguntas_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('preguntas_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>