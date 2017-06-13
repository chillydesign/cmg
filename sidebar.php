

<nav id="sidebar" role="complementary"   class="stickysidebar">
	<div class="theiaStickySidebar " >
		<ul>
			<?php chilly_nav('primary-menu'); ?>

			<?php if (is_user_logged_in()): ?>
			<li class="icon_logout" >
				<a href="<?php echo wp_logout_url(); ?>"><?php _e('Logout', 'webfactor'); ?></a>
			</li>
		<?php endif; ?>


		</ul>
	</div>
</nav>
