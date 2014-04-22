<?php

$num_columns	= 22;
$can_delete	= $this->auth->has_permission('Tutorandos.Tutorias.Delete');
$can_edit		= $this->auth->has_permission('Tutorandos.Tutorias.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="well shallow-well">
	<span class="filter-link-list">
		<?php
		// If there's a current filter, we need to replace the caption with a clear button
		if ($filter_type == 'first_letter') :
			echo anchor($index_url, lang('bf_clear'), array('class' => 'btn btn-small btn-primary'));
		else :
			e(lang('tutorandos_filter_first_letter'));
		endif;

		$letters = range('A', 'Z');
		foreach ($letters as $letter) :
			echo anchor($index_url . 'first_letter-' . $letter, $letter) . PHP_EOL;
		endforeach;
		?>
	</span>
</div>
<ul class="nav nav-tabs" >
	<li<?php echo $filter_type == 'all' ? ' class="active"' : ''; ?>><?php echo anchor($index_url, lang('tutorandos_tab_all')); ?></li>	
	<li<?php echo $filter_type == 'entrevistados' ? ' class="active"' : ''; ?>><?php echo anchor($index_url . 'entrevistados/', lang('tutorandos_tab_entrevistado')); ?></li>
	<li<?php echo $filter_type == 'noentrevistados' ? ' class="active"' : ''; ?>><?php echo anchor($index_url . 'noentrevistados/', lang('tutorandos_tab_noentrevistado')); ?></li>	
</ul>

<div class="admin-box">	
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>					
					<th>Apellido</th>					
					<th>Nombres</th>					
					<th>Tel&eacute;fono Movil</th>
					<th>Correo Electr&oacute;nico</th>										
					<th>Tutor</th>				
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('tutorandos_delete_confirm'))); ?>')" />
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
					<td class="column-check"><input type="checkbox" name="checked[]" value="<?php echo $record->tutorando_id; ?>" /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/tutorias/tutorandos/edit/' . $record->tutorando_id, '<span class="icon-pencil"></span>' .  $record->apellido); ?></td>
				<?php else : ?>
					<td><?php e($record->apellido); ?></td>
				<?php endif; ?>
					<td><?php e($record->nombre) ?></td>										
					<td><?php e($record->telefono_movil) ?></td>
					<td><?php e($record->correo) ?></td>		
					<td><?php echo anchor(SITE_AREA . '/settings/users/edit/' . $record->id,  $record->surname); ?></td>													
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">No hay registros en esta seleccion.</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>