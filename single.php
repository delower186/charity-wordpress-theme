<?php 
get_header(); 
?>
        <main>

            <section class="news-detail-header-section text-center" style="background-image: url('<?php echo get_current_post_page_thumbnail(); ?>');">
                <div class="section-overlay"></div>

                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <h1 class="text-white"><?php echo get_current_post_page_title(); ?></h1>
                        </div>

                    </div>
                </div>
            </section>

            <section class="news-section section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-7 col-12">
                            <?php

                                if ( have_posts() ) :
                                    /* Start the Loop */
                                    while ( have_posts() ) : the_post();

                                        $categories = get_the_category();

                                        $show_post_categories = '';

                                        if ( ! empty( $categories ) ) {
                                            foreach ( $categories as $cat ) {
                                                $show_post_categories .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="category-block-link">'
                                                    . esc_html( $cat->name ) .
                                                    '</a> ';
                                            }
                                        }

                                        $tags = get_the_tags();

                                        $show_post_tags = '';

                                        if ( $tags ) {
                                            foreach ( $tags as $tag ) {
                                                $show_post_tags .= '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="tags-block-link">' .
                                                    esc_html( $tag->name ) . '</a> ';
                                            }
                                        }

                                        echo '<div class="news-block">
                                                    <div class="news-block-top">
                                                        <a href="'.esc_url( get_permalink()).'">
                                                            <img src="'.get_the_post_thumbnail_url().'" class="news-image img-fluid" alt="">
                                                        </a>

                                                        <div class="news-category-block">
                                                            '.$show_post_categories.'
                                                        </div>
                                                    </div>

                                                    <div class="news-block-info">
                                                        <div class="d-flex mt-2">
                                                            <div class="news-block-date">
                                                                <p>
                                                                    <i class="bi-calendar4 custom-icon me-1"></i>
                                                                    '.get_the_date('M j, Y').'
                                                                </p>
                                                            </div>

                                                            <div class="news-block-author mx-5">
                                                                <p>
                                                                    <i class="bi-person custom-icon me-1"></i>
                                                                    By '.esc_html( get_the_author_meta( 'display_name' ) ).'
                                                                </p>
                                                            </div>

                                                            <div class="news-block-comment">
                                                                <p>
                                                                    <i class="bi-chat-left custom-icon me-1"></i>
                                                                    '.get_comments_number().' Comments
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="news-block-title mb-2">
                                                            <h4><a href="'.esc_url( get_permalink()).'" class="news-block-title-link">'.get_the_title().'</a></h4>
                                                        </div>

                                                        <div class="news-block-body">
                                                            '.get_the_content().'
                                                        </div>
                                                        <div class="social-share border-top mt-5 py-4 d-flex flex-wrap align-items-center">
                                                            <div class="tags-block me-auto">
                                                                '.$show_post_tags.'
                                                            </div>

                                                            <div class="d-flex">
                                                                '.do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]').'
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';
                                                if ( comments_open() || get_comments_number() ) {
                                                    comments_template();
                                                }

                                    endwhile;

                                else:
                                    echo '<div class="news-block">
                                            <div class="news-block-title mb-2">
                                                <h4>No content found</h4>
                                            </div>
                                        </div>';

                                wp_reset_postdata();
                                endif;
                            ?>
                        </div>

                        <div class="col-lg-4 col-12 mx-auto mt-4 mt-lg-0">
                        <?php get_sidebar(); ?>
                        </div>

                    </div>
                </div>
            </section>
            <section class="news-section section-padding section-bg">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12 mb-4">
                            <h2>Related news</h2>
                        </div>

                        <?php
                            // Get current post categories
                            $category_ids = wp_get_post_categories(get_the_ID());

                            if ($category_ids) {
                                $args = array(
                                    'category__in' => $category_ids,
                                    'post__not_in' => array(get_the_ID()), // Exclude current post
                                    'posts_per_page' => 2, // Number of related posts
                                    'orderby' => 'rand', // Random order
                                );

                                $related_posts = new WP_Query($args);

                                if ($related_posts->have_posts()) {

                                    while ($related_posts->have_posts()) {
                                        $related_posts->the_post();

                                        $post_categories = get_the_category();

                                        $show_post_categories = '';

                                        if ( ! empty( $post_categories ) ) {
                                            foreach ( $post_categories as $cat ) {
                                                $show_post_categories .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="category-block-link">'
                                                    . esc_html( $cat->name ) .
                                                    '</a> ';
                                            }
                                        }

                                        echo '<div class="col-lg-6 col-12">
                                                <div class="news-block">
                                                    <div class="news-block-top">
                                                        <a href="'.esc_url( get_permalink()).'">
                                                            <img src="'.get_the_post_thumbnail_url().'" class="news-image img-fluid" alt="">
                                                        </a>

                                                        <div class="news-category-block">
                                                            '.$show_post_categories.'
                                                        </div>
                                                    </div>

                                                    <div class="news-block-info">
                                                        <div class="d-flex mt-2">
                                                            <div class="news-block-date">
                                                                <p>
                                                                    <i class="bi-calendar4 custom-icon me-1"></i>
                                                                    '.get_the_date('M j, Y').'
                                                                </p>
                                                            </div>

                                                            <div class="news-block-author mx-5">
                                                                <p>
                                                                    <i class="bi-person custom-icon me-1"></i>
                                                                    By '.esc_html( get_the_author_meta( 'display_name' ) ).'
                                                                </p>
                                                            </div>

                                                            <div class="news-block-comment">
                                                                <p>
                                                                    <i class="bi-chat-left custom-icon me-1"></i>
                                                                    '.get_comments_number().' Comments
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="news-block-title mb-2">
                                                            <h4><a href="'.esc_url( get_permalink()).'" class="news-block-title-link">'.get_the_title().'</a></h4>
                                                        </div>

                                                        <div class="news-block-body">
                                                            <p>'.charity_excerpt_limit(200, get_the_excerpt()).'</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }

                                }else{

                                }

                                wp_reset_postdata();
                            }
                        ?>
                    </div>
                </div>
            </section>
        </main>
<?php get_footer(); ?>