<?php /*Template Name: Calendar Template */ get_header(); ?>


<h1><?php the_title(); ?></h1>


<div id="events_calendar">
	<span class="loading glyphicon glyphicon-cog"></span>
</div>




<script type="text/javascript">
	var calendar_api_url = '<?php echo home_url(); ?>/api/v1/?events=true';
</script>


<script id="calendar_template" type="x-underscore">
<?php echo file_get_contents(dirname(__FILE__) . '/templates/calendar.underscore'); ?>
</script>



<?php get_footer(); ?>
