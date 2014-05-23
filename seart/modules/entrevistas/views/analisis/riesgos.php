<div class="admin-box">
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
	<fieldset>
		<table class="table table-condensed">
			<tr>
				<th colspan="2" style='align:center'>RIESGOS DETECTADOS POR TUTORANDO</th>
			</tr>
			<tr>
				<th colspan="2">TUTOR RESPONSABLE</th>
			</tr>
			<tr>
				<th><?= $tutor->surname.' '.$tutor->name ?></th>
			</tr>
			<tr>
				<th th colspan="2">TUTORANDO</th>				
			</tr>
			<tr>
				<th><?= $tutorando[0]->apellido.' '.$tutorando[0]->nombre ?></th>
			</tr>
		</table><br>
			<ul>
				<br><li>RIESGO VOCACIONAL</li>
				<div class="alert alert-block"><?php if (empty($resultados['vocacional'])) {
					echo "No posee Riesgo vocacional";
				} else {
					echo 'Posee Riesgo Vocacional: ';
					echo '<ul>';
					foreach ($resultados['vocacional'] as $key => $value) {
						echo '<li>'.$value.'</li>';
					}
					echo '</ul>';
				} ?></div>
				<li>RIESGO ACADÉMICO</li>
				<div class="alert alert-info"><?php if (empty($resultados['academico'])) {
					echo "No posee Riesgo académico";
				} else {
					echo 'Posee Riesgo Acad&eacute;mico: ';
					echo '<ul>';
					foreach ($resultados['academico'] as $key => $value) {
						echo '<li>'.$value.'</li>';
					}
					echo '</ul>';
				} ?></div>
				<li>RIESGO ECONÓMICO</li>
				<div class="alert alert-block"><?php if (empty($resultados['economico'])) {
					echo "No posee Riesgo económico";
				} else {
					echo 'Posee Riesgo Econ&oacute;mico: ';
					echo '<ul>';
					foreach ($resultados['economico'] as $key => $value) {
						echo '<li>'.$value.'</li>';
					}
					echo '</ul>';
				} ?></div>
				<li>RIESGO PERSONAL</li>
				<div class="alert alert-info"><?php if (empty($resultados['personal'])) {
					echo "No posee Riesgo personal";
				} else {
					echo 'Posee Riesgo Personal: ';
					echo '<ul>';
					foreach ($resultados['personal'] as $key => $value) {
						echo '<li>'.$value.'</li>';
					}
					echo '</ul>';
				} ?></div>
			</ul>						
	</fieldset>
	<div class="form-actions">		
		<a href="<?php echo base_url().'index.php/admin/analisis/entrevistas/riesgos/'.$tutor->id.'/'.$anterior; ?>" class="btn btn-success"> << Ver anterior</a>
		<a href="<?php echo base_url().'index.php/admin/analisis/entrevistas/riesgos/'.$tutor->id.'/'.$siguiente; ?>" class="btn btn-primary">Ver siguiente >></a>
	</div>
	<?php echo form_close(); ?>
</div>