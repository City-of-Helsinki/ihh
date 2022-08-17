
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
                    $('#blog-posts-container').html(data); // insert data
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
        $(document).on('click', '.pagination a', function(evt){
            evt.preventDefault();
            const btn = $(this);
            const page = btn.data('page');
            const nextPage = page + 1 ;

            const filter = $('#filter');
            const statusSrOnly = $('.sr-only.status');

            const url = new URL(btn.attr('href'));

            $.ajax({
                url: filter.attr('action'),
                data: filter.serialize() + '&paged=' + url.searchParams.get('paged'),
                type: 'get',
                beforeSend: function() {
                    statusSrOnly.text('Loading');
                    console.log('loading');
                },
                success: function(result){
                    btn.data('page', nextPage)
                    $('#blog-posts-container').html(result);
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