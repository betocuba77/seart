	<footer class="container-fluid footer">
		<p class="pull-right">
			Ejecutado en {elapsed_time} segundos, usando {memory_usage}.
			<br/>
			Desarrollado por <a href="http://sitemadetutorias.com.ar" target="_blank"><i class="icon-fire">&nbsp;</i>&nbsp;Alumnos Tutores </a> <?php echo BONFIRE_VERSION ?>
		</p>
	</footer>

	<div id="debug"><!-- Stores the Profiler Results --></div>

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo js_path(); ?>jquery-1.7.2.min.js"><\/script>')</script>

	<?php echo Assets::js(); ?>
</body>
</html>
