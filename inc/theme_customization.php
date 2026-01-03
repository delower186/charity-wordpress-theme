<?php 
/**
 * The template for static fields
 * @package Charity
*/
/**
 * Summary of charity_add_customizer_field
 * @param mixed $wp_customize
 * @param mixed $args
 * @return void
 */
function charity_add_customizer_field( $wp_customize, $args ) {

    $defaults = array(
        'setting'  => '',
        'label'    => '',
        'section'  => '',
        'type'     => 'text',
        'default'  => '',
        'sanitize' => 'sanitize_text_field',
    );

    $args = wp_parse_args( $args, $defaults );

    // Add setting
    $wp_customize->add_setting( $args['setting'], array(
        'default'           => $args['default'],
        'sanitize_callback' => $args['sanitize'],
    ) );

    // Add control
    $wp_customize->add_control( $args['setting'], array(
        'label'   => $args['label'],
        'section' => $args['section'],
        'type'    => $args['type'],
    ) );
}
/**
 * Summary of charity_homepage_customizer_register
 * @param mixed $wp_customize
 * @return void
 */
function charity_homepage_customizer_register( $wp_customize ) {

    // Add a section
    $wp_customize->add_section( 'charity_homepage_customization_section', array(
        'title'    => __( 'Static Contents', 'charity' ),
        'priority' => 30,
    ) );

    /**
     * Section msg field generator
     */
    $sections = ['address', 'email'];

    foreach($sections as $section){
        $wp_customize->add_setting( $section, array(
            'default' => $section,
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        
        $wp_customize->add_control( $section.'_control', array(
        'label' => $section,
        'section' => 'charity_homepage_customization_section', // Or create a new section
        'settings' => $section,
        'type' => 'text',
        ) );
    }
}
add_action( 'customize_register', 'charity_homepage_customizer_register' );
/**
 * Summary of charity_social_media_register
 * @param mixed $wp_customize
 * @return void
 */
function charity_social_media_register( $wp_customize ) {
    // Add a section
    $wp_customize->add_section( 'charity_social_section', array(
        'title'    => __( 'Social Links', 'charity' ),
        'priority' => 31,
    ) );

    /**
     * Social link field generator
     */

     $links = ['twitter','facebook','instagram','linkedin','youtube','whatsapp'];

     foreach($links as $link){
        $wp_customize->add_setting( $link, array(
            'default' => '#',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        
        $wp_customize->add_control( $link.'_control', array(
        'label' => $link,
        'section' => 'charity_social_section', // Or create a new section
        'settings' => $link,
        'type' => 'text',
        ) );
    }

}
add_action( 'customize_register', 'charity_social_media_register' );
/**
 * Summary of charity_welcome_register
 * @param mixed $wp_customize
 * @return void
 */
function charity_welcome_register( $wp_customize ) {

    $wp_customize->add_section( 'charity_welcome_section', array(
        'title'    => __( 'Welcome Section', 'charity' ),
        'priority' => 31,
    ) );

    /**
     * Add single items here
     */
    charity_add_customizer_field( $wp_customize, array(
        'setting' => "welcome_text",
        'label'   => "Welcome Text",
        'section' => 'charity_welcome_section',
        'type'    => 'text',
    ) );


    /**
     * Add paired item here
     */
    $items = array(
        'volunteer'   => __( 'Volunteer', 'charity' ),
        'caring'      => __( 'Caring', 'charity' ),
        'donation'    => __( 'Donation', 'charity' ),
        'scholarship' => __( 'Scholarship', 'charity' ),
    );

    foreach ( $items as $key => $label ) {

        // TEXT
        charity_add_customizer_field( $wp_customize, array(
            'setting' => "{$key}_text",
            'label'   => "{$label} Text",
            'section' => 'charity_welcome_section',
            'type'    => 'text',
        ) );

        // URL
        charity_add_customizer_field( $wp_customize, array(
            'setting'  => "{$key}_url",
            'label'    => "{$label} URL",
            'section'  => 'charity_welcome_section',
            'type'     => 'url',
            'sanitize' => 'esc_url_raw',
        ) );
    }
}

add_action( 'customize_register', 'charity_welcome_register' );
/**
 * Summary of charity_about_register
 * @param mixed $wp_customize
 * @return void
 */
function charity_about_register( $wp_customize ) {

    $wp_customize->add_section( 'charity_about_section', array(
        'title'    => __( 'About Section', 'charity' ),
        'priority' => 31,
    ) );

    $fields = [
        'about_image',
        'about_heading',
        'about_title',
        'about_description',
        'mission_heading',
        'mission_description',
        'counter_funded',
        'counter_donations'
    ];

    foreach ( $fields as $field ) {

        // Default type
        $type = 'text';
        $sanitize = 'sanitize_text_field';

        switch ( $field ) {

            case 'about_description':
            case 'mission_description':
                $type = 'textarea';
                $sanitize = 'wp_kses_post'; // ✅ allow HTML
                break;

            case 'counter_funded':
            case 'counter_donations':
                $type = 'number';
                $sanitize = 'absint';
                break;

            case 'about_image':
                $wp_customize->add_setting( $field, array(
                    'sanitize_callback' => 'esc_url_raw',
                ) );

                $wp_customize->add_control(
                    new WP_Customize_Image_Control(
                        $wp_customize,
                        $field,
                        array(
                            'label'   => __( 'About Image', 'charity' ),
                            'section' => 'charity_about_section',
                        )
                    )
                );
                continue 2;

        }

        $wp_customize->add_setting( $field, array(
            'default'           => '',
            'sanitize_callback' => $sanitize,
        ) );

        $wp_customize->add_control( $field, array(
            'label'   => ucwords( str_replace('_', ' ', $field) ),
            'section' => 'charity_about_section',
            'type'    => $type,
        ) );
    }
}

add_action( 'customize_register', 'charity_about_register' );
/**
 * Summary of charity_founder_register
 * @param mixed $wp_customize
 * @return void
 */
function charity_founder_register( $wp_customize ) {

    $wp_customize->add_section( 'charity_founder_section', array(
        'title'    => __( 'Founder Section', 'charity' ),
        'priority' => 31,
    ) );

    $fields = [
        'founder_photo',
        'founder_name',
        'founder_designation',
        'founder_about',
        'founder_facebook_link',
        'founder_twitter_link',
        'founder_linkedin_link',
        'founder_instagram_link'
    ];

    foreach ( $fields as $field ) {

        // Default type
        $type = 'text';
        $sanitize = 'sanitize_text_field';

        switch ( $field ) {

            case 'founder_about':
                $type = 'textarea';
                $sanitize = 'wp_kses_post'; // ✅ allow HTML
                break;

            case 'founder_photo':
                $wp_customize->add_setting( $field, array(
                    'sanitize_callback' => 'esc_url_raw',
                ) );

                $wp_customize->add_control(
                    new WP_Customize_Image_Control(
                        $wp_customize,
                        $field,
                        array(
                            'label'   => __( 'Founder Image', 'charity' ),
                            'section' => 'charity_founder_section',
                        )
                    )
                );
                continue 2;

        }

        $wp_customize->add_setting( $field, array(
            'default'           => '',
            'sanitize_callback' => $sanitize,
        ) );

        $wp_customize->add_control( $field, array(
            'label'   => ucwords( str_replace('_', ' ', $field) ),
            'section' => 'charity_founder_section',
            'type'    => $type,
        ) );
    }
}

add_action( 'customize_register', 'charity_founder_register' );
/**
 * Summary of charity_impact_register
 * @param mixed $wp_customize
 * @return void
 */
function charity_impact_register( $wp_customize ) {
    // Add a section
    $wp_customize->add_section( 'charity_impact_section', array(
        'title'    => __( 'Impact Section', 'charity' ),
        'priority' => 31,
    ) );

    /**
     * Impact fields generator
     */

     $fields = ['impact_msg','impact_link_text','impact_link_action'];

     foreach($fields as $field){

        // Default type
        $type = 'text';
        $sanitize = 'sanitize_text_field';

        switch ( $field ) {

            case 'impact_msg':
                $type = 'textarea';
                $sanitize = 'wp_kses_post'; // ✅ allow HTML
                break;

        }  

        $wp_customize->add_setting( $field, array(
            'default' => '',
            'sanitize_callback' => $sanitize,
        ) );
        
        $wp_customize->add_control( $field.'_control', array(
        'label' => ucwords( str_replace('_', ' ', $field) ),
        'section' => 'charity_impact_section', // Or create a new section
        'settings' => $field,
        'type' => $type,
        ) );
    }

}
add_action( 'customize_register', 'charity_impact_register' );

function charity_volunteer_register( $wp_customize ) {
    // Add a section
    $wp_customize->add_section( 'charity_volunteer_section', array(
        'title'    => __( 'Volunteer Section', 'charity' ),
        'priority' => 31,
    ) );

    /**
     * Volunteer fields generator
     */

     $fields = ['volunteer_title','volunteer_msg','volunteer_image'];

     foreach($fields as $field){

        // Default type
        $type = 'text';
        $sanitize = 'sanitize_text_field';

        switch ( $field ) {

            case 'volunteer_msg':
                $type = 'textarea';
                $sanitize = 'wp_kses_post'; // ✅ allow HTML
                break;

            case 'volunteer_image':
                $wp_customize->add_setting( $field, array(
                    'sanitize_callback' => 'esc_url_raw',
                ) );

                $wp_customize->add_control(
                    new WP_Customize_Image_Control(
                        $wp_customize,
                        $field,
                        array(
                            'label'   => __( 'Volunteer Image', 'charity' ),
                            'section' => 'charity_volunteer_section',
                        )
                    )
                );
                continue 2;

        }  

        $wp_customize->add_setting( $field, array(
            'default' => '',
            'sanitize_callback' => $sanitize,
        ) );
        
        $wp_customize->add_control( $field.'_control', array(
        'label' => ucwords( str_replace('_', ' ', $field) ),
        'section' => 'charity_volunteer_section', // Or create a new section
        'settings' => $field,
        'type' => $type,
        ) );
    }

}
add_action( 'customize_register', 'charity_volunteer_register' );