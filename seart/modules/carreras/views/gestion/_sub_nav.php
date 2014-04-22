<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/gestion/carreras') ?>" id="list"><?php echo lang('carreras_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Carreras.Gestion.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/gestion/carreras/create') ?>" id="create_new"><?php echo lang('carreras_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>