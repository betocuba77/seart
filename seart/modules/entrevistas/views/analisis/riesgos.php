<div class="admin-box">
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
	<fieldset>
		<table class="table table-condensed">
			<tr>
				<th colspan="2" style='align:center'>1er ENCUENTRO 2014</th>
			</tr>
			<tr>
				<th colspan="2">TUTOR RESPONSABLE</th>
			</tr>
			<tr>
				<th>Apellido y Nombre</th>
				<td><?= $tutor->surname.' '.$tutor->name ?></td>
			</tr>
			<tr>
				<th th colspan="2">DATOS PERSONALES DEL TUTORANDO</th>				
			</tr>
			<tr>
				<th th colspan="2">RIESGOS DETECTADOS</th>				
			</tr>
			<tr>
				<th>Vocacional</th>
				<td><?= $tutorando->apellido.' '.$tutorando->nombre ?></td>
			</tr>
			<tr>
				<th>Académico</th>
				<td><?= $tutorando->fecha_nacimiento ?></td>
			</tr>
			<tr>
				<th>Ecónomico</th>
				<td><?= $tutorando->telefono_movil ?></td>
			</tr>
			<tr>
				<th>Personal</th>
				<td><?= $tutorando->email ?></td>
			</tr>
		</table>
	</fieldset>
	<div class="form-actions">
		<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('entrevistas_action_create'); ?>"  />
		<?php echo lang('bf_or'); ?>
		<?php echo anchor(SITE_AREA .'/analisis/entrevistas', lang('entrevistas_cancel'), 'class="btn btn-warning"'); ?>
	</div>
	<?php echo form_close(); ?>
</div>