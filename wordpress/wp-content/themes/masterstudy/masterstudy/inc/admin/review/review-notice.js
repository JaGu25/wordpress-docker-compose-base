(function($) {
    $(document).ready(function () {
        $('body').on('click', '.add_review', function (e) {
            e.preventDefault();
            review_added_set_option('added');
            var win = window.open($(this).attr('href'), '_blank');
            win.focus();
        });

        $('body').on('click', '.skip_review', function (e) {
            e.preventDefault();
            review_added_set_option('skip');
        });
    });

    function review_added_set_option(status) {
        $('.review-message').hide();
        $.ajax({
            url: ajaxurl,
            type: "GET",
            data: 'add_review_status=' + status + '&action=stm_ajax_add_review&security=' + stm_ajax_add_review,
            success: function (data) {}
        });
    }
})(jQuery);