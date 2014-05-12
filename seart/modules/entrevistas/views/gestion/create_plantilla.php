<div class="admin-box">
	<?php echo form_open($this->uri->uri_string(),'class="form-horizontal"'); ?>
	<h4>Nueva Plantilla</h4>

	<div class="control-group <?php echo form_error('fecha') ? 'error' : ''; ?>">
		<?php echo form_label('Año', 'anio', array('class' => 'control-label') ); ?>
		<div class='controls'>
			<input id='anio' type='text' name='anio'  value="" />
				<span class='help-inline'><?php echo form_error('fecha'); ?></span>
		</div>
	</div>

	<div class="control-group <?php echo form_error('descripcion') ? 'error' : ''; ?>">
		<?php echo form_label('Descripcion', 'descripcion', array('class' => 'control-label') ); ?>
		<div class='controls'>
			<?php echo form_textarea( array( 'name' => 'descripcion', 'id' => 'descripcion', 'rows' => '5', 'cols' => '180', 'value' => set_value('descripcion', isset($preguntas['descripcion']) ? $preguntas['descripcion'] : '') ) ); ?>
			<span class='help-inline'><?php echo form_error('descripcion'); ?></span>
		</div>
	</div>
	<br>
	<h4>Listado de preguntas</h4>	
		<table class="table table-striped">
			<thead>
				<tr>					
					<th class="column-check"><input class="check-all" type="checkbox" /></th>				
					<th>Descripción</th>
					<th>Factor</th>
				</tr>
			</thead>			
			<tbody>
				<?php
				
					foreach ($records as $record) :
				?>
				<tr>					
					<td class="column-check"><input type="checkbox" name="checked[]" value="<?php echo $record->pregunta_id; ?>" /></td>		
					<td><?php echo anchor(SITE_AREA . '/gestion/preguntas/edit/' . $record->pregunta_id, $record->descripcion); ?></td>			
					<td>
						<?php switch ($record->factor) {
							case 1 : echo 'Vocacional'; break;
							case 2 : echo 'Académico'; break;
							case 3 : echo 'Económico'; break;
							case 4 : echo 'Personal'; break;
						} 
						?>
					</td>
				</tr>
				<?php
					endforeach; ?>
				
			</tbody>
		</table>

		<div class="form-actions">
			<input type="submit" name="save" class="btn btn-primary" value="Guardar Plantilla"  />
			<?php echo lang('bf_or'); ?>
			<?php echo anchor(SITE_AREA .'/gestion/preguntas', 'Cancelar', 'class="btn btn-warning"'); ?>				
		</div>

	<?php echo form_close(); ?>
</div>