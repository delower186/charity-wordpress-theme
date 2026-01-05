jQuery(document).ready(function($) {

    $('#charity-newsletter-form').on('submit', function(e) {
        e.preventDefault();

        var email = $('#subscribe-email').val();
        var msgBox = $('#charity-newsletter-msg');
        msgBox.html('Sending...');

        $.ajax({
            url: charity_newsletter_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'charity_save_newsletter',
                email: email,
                nonce: charity_newsletter_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    msgBox.html('<span style="color:green;">' + response.data + '</span>');
                    $('#charity-newsletter-form')[0].reset();
                } else {
                    msgBox.html('<span style="color:red;">' + response.data + '</span>');
                }
            },
            error: function() {
                msgBox.html('<span style="color:red;">AJAX request failed.</span>');
            }
        });
    });

});
