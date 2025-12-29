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
        'menu_icon' => 'dashicons-welcome-view-site',
    );

    register_post_type( 'slider', $args );
    
}

add_action( 'init', 'charity_create_slider_post_type');