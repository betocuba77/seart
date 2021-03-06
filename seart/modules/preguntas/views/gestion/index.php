<?php
$num_columns	= 3;
$can_delete	= $this->auth->has_permission('Preguntas.Gestion.Delete');
$can_edit		= $this->auth->has_permission('Preguntas.Gestion.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	<h3>Preguntas</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Descripción</th>
					<th>Factor</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('preguntas_delete_confirm'))); ?>')" />
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
					<td class="column-check"><input type="checkbox" name="checked[]" value="<?php echo $record->pregunta_id; ?>" /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/gestion/preguntas/edit/' . $record->pregunta_id, '<span class="icon-pencil"></span>' .  $record->descripcion); ?></td>
				<?php else : ?>
					<td><?php e($record->descripcion); ?></td>
				<?php endif; ?>
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
					endforeach;
				else:
				?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">No se han encontrado registros que coinciden con su selección.</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>