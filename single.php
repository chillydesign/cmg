<?php get_header(); ?>



	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(); // Fullsize image for the single post ?>
				</a>
			<?php endif; ?>



			<h1><?php the_title(); ?></h1>


			<p><span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span></p>

			<?php the_content(); // Dynamic Content ?>


			<p><?php edit_post_link(); // Always handy to have Edit Post Links available ?></p>

			<?php // comments_template(); ?>

		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>



<?php get_footer(); ?>
