<?php

if(isset($_GET['ye'])){$year = $_GET['ye'];} else {$year = date('Y'); }
if(isset($_GET['mo'])){$month = $_GET['mo'];} else {$month = date('m');}
$start = $year . '-' . $month . '-01';
$end = $year . '-' . $month . '-31';


$args = array(
	'post_type'       => 'bulletin',
	'posts_per_page'  => 1,
    'meta_query'=>	array(
        'relation' => 'OR',
        array(
            'key'     => 'date',
            'value'   =>  array($start, $end),
            'compare' => 'BETWEEN',
            'type'    =>  'date'
        ),
    )
);
$bulletins = 	new WP_Query( $args );

?>


<?php $count =1; ?>
<?php while ( $bulletins->have_posts() ) : $bulletins->the_post(); ?>


    <?php $fichier = get_field('fichier'); ?>

	<?php
	    setlocale(LC_TIME, "fr_FR");
	    echo '<a class="downld" href="' . $fichier['url'] . '"><h2>' . ucfirst(utf8_encode(strftime('%B', mktime(null, null, null, $month, 1)))) . strftime(' %Y', mktime(null, null, null, null, null, $year + 1));  include('img/download.svg'); echo '</h2></a>';
	?>
    <?php echo do_shortcode('[pdf-embedder url="' . $fichier['url'] . '" ] ') ; ?>

    <p>
        <a href="<?php echo $fichier['url']; ?>">Download <?php echo $fichier['filename']; ?></a>
    </p>
<?php $i++; ?>
 <?php endwhile; wp_reset_postdata(); ?>

 <?php if($i != 1){
	 setlocale(LC_TIME, "fr_FR");
	 echo '<h2>' . ucfirst(utf8_encode(strftime('%B', mktime(null, null, null, $month, 1)))) . strftime(' %Y', mktime(null, null, null, null, null, $year + 1)) . '</h2><p>Le bulletin interne n\'a pas encore été publié pour ' . utf8_encode(strftime('%B', mktime(null, null, null, $month, 1))) . strftime(' %Y', mktime(null, null, null, null, null, $year + 1)) . '.</p>';
 } ?>
