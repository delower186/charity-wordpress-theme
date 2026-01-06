<?php 
require_once get_template_directory() . '/classes/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'charity_register_required_plugins');

function charity_register_required_plugins() {
    $plugins = array(
        array(
            'name'     => 'Contact Form 7',
            'slug'     => 'contact-form-7',
            'required' => true,
        ),
        array(
            'name'     => 'Social Media Share Buttons & Social Sharing Icons',
            'slug'     => 'ultimate-social-media-icons',
            'required' => true,
        ),
    );

    $config = array(
        'id'           => 'charity',              // Unique ID
        'menu'         => 'tgmpa-install-plugins', // Menu slug
        'has_notices'  => true,
        'dismissable'  => false,                   // Force installation
        'is_automatic' => false,
    );

    tgmpa($plugins, $config);
}