<?php /*Template Name: Calendar Template */ get_header(); ?>


<div class="container">
<div id="events_calendar"></div>
</div>


<script type="text/javascript">
	var calendar_api_url = '<?php echo home_url(); ?>/api/v1/?events=true';
</script>


<script id="calendar_template" type="x-underscore">
<?php echo file_get_contents(dirname(__FILE__) . '/templates/calendar.underscore'); ?>
</script>



<?php get_footer(); ?>
