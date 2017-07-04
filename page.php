<?php get_header(); ?>




		<h1><?php the_title(); ?></h1>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php // include('section-loop.php'); ?>
                <?php the_content(); ?>
                <?php if (have_rows('galeries'))   include('galerie_content.php'); ?>

                <?php // comments_template( '', true ); // Remove if you don't want comments ?>
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
