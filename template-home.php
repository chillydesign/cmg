<?php /* Template Name: Accueil Page Template */ get_header(); ?>


			<h1 style="background-image:url('<?php if(get_field('home_image', 'option')) { echo get_field('home_image', 'option'); } else { echo get_field('login_image', 'option');} ?>')"><?php the_title(); ?></h1>

<div class="row">
<div class="col-sm-6">
	<div class="box box_orange">
			<h3>A la une</h3>
			<div class="box_content">
				<?php $bulletins = get_posts(array('post_type'  => 'bulletin', 'posts_per_page' => 1, 'post_status' => 'publish' )); ?>
				<?php if ( $bulletins ) : foreach ( $bulletins as $post ) : setup_postdata( $post ); ?>
					<?php $download = get_field('fichier', get_the_ID()  );  ?>
					<h4 class="title_icon icon_download">
						<a target="_blank" href="<?php echo $download['url']; ?>">
							Télécharger le bulletin interne <?php echo get_the_title(); ?>
						</a>
					</h4>
		    <?php endforeach; wp_reset_postdata(); endif; ?>



					<h4 class="title_icon icon_news">	Prochainement</h4>
					<ul>
						<?php
						$s = new DateTime('today');
					  $e = new DateTime('last day of next year');
					  $start = $s->format('Y-m-d');
					  $end = $e->format('Y-m-d');

						?>
						<?php $events = get_posts(array(
							'post_type'  => 'evenement',
							'posts_per_page' => 2,
							'post_status' => 'publish',
							'orderby' => 'date_start',
						  'order'=> 'ASC',
						  'meta_query'=>	array(
						    'relation' => 'OR',
						    array(
						      'key'     => 'date_start',
						      'value'   =>  array($start, $end),
						      'compare' => 'BETWEEN',
						      'type'    =>  'date'
						    ),
						    array(
						      'key'     => 'date_end',
						      'value'   =>  array($start, $end),
						      'compare' => 'BETWEEN',
						      'type'    =>  'date'
						    )
						  )
						)); ?>
						<?php if ( $events ) : foreach ( $events as $post ) : setup_postdata( $post ); ?>
							<?php $date = get_field('date_start', get_the_ID()  );  ?>
							<?php $date_formatted =  date('d/m/Y', strtotime( $date )); ?>
							<li><a href="<?php echo get_the_permalink(); ?>"><strong> <?php echo $date_formatted; ?></strong> <?php echo get_the_title(); ?></a></li>
				    <?php endforeach; wp_reset_postdata(); endif; ?>
					</ul>



						<div class="tiva-events-calendar compact" data-start="monday" data-view="calendar" data-source="json"></div>
			</div>
	</div>

	<?php if( have_rows('left_col') ) : while ( have_rows('left_col') ) : the_row(); ?>
      <div class="box box_<?php echo get_sub_field('color'); ?>">
        <?php if(get_sub_field('button')) { ?>
          <a <?php if(get_sub_field('newtab')){echo 'target="_blank"';} ?> style="text-decoration : none; " href="<?php echo get_sub_field('link')?>"> <h3><?php echo get_sub_field('title');?></h3></a>
        <?php } else { ?>
          <h3><?php echo get_sub_field('title');?></h3>
          <div class="box_content"><?php echo get_sub_field('content');?></div>
        <?php } ?>
      </div>
  	<?php endwhile; ?>
  	<?php endif; ?>


</div>
<div class="col-sm-6">


			<div class="box box_green">
					<h3>Annuaire</h3>
					<div class="box_content">

						<h4 class="title_icon icon_search">Rechercher une personne</h4>
						<?php $staff_search_url = site_url('annuaire'); ?>
						<form  class="box_content" method="GET" action="<?php echo $staff_search_url; ?>">
							<input placeholder="rechercher une personne" id="staff_search"  type="text" name="sm" >
							<input type="submit" id="submit_staff_search"   />
							<div id="category_box" class="search_box">
								<?php $terms = get_terms( array( 'taxonomy' => 'personnel_category',  'parent' => 0  )); ?>
								<?php foreach ($terms as $term)  : ?>
									<label><input  name="ct[]"  type="checkbox" class="search_check" value="<?php echo $term->term_id; ?>" data-field="category" /> <?php echo $term->name; ?>   </label>
								<?php endforeach; ?>
							</div>
							<button type="submit" class="button button_block">Chercher</button>

						</form>


					</div>

			</div>
			<?php if( have_rows('right_col') ) : while ( have_rows('right_col') ) : the_row(); ?>
      <div class="box box_<?php echo get_sub_field('color'); ?>">
        <?php if(get_sub_field('button')) { ?>
          <a <?php if(get_sub_field('newtab')){echo 'target="_blank"';} ?> style="text-decoration : none; " href="<?php echo get_sub_field('link')?>"> <h3><?php echo get_sub_field('title');?></h3></a>
        <?php } else { ?>
          <h3><?php echo get_sub_field('title');?></h3>
          <div class="box_content"><?php echo get_sub_field('content');?></div>
        <?php } ?>
      </div>
  	<?php endwhile; ?>
  	<?php endif; ?>


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


		<script type="text/javascript">

			var events_json = '<?php echo home_url(); ?>/api/v1/?events=true';
		</script>
		

<?php get_footer(); ?>
