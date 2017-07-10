<div class="row">
  <div class="col-sm-6">
    <?php while ( have_rows('left_col') ) : the_row(); ?>
      <div class="box box_<?php echo get_sub_field('color'); ?>">
        <h3><?php echo get_sub_field('title');?></h3>
        <div class="box_content"><?php echo get_sub_field('content');?></div>
      </div>
  	<?php endwhile; ?>
  </div>
  <div class="col-sm-6">
    <?php while ( have_rows('right_col') ) : the_row(); ?>
      <div class="box box_<?php echo get_sub_field('color'); ?>">
        <h3><?php echo get_sub_field('title');?></h3>
        <div class="box_content"><?php echo get_sub_field('content');?></div>
      </div>
  	<?php endwhile; ?>
  </div>
</div>
