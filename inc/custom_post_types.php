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