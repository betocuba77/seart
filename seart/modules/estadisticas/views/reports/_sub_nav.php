<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/reports/estadisticas/') ?>" id="list">Total Entrevistas realizadas</a>
	</li>	
	<li <?php echo $this->uri->segment(4) == 'entrevistas_tutor' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/reports/estadisticas/entrevistas_tutor') ?>" id="list">Entrevistas realizadas por Tutor</a>
	</li>	
	<li <?php echo $this->uri->segment(4) == 'tutorandos_riesgos' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/reports/estadisticas/tutorandos_riesgos') ?>" id="list">Tutorandos con riesgos</a>
	</li>	
	<li <?php echo $this->uri->segment(4) == 'riesgos_institucionales' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/reports/estadisticas/riesgos_institucionales') ?>" id="list">Indicadores de riesgos Institucionales</a>
	</li>	
</ul>