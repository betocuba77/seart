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
				<?php if (empty($resultados['vocacional'])) {
					echo "No posee Riesgo vocacional";
				} else {
					echo 'Posee Riesgo Vocacional: ';
					echo '<ul>';
					foreach ($resultados['vocacional'] as $key => $value) {
						echo '<li>'.$value.'</li>';
					}
					echo '</ul>';
				} ?>
				<br><li>RIESGO ACADEMICO</li>
				<?php if (empty($resultados['academico'])) {
					echo "No posee Riesgo academico";
				} else {
					echo 'Posee Riesgo Acad&eacute;mico: ';
					echo '<ul>';
					foreach ($resultados['academico'] as $key => $value) {
						echo '<li>'.$value.'</li>';
					}
					echo '</ul>';
				} ?>
				<br><li>RIESGO ECONOMICO</li>
				<?php if (empty($resultados['economico'])) {
					echo "No posee Riesgo economico";
				} else {
					echo 'Posee Riesgo Econ&oacute;mico: ';
					echo '<ul>';
					foreach ($resultados['economico'] as $key => $value) {
						echo '<li>'.$value.'</li>';
					}
					echo '</ul>';
				} ?>
				<br><br><li>RIESGO PERSONAL</li>
				<?php if (empty($resultados['personal'])) {
					echo "No posee Riesgo personal";
				} else {
					echo 'Posee Riesgo Personal: ';
					echo '<ul>';
					foreach ($resultados['personal'] as $key => $value) {
						echo '<li>'.$value.'</li>';
					}
					echo '</ul>';
				} ?>
			</ul>						
	</fieldset>
	<div class="form-actions">
		<input type="submit" name="save" class="btn btn-success" value="<< Ver anterior"  />
		<input type="submit" name="save" class="btn btn-primary" value="Ver siguiente >>"  />
	</div>
	<?php echo form_close(); ?>
</div>