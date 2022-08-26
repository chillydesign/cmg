<?php /* Template Name: Dates à retenir */ get_header(); ?>


			<h1><?php the_title(); ?></h1>







<div class="events_list">
	<?php
	if(isset($_GET['ye'])){$year = $_GET['ye'];} else {$year = date('Y'); }
	if(isset($_GET['mo'])){$month = $_GET['mo'];} else {$month = date('m');}




	 $start = $year . '-' . $month . '-01';
	 $end = $year . '-' . $month . '-31';
	 ?>
	<?php $events = get_posts(array(
		'post_type'  => 'evenement',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'orderby' => 'date_start',
		'order'=> 'ASC',
		'meta_query'=>	array(
			'relation' => 'AND',
			array(
				'key'     => 'date_start',
				'value'   =>  $end,
				'compare' => '<=',
				'type'    =>  'date'
			),
			array(
				'key'     => 'date_end',
				'value'   =>  $start,
				'compare' => '>=',
				'type'    =>  'date'
			)
		)
	)); ?>
	<?php
		setlocale(LC_TIME, "fr_FR");
		echo '<h2>' . ucfirst(utf8_encode(strftime('%B ', mktime(null, null, null, $month, 1)))) . strftime(' %Y', mktime(null, null, null, null, null, $year + 1)) . '</h2>';
	?>
	<?php $i=1; ?>
	<table class="events_table">
		<?php if ( $events ) : foreach ( $events as $post ) : setup_postdata( $post ); ?>
			<?php $id = get_the_ID() ; ?>
			<?php $start_date = get_field('date_start', $id );  ?>
			<?php $start_year = date_i18n('Y', strtotime( $start_date )); ?>
			<?php $start_month = date_i18n('M', strtotime( $start_date )); ?>
			<?php $start_day = date_i18n('d', strtotime( $start_date )); ?>

			<?php $end_date = get_field('date_end', $id );  ?>
			<?php $end_year = date_i18n('Y', strtotime( $end_date )); ?>
			<?php $end_month = date_i18n('M', strtotime( $end_date )); ?>
			<?php $end_day = date_i18n('d', strtotime( $end_date )); ?>

			<?php if($start_date == $end_date){
				$date_formatted = date_i18n('d M Y', strtotime( $start_date ));
			} elseif($start_year == $end_year){
				if($start_month == $end_month){
					$date_formatted = $start_day . ' - ' . $end_day . ' ' . $start_month . ' ' . $start_year;
				} else {
					$date_formatted = $start_day . ' ' . $start_month . ' - ' . $end_day . ' ' . $end_month . ' ' . $start_year;
				}
			} else {
				$date_formatted = date_i18n('d M Y', strtotime( $start_date )) . ' - ' . date_i18n('d M Y', strtotime( $end_date ));
			} ?>

			<tr>
				<td><strong><?php echo get_the_title(); ?></strong><td>
				<td><?php echo $date_formatted; ?><td>
				<td><?php echo get_field('time', $id); ?> </td>
				<td><?php echo get_field('place', $id); ?> </td>
			</tr>
		<?php $i++; ?>
		<?php endforeach; wp_reset_postdata(); endif; ?>
		<?php if($i == 1) {echo '<p>Aucune date à retenir</p>';} ?>
	</table>
</div>
<?php get_template_part('sidebar-date'); ?>
<div style="clear:both"></div>




<?php get_footer(); ?>
