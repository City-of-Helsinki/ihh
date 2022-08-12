
(function($){
    $(document).ready(function(){
        console.log('ajax');

        /**
        * AJAX filter functionality
        */
        $('.js-filter input[type="radio"]').on('change', function () {
            const filter = $('#filter');
            const statusSrOnly = $('.sr-only.status');

            console.log(filter.serialize());

            $.ajax({
                url: filter.attr('action'),
                data: filter.serialize(), // form data
                type: filter.attr('method'), // POST
                beforeSend: function() {
                    statusSrOnly.text('Loading ');
                    console.log('loading');
                },
                success: function (data) {
                    $('#blog-posts').html(data); // insert data
                },
                error: function(result){
                    console.warn(result);
                },
                complete: function() {
                    statusSrOnly.text('Loading completed');
                    console.log('completed');
                },
            });
            return false;
        });

        /*
        * Load more
        */
        $(document).on('click', '.load-more', function(){
            const btn = $(this);
            const page = btn.data('page');
            const nextPage = page + 1 ;

            const filter = $('#filter');
            const statusSrOnly = $('.sr-only.status');

            $.ajax({
                url: filter.attr('action'),
                data: filter.serialize() + '&page=' + page,
                type: 'post',
                beforeSend: function() {
                    statusSrOnly.text('Loading');
                    console.log('loading');
                },
                success: function(result){
                    btn.data('page', nextPage)
                    $('#blog-posts').append(result);
                },
                error: function(result){
                    console.warn(result);
                },
                complete: function() {
                    statusSrOnly.text('Loading completed');
                    console.log('completed');
                },
            });

        });
    })
})(jQuery);