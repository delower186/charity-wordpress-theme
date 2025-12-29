<?php
/**
 * Add meta box Project Information
 *
 */
function charity_causes_meta_box() {
    add_meta_box(
        'causes_donation_meta',                         // ID
        'Donation Information',               // Title
        'charity_causes_meta_box_callback',     // Callback function
        'causes',                       // Post type
        'normal',                          // Context
        'default'                          // Priority
    );

}
add_action('add_meta_boxes', 'charity_causes_meta_box');

function charity_causes_meta_box_callback($post) {
    // Add nonce for security
    wp_nonce_field('causes_meta_box_nonce', 'causes_meta_box_nonce_field');

    // Retrieve existing value
    $donation_goal = get_post_meta($post->ID, '_donation_goal', true);
    $donation_raised = get_post_meta($post->ID, '_donation_raised', true);


    ?>
    <p>
        <label for="donation_goal">Donation Goal:</label><br>
        <input type="number" name="donation_goal" id="donation_goal" value="<?php echo esc_attr($donation_goal); ?>">
    </p>
    <p>
        <label for="donation_raised">Donation Raised:</label><br>
        <input type="disabled" name="donation_raised" id="donation_raised" value="<?php echo esc_attr($donation_raised) ? '':0; ?>" disabled>
    </p>
    <?php
}

function charity_save_causes_meta_box($post_id) {
    // Verify nonce
    if (!isset($_POST['causes_meta_box_nonce_field']) ||
        !wp_verify_nonce($_POST['causes_meta_box_nonce_field'], 'causes_meta_box_nonce')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) return;

    // Save field
    if (isset($_POST['donation_goal'])) {
        update_post_meta($post_id, '_donation_goal', sanitize_text_field($_POST['donation_goal']));
    }
    if (isset($_POST['donation_raised'])) {
        update_post_meta($post_id, '_donation_raised', sanitize_text_field($_POST['donation_raised']));
    }
}
add_action('save_post', 'charity_save_causes_meta_box');