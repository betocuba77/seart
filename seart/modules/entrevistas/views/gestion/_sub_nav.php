<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/gestion/entrevistas') ?>" id="list"><?php echo lang('entrevistas_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Entrevistas.Gestion.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/gestion/entrevistas/create') ?>" id="create_new"><?php echo lang('entrevistas_new'); ?></a>
	</li>
	<?php endif; ?>	
	<?php if ($this->auth->has_permission('Entrevistas.Gestion.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'modelo' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/gestion/entrevistas/modelo') ?>" id="modelo">Modelo Entrevista</a>
	</li>
	<?php endif; ?>
</ul>