jQuery(document).ready(function($) {

    $('#charity-ajax-search-form').on('submit', function(e) {
        e.preventDefault();

        var query = $('#charity-search-input').val();
        var resultsDiv = $('#charity-search-results');
        resultsDiv.html('Searching...');

        $.ajax({
            url: charity_search_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'charity_ajax_search',
                search: query,
                nonce: charity_search_ajax.nonce
            },
            success: function(response) {
                if(response.success){
                    resultsDiv.html(response.data);
                } else {
                    resultsDiv.html('<span style="color:red;">No results found.</span>');
                }
            },
            error: function() {
                resultsDiv.html('<span style="color:red;">AJAX request failed.</span>');
            }
        });

    });

});

