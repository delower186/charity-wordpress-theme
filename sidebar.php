                            <?php if ( is_active_sidebar( 'blog-sidebar-top' ) ) : ?>
                                <?php dynamic_sidebar( 'blog-sidebar-top' ); ?>
                            <?php endif; ?>

                            <h5 class="mt-5 mb-3">Recent news</h5>
                            <?php 
                                $args = [
                                    'post_type'      => 'post',
                                    'posts_per_page' => 2, // get 3rd & 4th posts
                                    'offset'         => 2, // skip 1st and 2nd latest posts
                                    'orderby'        => 'date',
                                    'order'          => 'DESC',
                                ];

                                $query = new WP_Query( $args );

                                if ( $query->have_posts() ) :
                                    while ( $query->have_posts() ) : $query->the_post();
                                        echo '<div class="news-block news-block-two-col d-flex mt-4">
                                                <div class="news-block-two-col-image-wrap">
                                                    <a href="'.esc_url( get_permalink()).'">
                                                        <img src="'.get_the_post_thumbnail_url().'" class="news-image img-fluid" alt="">
                                                    </a>
                                                </div>

                                                <div class="news-block-two-col-info">
                                                    <div class="news-block-title mb-2">
                                                        <h6><a href="'.esc_url( get_permalink()).'" class="news-block-title-link">'.charity_excerpt_limit(20, get_the_title()).'</a></h6>
                                                    </div>

                                                    <div class="news-block-date">
                                                        <p>
                                                            <i class="bi-calendar4 custom-icon me-1"></i>
                                                            '.get_the_date('M j, Y').'
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>';
                                    endwhile;
                                    wp_reset_postdata();
                                endif;
                            ?>

                            <div class="category-block d-flex flex-column">
                                <h5 class="mb-3">Categories</h5>

                                <?php 
                                    $categories = get_categories([
                                        'hide_empty' => false,
                                    ]);

                                    foreach ( $categories as $category ) {
                                        echo '<a href="'.esc_url( get_category_link( $category->term_id ) ).'" class="category-block-link">
                                                '.esc_html( $category->name ).'
                                                <span class="badge">'.intval( $category->count ).'</span>
                                            </a>';
                                    }
                                ?>

                            </div>

                            <div class="tags-block">
                                <h5 class="mb-3">Tags</h5>
                                <?php 
                                    $tags = get_tags([
                                        'hide_empty' => true,
                                    ]);

                                    foreach ( $tags as $tag ) {
                                        echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="tags-block-link">
                                                '.esc_html( $tag->name ).'
                                            </a>';
                                    }
                                ?>
                            </div>
                            <?php if ( is_active_sidebar( 'blog-sidebar-bottom' ) ) : ?>
                                <?php dynamic_sidebar( 'blog-sidebar-bottom' ); ?>
                            <?php endif; ?>