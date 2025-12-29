<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php bloginfo('name'); ?> &raquo; <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
        <?php wp_head(); ?>
        <?php
            if ( function_exists('has_site_icon') && has_site_icon() ) {
                $favicon_url = get_site_icon_url();
                echo '<link rel="icon" href="' . esc_url( $favicon_url ) . '" type="image/png">';
            }
        ?>
    </head>
    
    <body id="section_1" <?php body_class(); ?>>

        <header class="site-header">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-8 col-12 d-flex flex-wrap">
                        <p class="d-flex me-4 mb-0">
                            <i class="bi-geo-alt me-2"></i>
                            <?php echo get_theme_mod('address'); ?>
                        </p>

                        <p class="d-flex mb-0">
                            <i class="bi-envelope me-2"></i>

                            <a href="mailto:<?php echo get_theme_mod('email'); ?>">
                                <?php echo get_theme_mod('email'); ?>
                            </a>
                        </p>
                    </div>

                    <div class="col-lg-3 col-12 ms-auto d-lg-block d-none">
                        <ul class="social-icon">
                            <?php 
                                if (get_theme_mod('twitter')){
                                    echo '<li class="social-icon-item">
                                            <a href="'.get_theme_mod('twitter').'" class="social-icon-link bi-twitter"></a>
                                        </li>';
                                }
                                if (get_theme_mod('facebook')){
                                    echo '<li class="social-icon-item">
                                            <a href="'.get_theme_mod('facebook').'" class="social-icon-link bi-facebook"></a>
                                        </li>';
                                }
                                if (get_theme_mod('instagram')){
                                    echo '<li class="social-icon-item">
                                            <a href="'.get_theme_mod('instagram').'" class="social-icon-link bi-instagram"></a>
                                        </li>';
                                }
                                if (get_theme_mod('linkedin')){
                                    echo '<li class="social-icon-item">
                                            <a href="'.get_theme_mod('linkedin').'" class="social-icon-link bi-linkedin"></a>
                                        </li>';
                                }
                                if (get_theme_mod('youtube')){
                                    echo '<li class="social-icon-item">
                                            <a href="'.get_theme_mod('youtube').'" class="social-icon-link bi-youtube"></a>
                                        </li>';
                                }
                                if (get_theme_mod('whatsapp')){
                                    echo '<li class="social-icon-item">
                                            <a href="'.get_theme_mod('whatsapp').'" class="social-icon-link bi-whatsapp"></a>
                                        </li>';
                                }
                            ?>
                        </ul>
                    </div>

                </div>
            </div>
        </header>

        <nav class="navbar navbar-expand-lg bg-light shadow-lg">
            <div class="container">
                <?php
                    $custom_logo_id = get_theme_mod( 'custom_logo' );

                    if ( $custom_logo_id ) {
                        $logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
                        $logo_url = $logo[0];
                    }
                ?>
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo esc_url( $logo_url ); ?>" class="logo img-fluid" alt="Association for Community Awareness">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <?php wp_nav_menu( array( 
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'navbar-nav ms-auto',
                        'fallback_cb'    => false,
                        'walker'         => new Bootstrap_5_WP_Nav_Menu_Walker(),
                    ) ); ?>
                </div>
            </div>
        </nav>