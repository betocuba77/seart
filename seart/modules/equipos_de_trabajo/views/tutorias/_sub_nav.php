<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/tutorias/equipos_de_trabajo') ?>" id="list"><?php echo lang('equipos_de_trabajo_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Equipos_de_Trabajo.Tutorias.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/tutorias/equipos_de_trabajo/create') ?>" id="create_new"><?php echo lang('equipos_de_trabajo_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>