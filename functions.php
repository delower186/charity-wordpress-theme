<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

require_once(get_template_directory() . "/inc/theme_customization.php");
require_once(get_template_directory() . "/inc/Bootstrap_5_WP_Nav_Menu_Walker.php");
require_once(get_template_directory() . "/inc/custom_post_types.php");
require_once(get_template_directory() . "/inc/custom_meta_boxes.php");
require_once(get_template_directory() . "/inc/forms.php");
require_once(get_template_directory() . "/inc/utilities.php");

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


function charity_register_scripts(){
    // Vendor JS Files
    wp_enqueue_script('jquery');
    wp_enqueue_script( "charity-bootstrap", get_template_directory_uri()."/js/bootstrap.min.js", array(), "5.2.2", "all",true);
    wp_enqueue_script( "charity-jquery-sticky", get_template_directory_uri()."/js/jquery.sticky.js", array(), "1.0.3", "all",true);
    wp_enqueue_script( "charity-click-scroll", get_template_directory_uri()."/js/click-scroll.js", array(), "1.0.0", "all",true);
    wp_enqueue_script( "charity-counter", get_template_directory_uri()."/js/counter.js", array(), "1.0.0", "all",true);
    // Main JS File
    wp_enqueue_script( "charity-main", get_template_directory_uri()."/js/main.js", array(), "1.0.0", "all",true);
}

add_action( "wp_enqueue_scripts", "charity_register_scripts");

/**
 * Register menu
 */

function charity_register_menus() {
  register_nav_menus([
    'primary' => __("Primary Menu","charity"),
  ]);
}
add_action( 'after_setup_theme', 'charity_register_menus' );