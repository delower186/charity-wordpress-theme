<?php 
/**
 * Template Name: Page
 */
get_header(); 
?>
    <main style="background-image: url('<?php echo get_current_post_page_thumbnail(); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <?php
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        ?>
    </main>
<?php get_footer(); ?>