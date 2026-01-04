        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-12 mb-4">
                        <?php
                            $custom_logo_id = get_theme_mod( 'custom_logo' );

                            if ( $custom_logo_id ) {
                                $logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
                                $logo_url = $logo[0];
                            }
                        ?>
                        <img src="<?php echo esc_url( $logo_url ); ?>" class="logo img-fluid" alt="ASCOA">
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <h5 class="site-footer-title mb-3">Quick Links</h5>

                        <ul class="footer-menu">

                            <?php
                                // 1️⃣ Get the menu items
                                // Use wp_get_nav_menu_items() to fetch items of a menu:
                                $menu_name = 'primary'; // replace with your menu location or name
                                $locations = get_nav_menu_locations();
                                $menu_id = $locations[ $menu_name ] ?? 0;

                                if ( $menu_id ) {
                                    $menu_items = wp_get_nav_menu_items( $menu_id );
                                }
                                // 2️⃣ Filter items that start with #
                                $anchor_items = [];

                                if ( ! empty( $menu_items ) ) {
                                    foreach ( $menu_items as $item ) {
                                        if ( strpos( $item->url, '#' ) === 0 ) {
                                            $anchor_items[] = $item;
                                        }
                                    }
                                }
                                // ✅ $anchor_items now contains only items where url starts with #
                                // 3️⃣ Display them
                                if ( ! empty( $anchor_items ) ) {
                                    foreach ( $anchor_items as $item ) {
                                        echo '<li class="footer-menu-item"><a class="footer-menu-link" href="' . esc_attr( $item->url ) . '">' . esc_html( $item->title ) . '</a></li>';
                                    }
                                }
                            ?>

                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mx-auto">
                        <h5 class="site-footer-title mb-3">Contact Infomation</h5>

                        <p class="text-white d-flex mb-2">
                            <i class="bi-telephone me-2"></i>

                            <a href="tel: <?php echo get_theme_mod('phone'); ?>" class="site-footer-link">
                                <?php echo get_theme_mod('phone'); ?>
                            </a>
                        </p>

                        <p class="text-white d-flex">
                            <i class="bi-envelope me-2"></i>

                            <a href="mailto:<?php echo get_theme_mod('email'); ?>" class="site-footer-link">
                                <?php echo get_theme_mod('email'); ?>
                            </a>
                        </p>

                        <p class="text-white d-flex mt-3">
                            <i class="bi-geo-alt me-2"></i>
                            <?php echo get_theme_mod('address'); ?>
                        </p>

                        <a href="<?php echo get_theme_mod('direction'); ?>" target="_blank" class="custom-btn btn mt-3">Get Direction</a>
                    </div>
                </div>
            </div>

            <div class="site-footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-md-7 col-12">
                            <p class="copyright-text mb-0">Copyright © <?php echo get_theme_mod('copyright_year'); ?> <a href="#"><?php echo get_theme_mod('copyright_name'); ?></a>
                        	Developed By: <a href="https://sandalia.com.bd/apps" target="_blank">Sandalia Apps</a></p>
                        </div>
                        
                        <div class="col-lg-6 col-md-5 col-12 d-flex justify-content-center align-items-center mx-auto">
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
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>