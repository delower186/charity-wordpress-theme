<?php 
// Create Custom Search Widget
class Charity_Ajax_Search_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'charity_ajax_search',
            __('Charity AJAX Search', 'charity'),
            ['description' => __('AJAX-powered search form', 'charity')]
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        ?>
        <div id="charity-ajax-search-widget">
            <form id="charity-ajax-search-form" class="custom-form search-form" method="get" action="">
                <input type="search"
                       id="charity-search-input"
                       name="s"
                       class="form-control"
                       placeholder="Search"
                       aria-label="Search">
                <button type="submit" class="form-control"><i class="bi-search"></i></button>
            </form>
            <div id="charity-search-results" style="margin-top:10px;"></div>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = $instance['title'] ?? 'Search';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'charity'); ?></label>
            <input class="widefat"
                   id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        return ['title' => sanitize_text_field($new_instance['title'])];
    }
}

// Register the Search widget
function charity_register_ajax_search_widget() {
    register_widget('Charity_Ajax_Search_Widget');
}
add_action('widgets_init', 'charity_register_ajax_search_widget');


// Enqueue AJAX Scripts for Search
function charity_enqueue_search_ajax() {
    wp_enqueue_script(
        'charity-search-ajax',
        get_template_directory_uri() . '/js/search-ajax.js',
        ['jquery'],
        '1.0',
        true
    );

    wp_localize_script('charity-search-ajax', 'charity_search_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('charity_search_nonce')
    ]);
}
add_action('wp_enqueue_scripts', 'charity_enqueue_search_ajax');


// Create AJAX Handler
function charity_ajax_search() {
    check_ajax_referer('charity_search_nonce','nonce');

    if(empty($_POST['search'])) {
        wp_send_json_error();
    }

    $search = sanitize_text_field($_POST['search']);

    $args = [
        's' => $search,
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 5
    ];

    $query = new WP_Query($args);

    if($query->have_posts()){
        $output = '<ul>';
        while($query->have_posts()){
            $query->the_post();
            $output .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
        }
        $output .= '</ul>';
        wp_reset_postdata();
        wp_send_json_success($output);
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_charity_ajax_search','charity_ajax_search');
add_action('wp_ajax_nopriv_charity_ajax_search','charity_ajax_search');



