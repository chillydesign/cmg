<div class="row">
  <div class="col-sm-6">
    <?php while ( have_rows('left_col') ) : the_row(); ?>
      <div class="box box_<?php echo get_sub_field('color'); ?>">
        <?php if(get_sub_field('button')) { ?>
          <a <?php if(get_sub_field('newtab')){echo 'target="_blank"';} ?> style="text-decoration : none; " href="<?php echo get_sub_field('link')?>"> <h3><?php echo get_sub_field('title');?></h3></a>
        <?php } else { ?>
          <h3><?php echo get_sub_field('title');?></h3>
          <div class="box_content"><?php echo get_sub_field('content');?></div>
        <?php } ?>
      </div>
  	<?php endwhile; ?>
  </div>
  <div class="col-sm-6">
    <?php while ( have_rows('right_col') ) : the_row(); ?>
      <div class="box box_<?php echo get_sub_field('color'); ?>">
        <?php if(get_sub_field('button')) { ?>
          <a <?php if(get_sub_field('newtab')){echo 'target="_blank"';} ?> style="text-decoration : none; " href="<?php echo get_sub_field('link')?>"> <h3><?php echo get_sub_field('title');?></h3></a>
        <?php } else { ?>
          <h3><?php echo get_sub_field('title');?></h3>
          <div class="box_content"><?php echo get_sub_field('content');?></div>
        <?php } ?>
      </div>
  	<?php endwhile; ?>
  </div>
</div>
