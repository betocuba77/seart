<?php

$num_columns	= 4;
$can_delete	= $this->auth->has_permission('Entrevistas.Gestion.Delete');
$can_edit		= $this->auth->has_permission('Entrevistas.Gestion.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	<h3>Entrevistas</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					<th>ID</th>
					<th>Entrevistador</th>
					<th>Entrevistado</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('entrevistas_delete_confirm'))); ?>')" />
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
					<td class="column-check"><input type="checkbox" name="checked[]" value="<?php echo $record->entrevista_id; ?>" /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/gestion/entrevistas/edit/' . $record->entrevista_id, '<span class="icon-pencil"></span>' .  $record->entrevista_id); ?></td>
				<?php else : ?>
					<td><?php e($record->entrevista_id); ?></td>
				<?php endif; ?>
					<td><?php e($record->surname.' '.$record->name); ?></td>
					<td><?php e($record->apellido).' '.e($record->apellido) ?></td>
					<td><?php e($record->fecha) ?></td>
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