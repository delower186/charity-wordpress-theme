<?php
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

<?php if ( have_comments() ) : ?>
    <?php
    wp_list_comments(array(
    'style'      => '',  // keep empty for custom callback
    'callback'   => 'charity_comment_callback',
    'avatar_size'=> 60,
    'short_ping' => true,
    'max_depth'  => get_option('thread_comments_depth'), // default WordPress depth
    ));
    ?>
<?php endif; ?>

<?php
comment_form(array(
    'class_form' => 'custom-form comment-form mt-4',
    'title_reply' => '<h6 class="mb-3">Write a comment</h6>',
    'comment_field' => '
        <textarea name="comment" rows="4" class="form-control" placeholder="Your comment here" required></textarea>',
    'submit_button' => '
        <div class="col-lg-3 col-md-4 col-6 ms-auto">
            <button type="submit" class="form-control">%4$s</button>
        </div>',
));
?>

</div>
