
<?php

$update_taxonomy = 'category';
$get_terms_args = array(
        'taxonomy' => $update_taxonomy,
        'fields' => 'ids',
        'hide_empty' => false,
        );

$update_terms = get_terms($get_terms_args);
wp_update_term_count_now($update_terms, $update_taxonomy);

 ?>

			<!-- footer -->
			<footer class="footer" role="contentinfo">

				<p class="container">
					&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. Website by <a href="//webfactor.ch" title="Webfactor">Webfactor</a>.
				</p>

			</footer>
			<!-- /footer -->


		<?php $td = get_template_directory_uri() ; ?>
		<script type="text/javascript" src="<?php echo $td; ?>/node_modules/jquery/dist/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo $td; ?>/node_modules/underscore/underscore-min.js"></script>
		<script type="text/javascript" src="<?php echo $td; ?>/js/min/scripts.js"></script>
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
