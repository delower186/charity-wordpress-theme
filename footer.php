        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-12 mb-4">
                        <!-- <img src="images/logo.png" class="logo img-fluid" alt=""> -->
                        <span class="text-white">
                            ASCOA
                        </span>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <h5 class="site-footer-title mb-3">Quick Links</h5>

                        <ul class="footer-menu">
                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Our Story</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Newsroom</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Causes</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Become a volunteer</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Partner with us</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mx-auto">
                        <h5 class="site-footer-title mb-3">Contact Infomation</h5>

                        <p class="text-white d-flex mb-2">
                            <i class="bi-telephone me-2"></i>

                            <a href="tel: +23780022742" class="site-footer-link">
                                +23780022742
                            </a>
                        </p>

                        <p class="text-white d-flex">
                            <i class="bi-envelope me-2"></i>

                            <a href="mailto:info@ascoa-cm.org" class="site-footer-link">
                                info@ascoa-cm.org
                            </a>
                        </p>

                        <p class="text-white d-flex mt-3">
                            <i class="bi-geo-alt me-2"></i>
                            Formal GCE Board sandpit, Buea, Cameroon
                        </p>

                        <a href="#" class="custom-btn btn mt-3">Get Direction</a>
                    </div>
                </div>
            </div>

            <div class="site-footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-md-7 col-12">
                            <p class="copyright-text mb-0">Copyright © 2025 <a href="#">ASCOA</a>
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