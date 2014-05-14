<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/tutorias/tutorandos') ?>" id="list"><?php echo lang('tutorandos_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Tutorandos.Tutorias.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/tutorias/tutorandos/create') ?>" id="create_new"><?php echo lang('tutorandos_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>