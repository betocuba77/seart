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
				<th>Apellido y Nombre: Cuba Beto</th>
			</tr>
			<tr>
				<th th colspan="2">TUTORANDO</th>				
			</tr>
			<tr>
				<th>Apellido y Nombre: Suárez Raúl</th>
			</tr>
		</table><br>
			<ul>
				<li>RIESGO VOCACIONAL 3: Se ha detectado que la elección de la carrera no fue propia, sino que existen presiones familiares.</li>				
			</ul>
			<ul>	
				<li>RIESGO ACADÉMICO 2: Se ha detectado que el alumno no posee hábito, disciplina o técnica de estudio.</li>
				<li>RIESGO ACADÉMICO 3: Se ha detectado que el alumno no posee un grupo de estudio.</li>
			</ul>
			<ul>	
				<li>RIESGO ECONÓMICO 1: Se ha detectado que el alumno tiene poco ingreso y depende de la beca para continuar sus estudios.</li>
			</ul>
			<ul>	
				<li>RIESGO PERSONAL 1: Se ha detectado que el alumno tiene personas a cargo.</li>
				<li>RIESGO PERSONAL 3: Se ha detectado que el alumno dedica más tiempo a otras actividades secundarias.</li>				
			</ul>
			<ul>	
				<li>RIESGO INSTITUCIONAL 2: Se ha detectado que alumno tiene problemas con la conexión al WiFi.</li>
			</ul>
	</fieldset>
	<div class="form-actions">
		<input type="submit" name="save" class="btn btn-success" value="<< Ver anterior"  />
		<input type="submit" name="save" class="btn btn-primary" value="Ver siguiente >>"  />
	</div>
	<?php echo form_close(); ?>
</div>