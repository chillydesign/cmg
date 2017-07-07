<?php

$args = array(
	'post_type'       => 'bulletin',
	'posts_per_page'  => -1,
	'meta_query'      => array(
		'relation'    => 'AND',
		'year' => array(
			'key'     => 'year',
			'compare' => 'EXISTS',
		),
		'month'    => array(
			'key'     => 'month',
			'type'    => 'NUMERIC',
			'compare' => 'EXISTS',
		)
	),
    'orderby' => array(
       'year' => 'DESC',
       'month'   => 'DESC',
     )
);
$bulletins = 	new WP_Query( $args );
$old_year = false;

?>

<?php while ( $bulletins->have_posts() ) : $bulletins->the_post(); ?>

    <?php $year = get_field('year'); ?>
    <?php $fichier = get_field('fichier'); ?>
    <?php if ($old_year !=  $year   ): ?>
        <h2><?php echo $year; ?></h2>
    <?php endif; ?>
    <?php $old_year = $year; ?>


    <h3><?php echo get_the_title(); ?></h3>
    <p>
        <a href="<?php echo $fichier['url']; ?>"><?php echo $fichier['filename']; ?></a>
    </p>

 <?php endwhile; wp_reset_postdata(); ?>
