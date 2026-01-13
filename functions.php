<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
// Add theme support for Elementor
add_theme_support('elementor');
add_theme_support('align-wide');

// Elementor Plugin Enable for Custom Post Type Causes
add_post_type_support('causes', 'editor');
add_post_type_support('causes', 'elementor');



require_once(get_template_directory() . "/inc/tgm-plugin-activation.php");
require_once(get_template_directory() . "/inc/theme_customization.php");
require_once(get_template_directory() . "/inc/Bootstrap_5_WP_Nav_Menu_Walker.php");
require_once(get_template_directory() . "/inc/custom_post_types.php");
require_once(get_template_directory() . "/inc/custom_meta_boxes.php");
require_once(get_template_directory() . "/inc/forms.php");
require_once(get_template_directory() . "/inc/utilities.php");
require_once(get_template_directory() . "/widgets/custom_search_widget.php");
require_once(get_template_directory() . "/widgets/custom_newsletter_widget.php");

function charity_theme_support(){
    // adds dynamic title tag support
    add_theme_support('title-tag');

    // custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 524,
        'width'       => 524,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // featured image support to portfolio post type
    add_theme_support( 'post-thumbnails' );
}

add_action( "after_setup_theme", "charity_theme_support");

function charity_register_styles(){

    $version = wp_get_theme()->get('Version');
    
    // Fonts
    wp_enqueue_style( "Metropolis-Regular-woff2", get_template_directory_uri()."/fonts/Metropolis/Metropolis-Regular.woff2", array(), "1.0", "all" );
    wp_enqueue_style( "Metropolis-Regular-woff", get_template_directory_uri()."/fonts/Metropolis/Metropolis-Regular.woff", array(), "1.0", "all" );
    wp_enqueue_style( "Metropolis-Light-woff2", get_template_directory_uri()."/fonts/Metropolis/Metropolis-Light.woff2", array(), "1.0", "all" );
    wp_enqueue_style( "Metropolis-Light-woff", get_template_directory_uri()."/fonts/Metropolis/Metropolis-Light.woff", array(), "1.0", "all" );
    wp_enqueue_style( "Metropolis-SemiBold-woff2", get_template_directory_uri()."/fonts/Metropolis/Metropolis-SemiBold.woff2", array(), "1.0", "all" );
    wp_enqueue_style( "Metropolis-SemiBold-woff", get_template_directory_uri()."/fonts/Metropolis/Metropolis-SemiBold.woff", array(), "1.0", "all" );
    wp_enqueue_style( "Metropolis-Bold-woff2", get_template_directory_uri()."/fonts/Metropolis/Metropolis-Bold.woff2", array(), "1.0", "all" );
    wp_enqueue_style( "Metropolis-Bold-woff", get_template_directory_uri()."/fonts/Metropolis/Metropolis-Bold.woff", array(), "1.0", "all" );

    
    // Vendor CSS Files 
    wp_enqueue_style( "charity-bootstrap", get_template_directory_uri()."/css/bootstrap.min.css", array(), "5.2.2", "all" );
    wp_enqueue_style( "charity-bootstrap-icons", get_template_directory_uri()."/css/bootstrap-icons.css", array(), "1.0.0", "all" );


    // Main CSS File
    wp_enqueue_style( "charity-main", get_template_directory_uri()."/css/main.css", array(), "1.0", "all" );

    // Style
    wp_enqueue_style( "charity-style", get_template_directory_uri()."/style.css", array(), $version, "all" );
}

add_action( "wp_enqueue_scripts", "charity_register_styles");


function charity_register_scripts() {
    // Vendor JS Files
    wp_enqueue_script('jquery'); // always enqueue jQuery first

    wp_enqueue_script(
        'charity-bootstrap',
        get_template_directory_uri() . '/js/bootstrap.min.js',
        array('jquery'), // make Bootstrap dependent on jQuery
        '5.2.2',
        true
    );

    wp_enqueue_script(
        'charity-jquery-sticky',
        get_template_directory_uri() . '/js/jquery.sticky.js',
        array('jquery'), // jQuery dependency ensures $ is defined
        '1.0.3',
        true
    );

    wp_enqueue_script(
        'charity-click-scroll',
        get_template_directory_uri() . '/js/click-scroll.js',
        array('jquery'), // jQuery dependency ensures $ is defined
        '1.0.0',
        true
    );

    wp_enqueue_script(
        'charity-counter',
        get_template_directory_uri() . '/js/counter.js',
        array('jquery'), // if this depends on jQuery
        '1.0.0',
        true
    );

    // Main JS File
    wp_enqueue_script(
        'charity-main',
        get_template_directory_uri() . '/js/main.js',
        array('jquery'), // main.js depends on jQuery
        '1.0.0',
        true
    );
}

add_action('wp_enqueue_scripts', 'charity_register_scripts');


/**
 * Register menu
 */

function charity_register_menus() {
  register_nav_menus([
    'primary' => __("Primary Menu","charity"),
  ]);
}
add_action( 'after_setup_theme', 'charity_register_menus' );

/***
 * Register widget area
 */
function charity_widgets_init() {
	
    $widgets = ['blog-sidebar-top'];

    foreach($widgets as $widget){
        register_sidebar(
            array(
                'name'          => esc_html__( strtoupper($widget), 'charity' ),
                'id'            => $widget,
                'description'   => esc_html__( 'Add Widgets here.', 'charity' ),
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '',
                'after_title'   => '',
            )
        );
    }

    $widgets = ['blog-sidebar-bottom'];

    foreach($widgets as $widget){
        register_sidebar(
            array(
                'name'          => esc_html__( strtoupper($widget), 'charity' ),
                'id'            => $widget,
                'description'   => esc_html__( 'Add Widgets here.', 'charity' ),
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '',
                'after_title'   => '',
            )
        );
    }
}
add_action( 'widgets_init', 'charity_widgets_init' );
/**
 * Summary of charity_comment_callback
 * @param mixed $comment
 * @param mixed $args
 * @param mixed $depth
 * @return void
 */
function charity_comment_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    $is_reply = $comment->comment_parent ? ' ms-5 ps-3' : ' mt-3 mb-4';
    ?>
    <div <?php comment_class("author-comment d-flex flex-column {$is_reply}"); ?> id="comment-<?php comment_ID(); ?>">
        <div class="d-flex align-items-start">
            <?php echo get_avatar($comment, 60, '', '', ['class' => 'img-fluid avatar-image me-3']); ?>
            <div class="author-comment-info flex-grow-1">
                <h6 class="mb-1"><?php comment_author(); ?></h6>
                <p class="mb-0"><?php comment_text(); ?></p>
                <div class="d-flex mt-2">
                    <?php
                    comment_reply_link(array_merge($args, array(
                        'reply_text' => 'Reply',
                        'depth'      => $depth,
                        'max_depth'  => $args['max_depth'],
                        'before'     => '<span class="author-comment-link">',
                        'after'      => '</span>',
                    )));
                    ?>
                </div>
            </div>
        </div>

        <?php if ( $comment->has_children ) : ?>
            <div class="children mt-3 ps-4">
                <?php wp_list_comments(array(
                    'callback' => 'charity_comment_callback',
                    'style' => 'div',
                    'avatar_size' => 60,
                    'max_depth' => $args['max_depth'],
                ), $comment->get_children()); ?>
            </div>
        <?php endif; ?>
    </div>
<?php
}


/**
 * Summary of charity_enable_threaded_comments
 * @return void
 */
function charity_enable_threaded_comments() {
    if ( is_singular() && comments_open() && get_option('thread_comments') ) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'charity_enable_threaded_comments');

// Add Bootstrap classes to name, email, website fields
function charity_bootstrap_comment_form_fields($fields) {
    foreach ($fields as $key => $field) {
        // Exclude cookies consent
        if ($key === 'cookies') {
            continue;
        }
        $fields[$key] = str_replace('<input', '<input class="form-control mb-2"', $field);
    }
    return $fields;
}
add_filter('comment_form_default_fields', 'charity_bootstrap_comment_form_fields');

// Add Bootstrap class to textarea
function charity_bootstrap_comment_form_textarea($field) {
    return str_replace(
        '<textarea',
        '<textarea class="form-control mb-2"',
        $field
    );
}
add_filter('comment_form_field_comment', 'charity_bootstrap_comment_form_textarea');



