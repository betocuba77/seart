<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/tutorias/tutores') ?>" id="list"><?php echo lang('tutores_list'); ?></a>
	</li>	
</ul>