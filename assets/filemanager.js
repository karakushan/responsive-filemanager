(function ($) {
    $('.iframe-btn').fancybox({
        'width': 900,
        'height': 600,
        'type': 'iframe',
        'autoScale': false
    });

    $(document).on('focusin', '.iframe-btn', function (event) {
        event.preventDefault();

            $('.iframe-btn').fancybox({
                'width': 900,
                'height': 600,
                'type': 'iframe',

                'autoScale': false
            });



    });


})(jQuery);



