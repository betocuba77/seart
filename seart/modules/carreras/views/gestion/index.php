<?php

$num_columns	= 3;
$can_delete	= $this->auth->has_permission('Carreras.Gestion.Delete');
$can_edit		= $this->auth->has_permission('Carreras.Gestion.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	<h3>Carreras</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Nombre</th>
					<th>Plan de Estudio</th>
					<th>Facultad</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('carreras_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					<?php if ($can_delete) : ?>
					<td class="column-check"><input type="checkbox" name="checked[]" value="<?php echo $record->carrera_id; ?>" /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/gestion/carreras/edit/' . $record->carrera_id, '<span class="icon-pencil"></span>' .  $record->nombre); ?></td>
				<?php else : ?>
					<td><?php e($record->nombre); ?></td>
				<?php endif; ?>
					<td><?php e($record->anio_plan.' '.$record->version) ?></td>
					<td><?php switch ($record->facultad) {
						case '0': echo 'Facultad de Ingenier&iacute;a'; break;
						case '0': echo 'Facultad de Ingenier&iacute;a'; break;
						case '0': echo 'Facultad de Ingenier&iacute;a'; break;
						case '0': echo 'Facultad de Ingenier&iacute;a'; break;						
						}
					?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">No records found that match your selection.</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>