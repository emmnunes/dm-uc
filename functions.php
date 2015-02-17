<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('xxl', 1920, '', true); // Large Thumbnail
    add_image_size('xl', 1024, '', true); // Large Thumbnail
    add_image_size('large', 724, '', true); // Large Thumbnail
    add_image_size('medium', 512, '', true); // Medium Thumbnail
    add_image_size('small', 256, '', true); // Small Thumbnail
    add_image_size('avatar', 300, 300, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

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
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_main_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'main-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'nav navbar-nav navbar-right',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<nav><ul class="list-unstyled">%3$s</ul></nav>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

function html5blank_user_nav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'user-menu',
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
        'items_wrap'      => '<nav><ul class="list-unstyled">%3$s</ul></nav>',
        'depth'           => 0,
        'walker'          => ''
        )
    );
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.8.3.min.js', array(), '2.8.3'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('mobile-detect', get_template_directory_uri() . '/js/lib/mobile-detect.min.js', array(), '2.8.3'); // Mobile Detect Modernizr
        wp_enqueue_script('mobile-detect'); // Enqueue it!

        wp_register_script('mobile-detect-modernizr', get_template_directory_uri() . '/js/lib/mobile-detect-modernizr.js', array('modernizr', 'mobile-detect'), '2.8.3'); // Mobile Detect Modernizr
        wp_enqueue_script('mobile-detect-modernizr'); // Enqueue it!

        wp_register_script('classie', get_template_directory_uri() . '/js/lib/classie.min.js', array(), '2.7.1'); // Classie
        wp_enqueue_script('classie'); // Enqueue it!

        wp_register_script('notification', get_template_directory_uri() . '/js/lib/notificationFx.js', array('jquery','classie', 'modernizr'), '2.7.1'); // NotificationFx
        wp_enqueue_script('notification'); // Enqueue it!

        wp_register_script('bootstrap', get_template_directory_uri() . '/js/lib/bootstrap.min.js', array('jquery'), '3.1.1'); // Bootstrap
        wp_enqueue_script('bootstrap'); // Enqueue it!

        wp_register_script('remove-diacritics', get_template_directory_uri() . '/js/lib/remove-diacritics.js', array(), '1.0.0'); // Remove Diacritics
        wp_enqueue_script('remove-diacritics'); // Enqueue it!

        wp_register_script('textarea-autosize', get_template_directory_uri() . '/js/lib/jquery.autosize.min.js', array('jquery'), '1.0.0'); // Autosize
        wp_enqueue_script('textarea-autosize'); // Enqueue it!

        wp_register_script('svgeezy', get_template_directory_uri() . '/js/lib/svgeezy.min.js', array(), '1.0.0'); // SVGeezy
        wp_enqueue_script('svgeezy'); // Enqueue it!

        wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('scripts'); // Enqueue it!

        wp_localize_script( 'scripts', 'ajax_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));
    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_page('123') || is_page('141')) {
        wp_register_script('select2-locale', '/wp-content/plugins/advanced-custom-fields-pro/inc/select2/select2_locale_pt-PT.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('select2-locale'); // Enqueue it!
    }

    if (is_home()) {
        wp_register_script('load-all-posts', get_template_directory_uri() . '/js/load-all-posts.js', array('jquery'), '1.0.0', false);
        wp_enqueue_script('load-all-posts'); // Enqueue it!

        wp_localize_script( 'load-all-posts', 'ajax_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));        
    }

    if (is_post_type_archive('trabalhos') && !is_author()) {
        wp_register_script('select2', '/wp-content/plugins/advanced-custom-fields-pro/inc/select2/select2.min.js', array('jquery'), '1.0.0', false);
        wp_enqueue_script('select2'); // Enqueue it!

        wp_register_script('select2-locale', '/wp-content/plugins/advanced-custom-fields-pro/inc/select2/select2_locale_pt-PT.js', array('jquery'), '1.0.0', false);
        wp_enqueue_script('select2-locale'); // Enqueue it!

        wp_register_script('filter-work', get_template_directory_uri() . '/js/filter-work.js', array('jquery'), '1.0.0', false);
        wp_enqueue_script('filter-work'); // Enqueue it!

        wp_localize_script( 'filter-work', 'ajax_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));

        wp_register_style('select2-css', '/wp-content/plugins/advanced-custom-fields-pro/inc/select2/select2.css', array(), '1.0', 'all');
        wp_enqueue_style('select2-css'); // Enqueue it!
    }

    if (is_author()) {
        wp_register_script('select2-locale', '/wp-content/plugins/advanced-custom-fields-pro/inc/select2/select2_locale_pt-PT.js', array('jquery', 'select2'), '1.0.0', true);
        wp_enqueue_script('select2-locale'); // Enqueue it!
    }

    if (is_page('login')) {
        wp_register_script('login', get_template_directory_uri() . '/js/login.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('login'); // Enqueue it!

        wp_localize_script( 'login', 'ajax_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));
    }

    if (is_page('recuperar')) {
        wp_register_script('retrieve', get_template_directory_uri() . '/js/retrieve.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('retrieve'); // Enqueue it!

        wp_localize_script( 'retrieve', 'ajax_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));
    }

    if (is_page('registar')) {
        wp_register_script('register', get_template_directory_uri() . '/js/register.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('register'); // Enqueue it!

        wp_localize_script( 'register', 'ajax_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));
    }

    if (is_page('231')) {
        wp_register_script('update-user-settings', get_template_directory_uri() . '/js/update-user-settings.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('update-user-settings'); // Enqueue it!

        wp_localize_script( 'update-user-settings', 'ajax_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));
    }

    if (is_page('portfolio')) {
        wp_register_script('remove-work', get_template_directory_uri() . '/js/remove-work.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('remove-work'); // Enqueue it!

        wp_localize_script( 'remove-work', 'ajax_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));
    }

    if (is_page('artigos')) {
        wp_register_script('remove-post', get_template_directory_uri() . '/js/remove-post.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('remove-post'); // Enqueue it!

        wp_localize_script( 'remove-post', 'ajax_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));
    }

    if (is_page('conta') || is_author()) {
        wp_register_script('update-user', get_template_directory_uri() . '/js/update-user.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('update-user'); // Enqueue it!

        wp_localize_script( 'update-user', 'ajax_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));
    }

    if (is_page('docencia')) {
        wp_register_script('approve-reject-work', get_template_directory_uri() . '/js/approve-reject-work.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('approve-reject-work'); // Enqueue it!    

        wp_localize_script( 'approve-reject-work', 'ajax_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));
    }

    if (is_singular('post')) {
        wp_register_script('remove-comment', get_template_directory_uri() . '/js/remove-comment.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('remove-comment'); // Enqueue it!

        wp_localize_script( 'remove-comment', 'ajax_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));
    }

    if (is_singular('trabalhos')) {
        wp_register_script('fluidbox', get_template_directory_uri() . '/js/lib/jquery.fluidbox.min.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('fluidbox'); // Enqueue it!

        wp_register_script('works', get_template_directory_uri() . '/js/works.js', array('fluidbox'), '1.0.0', true);
        wp_enqueue_script('works'); // Enqueue it!

        wp_localize_script( 'works', 'ajax_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'ajax-nonce' )
        ));
    }

    if (is_page('docencia') || is_page('portfolio') || is_page('artigos') || is_singular('post') ) {
        wp_register_script('modals', get_template_directory_uri() . '/js/modals.js', array(), '1.0.0'); // Modals
        wp_enqueue_script('modals'); // Enqueue it!
    }
      
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0', 'all');
    wp_enqueue_style('bootstrap'); // Enqueue it!

    wp_register_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', array(), '1.0', 'all');
    wp_enqueue_style('font-awesome'); // Enqueue it!

    wp_register_style('font-dm', get_template_directory_uri() . '/css/font-dm.css', array(), '1.0', 'all');
    wp_enqueue_style('font-dm'); // Enqueue it!

    if (is_archive() && !is_author()) {
        wp_register_style('select2-css', '/wp-content/plugins/advanced-custom-fields-pro/inc/select2/select2.css', array(), '1.0', 'all');
        wp_enqueue_style('select2-css'); // Enqueue it!
    }

    wp_register_style('style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('style'); // Enqueue it!
}

// Add IE conditional html5 shim to header
function add_ie_html5_shim () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_html5_shim');

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'main-menu' => __('Main Menu', 'html5blank'), // Main Navigation
        'user-menu' => __('User Menu', 'html5blank'), // User Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigationx
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
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
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Rename Wordpress Roles
function change_role_name() {
    global $wp_roles;

    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();

    //You can list all currently available roles like this...
    //$roles = $wp_roles->get_names();
    //print_r($roles);

    $wp_roles->roles['author']['name'] = 'Aluno';
    $wp_roles->role_names['author'] = 'Aluno';
    $wp_roles->roles['subscriber']['name'] = 'Docente';
    $wp_roles->role_names['subscriber'] = 'Docente';
    $wp_roles->roles['teacher_author']['name'] = 'Docente + Aluno';
    $wp_roles->role_names['teacher_author'] = 'Docente + Aluno';
    $wp_roles->roles['contributor']['name'] = 'Coordenador';
    $wp_roles->role_names['contributor'] = 'Coordenador';           
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
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
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
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
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        return false;
    } else {
        return true;
    }
}

//Block Users from seeing Dashboard
function block_dashboard() {
    if ( is_admin() && ! current_user_can( 'administrator' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
        wp_redirect( home_url() );
        exit;
    }
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}

    $avatar = get_field('avatar', 'user_' . $comment->user_id);
    $user = get_userdata($comment->user_id);
    if (implode(', ', $user->roles) == 'author') {
        $user_url = home_url() . '/aluno/' . $user->user_nicename;
    } else {
        $user_url = home_url() . '/docente/' . $user->user_nicename;
    }
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
    <?php 
        if ($comment->user_id == get_current_user_id()) {
            $nonce = wp_create_nonce('dm_remove_comment'); ?>
            <a class="remove md-trigger" data-modal="modal-rc" data-id="<?php echo $comment->comment_ID; ?>" data-nonce="<?php echo $nonce ?>"><i class="icon dm-apagar"></i></a>
    <?php } ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
    <div class="row">
	<div class="col-xs-4 col-sm-2 comment-author vcard">
    <div class="avatar">
	<?php if (!empty($avatar)) echo "<img src='" . $avatar['sizes']['avatar'] . "' />"; ?>
    </div>
	</div>
    <div class="col-xs-8 col-sm-10">
        <?php echo '<cite class="author"><a href="' . $user_url . '">' . $user->display_name . '</a></cite>'; ?>
        <?php
            $time = strtotime(get_comment_date('Y-m-d') . ' ' .  get_comment_time('H:m:s'));
            echo '<span class="comment-details"> há ' . humanTiming($time) . '</span>';
        ?>
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
            <br />
        <?php endif; ?>
        <div class="comment-content">
        <?php comment_text() ?>
        </div>

        <div class="reply">
        <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'login_text' => '', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
        <?php if ( 'div' != $args['style'] ) : ?>
        </div>
        <?php endif; ?>
        </div>
    </div>
<?php }

function humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'ano',
        2592000 => 'mês',
        604800 => 'semana',
        86400 => 'dia',
        3600 => 'hora',
        60 => 'minuto',
        1 => 'segundo'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        if ($numberOfUnits>1 && $text = 'mês') {
            $text = 'meses';
        } else {
            $text = $text.(($numberOfUnits>1)?'s':'');
        }
        return $numberOfUnits.' '.$text;
    }

}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination
add_action('init', 'change_role_name'); // Rename Wordpress Roles
add_action('init', 'block_dashboard' ); // Block Dashboard Access

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
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
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

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
    register_post_type('trabalhos', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Trabalhos', 'html5blank'), // Rename these to suit
            'singular_name' => __('Trabalho', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Adicionar novo Trabalho', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Editar Trabalho', 'html5blank'),
            'new_item' => __('Novo Trabalho', 'html5blank'),
            'view' => __('Ver Trabalho', 'html5blank'),
            'view_item' => __('Ver Trabalho', 'html5blank'),
            'search_items' => __('Procurar trabalho', 'html5blank'),
            'not_found' => __('Não foram encontrados trabalhos', 'html5blank'),
            'not_found_in_trash' => __('Nenhum trabalho encontrado na Lixeira', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true // Allows export in Tools > Export
    ));

    register_post_type('cadeiras', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Cadeiras', 'html5blank'), // Rename these to suit
            'singular_name' => __('Cadeira', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Adicionar nova Cadeira', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Editar Cadeira', 'html5blank'),
            'new_item' => __('Nova Cadeira', 'html5blank'),
            'view' => __('Ver Cadeira', 'html5blank'),
            'view_item' => __('Ver Cadeira', 'html5blank'),
            'search_items' => __('Procurar cadeira', 'html5blank'),
            'not_found' => __('Não foram encontradas cadeiras', 'html5blank'),
            'not_found_in_trash' => __('Nenhuma cadeira encontrado na Lixeira', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true // Allows export in Tools > Export
    ));
}

add_action( 'init', 'create_post_type_taxonomies' );

function create_post_type_taxonomies() {
    register_taxonomy(
        'tags',
        'trabalhos',
        array(
            'label' => __( 'Tags' ),
            'rewrite' => array( 'slug' => 'tags' ),
            'hierarchical' => true,
        )
    );
}

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

/*------------------------------------*\
    DM Custom Functions
\*------------------------------------*/

// Pesquisa por Posts
function dm_search_post()
{
    $search_query = new WP_Query( array(
        's' => $_POST['search_string'],
        'posts_per_page' => '-1',
        'post_type' => 'post',
        'post_status' => 'publish',
        'no_found_rows' => true
    ) );

    if ( $search_query->have_posts() &&  $_POST['search_string'] != ''):

        while ($search_query->have_posts()) : $search_query->the_post();

            get_template_part('inc/post-type-post');

        endwhile;

    endif;

    wp_reset_postdata();

    die();
}

add_action('wp_ajax_nopriv_dm_search_post', 'dm_search_post');
add_action('wp_ajax_dm_search_post', 'dm_search_post');

// Pesquisa por Trabalhos
function dm_search_work()
{
    $search_query = new WP_Query( array(
        's' => $_POST['search_string'],
        'posts_per_page' => '-1',
        'post_type' => 'trabalhos',
        'post_status' => 'publish',
        'no_found_rows' => true
    ) );

    if ( $search_query->have_posts() &&  $_POST['search_string'] != ''):

        while ($search_query->have_posts()) : $search_query->the_post();

            get_template_part('inc/post-type-work');

        endwhile;

    endif;

    wp_reset_postdata();

    die();
}

add_action('wp_ajax_nopriv_dm_search_work', 'dm_search_work');
add_action('wp_ajax_dm_search_work', 'dm_search_work');

// Pesquisa por Trabalhos
function dm_search_user()
{
    $search_query = new WP_User_Query( array(
        's' => $_POST['search_string'],
        'orderby' => 'display_name',
        'order' => 'ASC',
        'search_columns' => array(
            'display_name'
        ),
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key'     => 'first_name',
                'value'   => $_POST['search_string'],
                'compare' => 'LIKE'
            ),
            array(
                'key'     => 'last_name',
                'value'   => $_POST['search_string'],
                'compare' => 'LIKE'
            ),
            array(
                'key'     => 'display_name',
                'value'   => $_POST['search_string'],
                'compare' => 'LIKE'
            )
        )
    ) );

    $results = array();

    if ( $search_query->get_results() &&  $_POST['search_string'] != '') {
        foreach ( $search_query->get_results() as $user ) {
            $username = $user->user_login;
            $display_name = $user->display_name;

            $is_student = check_user_role(array('author'), $username);
            $is_teacher_coordinator = check_user_role(array('subscriber','contributor','teacher_author'), $username);

            if ($is_student) {
                $role = 'ALUNO';
                $link = home_url() . '/aluno/' . $user->user_nicename;
            } else if ($is_teacher_coordinator) {
                $role = 'DOCENTE';
                $link = home_url() . '/docente/' . $user->user_nicename;
            }

            $results[] = array(
                'display_name' => $display_name,
                'role' => $role,
                'url' => $link
            );
        }
        $results = json_encode( $results );
    } else {
        $results = '';
    }

    wp_reset_postdata();
    
    die( $results );
}

add_action('wp_ajax_nopriv_dm_search_user', 'dm_search_user');
add_action('wp_ajax_dm_search_user', 'dm_search_user');

// Login
function ajax_login(){

    check_ajax_referer( 'ajax-login-nonce', 'security' );

    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];

    $user = apply_filters('authenticate', null, $_POST['username'], $_POST['password']);
    $username = $_POST['username'];
    $is_admin = check_user_role(array('administrator'), $username);
    
    if ( get_user_meta( $user->ID, 'has_to_be_activated', true ) != false ) {
        echo json_encode(array('loggedin'=>false, 'message'=>__('A conta ainda não se encontra activa.')));
    } else {
        $user_signon = wp_signon( $info, false );
        if ( is_wp_error($user_signon) ){
            echo json_encode(array('loggedin'=>false, 'message'=>__('Nome de utilizador ou password incorrectos.')));
        } else {      
            if (!$is_admin) {

                $is_student = check_user_role(array('author'), $username);
                $is_teacher_coordinator = check_user_role(array('subscriber','contributor','teacher_author'), $username);

                if ($is_student) {
                    $link = home_url() . '/aluno/' . $user->user_nicename;
                } else if ($is_teacher_coordinator) {
                    $link = home_url() . '/docente/' . $user->user_nicename;
                } else {
                    $link = home_url() . '/conta/artigos';
                }

                echo json_encode(array('loggedin'=>true, 'redirect'=> $link, 'message'=>__('Login efectuado. A redirecionar para a sua conta.')));
            } else {
                echo json_encode(array('loggedin'=>true, 'redirect'=> home_url() . '/wp-admin', 'message'=>__('Login efectuado. A redirecionar para a sua conta.')));
            }
        }
    }

    die();
}

add_action( 'wp_ajax_nopriv_ajax_login', 'ajax_login' );

function check_user_role($roles,$username=NULL) {
    // Get user by ID, else get current user
    if ($username)
        $user = get_user_by( 'login', $username );
    else
        $user = wp_get_current_user();
 
    // No user found, return
    if (empty($user))
        return FALSE;
 
    // Append administrator to roles, if necessary
    if (!in_array('administrator',$roles))
        $roles[] = 'administrator';
 
    // Loop through user roles
    foreach ($user->roles as $role) {
        // Does user have role
        if (in_array($role,$roles)) {
            return TRUE;
        }
    }
 
    // User not in roles
    return FALSE;
}

function ajax_recover(){

    check_ajax_referer( 'ajax-recover-nonce', 'security' );

    global $wpdb;
    $username = trim($_POST['username']);
    $user_exists = false;

    if (username_exists($username))
    {
        $user_exists = true;
        $user = get_userdatabylogin($username);
    } elseif (email_exists($username))
    {
        $user_exists = true;
        $user = get_user_by_email($username);
    } else
    {
        $error[] = __('Nome de utilizador ou e-mail não encontrado.');
    }

    if ($user_exists)
    {
        $user_login = $user->user_login;
        $user_email = $user->user_email;

        // Generate something random for a password... md5'ing current time with a rand salt
        $salt = wp_generate_password(20);
        $key = sha1($salt . $user_email . uniqid(time(), true));

        // Now insert the new pass md5'd into the db
        $wpdb->query("UPDATE $wpdb->users SET user_activation_key = '$key' WHERE user_login = '$user_login'");

        //create email message
        $url = home_url();
        $logo = home_url() . '/wp-content/themes/dm/img/logo.png';
        $user = $user_login;
        $activation_link = get_option('siteurl') . "/recuperar?chave=" . $key . "&login=" . $user_login;
        ob_start();   
        include(TEMPLATEPATH . '/inc/retrieve-email-template.php');          
        $body = ob_get_contents();
        ob_end_clean();

        //send email message
        if (FALSE == wp_mail($user_email, 'Redefinição de password', $body)) {
            $error[] = __('Ocorreu um erro. Contacte o administrador.');
        }
    }

    if ($error)
    {
        foreach($error as $e){
            $errors = $e;
        }
        echo json_encode(array('recovered'=>false, 'message'=>__($errors)));
    } else
    {
        echo json_encode(array('recovered'=>true, 'message'=>__('Foi enviado um e-mail com instruções para recuperação de conta.')));
    }

    die();
}

add_action( 'wp_ajax_nopriv_ajax_recover', 'ajax_recover' );
add_action( 'wp_ajax_ajax_recover', 'ajax_recover' );

function dm_register() {

    check_ajax_referer( 'ajax-register-nonce', 'security' );

    global $wpdb;

    $userdata = array(
        'user_pass' => esc_attr( $_POST['password'] ),
        'user_login' => sanitize_title( esc_attr( $_POST['username'] ) ),
        'user_email' => esc_attr( $_POST['email'] ),
        'role' => get_option( 'default_role' ),
    );

    $domain = array_pop(explode('@', $_POST['email']));

    if ( !$userdata['user_login'] )
        echo "Por favor, introduza um nome de utilizador.";
    elseif ( username_exists($userdata['user_login']) )
        echo "Ups... parece que o utilizador introduzido já existe!";
    elseif ( !is_email($userdata['user_email'], true) || $domain != 'student.dei.uc.pt')
        echo 'Por favor, introduza um email student.dei.uc.pt válido.';
    elseif ( email_exists($userdata['user_email']) )
        echo "Ups... parece que o e-mail introduzido já está a ser utilizado!";
    elseif ( empty($_POST['password']) || empty($_POST['checkPassword']) )
        echo "Por favor, preencha os campos de password.";
    elseif ( $_POST['password'] != $_POST['checkPassword'] )
        echo "Ups... as passwords introduzidas não são iguais!";
    else {
        $user_id = wp_insert_user( $userdata );
        if ($user_id) {
            $user = get_user_by('id', $user_id);
            $user_email = $user->user_email;

            $salt = wp_generate_password(20);
            $key = sha1($salt . $user->user_email . uniqid(time(), true));

            add_user_meta( $user_id, 'has_to_be_activated', $key, true );

            $url = home_url();
            $logo = home_url() . '/wp-content/themes/dm/img/logo.png';
            $user = $user->user_login;
            $activation_link = get_option('siteurl') . "/registar?activar=$key";

            ob_start();
            
            include(TEMPLATEPATH . '/inc/register-email-template.php');        
            
            $body = ob_get_contents();
            
            ob_end_clean();
            
            if (FALSE == wp_mail( $user_email, 'Confirmação de registo',  $body)) {
                echo "Ocorreu um erro. Contacte o administrador.";
                $error = true;
            }

            if (!$error)
            {
                echo "Obrigado por se registar! Foi enviado um e-mail com instruções para activação da conta.";
            }
        }
    }

    die();
}
add_action( 'wp_ajax_nopriv_dm_register', 'dm_register' );
add_action( 'wp_ajax_dm_register', 'dm_register' );

add_filter ("wp_mail_content_type", "mail_content_type");
function mail_content_type() {
    return "text/html";
}

add_filter( 'wp_mail_from_name', 'mail_content_from_name' );
function mail_content_from_name()
{
    return 'Design e Multimédia';
}

add_filter( 'wp_mail_from', 'mail_content_from' );
function mail_content_from()
{
    return 'mail@tese.joaosaraiva.com';
}

// function custom_phpmailer_init($PHPMailer)
// {
//     $PHPMailer->IsSMTP();
//     $PHPMailer->SMTPAuth = true;
//     $PHPMailer->SMTPSecure = 'ssl';
//     $PHPMailer->Host = 'smtp.dei.uc.pt';
//     $PHPMailer->Port = 465;
//     $PHPMailer->Username = 'jpss@student.dei.uc.pt';
//     $PHPMailer->Password = '13812885';
// }
// add_action('phpmailer_init', 'custom_phpmailer_init');

function dm_change_password(){

    check_ajax_referer( 'ajax-password-nonce', 'security' );

    global $wpdb;

    $user_login = esc_attr( $_POST['username'] );
    $user_pass = esc_attr ( $_POST['password'] );
    $user_pass = wp_hash_password( $user_pass );

    if ( empty($_POST['password']) || empty($_POST['checkPassword']) )
        echo json_encode(array('redirect'=>false, 'message'=>__("Por favor, preencha os campos de password.")));
    elseif ( $_POST['password'] != $_POST['checkPassword'] )
        echo json_encode(array('redirect'=>false, 'message'=>__("Ups... as passwords introduzidas não são iguais!")));
    else {
        $wpdb->query("UPDATE $wpdb->users SET user_activation_key = '' WHERE user_login = '$user_login'");
        $wpdb->query("UPDATE $wpdb->users SET user_pass = '$user_pass' WHERE user_login = '$user_login'");
        $link = home_url() . '/login'; 
        echo json_encode(array('redirect'=>true, 'link'=> home_url() . '/login', 'message'=>__("A sua password foi alterada! A redirecionar para página de login!")));
    }

    die();

}
add_action( 'wp_ajax_nopriv_dm_change_password', 'dm_change_password' );
add_action( 'wp_ajax_dm_change_password', 'dm_change_password' );

function dm_profile_change_password(){

    check_ajax_referer( 'ajax-password-nonce', 'security' );

    $user = wp_get_current_user();
    $user_login = $user->user_login;
    $user_pass = esc_attr ( $_POST['password'] );

    if ( empty($_POST['password']) || empty($_POST['checkPassword']) )
        echo json_encode(array('message'=>__("Por favor, preencha os campos de password.")));
    elseif ( $_POST['password'] != $_POST['checkPassword'] )
        echo json_encode(array('message'=>__("Ups... as passwords introduzidas não são iguais!")));
    else {
        wp_set_password( $user_pass, $user->ID );
        wp_set_auth_cookie( $user->ID, true);
        echo json_encode(array('message'=>__("A sua password foi alterada!")));
    }

    die();

}
add_action( 'wp_ajax_dm_profile_change_password', 'dm_profile_change_password' );

function dm_profile_change_nicename(){

    check_ajax_referer( 'ajax-password-nonce', 'security' );

    global $wpdb;

    $user = wp_get_current_user();
    $user_login = $user->user_login;   
    $user_nicename = esc_attr ( $_POST['nicename'] );
    $user_nicename = sanitize_title( $user_nicename );

    $check_nicename = get_user_by( 'slug', $user_nicename);

    $is_student = check_user_role(array('author'), $user_login);
    $is_teacher_coordinator = check_user_role(array('subscriber','contributor','teacher_author'), $user_login);

    if ($is_student) {
        $link = home_url() . '/aluno/' . $user_nicename;
    } else if ($is_teacher_coordinator) {
        $link = home_url() . '/docente/' . $user_nicename;
    }

    if ( $_POST['nicename'] == '' )
        echo json_encode(array('message'=>__("Por favor, preencha o campo.")));
    else if ( $check_nicename->first_name != '' )
        echo json_encode(array('message'=>__("Não foi possível alterar o seu nickname. Já está a ser utilizado.")));
    else {
        $wpdb->query("UPDATE $wpdb->users SET user_nicename = '$user_nicename' WHERE user_login = '$user_login'");
        echo json_encode(array('link' => $link, 'message'=>__("O link para o seu perfil foi alterado com sucesso!")));
    }

    die();

}
add_action( 'wp_ajax_dm_profile_change_nicename', 'dm_profile_change_nicename' );

// Função para remover trabalho
function dm_remove_work(){

    $permission = check_ajax_referer( 'dm_remove_work_nonce', 'nonce', false );

    if( $permission == false ) {
        echo 'error';
    } else {
        wp_delete_post( $_REQUEST['id'] );
        echo 'success';
    }

    die();

}

add_action( 'wp_ajax_dm_remove_work', 'dm_remove_work' );

// Função para remover comentário
function dm_remove_comment(){

    $permission = check_ajax_referer( 'dm_remove_comment', 'nonce', false );

    if( $permission == false ) {
        echo 'error';
    } else {
        wp_delete_comment( $_REQUEST['id'] );
        echo 'success';
    }

    die();

}

add_action( 'wp_ajax_dm_remove_comment', 'dm_remove_comment' );

// Função para remover artigo
function dm_remove_post(){

    $permission = check_ajax_referer( 'dm_remove_post_nonce', 'nonce', false );

    if( $permission == false ) {
        echo 'error';
    } else {
        wp_delete_post( $_REQUEST['id'] );
        echo 'success';
    }

    die();

}

add_action( 'wp_ajax_dm_remove_post', 'dm_remove_post' );

// Função para aprovar trabalho
function dm_approve_work(){

    $permission = check_ajax_referer( 'dm_approve_work_nonce', 'nonce', false );

    if( $permission == false ) {
        echo 'error';
    } else {
        $post = array( 'ID' => $_REQUEST['id'], 'post_status' => 'publish' );
        wp_update_post($post);
        echo 'success';
    }

    die();

}

add_action( 'wp_ajax_dm_approve_work', 'dm_approve_work' );

// Função para rejeitar trabalho
function dm_reject_work(){

    $permission = check_ajax_referer( 'dm_reject_work_nonce', 'nonce', false );

    if( $permission == false ) {
        echo 'error';
    } else {
        $post = array( 'ID' => $_REQUEST['id'], 'post_status' => 'trash' );
        wp_update_post($post);
        echo 'success';
    }

    die();

}

add_action( 'wp_ajax_dm_reject_work', 'dm_reject_work' );

// Função para actualizar o perfil
function dm_update_profile() {

    global $current_user;

    require_once( ABSPATH . WPINC . '/registration.php' );
    $error = array();

    /* Update user password. */
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] )
            wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
        else
            $error[] = __('- As passwords que inseriu não são iguais.', 'profile');
    }

    /* Update user information. */
    if ( !empty( $_POST['url'] ) )
        wp_update_user( array ('ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] )));
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] )))
            $error[] = __('- O email introduzido não é válido. Por favor verifique.', 'profile');
        elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id && email_exists(esc_attr( $_POST['email'] )) != false)
            $error[] = __('- O email já está a ser utilizado por outro utilizador.', 'profile');
        else{
            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
        }
    } else {
        $error[] = __('- O campo email tem de estar preenchido.', 'profile');
    }

    $display_name = esc_attr( $_POST['firstname'] ) . ' ' . esc_attr( $_POST['lastname'] );

    if ( !empty( $_POST['firstname'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['firstname'] ) );
    if ( !empty( $_POST['lastname'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['lastname'] ) );
    if ( !empty( $_POST['firstname'] ) && !empty( $_POST['lastname'] ) )
        wp_update_user( array ('ID' => $current_user->ID, 'display_name' => $display_name ) ) ;
    if ( !empty( $_POST['description'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );

    /* Update ACF Fields */
    update_field('field_53c747e0a9ba7', $_POST['avatar'], 'user_' . $current_user->ID);
    update_field('field_53cb01b22aa4e', $_POST['facebook'], 'user_' . $current_user->ID);
    update_field('field_53cb01f92aa4f', $_POST['twitter'], 'user_' . $current_user->ID);
    update_field('field_54e2237f38128', $_POST['linkedin'], 'user_' . $current_user->ID);
    update_field('field_53cb02012aa50', $_POST['pinterest'], 'user_' . $current_user->ID);
    update_field('field_53cb020a2aa51', $_POST['dribbble'], 'user_' . $current_user->ID);
    update_field('field_53cb021a2aa52', $_POST['behance'], 'user_' . $current_user->ID);
    update_field('field_53cb02442aa54', $_POST['vimeo'], 'user_' . $current_user->ID);
    update_field('field_53ea566958547', $_POST['description'], 'user_' . $current_user->ID);

    if ( !empty( $_POST['courses'] ) ) {
        $newCourses = $_POST['courses'];  
        $newCourses = explode(",", $newCourses);
        $courses = array();
        foreach ($newCourses as $course) {
            $courses[] = get_post($course);
        }
        update_field('field_53e65cfd1864b', $courses, 'user_' . $current_user->ID);
    }  

    if ( count($error) == 0 ) {

        $success = 'O seu perfil foi actualizado.';

        die( $success );

    } else {
        $error = json_encode($error, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        die( $error );
    }

}

add_action( 'wp_ajax_dm_update_profile', 'dm_update_profile' );


// Restringir o acesso a certas páginas
function dm_restrict_page_access() {

  if ( ! is_page() ) return;

  /*
     90 - conta
    121 - conta/portfolio
    123 - conta/portfolio/novo
    141 - conta/portfolio/editar
    231 - conta/definicoes
    356 - conta/docencia
    370 - conta/artigos
    373 - conta/artigos/novo 
    377 - conta/artigos/editar 
  */

    if ( is_user_logged_in() ) {
        $is_editor = check_user_role(array('editor'));
        $is_student = check_user_role(array('author'));
        $is_teacher = check_user_role(array('subscriber','contributor'));
        $is_admin = check_user_role(array('administrator'));
        if ($is_editor) {
            $restricted = array( 90, 121, 123, 141, 231, 356 );
        } else if ($is_student) {
            $restricted = array( 90, 356, 370, 373, 377 );
        } else if ($is_teacher) {
            $restricted = array( 90, 121, 123, 141 );
        } else if ( $is_admin ) {
            $restricted = array( 90 );
        } else {
            $restricted = array( 90 );
        }   
    } else {
        $restricted = array( 90, 121, 141, 123, 370, 377, 373, 231, 356 );
    }

    if ( in_array( get_queried_object_id(), $restricted ) ) {
        wp_redirect( home_url() ); 
        exit();
    }

}

add_action( 'template_redirect', 'dm_restrict_page_access' );

// Remover campo default para o título
function dm_remove_work_title() {
    remove_post_type_support( 'post', 'title' );
    remove_post_type_support( 'trabalhos', 'title' );
}
add_action( 'init', 'dm_remove_work_title', 10 );

// Actualizar título com campo do ACF
function dm_update_work_title($post_id) {
    $title = '';
    
    switch (get_post_type($post_id)) {
        case 'trabalhos':
            $title = get_field('titulo', $post_id); break;
        case 'post':
            $title = get_field('titulo', $post_id); break;
    }
    
    if (!empty($title)) {
        $slug = sanitize_title($title);
        $my_post = array(
            'ID' => $post_id,
            'post_title' => $title,
            'post_name' => $slug
        );
        wp_update_post($my_post);
    }
}
add_action('acf/save_post', 'dm_update_work_title', 20);


function current_user_display_name(){
    $user = wp_get_current_user();
    return $user->display_name;
}
add_shortcode( 'current_user_display_name' , 'current_user_display_name' );

function current_user_profile_link() {
    $user = wp_get_current_user();
    if ( empty($user) || !$user->exists() ) {
        return 'not_logged_in';
    }

    $username = $user->user_login;

    $is_student = check_user_role(array('author'), $username);
    $is_teacher_coordinator = check_user_role(array('subscriber','contributor','teacher_author'), $username);

    if ($is_student) {
        $link = home_url() . '/aluno/' . $user->user_nicename;
    } else if ($is_teacher_coordinator) {
        $link = home_url() . '/docente/' . $user->user_nicename;
    }

    return $link;
}
add_shortcode('current_user_profile_link', 'current_user_profile_link');

function dynamic_menu_items( $menu_items ) {

    foreach ( $menu_items as $menu_item ) {

        if ( '#profile_link#' == $menu_item->url ) {

            global $shortcode_tags;

            if ( isset( $shortcode_tags['current_user_profile_link'] ) ) {

                $menu_item->title = call_user_func( $shortcode_tags['current_user_display_name'] );
                $menu_item->url = call_user_func( $shortcode_tags['current_user_profile_link'] );
            }
        }
    }

    return $menu_items;
}
add_filter( 'wp_nav_menu_objects', 'dynamic_menu_items' );

// Adicionar botão de logout ao menu de utilizador
function add_logout_item_to_menu( $items, $args ){

    if( is_admin() || $args->theme_location != 'user-menu' )
        return $items; 

    $redirect = ( is_home() ) ? false : get_permalink();
    if( is_user_logged_in( ) )
        $link = '<a href="' . wp_logout_url( home_url('login') ) . '" title="' .  __( 'Logout' ) .'">' . __( 'Logout' ) . '</a>';

    return $items.= '<li id="logout" class="menu-item menu-type-link">'. $link . '</li>';
}

add_filter( 'wp_nav_menu_items', 'add_logout_item_to_menu', 50, 2 );

add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars )
{

    $toolbars['Very Simple' ] = array();
    $toolbars['Very Simple' ][1] = array('bold' , 'italic' , 'underline', 'link', 'unlink' );
 
    if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
    {
        unset( $toolbars['Full' ][2][$key] );
    }
 
    unset( $toolbars['Basic' ] );
 
    return $toolbars;
}

add_filter( 'tiny_mce_before_init', 'override_mp6_tinymce_styles' );
function override_mp6_tinymce_styles( $mce_init ) {
    
    $content_css = get_stylesheet_directory_uri() . '/css/tinymce-style.css';
    if ( isset( $mce_init[ 'content_css' ] ) )
    $content_css .= ',' . $mce_init[ 'content_css' ];
    
    $mce_init[ 'content_css' ] = $content_css;
    
    return $mce_init;

}

add_filter("mce_external_plugins", "tomjn_mce_external_plugins");
function tomjn_mce_external_plugins($plugin_array){
    $plugin_array['typekit']  =  get_template_directory_uri().'/js/lib/typekit.tinymce.js';
    return $plugin_array;
}

function tag_class( $tag ) {
    $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                                'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                                'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                                'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                                'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', ' '=> '-' );
    $tag = strtolower(strtr( $tag, $unwanted_array ));

    return $tag;
}

function dm_get_works() {

    $query_data = $_GET;

    $meta_query = array();

    $course = ($query_data['course']) ? $query_data['course'] : false;
    $tag = ($query_data['tag']) ? $query_data['tag'] : false;
    $edition = ($query_data['edition']) ? $query_data['edition'] : false;
    $teacher = ($query_data['teacher']) ? $query_data['teacher'] : false;
    $numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
    $page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;

    if( !empty($course) )
    {
        $meta_query[] = array(
            'key'       => 'cadeira',
            'value'     => $course
        );
    }

    if( !empty($tag) )
    {
        $meta_query[] = array(
            'key'       => 'etiquetas',
            'value'     => $tag,
            'compare'   => 'LIKE'
        );
    }

    if( !empty($edition) )
    {
        $meta_query[] = array(
            'key'       => 'edição',
            'value'     => $edition
        );
    }

    if( !empty($teacher) )
    {
        $meta_query[] = array(
            'key'       => 'docente',
            'value'     => $teacher,
            'compare'   => 'LIKE'
        );
    }

    $args = array(
        'posts_per_page' => $numPosts,
        'paged'          => $page,
        'post_type' => 'trabalhos',
        'post_status' => 'publish',
        'meta_query' => $meta_query
    );
    $query = new WP_Query( $args );

    if ($query->have_posts()):

        while ($query->have_posts()) : $query->the_post();

            get_template_part('inc/post-type-work');

        endwhile;

    else:
        echo '<div class="col-xs-12"><h4>Não existem trabalhos para os filtros seleccionados!</h4></div>';
    endif;

    wp_reset_postdata();

    die();
}

add_action('wp_ajax_dm_get_works', 'dm_get_works');
add_action('wp_ajax_nopriv_dm_get_works', 'dm_get_works');

function dm_get_num_works() {
    $query_data = $_GET;

    $meta_query = array();

    $course = ($query_data['course']) ? $query_data['course'] : false;
    $tag = ($query_data['tag']) ? $query_data['tag'] : false;
    $edition = ($query_data['edition']) ? $query_data['edition'] : false;
    $teacher = ($query_data['teacher']) ? $query_data['teacher'] : false;
    $numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
    $page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;

    if( !empty($course) )
    {
        $meta_query[] = array(
            'key'       => 'cadeira',
            'value'     => $course
        );
    }

    if( !empty($tag) )
    {
        $meta_query[] = array(
            'key'       => 'etiquetas',
            'value'     => $tag,
            'compare'   => 'LIKE'
        );
    }

    if( !empty($edition) )
    {
        $meta_query[] = array(
            'key'       => 'edição',
            'value'     => $edition
        );
    }

    if( !empty($teacher) )
    {
        $meta_query[] = array(
            'key'       => 'docente',
            'value'     => $teacher,
            'compare'   => 'LIKE'
        );
    }

    $args = array(
        'posts_per_page' => $numPosts,
        'paged'          => $page,
        'post_type' => 'trabalhos',
        'post_status' => 'publish',
        'meta_query' => $meta_query
    );
    $query = new WP_Query( $args );

    $numPages = $query->max_num_pages;
    
    wp_reset_query();

    echo $numPages;

    die();
}

add_action('wp_ajax_dm_get_num_works', 'dm_get_num_works');
add_action('wp_ajax_nopriv_dm_get_num_works', 'dm_get_num_works');

function dm_get_all_posts() {
    $numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
    $page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;

    $args = array(
        'posts_per_page' => $numPosts,
        'paged'          => $page,
        'post_type' => array( 'post', 'trabalhos'),
        'post_status' => 'publish'
    );
    $query = new WP_Query( $args );

    if ($query->have_posts()): while ($query->have_posts()) : $query->the_post();
          
        if (get_post_type() == 'trabalhos') {
            get_template_part('inc/post-type-work');
        } elseif (get_post_type() == 'post') {
            get_template_part('inc/post-type-post');
        } 
   
    endwhile;
    endif;

    wp_reset_query();

    die();
}

add_action('wp_ajax_dm_get_all_posts', 'dm_get_all_posts');
add_action('wp_ajax_nopriv_dm_get_all_posts', 'dm_get_all_posts');

function dm_get_num_all_posts() {
    $numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;

    $args = array(  
        'posts_per_page' => $numPosts,
        'post_type' => array( 'post', 'trabalhos'),
        'post_status' => 'publish'
    );
    $query = new WP_Query( $args );

    $numPages = $query->max_num_pages;
    
    wp_reset_query();

    echo $numPages;

    die();
}

add_action('wp_ajax_dm_get_num_all_posts', 'dm_get_num_all_posts');
add_action('wp_ajax_nopriv_dm_get_num_all_posts', 'dm_get_num_all_posts');

add_action('init', 'do_output_buffer');
function do_output_buffer() {
        ob_start();
}

//restrict authors to only being able to view media that they've uploaded
function my_files_only( $wp_query ) {
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/upload.php' ) !== false
    || strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) !== false ) {
        if ( !current_user_can( 'level_5' ) ) {
            global $current_user;
            $wp_query->set( 'author', $current_user->id );
        }
    }
}
add_filter('parse_query', 'my_files_only' );

function ml_restrict_media_library( $wp_query_obj ) {
    global $current_user, $pagenow;

    if( !is_a( $current_user, 'WP_User') ) {
        return;
    }
    if( 'admin-ajax.php' != $pagenow || $_REQUEST['action'] != 'query-attachments' ) {
        return;
    }
    if( !current_user_can('manage_media_library') ) {
        $author_search = ''; 
        $authors = get_post_meta( $_REQUEST['trabalho'], 'autor' ,true);
        foreach($authors as $author) {

            $author_search .= $author;

            if ($author !== end(($authors))) {
                $author_search .= ',';
            } 

        }
        $wp_query_obj->set( 'author', $current_user->id );  
        
        return;
    }
}
add_action('pre_get_posts','ml_restrict_media_library');

function home_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );

/* Post Like */

add_action( 'wp_ajax_nopriv_jm-post-like', 'jm_post_like' );
add_action( 'wp_ajax_jm-post-like', 'jm_post_like' );
function jm_post_like() {
    $nonce = $_POST['nonce'];
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Nope!' );
    
    if ( isset( $_POST['jm_post_like'] ) ) {
    
        $post_id = $_POST['post_id']; // post id
        $post_like_count = get_post_meta( $post_id, "_post_like_count", true ); // post like count
        
        if ( function_exists ( 'wp_cache_post_change' ) ) { // invalidate WP Super Cache if exists
            $GLOBALS["super_cache_enabled"]=1;
            wp_cache_post_change( $post_id );
        }
        
        if ( is_user_logged_in() ) { // user is logged in
            $user_id = get_current_user_id(); // current user
            $meta_POSTS = get_user_option( "_liked_posts", $user_id  ); // post ids from user meta
            $meta_USERS = get_post_meta( $post_id, "_user_liked" ); // user ids from post meta
            $liked_POSTS = NULL; // setup array variable
            $liked_USERS = NULL; // setup array variable
            
            if ( count( $meta_POSTS ) != 0 ) { // meta exists, set up values
                $liked_POSTS = $meta_POSTS;
            }
            
            if ( !is_array( $liked_POSTS ) ) // make array just in case
                $liked_POSTS = array();
                
            if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values
                $liked_USERS = $meta_USERS[0];
            }       

            if ( !is_array( $liked_USERS ) ) // make array just in case
                $liked_USERS = array();
                
            $liked_POSTS['post-'.$post_id] = $post_id; // Add post id to user meta array
            $liked_USERS['user-'.$user_id] = $user_id; // add user id to post meta array
            $user_likes = count( $liked_POSTS ); // count user likes
    
            if ( !AlreadyLiked( $post_id ) ) { // like the post
                update_post_meta( $post_id, "_user_liked", $liked_USERS ); // Add user ID to post meta
                update_post_meta( $post_id, "_post_like_count", ++$post_like_count ); // +1 count post meta
                update_user_option( $user_id, "_liked_posts", $liked_POSTS ); // Add post ID to user meta
                update_user_option( $user_id, "_user_like_count", $user_likes ); // +1 count user meta
                echo $post_like_count; // update count on front end

            } else { // unlike the post
                $pid_key = array_search( $post_id, $liked_POSTS ); // find the key
                $uid_key = array_search( $user_id, $liked_USERS ); // find the key
                unset( $liked_POSTS[$pid_key] ); // remove from array
                unset( $liked_USERS[$uid_key] ); // remove from array
                $user_likes = count( $liked_POSTS ); // recount user likes
                update_post_meta( $post_id, "_user_liked", $liked_USERS ); // Remove user ID from post meta
                update_post_meta($post_id, "_post_like_count", --$post_like_count ); // -1 count post meta
                update_user_option( $user_id, "_liked_posts", $liked_POSTS ); // Remove post ID from user meta          
                update_user_option( $user_id, "_user_like_count", $user_likes ); // -1 count user meta
                echo "already".$post_like_count; // update count on front end
                
            }
            
        } else { // user is not logged in (anonymous)
            $ip = $_SERVER['REMOTE_ADDR']; // user IP address
            $meta_IPS = get_post_meta( $post_id, "_user_IP" ); // stored IP addresses
            $liked_IPS = NULL; // set up array variable
            
            if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
                $liked_IPS = $meta_IPS[0];
            }
    
            if ( !is_array( $liked_IPS ) ) // make array just in case
                $liked_IPS = array();
                
            if ( !in_array( $ip, $liked_IPS ) ) // if IP not in array
                $liked_IPS['ip-'.$ip] = $ip; // add IP to array
            
            if ( !AlreadyLiked( $post_id ) ) { // like the post
                update_post_meta( $post_id, "_user_IP", $liked_IPS ); // Add user IP to post meta
                update_post_meta( $post_id, "_post_like_count", ++$post_like_count ); // +1 count post meta
                echo $post_like_count; // update count on front end
                
            } else { // unlike the post
                $ip_key = array_search( $ip, $liked_IPS ); // find the key
                unset( $liked_IPS[$ip_key] ); // remove from array
                update_post_meta( $post_id, "_user_IP", $liked_IPS ); // Remove user IP from post meta
                update_post_meta( $post_id, "_post_like_count", --$post_like_count ); // -1 count post meta
                echo "already".$post_like_count; // update count on front end
                
            }
        }
    }
    
    exit;
}

function AlreadyLiked( $post_id ) { // test if user liked before
    if ( is_user_logged_in() ) { // user is logged in
        $user_id = get_current_user_id(); // current user
        $meta_USERS = get_post_meta( $post_id, "_user_liked" ); // user ids from post meta
        $liked_USERS = ""; // set up array variable
        
        if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values
            $liked_USERS = $meta_USERS[0];
        }
        
        if( !is_array( $liked_USERS ) ) // make array just in case
            $liked_USERS = array();
            
        if ( in_array( $user_id, $liked_USERS ) ) { // True if User ID in array
            return true;
        }
        return false;
        
    } else { // user is anonymous, use IP address for voting
    
        $meta_IPS = get_post_meta( $post_id, "_user_IP" ); // get previously voted IP address
        $ip = $_SERVER["REMOTE_ADDR"]; // Retrieve current user IP
        $liked_IPS = ""; // set up array variable
        
        if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
            $liked_IPS = $meta_IPS[0];
        }
        
        if ( !is_array( $liked_IPS ) ) // make array just in case
            $liked_IPS = array();
        
        if ( in_array( $ip, $liked_IPS ) ) { // True is IP in array
            return true;
        }
        return false;
    }
    
}

function getPostLikeLink( $post_id ) {
    $like_count = get_post_meta( $post_id, "_post_like_count", true ); // get post likes
    $count = ( empty( $like_count ) || $like_count == "0" ) ? '0' : esc_attr( $like_count );
    if ( AlreadyLiked( $post_id ) ) {
        $class = esc_attr( ' liked' );
        $title = esc_attr( 'Depreciar' );
        $heart = '<i id="icon-like" class="dm-depreciar dm-2x"></i>';
    } else {
        $class = esc_attr( '' );
        $title = esc_attr( 'Apreciar' );
        $heart = '<i id="icon-unlike" class="dm-apreciar dm-2x"></i>';
    }
    $output = '<a href="#" class="jm-post-like'.$class.'" data-post_id="'.$post_id.'" title="'.$title.'">'.$heart.'&nbsp;<span class="count">'.$count.'</span></a>';
    return $output;
}

?>
