
(function($){
    $(document).ready(function(){

        /**
        * AJAX filter functionality
        */
        $('.js-filter input[type="radio"]').on('change', function () {
            const filter = $('#filter');
            const statusSrOnly = $('.sr-only.status');
            const inputValue = $(this).val();

            $.ajax({
                url: filter.attr('action'),
                data: filter.serialize(),
                type: filter.attr('method'), // POST
                beforeSend: function() {
                    statusSrOnly.text('Loading ' + inputValue);
                },
                success: function (data) {
                    $('#blog-posts-container').html(data);
                },
                error: function(result){
                    console.warn(result);
                },
                complete: function() {
                    statusSrOnly.text('Loading ' + inputValue + ' completed');
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
                    statusSrOnly.text('Loading page' + url.searchParams.get('paged'));
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
                },
            });

        });
    })
})(jQuery);