<?php
// generate slider post type
function charity_create_slider_post_type(){   
        
    $args = array(

        'labels' => array(
            'name'               => 'Slider',
            'singular_name'      => 'Slide',
            'menu_name'          => 'Slides',
            'add_new'            => "Add New Slide",
            'add_new_item'       => "Add New Slide",
            'new_item'           => "New Slide",
            'edit_item'          => "Edit Slide",
            'view_item'          => "View Slide",
            'all_items'          => "All Slides",

        ),

        'public' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'slider'),
        'supports' => array('title','editor','thumbnail'),
        'menu_icon' => 'dashicons-slides',
    );

    register_post_type( 'slider', $args );
    
}

add_action( 'init', 'charity_create_slider_post_type');
/**
 * Summary of charity_create_causes_post_type
 * @return void
 */
function charity_create_causes_post_type(){   
        
    $args = array(

        'labels' => array(
            'name'               => 'Causes',
            'singular_name'      => 'Cause',
            'menu_name'          => 'Causes',
            'add_new'            => "Add New Cause",
            'add_new_item'       => "Add New Cause",
            'new_item'           => "New Cause",
            'edit_item'          => "Edit Cause",
            'view_item'          => "View Cause",
            'all_items'          => "All Causes",

        ),

        'public' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'cause'),
        'supports' => array('title','editor','thumbnail'),
        'menu_icon' => 'dashicons-list-view',
    );

    register_post_type( 'causes', $args );
    
}

add_action( 'init', 'charity_create_causes_post_type');
/**
 * Summary of charity_create_testimonial_post_type
 * @return void
 */
function charity_create_testimonial_post_type(){   
        
    $args = array(

        'labels' => array(
            'name'               => 'Testimonials',
            'singular_name'      => 'Testimonial',
            'menu_name'          => 'Testimonials',
            'add_new'            => "Add New Testimonial",
            'add_new_item'       => "Add New Testimonial",
            'new_item'           => "New Testimonial",
            'edit_item'          => "Edit Testimonial",
            'view_item'          => "View Testimonial",
            'all_items'          => "All Testimonials",

        ),

        'public' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'testimonial'),
        'supports' => array('title','editor','thumbnail'),
        'menu_icon' => 'dashicons-list-view',
    );

    register_post_type( 'testimonials', $args );
    
}

add_action( 'init', 'charity_create_testimonial_post_type');