<ul id="gallery_navigator" >
<?php while(have_rows('galeries')): the_row() ;  ?>
    <?php $title =  get_sub_field('title'); ?>
    <?php $id = 'gallery_' . sanitize_title($title); ?>
    <li><a href="#<?php echo $id; ?>"><?php echo $title; ?></a></li>
<?php endwhile; ?>
</ul>


<div id="galleries_container">

<?php while(have_rows('galeries')): the_row() ;  ?>
    <?php $title =  get_sub_field('title'); ?>
    <?php $images =  get_sub_field('galerie'); ?>
    <?php $id = 'gallery_' . sanitize_title($title); ?>

    <h2><?php echo $title; ?></h2>

    <ul  id="<?php echo $id; ?>"  class="gallery_ul"  data-featherlight-gallery data-featherlight-filter="a">
        <?php foreach ($images as $image) : ?>
            <li>
                <a href="<?php echo $image['sizes']['large']; ?>"><img src="<?php echo $image['sizes']['thumbnail']; ?>" alt= "" /></a>
            </li>
        <?php endforeach; ?>
    </ul>


<?php endwhile; ?>

</div>
