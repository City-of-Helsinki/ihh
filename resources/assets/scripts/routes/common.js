export default {
  init() {
    const ARROW_SVG_RIGHT = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.6 32.1" xml:space="preserve" role="presentation"><path style="fill-rule:evenodd;clip-rule:evenodd" d="M32.6 16.1 16.5 0l-2.8 2.8 11.4 11.3H0v4h25L13.7 29.3l2.8 2.8z"></path></svg>';

    $('.venobox').venobox({
        spinner: 'wave',
        bgcolor: '#000',
    });

    $('#services-select').change(function (e) {
        window.location.href = e.target.value;
    });

    $('#skip-to-main').click(function (e) {
        if ($('#ihh-site-notification').length) {
            e.preventDefault();
            $('#ihh-site-notification').focus();
        }
    });

    $(document).ready(function () {
        $('a[target=_blank]').each(function () {
            $(this).append(' <span class="ihh-visually-hidden">opens in new tab</span>');
        });

        detectExternalLinks('.main a');
        createAnchorlinks('.anchorlink-navigation', '#main h2');

        window.CXBus.configure({pluginsPath:'https://apps.mypurecloud.ie/widgets/9.0/plugins/'});
        window.CXBus.loadPlugin('widgets-core');
        $('a[target=_blank]').each(function(){
            $(this).append(' <span class="ihh-visually-hidden">opens in new tab</span>')
        });

        /* Animate view to anchorlink on page load */
        if (window.location.hash) {
            setTimeout(function(){
                const jQueryTarget = jQuery('body').find(window.location.hash);

                jQuery('html, body').animate({
                    scrollTop: jQueryTarget.offset().top,
                });
            }, 1000);
        }
    });


    function createAnchorlinks(navigationEl, anchorTargetEl) {
        const UNDESIRABLE_PARENTS = '.question, .sidebar, .cmplz-cookiebanner';
        const anchorNavigation = document.querySelector(navigationEl);
        const headings = document.querySelectorAll(anchorTargetEl);
        const svgArrowRight =
            '<span class="inline-svg"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.6 32.1" xml:space="preserve" role="presentation"><path style="fill-rule:evenodd;clip-rule:evenodd" d="M32.6 16.1 16.5 0l-2.8 2.8 11.4 11.3H0v4h25L13.7 29.3l2.8 2.8z"></path></svg></span>';

        if (headings && anchorNavigation) {
            let ul = document.createElement('ul');

            /* Relocate anchorlink container if position_at_top */
            const anchorlinksAtTop = document.querySelector('.anchorlink-container.position_at_top');

            if (anchorlinksAtTop){
                const articleBlock = document.querySelector('.content-block');
                const h1 = articleBlock.querySelectorAll('h1');
                const ingress = articleBlock.querySelector('p.ingress');

                if(ingress){
                    jQuery('.anchorlink-container').insertAfter(ingress);
                }else if(h1){
                    jQuery('.anchorlink-container').insertAfter(h1[0]);
                }
            }

            for (let i = 0; i < headings.length; i++) {
                const headingInnerText = headings[i].innerText;
                /* Compare: H2 position relative to anchorlink-navigation. */
                /* Value 2 = heading is before nav, 4 = after */
                const headingPosition = anchorNavigation.compareDocumentPosition(headings[i]);

                if (headingInnerText !== '' && headingPosition === 4 && jQuery(headings[i]).parents(UNDESIRABLE_PARENTS).length === 0) {
                    /* Start anchor link href and target element id with 'to-' if headingInnerText starts with a number */
                    const curHeadingText = headingInnerText.match(/^\d/) ? 'to-'+headingInnerText : headingInnerText;

                    const elementID = curHeadingText
                    .toLowerCase()
                    .replace(/\s+/g, '-')
                    .replace(/[^a-z0-9-]+/gi, '');
                    const anchorLink_HREF = '#' + elementID;

                    /* Add target anchor */
                    let span = document.createElement('span');
                    span.setAttribute('id', elementID);
                    headings[i].append(span);
                    headings[i].classList.add('anchor-target');

                    let li = document.createElement('li');
                    let link = document.createElement('a');

                    link.setAttribute('href', anchorLink_HREF);
                    link.append(headingInnerText);
                    link.insertAdjacentHTML('afterbegin', svgArrowRight);
                    li.append(link);
                    ul.append(li);

                    scrollToTarget(link);
                }
            }

            anchorNavigation.appendChild(ul);
        }
    }

    function scrollToTarget(element) {
        element.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth',
            });
        });
    }

    function isValidUrl(url){
        try {
            new URL(url);
        } catch (e) {
            return false;
        }

        return true;
    }

    function detectExternalLinks(item) {
        const locationHostname = window.location.hostname;
        const links = document.querySelectorAll(item);

        for (let i = 0; i < links.length; i++) {
            if( isValidUrl(links[i]) ){
                let domain = new URL(links[i]);
                let linkHostname = domain.hostname.replace('www.', '');

                if (linkHostname && locationHostname !== linkHostname && !links[i].classList.contains('venobox')) {
                    addExternalLinkStyling(links[i]);
                } else {
                    if (links[i].classList.contains('arrow')) {
                        addInternalLinkIcon(links[i]);
                    }
                }
            }
        }
    }

    function addExternalLinkStyling(link) {
        const UNDESIRABLE_PARENTS = '.share, .service-link';

        if (jQuery(link).parents(UNDESIRABLE_PARENTS).length === 0) {
            link.classList.add('external-link');
            addExternalLinkIcon(link);
        }
    }

    function addExternalLinkIcon(link) {
        const svgArrow45 = '<span class="inline-svg rotate-45">'+ARROW_SVG_RIGHT+'</span>';
        const inlineSVG = link.querySelector('.inline-svg');

        if (inlineSVG === null) {
            jQuery(link).prepend(svgArrow45);
        }
    }

    function addInternalLinkIcon(link) {
        const svgArrow45 = '<span class="inline-svg rotate-0">'+ARROW_SVG_RIGHT+'</span>';
        const inlineSVG = link.querySelector('.inline-svg');

        if (inlineSVG === null) {
            jQuery(link).prepend(svgArrow45);
        }
    }

    function filterAccordions(elements){
        const buttons = document.querySelectorAll(elements);

        buttons.forEach(button => {
            button.addEventListener('click', () =>{
                const targetTagId = button.dataset.tagid;
                const isSelected = button.classList.contains('selected');
                const parent = button.closest('.ihh-accordion');
                const accordions = parent.querySelectorAll('[data-tags]');

                accordions.forEach(item => {
                    const itemTags = item.dataset.tags;
                    const itemLI = item.closest('li');

                    if(isSelected){
                        jQuery(itemLI).fadeIn('fast');
                    }
                    else{
                        itemTags.includes(targetTagId) ? jQuery(itemLI).fadeIn('fast') : jQuery(itemLI).fadeOut('fast');
                    }
                });

                if(isSelected){
                    button.classList.remove('selected')
                    button.setAttribute('aria-pressed', 'false');
                }
                else{
                    parent.querySelectorAll('.accordion-filters button').forEach(btn => {
                        btn.classList.remove('selected');
                        btn.setAttribute('aria-pressed', 'false');
                    });

                    button.classList.add('selected');
                    button.setAttribute('aria-pressed', 'true');
                }

                // After filtering accordion list, focus first item
                setTimeout(() => {
                    const visibleFilteredAccordion = parent.querySelectorAll('.accordion-with-description--accordions li:not([style="display: none;"])');
                    const firstItem = visibleFilteredAccordion[0].querySelector('.question-header');

                    if(firstItem){
                        firstItem.focus();
                    }
                }, 400);
            });
        });
    }
    filterAccordions('.accordion-filters button');


  },
  finalize() {},
};

