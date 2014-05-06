<script type="text/javascript">
	var nextinput = 0;
	function AgregarCampos(){
		nextinput++;
		campo = '<li id="rut'+nextinput+'"><div class="control-label">Opcion de respuesta ' + nextinput +'</div><div class="controls"><input type="text" size="20" id="opcion' + nextinput + '"  name="campo[' + nextinput + ']"  /></div></li><br>';
		$("#campos").append(campo);
	}
</script>

<?php
if (isset($preguntas)){
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
				$factores = array( 1 => 'Vocacional', 2 => 'Academico', 3 => 'Economico', 4 => 'Personal');
				echo form_dropdown('preguntas_factor', $factores, set_value('preguntas_factor', isset($preguntas['factor']) ? $preguntas['factor'] : ''), 'Factor');
			?>
			<?php // Change the values in this array to populate your dropdown as required
				$respuesta = array( 1 => 'Opcion única', 2 => 'Opcion múltiple');
				echo form_dropdown('tipo_respuesta', $respuesta, set_value('tipo_respuesta', isset($preguntas['tipo_respuesta']) ? $preguntas['tipo_respuesta'] : ''), 'Tipo de respuesta');
			?>
			<div class="control-group">
				<div class="controls">
					<input type="button" onclick="AgregarCampos();" value="Agregar opcion de respuesta." class="btn">			
				</div>				
			</div>
			<div id="campos"  class="control-group">
				<div class="controls" ></div>
			</div>
				
		</fieldset>
		<fieldset>			
			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('preguntas_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/gestion/preguntas', lang('preguntas_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>