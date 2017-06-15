<?php /* Template Name: Accueil Page Template */ get_header(); ?>



			<h1><?php the_title(); ?></h1>

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
						<?php $events = get_posts(array(
							'post_type'  => 'evenement',
							'posts_per_page' => 2,
							'post_status' => 'publish',
							'meta_key'   => 'date',
							'orderby'    => 'meta_value_num',
							'order'    => 'ASC',
							 'meta_query' => array(
								 array(
									 'key'     => 'date',
									 'value'   =>  date('Ymd')  ,
									 'compare' => '>',
									)
							 )

						 )); ?>
						<?php if ( $events ) : foreach ( $events as $post ) : setup_postdata( $post ); ?>
							<?php $date = get_field('date', get_the_ID()  );  ?>
							<?php $date_formatted =  date('d/m/Y', strtotime( $date )); ?>
							<li><a href="<?php echo get_the_permalink(); ?>"><strong> <?php echo $date_formatted; ?></strong> <?php echo get_the_title(); ?></a></li>
				    <?php endforeach; wp_reset_postdata(); endif; ?>
					</ul>



						<div class="tiva-events-calendar compact" data-view="calendar" data-source="json"></div>

					<!-- <div id="events_calendar">
						<span class="loading glyphicon glyphicon-cog"></span>
					</div> -->



			</div>
	</div>




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

		<div class="box box_yellow">
				<h3>Infos Pratiques</h3>
				<div class="box_content">
					<h4 class="title_icon icon_wifi">Accès Wifi</h4>
					<p style="padding:0"><strong>CMG ETU :</strong> Bartholoni1835</p>
					<p><strong>CMG Invité :</strong> passwd</p>


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


		<script type="text/javascript">

			var events_json = '<?php echo home_url(); ?>/api/v1/?events=true';
		</script>
		<script id="calendar_template" type="x-underscore">
		<?php echo file_get_contents(dirname(__FILE__) . '/templates/calendar.underscore'); ?>
		</script>

<?php get_footer(); ?>
