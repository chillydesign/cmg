<?php /* Template Name: Place Neuve Template */ get_header(); ?>


		<h1><?php the_title(); ?></h1>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php // include('section-loop.php'); ?>
                <?php the_content(); ?>
				<?php include('section-loop.php')?>



<?php  $galerie = get_field('galerie'); ?>
<?php  if( $galerie ): ?>
    <ul class="bxslider">
        <?php foreach( $galerie as $image ): ?>
            <li  class="slide_photo_background" style="background-image: url(<?php echo $image['sizes']['large']; ?>);" >
                 <div class="slide_content"><?php echo $image['caption']; ?></div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<div class="row" style="margin-top:50px;">
	<div class="col-sm-8"><?php echo get_field('texte'); ?></div>
	<div class="col-sm-4">
		<div class="box box_orange">
        <h3>Dossier</h3>
        <div class="box_content">
					<p><a class="orange_button" href="<?php echo get_field('documentation'); ?>" target="_blank">Télécharger la documentation</a></p>
				</div>
    </div>
		<div class="box box_orange">
				<h3>Suivi du Projet</h3>
				<div class="box_content">
					<?php echo get_field('box'); ?>
				</div>
		</div>
	</div>
</div>




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
