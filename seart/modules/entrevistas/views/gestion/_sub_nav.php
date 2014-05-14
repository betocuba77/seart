<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/gestion/entrevistas') ?>" id="list">Entrevistas</a>
	</li>
	<?php if ($this->auth->has_permission('Entrevistas.Gestion.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/gestion/entrevistas/create') ?>" id="create_new"><?php echo lang('entrevistas_new').' Entrevista'; ?></a>
	</li>
	<?php endif; ?>	
	<?php if ($this->auth->has_permission('Entrevistas.Gestion.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'plantillas' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/gestion/entrevistas/plantillas') ?>" id="modelo">Plantillas</a>
	</li>
	<?php endif; ?>
	<?php if ($this->auth->has_permission('Entrevistas.Gestion.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create_plantilla' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/gestion/entrevistas/create_plantilla') ?>" id="modelo">Nueva Plantilla</a>
	</li>
	<?php endif; ?>
</ul>