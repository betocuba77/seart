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
				<th>Apellido y Nombre</th>
				<td><?= $tutorando->apellido.' '.$tutorando->nombre ?></td>
			</tr>
			<tr>
				<th>Edad</th>
				<td><?= $tutorando->fecha_nacimiento ?></td>
			</tr>
			<tr>
				<th>Telefono/s: </th>
				<td><?= $tutorando->telefono_movil ?></td>
			</tr>
			<tr>
				<th>E-mail</th>
				<td><?= $tutorando->email ?></td>
			</tr>
			<tr>
				<th>DATOS ACADEMICOS</th>				
			</tr>
			<tr>
				<th>Carrera:</th>
				<td></td>
			</tr>
			<tr>
				<th>Colegio Secundario:</th>
				<td><?= $tutorando->colegio_secundario ?></td>
			</tr>
			<tr>
				<th>Año de Egreso</th>
				<td><?= $tutorando->anio_egreso ?></td>
			</tr>
			<tr>
				<th>Orientacion del Titulo</th>
				<td><?= $tutorando->orientacion ?></td>
			</tr>
		</table>
	</fieldset>
	<br><hr>
	<fieldset>
		<legend>CUESTIONARIO</legend>
		<?php foreach ($preguntas as $pregunta) { 
			if ($pregunta['factor'] == 1) { 
				//FACTOR 1				
				// Si las respuestas son de opcion unica 
				echo $pregunta['pdescripcion'].'<br>'; ?>
				<textarea name="" style="width:98%"></textarea>
				<?php if ($pregunta['tipo_respuesta'] == 1) {					
					foreach ($pregunta['tipos_respuesta'] as $respuesta) { 
						echo '<li>'.$respuesta->tdescripcion; ?>
							<input type="radio" name="<?php echo $pregunta['pregunta_id'] ?>" value="<?= $respuesta->tipo_respuesta_id ?>" /></li><br>	
						<?php
					}
				} elseif($pregunta['tipo_respuesta'] == 2) { // Si las respuestas son de opcion 2
					foreach ($pregunta['tipos_respuesta'] as $respuesta) {
						echo '<li>'.$respuesta->tdescripcion; ?>
							<input type="checkbox" name="<?php echo $pregunta['pregunta_id'].'['.$respuesta->tipo_respuesta_id.']'; ?>" /></li><br>	
						<?php
					}
				}
								
			} 
			elseif ($pregunta['factor'] == 2) { 
				//FACTOR 1				
				// Si las respuestas son de opcion unica 
				echo $pregunta['pdescripcion'].'<br>'; ?>
				<textarea name="" style="width:98%"></textarea>
				<?php if ($pregunta['tipo_respuesta'] == 1) {					
					foreach ($pregunta['tipos_respuesta'] as $respuesta) { 
						echo '<li>'.$respuesta->tdescripcion; ?>
							<input type="radio" name="<?php echo $pregunta['pregunta_id']; ?>" value="<?= $respuesta->tipo_respuesta_id ?>" /></li><br>	
						<?php
					}
				} elseif($pregunta['tipo_respuesta'] == 2) { // Si las respuestas son de opcion 2
					foreach ($pregunta['tipos_respuesta'] as $respuesta) {
						echo '<li>'.$respuesta->tdescripcion; ?>
							<input type="checkbox" name="<?php echo $pregunta['pregunta_id'].'['.$respuesta->tipo_respuesta_id.']'; ?>" /></li><br>	
						<?php
					}
				}
								
			}  
			elseif ($pregunta['factor'] == 3) { 
				//FACTOR 1				
				// Si las respuestas son de opcion unica 
				echo $pregunta['pdescripcion'].'<br>'; ?>
				<textarea name="" style="width:98%"></textarea>
				<?php if ($pregunta['tipo_respuesta'] == 1) {					
					foreach ($pregunta['tipos_respuesta'] as $respuesta) { 
						echo '<li>'.$respuesta->tdescripcion; ?>
							<input type="radio" name="<?php echo $pregunta['pregunta_id']; ?>" value="<?= $respuesta->tipo_respuesta_id ?>" /></li><br>	
						<?php
					}
				} elseif($pregunta['tipo_respuesta'] == 2) { // Si las respuestas son de opcion 2
					foreach ($pregunta['tipos_respuesta'] as $respuesta) {
						echo '<li>'.$respuesta->tdescripcion; ?>
							<input type="checkbox" name="<?php echo $pregunta['pregunta_id'].'['.$respuesta->tipo_respuesta_id.']'; ?>" /></li><br>	
						<?php
					}
				}
								
			} 
			elseif ($pregunta['factor'] == 4) { 
				//FACTOR 1				
				// Si las respuestas son de opcion unica 
				echo $pregunta['pdescripcion'].'<br>'; ?>
				<textarea name="" style="width:98%"></textarea>
				<?php if ($pregunta['tipo_respuesta'] == 1) {					
					foreach ($pregunta['tipos_respuesta'] as $respuesta) { 
						echo '<li>'.$respuesta->tdescripcion; ?>
							<input type="radio" name="<?php echo $pregunta['pregunta_id']; ?>" value="<?= $respuesta->tipo_respuesta_id ?>" /></li><br>	
						<?php
					}
				} elseif($pregunta['tipo_respuesta'] == 2) { // Si las respuestas son de opcion 2
					foreach ($pregunta['tipos_respuesta'] as $respuesta) {
						echo '<li>'.$respuesta->tdescripcion; ?>
							<input type="checkbox" name="<?php echo $pregunta['pregunta_id'].'['.$respuesta->tipo_respuesta_id.']'; ?>" /></li><br>	
						<?php
					}
				}
								
			} 
		} ?>		
	</fieldset>
	<div class="form-actions">
		<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('entrevistas_action_create'); ?>"  />
		<?php echo lang('bf_or'); ?>
		<?php echo anchor(SITE_AREA .'/analisis/entrevistas', lang('entrevistas_cancel'), 'class="btn btn-warning"'); ?>
	</div>
	<?php echo form_close(); ?>
</div>