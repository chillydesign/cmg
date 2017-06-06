<?php /*Template Name: Search Template */ get_header(); ?>

<form  method="GET" action="">
<input placeholder="chercher un staff membre" id="staff_search_form"  type="text" name="sm" >
<input type="submit" id="submit_staff_search"  />
</form>



<div class="container">
	 <div id="staff_container"></div>
</div>




<script type="text/javascript">
	var search_url = '<?php echo home_url(); ?>/api/v1/';
</script>


<script id="staff_template" type="x-underscore">
	<?php echo file_get_contents(dirname(__FILE__) . '/templates/staff.underscore'); ?>
</script>
<?php get_footer(); ?>
