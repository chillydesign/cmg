<?php $column_count =  sizeof(  get_sub_field('columns')  ); ?>
<?php $column_class = count_to_bootstrap_class($column_count); ?>
<?php $i = 1; ?>


<div class="container-fluid section<?php echo $column_count; ?>col">
	<div class="row">
	<?php while ( have_rows('columns') ) : the_row(); ?>
		<div class="sectioncol <?php echo $column_class . ' ' . get_sub_field('background') . ' colnmb' . $i; ?>">
			<?php if(get_sub_field('title')) { ?>
			<div class="title">
				<?php echo get_sub_field('title'); ?>
			</div>
			<?php } ?>
			<div class="content">
				<?php echo get_sub_field('content'); ?>
			</div>
		</div>
	<?php $i++; ?>
	<?php endwhile; ?>
	</div> <!-- END OF ROW -->


</div><!--  END OF CONTAINER -->
