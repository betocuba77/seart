<?php

$num_columns	= 22;
$can_delete		= $this->auth->has_permission('Tutores.Tutorias.Delete');
$can_edit		= $this->auth->has_permission('Tutores.Tutorias.Edit');
$has_records	= isset($tutores) && is_array($tutores) && count($tutores);

?>
<div class="well shallow-well">
	<span class="filter-link-list">
		<?php
		// If there's a current filter, we need to replace the caption with a clear button
		if ($filter_type == 'first_letter') :
			echo anchor($index_url, lang('bf_clear'), array('class' => 'btn btn-small btn-primary'));
		else :
			e(lang('tutores_filter_first_letter'));
		endif;

		$letters = range('A', 'Z');
		foreach ($letters as $letter) :
			echo anchor($index_url . 'first_letter-' . $letter, $letter) . PHP_EOL;
		endforeach;
		?>
	</span>
</div>

<div class="admin-box">	
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>					
					<th>ID</th>				
					<th>Apellido</th>					
					<th>Nombres</th>					
					<th>E-mail</th>
					<th>Carrera</th>															
				</tr>
			</thead>			
			<tbody>
				<?php
				if ($has_records) :
					foreach ($tutores as $tutor) :
				?>
				<tr>					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/settings/users/edit/' . $tutor->id, '<span class="icon-pencil"></span>' .  $tutor->id); ?></td>
				<?php else : ?>
					<td><?php e($tutor->id); ?></td>
				<?php endif; ?>
					<td><?php e($tutor->surname) ?></td>										
					<td><?php e($tutor->name) ?></td>										
					<td><?php e($tutor->email) ?></td>
					<td><?php e($tutor->nombre) ?></td>																
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