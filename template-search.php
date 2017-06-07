<?php /*Template Name: Search Template */ get_header(); ?>



<div class="container">


	<div class="row">

		<div class="col-sm-3 ">
			<form  method="GET" action="">
				<input placeholder="chercher un staff membre" id="staff_search"  type="text" name="sm" >
				<input type="submit" id="submit_staff_search"   />
				<div id="category_box" class="search_box">
					<?php $terms = get_terms( 'personnel_category'); ?>
					<?php foreach ($terms as $term)  : ?>
						<label><input type="checkbox" class="search_check" value="<?php echo $term->term_id; ?>" data-field="category" /> <?php echo $term->name; ?>   </label>
					<?php endforeach; ?>
				</div>
			</form>
		</div>


		<div class="col-sm-9 ">
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
