<?php /* Template Name: Accueil Page Template */ get_header(); ?>



			<h1><?php the_title(); ?></h1>

<div class="row">
<div class="col-sm-6">



	<div class="box box_orange">
			<h3>A la une</h3>
			<div class="box_content">

				<p>
					Something here. Something here. Something here. Something here. Something here. Something here. Something here.
				</p>

			</div>

	</div>




</div>
<div class="col-sm-6">


			<div class="box box_green">
					<h3>Annuaire</h3>
					<div class="box_content">

						<p>
							Something here. Something here. Something here. Something here. Something here. Something here. Something here.
						</p>

					</div>

			</div>

		<div class="box box_yellow">
				<h3>Infos Pratiques</h3>
				<div class="box_content">

					<p>
						Something here. Something here. Something here. Something here. Something here. Something here. Something here.
					</p>

				</div>

		</div>


</div>

</div>


		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<?php comments_template( '', true ); // Remove if you don't want comments ?>

				<br class="clear">

				<?php edit_post_link(); ?>

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>


<?php get_footer(); ?>
