<?php /*Template Name: Bulletins Template */  get_header(); ?>




		<h1><?php the_title(); ?></h1>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="events_list">



                <?php the_content(); ?>
                <?php get_template_part('bulletins_index'); ?>
                </div>
                <?php get_template_part('sidebar-date'); ?>
                <div style="clear:both"></div>

				<?php edit_post_link(); ?>

			</article>
			<!-- /article -->

		<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article class="container">

			<h2><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h2>

		</article>
		<!-- /article -->

	<?php endif; ?>



<?php get_footer(); ?>
