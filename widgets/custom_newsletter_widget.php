<?php 
// Create the Widget Class
class Charity_Newsletter_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'charity_newsletter_widget',
            __('Charity Newsletter', 'charity'),
            ['description' => __('AJAX Newsletter Subscription Form', 'charity')]
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        ?>

        <div id="charity-newsletter-widget">
            <form id="charity-newsletter-form" class="custom-form subscribe-form" method="post" action="">
                <h5 class="mb-4">
                    <?php echo esc_html( $instance['title'] ?? 'Newsletter Form' ); ?>
                </h5>

                <input type="email"
                       name="subscribe_email"
                       id="subscribe-email"
                       pattern="[^ @]*@[^ @]*"
                       class="form-control"
                       placeholder="Email Address"
                       required>

                <div class="col-lg-12 col-12">
                    <button type="submit" class="form-control">Subscribe</button>
                </div>

                <div id="charity-newsletter-msg" style="margin-top:10px;"></div>
            </form>
        </div>

        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = $instance['title'] ?? 'Newsletter Form';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php _e('Title:', 'charity'); ?>
            </label>
            <input class="widefat"
                   id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['title'] = sanitize_text_field($new_instance['title']);
        return $instance;
    }
}

// Register the widget
function charity_register_newsletter_widget() {
    register_widget('Charity_Newsletter_Widget');
}
add_action('widgets_init', 'charity_register_newsletter_widget');

// Enqueue AJAX Script
function charity_enqueue_newsletter_scripts() {
    wp_enqueue_script(
        'charity-newsletter-ajax',
        get_template_directory_uri() . '/js/newsletter-ajax.js',
        ['jquery'],
        '1.0',
        true
    );

    wp_localize_script('charity-newsletter-ajax', 'charity_newsletter_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('charity_newsletter_nonce')
    ]);
}
add_action('wp_enqueue_scripts', 'charity_enqueue_newsletter_scripts');

// Handle AJAX in WordPress
function charity_save_newsletter_ajax() {
    check_ajax_referer('charity_newsletter_nonce', 'nonce');

    if (empty($_POST['email']) || !is_email($_POST['email'])) {
        wp_send_json_error('Please enter a valid email.');
    }

    $email = sanitize_email($_POST['email']);
    global $wpdb;
    $table = $wpdb->prefix . 'charity_newsletter';

    // Create table if not exists
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id BIGINT(20) NOT NULL AUTO_INCREMENT,
        email VARCHAR(255) NOT NULL UNIQUE,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // Save email
    $exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE email = %s", $email));

    if ($exists) {
        wp_send_json_error('This email is already subscribed.');
    } else {
        $wpdb->insert($table, ['email' => $email], ['%s']);
    }

    // Optional: Mailchimp integration
    $mailchimp_api_key = 'YOUR_MAILCHIMP_API_KEY';
    $mailchimp_list_id = 'YOUR_LIST_ID';

    if ($mailchimp_api_key && $mailchimp_list_id) {
        $data_center = substr($mailchimp_api_key,strpos($mailchimp_api_key,'-')+1);
        $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $mailchimp_list_id . '/members/';
        $json = json_encode([
            'email_address' => $email,
            'status' => 'subscribed'
        ]);

        wp_remote_post($url, [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode('user:' . $mailchimp_api_key),
                'Content-Type' => 'application/json'
            ],
            'body' => $json
        ]);
    }

    wp_send_json_success('Thank you for subscribing!');
}
add_action('wp_ajax_charity_save_newsletter', 'charity_save_newsletter_ajax');
add_action('wp_ajax_nopriv_charity_save_newsletter', 'charity_save_newsletter_ajax');

// Add Admin Menu Page
// Add submenu under "Dashboard" or "Tools"
function charity_newsletter_admin_menu() {
    add_menu_page(
        __('Newsletter Subscribers', 'charity'), // Page title
        __('Newsletter', 'charity'),            // Menu title
        'manage_options',                        // Capability
        'charity-newsletter-subscribers',        // Menu slug
        'charity_newsletter_admin_page',         // Callback function
        'dashicons-email-alt',                   // Icon
        30                                       // Position
    );
}
add_action('admin_menu', 'charity_newsletter_admin_menu');

// Display the Table of Subscribers
function charity_newsletter_admin_page() {
    global $wpdb;
    $table = $wpdb->prefix . 'charity_newsletter';

    $subscribers = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC");

    ?>
    <div class="wrap">
        <h1><?php _e('Newsletter Subscribers', 'charity'); ?></h1>

        <!-- Export CSV button -->
        <a href="<?php echo admin_url('admin.php?page=charity-newsletter-subscribers&charity_export_csv=1'); ?>" class="button button-primary" style="margin-bottom:15px;">
            <?php _e('Export CSV', 'charity'); ?>
        </a>

        <?php if ($subscribers): ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php _e('ID', 'charity'); ?></th>
                        <th><?php _e('Email', 'charity'); ?></th>
                        <th><?php _e('Subscribed On', 'charity'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $subscribers = charity_get_newsletter_subscribers(); ?>
                    <?php foreach ($subscribers as $sub): ?>
                        <tr>
                            <td><?php echo esc_html($sub->id); ?></td>
                            <td><?php echo esc_html($sub->email); ?></td>
                            <td><?php echo esc_html($sub->created_at); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p><?php _e('No subscribers found.', 'charity'); ?></p>
        <?php endif; ?>
    </div>
    <?php
}

// Add CSV Export Button
if (isset($_GET['charity_export_csv']) && current_user_can('manage_options')) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="newsletter-subscribers.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Email', 'Subscribed On']);

    $subscribers = charity_get_newsletter_subscribers();

    foreach ($subscribers as $sub) {
        fputcsv($output, [$sub->id, $sub->email, $sub->created_at]);
    }
    fclose($output);
    exit;
}
// Fetch subscribers safely before foreach
function charity_get_newsletter_subscribers() {
    global $wpdb;
    $table = $wpdb->prefix . 'charity_newsletter';
    return $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC");
}

