

	<!-- footer -->
	<footer class="footer" role="contentinfo">

		<p class="">
			&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. Website by <a href="//webfactor.ch" title="Webfactor">Webfactor</a>.
		</p>

	</footer>
	<!-- /footer -->



 </div> <!-- END OF  page_container -->


<?php get_sidebar(); ?>

 </div> <!-- END OF  page_section -->



<div id="sidebar_bg"></div>


		<?php $td = get_template_directory_uri() ; ?>
		<script type="text/javascript" src="<?php echo $td; ?>/bower_components/jquery/dist/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo $td; ?>/bower_components/theia-sticky-sidebar/dist/ResizeSensor.min.js"></script>
		<script type="text/javascript" src="<?php echo $td; ?>/bower_components/theia-sticky-sidebar/dist/theia-sticky-sidebar.min.js"></script>
		<!-- <script type="text/javascript" src="<?php // echo $td; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
        <!-- <script type="text/javascript" src="<?php // echo $td; ?>/bower_components/moment/min/moment.min.js"></script> -->
		<script type="text/javascript" src="<?php echo $td; ?>/bower_components/underscore/underscore-min.js"></script>
		<script type="text/javascript" src="<?php echo $td; ?>/bower_components/featherlight/release/featherlight.min.js"></script>
		<script type="text/javascript" src="<?php echo $td; ?>/bower_components/featherlight/release/featherlight.gallery.min.js"></script>
		<script type="text/javascript" src="<?php echo $td; ?>/js/tiva_fr.js"></script>
		<script type="text/javascript" src="<?php echo $td; ?>/js/tiva.js"></script>
		<script type="text/javascript" src="<?php echo $td; ?>/js/min/scripts.js"></script>
        <link rel="stylesheet" href="<?php echo $td; ?>/bower_components/featherlight/release/featherlight.min.css">
        <link rel="stylesheet" href="<?php echo $td; ?>/bower_components/featherlight/release/featherlight.gallery.min.css">
		<?php wp_footer(); ?>



		<script>
		// (function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		// (f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		// l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		// })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		// ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		// ga('send', 'pageview');
		</script>

	</body>
</html>
