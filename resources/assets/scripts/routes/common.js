export default {
  init() {
    $('.venobox').venobox({
      spinner: 'wave',
      bgcolor: '#000',
    });

    $('#services-select').change(function (e) {
      window.location.href = e.target.value;
    })

    $('#skip-to-main').click(function(e){
      if($('#ihh-site-notification').length) {
        e.preventDefault();
        $('#ihh-site-notification').focus();
      }
    });

    $(document).ready(function(){
      window.CXBus.configure({pluginsPath:'https://apps.mypurecloud.ie/widgets/9.0/plugins/'});
      window.CXBus.loadPlugin('widgets-core');
      $('a[target=_blank]').each(function(){
        $(this).append(' <span class="ihh-visually-hidden">opens in new tab</span>')
      });
    })
  },
  finalize() {
  },
};
