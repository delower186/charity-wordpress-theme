<?php 
/**
 * Template Name: Blog
 */
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
                                // Current page
                                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; 
                                // Blog query
                                $blog_posts = new WP_Query(array(
                                    'post_type'   => 'post',
                                    'post_status' => 'publish',
                                    'paged'       => $paged,
                                    'posts_per_page' => get_option('posts_per_page'),
                                ));

                                if ( $blog_posts->have_posts() ) :
                                    /* Start the Loop */
                                    while ( $blog_posts->have_posts() ) :
                                        $blog_posts->the_post();

                                        $categories = get_the_category();

                                        $show_post_categories = '';

                                        if ( ! empty( $categories ) ) {
                                            foreach ( $categories as $cat ) {
                                                $show_post_categories .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="category-block-link">'
                                                    . esc_html( $cat->name ) .
                                                    '</a> ';
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
                                                            <p>'.charity_excerpt_limit(200, get_the_excerpt()).'</p>
                                                        </div>
                                                    </div>
                                                </div>';

                                    endwhile;

                                    $pagination = paginate_links([
                                        'total'     => $blog_posts->max_num_pages,
                                        'current'   => $paged,
                                        'type'      => 'array',
                                        'prev_text' => '&laquo;',
                                        'next_text' => '&raquo;',
                                    ]);

                                    if ($pagination) :
                                    ?>
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-center">
                                                <?php foreach ($pagination as $page) : ?>
                                                    <li class="page-item <?php echo strpos($page, 'current') !== false ? 'active' : ''; ?>">
                                                        <?php
                                                        echo str_replace(
                                                            ['page-numbers', 'current'],
                                                            ['page-link', ''],
                                                            $page
                                                        );
                                                        ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </nav>
                                    <?php endif;

                                else:
                                    echo '<div class="news-block"><div class="news-block-title mb-2"><h4>No content found</h4></div></div>';

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
        </main>
<?php get_footer(); ?>