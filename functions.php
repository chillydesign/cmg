<?php
/*
*  Author: Todd Motto | @toddmotto
*  URL: webfactor.com | @webfactor
*  Custom functions, support, custom post types and more.
*/

/*------------------------------------*\
External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
Theme Support
\*------------------------------------*/

if (!isset($content_width)) {
  $content_width = 900;
}

if (function_exists('add_theme_support')) {
  // Add Menu Support
  add_theme_support('menus');

  // Add Thumbnail Theme Support
  add_theme_support('post-thumbnails');
  add_image_size('large', 1600, '', true); // Large Thumbnail
  add_image_size('medium', 800, '', true); // Medium Thumbnail
  add_image_size('small', 400, '', true); // Small Thumbnail
  add_image_size('square', 200, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

  // Add Support for Custom Backgrounds - Uncomment below if you're going to use
  /*add_theme_support('custom-background', array(
  'default-color' => 'FFF',
  'default-image' => get_template_directory_uri() . '/img/bg.jpg'
));*/

  // Add Support for Custom Header - Uncomment below if you're going to use
  /*add_theme_support('custom-header', array(
'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
'header-text'			=> false,
'default-text-color'		=> '000',
'width'				=> 1000,
'height'			=> 198,
'random-default'		=> false,
'wp-head-callback'		=> $wphead_cb,
'admin-head-callback'		=> $adminhead_cb,
'admin-preview-callback'	=> $adminpreview_cb
));*/

  // Enables post and comment RSS feed links to head
  add_theme_support('automatic-feed-links');

  // Localisation Support
  load_theme_textdomain('webfactor', get_template_directory() . '/languages');
}

/*------------------------------------*\
Functions
\*------------------------------------*/

// HTML5 Blank navigationh
function webfactor_nav() {
  wp_nav_menu(
    array(
      'theme_location'  => 'header-menu',
      'menu'            => '',
      'container'       => 'div',
      'container_class' => 'menu-{menu slug}-container',
      'container_id'    => '',
      'menu_class'      => 'menu',
      'menu_id'         => '',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul>%3$s</ul>',
      'depth'           => 0,
      'walker'          => ''
    )
  );
}

function wf_version() {
  return '0.2.2';
}

// Load HTML5 Blank scripts (header.php)
function webfactor_header_scripts() {
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    //wp_deregister_script('jquery');

    wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
    wp_enqueue_script('modernizr'); // Enqueue it!


  }
}

// Load HTML5 Blank conditional scripts
function webfactor_conditional_scripts() {
  if (is_page('pagenamehere')) {
    wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array(''), '1.0.0'); // Conditional script(s)
    wp_enqueue_script('scriptname'); // Enqueue it!
  }
}

// Load HTML5 Blank styles
function webfactor_styles() {


  wp_register_style('bootstrap', get_template_directory_uri() . '/bower_components/bootstrap/dist/css/bootstrap.min.css', array(), wf_version(), 'all');
  wp_enqueue_style('bootstrap'); // Enqueue it!

  wp_register_style('wf_style', get_template_directory_uri() . '/css/global.css', array(), wf_version(),  'all');
  wp_enqueue_style('wf_style'); // Enqueue it!



}

// Register HTML5 Blank Navigation
function register_html5_menu() {
  register_nav_menus(array( // Using array to specify more menus if needed
    'primary-menu' => __('Primary Menu', 'webfactor'), // Main Navigation
    'extra-menu' => __('Extra Menu', 'webfactor') // Extra Navigation if needed (duplicate as many as you need!)
  ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '') {
  $args['container'] = false;
  return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var) {
  return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist) {
  return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
  global $post;
  if (is_home()) {
    $key = array_search('blog', $classes);
    if ($key > -1) {
      unset($classes[$key]);
    }
  } elseif (is_page()) {
    $classes[] = sanitize_html_class($post->post_name);
  } elseif (is_singular()) {
    $classes[] = sanitize_html_class($post->post_name);
  }

  return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {
  // Define Sidebar Widget Area 1
  register_sidebar(array(
    'name' => __('Widget Area 1', 'webfactor'),
    'description' => __('Description for this widget-area...', 'webfactor'),
    'id' => 'widget-area-1',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  // Define Sidebar Widget Area 2
  register_sidebar(array(
    'name' => __('Widget Area 2', 'webfactor'),
    'description' => __('Description for this widget-area...', 'webfactor'),
    'id' => 'widget-area-2',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
  global $wp_widget_factory;
  remove_action('wp_head', array(
    $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
    'recent_comments_style'
  ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination() {
  global $wp_query;
  $big = 999999999;
  echo paginate_links(array(
    'base' => str_replace($big, '%#%', get_pagenum_link($big)),
    'format' => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total' => $wp_query->max_num_pages
  ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
  return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length) {
  return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '') {
  global $post;
  if (function_exists($length_callback)) {
    add_filter('excerpt_length', $length_callback);
  }
  if (function_exists($more_callback)) {
    add_filter('excerpt_more', $more_callback);
  }
  $output = get_the_excerpt();
  $output = apply_filters('wptexturize', $output);
  $output = apply_filters('convert_chars', $output);
  $output = '<p>' . $output . '</p>';
  echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more) {
  global $post;
  return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'webfactor') . '</a>';
}

// Remove Admin bar
function remove_admin_bar() {
  return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag) {
  return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions($html) {
  $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
  return $html;
}

// Custom Gravatar in Settings > Discussion
function webfactorgravatar($avatar_defaults) {
  $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
  $avatar_defaults[$myavatar] = "Custom Gravatar";
  return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments() {
  if (!is_admin()) {
    if (is_singular() and comments_open() and (get_option('thread_comments') == 1)) {
      wp_enqueue_script('comment-reply');
    }
  }
}

// Custom Comments Callback
function webfactorcomments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
  extract($args, EXTR_SKIP);

  if ('div' == $args['style']) {
    $tag = 'div';
    $add_below = 'comment';
  } else {
    $tag = 'li';
    $add_below = 'div-comment';
  }
?>
  <!-- heads up: starting < for the html tag (li or div) in the next line: -->
  <<?php echo $tag ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
      <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
      <?php endif; ?>
      <div class="comment-author vcard">
        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['180']); ?>
        <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
        <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
        <br />
      <?php endif; ?>

      <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>">
          <?php
          printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'), '  ', '');
                                                                                    ?>
      </div>

      <?php comment_text() ?>

      <div class="reply">
        <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
      <?php if ('div' != $args['style']) : ?>
      </div>
    <?php endif; ?>
  <?php }

/*------------------------------------*\
  Actions + Filters + ShortCodes
  \*------------------------------------*/

// Add Actions
add_action('init', 'webfactor_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'webfactor_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'webfactor_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu

add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'webfactorgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
  Custom Post Types
  \*------------------------------------*/

// Create 1 Custom Post type for a Demo, called personnel
add_action('init', 'create_post_type_personnel');
add_action('init', 'create_post_type_evenement');
add_action('init', 'create_post_type_bulletin');
add_action('init', 'create_personnel_cat');
function create_personnel_cat() {

  $per_labels = array(
    'name'              => _x('Categorie', 'taxonomy general name', 'webfactor'),
    'singular_name'     => _x('Categorie', 'taxonomy singular name', 'webfactor'),
    'search_items'      => __('Chercher Categorie', 'webfactor'),
    'all_items'         => __('Toutes les Categorie', 'webfactor'),
    'edit_item'         => __('Modifier Categorie', 'webfactor'),
    'update_item'       => __('Mettre à jour Categorie', 'webfactor'),
    'add_new_item'      => __('Ajouter Categorie', 'webfactor'),
    'new_item_name'     => __('Nouvelle Categorie', 'webfactor'),
    'menu_name'         => __('Categorie', 'webfactor'),
  );


  $tax_args = array(
    'hierarchical'      => true,
    'labels'            => $per_labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'personnel_category'),
  );


  register_taxonomy('personnel_category', array('personnel'), $tax_args);
}

function create_post_type_personnel() {
  //  register_taxonomy_for_object_type('personnel_category', 'personnel'); // Register Taxonomies for Category
  register_post_type(
    'personnel', // Register Custom Post Type
    array(
      'labels' => array(
        'name' => __('Personnel', 'webfactor'), // Rename these to suit
        'singular_name' => __('Personnel', 'webfactor'),
        'add_new' => __('Add New', 'webfactor'),
        'add_new_item' => __('Add New personnel', 'webfactor'),
        'edit' => __('Edit', 'webfactor'),
        'edit_item' => __('Edit personnel', 'webfactor'),
        'new_item' => __('New personnel', 'webfactor'),
        'view' => __('View personnel', 'webfactor'),
        'view_item' => __('View personnel', 'webfactor'),
        'search_items' => __('Search personnel', 'webfactor'),
        'not_found' => __('No personnels found', 'webfactor'),
        'not_found_in_trash' => __('No personnels found in Trash', 'webfactor')
      ),
      'public' => true,
      'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
      'has_archive' => true,
      'supports' => array(
        'title'
      ), // Go to Dashboard Custom HTML5 Blank post for supports
      'can_export' => true, // Allows export in Tools > Export
      'taxonomies' => array(
        //    'personnel_category'
      ) // Add Category and Post Tags support
    )
  );
}


function create_post_type_bulletin() {
  //  register_taxonomy_for_object_type('personnel_category', 'personnel'); // Register Taxonomies for Category
  register_post_type(
    'bulletin', // Register Custom Post Type
    array(
      'labels' => array(
        'name' => __('Bulletins', 'webfactor'), // Rename these to suit
        'singular_name' => __('Bulletin', 'webfactor'),
        'add_new' => __('Add New', 'webfactor'),
        'add_new_item' => __('Add New Bulletin', 'webfactor'),
        'edit' => __('Edit', 'webfactor'),
        'edit_item' => __('Edit Bulletins', 'webfactor'),
        'new_item' => __('New Bulletins', 'webfactor'),
        'view' => __('View Bulletins', 'webfactor'),
        'view_item' => __('View Bulletins', 'webfactor'),
        'search_items' => __('Search bulletins', 'webfactor'),
        'not_found' => __('No bulletins found', 'webfactor'),
        'not_found_in_trash' => __('No bulletins found in Trash', 'webfactor')
      ),
      'public' => true,
      'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
      'has_archive' => true,
      'supports' => array(
        'title',
        'editor'
      ), // Go to Dashboard Custom HTML5 Blank post for supports
      'can_export' => true, // Allows export in Tools > Export
      'taxonomies' => array(
        //    'personnel_category'
      ) // Add Category and Post Tags support
    )
  );
}

function create_post_type_evenement() {
  //  register_taxonomy_for_object_type('personnel_category', 'personnel'); // Register Taxonomies for Category
  register_post_type(
    'evenement', // Register Custom Post Type
    array(
      'labels' => array(
        'name' => __('Evenements', 'webfactor'), // Rename these to suit
        'singular_name' => __('Evenement', 'webfactor'),
        'add_new' => __('Add New', 'webfactor'),
        'add_new_item' => __('Add New evenement', 'webfactor'),
        'edit' => __('Edit', 'webfactor'),
        'edit_item' => __('Edit evenements', 'webfactor'),
        'new_item' => __('New evenements', 'webfactor'),
        'view' => __('View evenements', 'webfactor'),
        'view_item' => __('View evenements', 'webfactor'),
        'search_items' => __('Search evenements', 'webfactor'),
        'not_found' => __('No evenements found', 'webfactor'),
        'not_found_in_trash' => __('No evenements found in Trash', 'webfactor')
      ),
      'public' => true,
      'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
      'has_archive' => true,
      'supports' => array(
        'title',
        'editor'
      ), // Go to Dashboard Custom HTML5 Blank post for supports
      'can_export' => true, // Allows export in Tools > Export
      'taxonomies' => array(
        //    'personnel_category'
      ) // Add Category and Post Tags support
    )
  );
}






/*------------------------------------*\
  ShortCode Functions
  \*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null) {
  return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
  return '<h2>' . $content . '</h2>';
}




function chilly_nav($menu) {

  wp_nav_menu(
    array(
      'theme_location'  => $menu,
      'menu'            => '',
      'container'       => 'div',
      'container_class' => 'menu-{menu slug}-container',
      'container_id'    => '',
      'menu_class'      => 'menu',
      'menu_id'         => '',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '%3$s',
      'depth'           => 0,
      'walker'          => ''
    )
  );
}

function chilly_map($atts, $content = null) {

  $attributes = shortcode_atts(array(
    'title' => "Rue du Midi 15 Case postale 411 1020 Renens"
  ), $atts);



  $title = $attributes['title'];
  $chilly_map = '<div id="map_container_1"></div>';
  $chilly_map .= "<script> var latt = 46.5380683; var lonn=6.5812023; var map_title = '" . $title . "'  </script>";
  return $chilly_map;
}
add_shortcode('chilly_map', 'chilly_map');


function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');

  // filter to remove TinyMCE emojis
  // add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action('init', 'disable_wp_emojicons');


function remove_json_api() {

  // Remove the REST API lines from the HTML Header
  remove_action('wp_head', 'rest_output_link_wp_head', 10);
  remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
  // Remove the REST API endpoint.
  remove_action('rest_api_init', 'wp_oembed_register_route');
  // Turn off oEmbed auto discovery.
  add_filter('embed_oembed_discover', '__return_false');
  // Don't filter oEmbed results.
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
  // Remove oEmbed discovery links.
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
  // Remove oEmbed-specific JavaScript from the front-end and back-end.
  remove_action('wp_head', 'wp_oembed_add_host_js');
  // Remove all embeds rewrite rules.
  // add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

}
add_action('after_setup_theme', 'remove_json_api');




function count_to_bootstrap_class($count) {

  if ($count == 1) {
    $class = 'col-sm-12';
  } elseif ($count == 2) {
    $class = 'col-sm-6';
  } elseif ($count == 3) {
    $class = 'col-sm-4';
  } elseif ($count == 4) {
    $class = 'col-sm-3 col-xs-6';
  } elseif ($count <= 6) {
    $class = 'col-sm-2';
  } else {
    $class = 'col-sm-1';
  }
  return $class;
};

function thumbnail_of_post_url($post_id,  $size = 'large') {

  $image_id = get_post_thumbnail_id($post_id);
  $image_url = wp_get_attachment_image_src($image_id, $size);
  $image = $image_url[0];
  return $image;
}



// ADD OPTIONS PAGE
//add_action('admin_menu', 'add_global_custom_options');

function add_global_custom_options() {
  add_options_page('Options CMG', 'Options CMG', 'manage_options', 'functions', 'global_custom_options');
}
function global_custom_options() {
  ?>
    <div class="wrap">
      <h2>Options CMG</h2>
      <form method="post" action="options.php">
        <?php wp_nonce_field('update-options') ?>
        <p><strong>CMG ETU:</strong><br />
          <input type="text" name="wifi_username" size="45" value="<?php echo get_option('wifi_username'); ?>" />
        </p>


        <p><strong>CMG Invité:</strong><br />
          <input type="text" name="wifi_password" size="45" value="<?php echo get_option('wifi_password'); ?>" />

        </p>
        <p>
          <input type="submit" name="Submit" value="Store Options" />
          <input type="hidden" name="action" value="update" />
          <input type="hidden" name="page_options" value="wifi_password,wifi_username" />
        </p>

      </form>
    </div>
  <?php
}

add_filter('cf7_storage_csv_columns', function ($rows) {

  // Specify the field names you wish to remove
  $unset_fields = array(
    // 'mail-date',
    'mail-from',
    'mail-to',
    'mail-subject',
    'mail-body',
    'mail-attachments',
    'mail-from-name',
    'entry-id',
    'entry-url',
    'http-referer',
    'http-user-agent',
    'http-remote-addr',
  );

  foreach ($rows as &$row) {
    foreach ($unset_fields as $field_name) {
      if (isset($row[$field_name])) {
        unset($row[$field_name]);
      }
    }
  }

  return $rows;
});





function month_selected($mo, $ye) {
  if (isset($_GET['ye'])) {
    $year = $_GET['ye'];
  } else {
    $year = date(Y);
  }
  if (isset($_GET['mo'])) {
    $month = $_GET['mo'];
  } else {
    $month = date(m);
  }

  if ($month == $mo && $year == $ye) {
    echo 'active';
  }
}


// PREVENT ACCESS TO MEMBERS PAGE
add_action('template_redirect', 'redirect_if_not_loggedin');
function redirect_if_not_loggedin() {

  global $post;
  if (isset($post)) {


    if (!is_user_logged_in()   &&   !is_page_template('template-login.php')) {
      // feel free to customize the following line to suit your needs
      wp_redirect(site_url('login/?acces_refuse'), $status = 302);
      exit;
    }
  }
}


add_filter('authenticate', 'check_blank_username', 30, 3);



function  check_blank_username($user, $username, $password) {
  // forcefully capture login failed to forcefully open wp_login_failed action,
  // so that this event can be captured

  if (empty($username) || empty($password)) {
    do_action('wp_login_failed', $user);
  }
  return $user;
};


// dont go to wp-admin when you enter wrong username/password
// redirects you back to where you came from
add_action('wp_login_failed', 'jazz_login_failure');
function jazz_login_failure($username) {
  $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
  // if there's a valid referrer, and it's not the default log-in screen
  if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
    wp_redirect($referrer);  // let's append some information (login=failed) to the URL for the theme to use
    exit;
  }
}


// include_once('functions_add_new_users.php');


function admin_default_page() {
  $redirectto = get_home_url();
  return $redirectto;
}
add_filter('login_redirect', 'admin_default_page');

function set_post_order_in_admin($wp_query) {

  global $pagenow;

  if (is_admin() && 'edit.php' == $pagenow && !isset($_GET['orderby'])) {

    $wp_query->set('orderby', 'date');
    $wp_query->set('order', 'DESC');
  }
}

add_filter('pre_get_posts', 'set_post_order_in_admin', 5);

if (function_exists('acf_add_options_page')) {

  acf_add_options_page(array(
    'page_title'   => 'Options CMG',
    'menu_title'  => 'Options CMG',
    'menu_slug'   => 'cmg-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
}


function export_personnel_csv() {

  $tags = get_terms([
    'taxonomy'  => 'personnel_category',
    'hide_empty'    => false
  ]);
  $personnel = get_posts(array('posts_per_page' => -1, 'post_type' => 'personnel'));

  foreach ($tags as $t) {

    echo $t->slug;
    echo ',';
  }
  echo "\n";


  foreach ($personnel as $p) {
    $f = array();
    array_push($f, $p->post_title);
    array_push($f,  get_field('position', $p->ID));
    array_push($f,  get_field('telephone_1', $p->ID));
    array_push($f,  get_field('telephone_2', $p->ID));
    array_push($f,  get_field('email', $p->ID));
    array_push($f,  get_field('addresse', $p->ID));

    foreach ($tags as $t) {
      array_push($f,   has_term($t->term_id, 'personnel_category', $p->ID));
    }


    echo implode(',', $f);
    echo "\n";
  };
}

  ?>