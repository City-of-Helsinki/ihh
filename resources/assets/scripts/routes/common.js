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
        $('a[target=_blank]').each(function(){
            $(this).append(' <span class="ihh-visually-hidden">opens in new tab</span>')
        });

        detectExternalLinks('.main p a');
    })


    function detectExternalLinks(item){
        const hostName = window.location.hostname;
        const links = document.querySelectorAll(item);

        for (let i = 0; i < links.length; i++) {
            let domain = (new URL(links[i]));
            domain = domain.hostname.replace('www.','');

            if(hostName !== domain){
                addExternalLinkStyling(links[i]);
            }
        }
    }

    function addExternalLinkStyling(link){
        link.classList.add('external-link');
        addExternalLinkIcon(link);
    }

    function addExternalLinkIcon(link){
        const svgArrow45 = '<span class="inline-svg rotate-45"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.6 32.1" xml:space="preserve" role="presentation"><path style="fill-rule:evenodd;clip-rule:evenodd" d="M32.6 16.1 16.5 0l-2.8 2.8 11.4 11.3H0v4h25L13.7 29.3l2.8 2.8z"></path></svg></span>';
        const inlineSVG = link.querySelector('.inline-svg');

        if( inlineSVG === null ){
            jQuery(link).prepend(svgArrow45);
        }
    }


  },
  finalize() {
  },
};
