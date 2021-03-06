<?php /*Template Name: Search Template */ get_header(); ?>




<h1><?php the_title(); ?></h1>


	<div class="row">

		<div class="col-sm-4 stickysidebar" >
			<div class="theiaStickySidebar">
				<div class="box box_green">
					<h3>Chercher</h3>
				<form  class="box_content" method="GET" action="">
					<?php $sm_value = ( isset($_GET['sm']) ) ? $_GET['sm'] : ''; ?>
					<input placeholder="rechercher une personne" id="staff_search"  type="text" name="sm" value="<?php echo $sm_value; ?>"  >
					<input type="submit" id="submit_staff_search"   />
					<div id="category_box" class="search_box">
						<?php $terms = get_terms( array( 'taxonomy' => 'personnel_category',  'parent' => 0  )); ?>
						<?php foreach ($terms as $term)  : ?>
							<?php  $checked = ( isset($_GET['ct'])  &&   in_array(   $term->term_id  , $_GET['ct']   ) ) ? 'checked' : '';   ?>
							<label><input <?php echo $checked; ?> type="checkbox" name="ct[]"  class="search_check" value="<?php echo $term->term_id; ?>" data-field="category" /> <?php echo $term->name; ?>   </label>
						<?php endforeach; ?>
					</div>

				</form>
				</div>
			</div>
		</div>


		<div class="col-sm-8 stickysidebar ">
			<div class="theiaStickySidebar">
				<div id="staff_container">
					<span class="loading glyphicon glyphicon-cog"></span>
				</div>


			</div>


		</div>
	</div>




<script type="text/javascript">
var search_url = '<?php echo home_url(); ?>/api/v1/';
</script>


<script id="staff_template" type="x-underscore">
<?php echo file_get_contents(dirname(__FILE__) . '/templates/staff.underscore'); ?>
</script>

<?php get_footer(); ?>
