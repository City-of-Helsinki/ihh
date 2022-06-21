export default {
  init() {
    const ARROW_SVG = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.6 32.1" xml:space="preserve" role="presentation"><path style="fill-rule:evenodd;clip-rule:evenodd" d="M32.6 16.1 16.5 0l-2.8 2.8 11.4 11.3H0v4h25L13.7 29.3l2.8 2.8z"></path></svg>';

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

        $('a.external-link').each(function () {
            const svgArrow =
            '<span class="inline-svg rotate-45"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.6 32.1" xml:space="preserve" role="presentation"><path style="fill-rule:evenodd;clip-rule:evenodd" d="M32.6 16.1 16.5 0l-2.8 2.8 11.4 11.3H0v4h25L13.7 29.3l2.8 2.8z"></path></svg></span>';
            $(this).prepend(svgArrow);
        });

        createAnchorlinks('.anchorlink-navigation', 'h2');
    });


    function createAnchorlinks(navigationEl, anchorTargetEl) {
        const UNDESIRABLE_PARENTS = '.question, .sidebar';
        const anchorNavigation = document.querySelector(navigationEl);
        const headings = document.querySelectorAll(anchorTargetEl);
        const svgArrowRight =
            '<span class="inline-svg rotate-90"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.6 32.1" xml:space="preserve" role="presentation"><path style="fill-rule:evenodd;clip-rule:evenodd" d="M32.6 16.1 16.5 0l-2.8 2.8 11.4 11.3H0v4h25L13.7 29.3l2.8 2.8z"></path></svg></span>';

        if (headings && anchorNavigation) {
            let ul = document.createElement('ul');

            for (let i = 0; i < headings.length; i++) {
                const headingInnerText = headings[i].innerText;
                /* Compare: H2 position relative to anchorlink-navigation. */
                /* Value 2 = heading is before nav, 4 = after */
                const headingPosition = anchorNavigation.compareDocumentPosition(headings[i]);

                if (headingInnerText !== '' && headingPosition === 4 && jQuery(headings[i]).parents(UNDESIRABLE_PARENTS).length === 0) {
                    const elementID = headingInnerText
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
    $(document).ready(function(){
        $('a[target=_blank]').each(function(){
            $(this).append(' <span class="ihh-visually-hidden">opens in new tab</span>')
        });

        detectExternalLinks('.main a');
    })


    function detectExternalLinks(item) {
        const hostName = window.location.hostname;
        const links = document.querySelectorAll(item);

        for (let i = 0; i < links.length; i++) {
            let domain = (new URL(links[i]));
            domain = domain.hostname.replace('www.', '');

            if (hostName !== domain) {
                addExternalLinkStyling(links[i]);
            } else {
                if (links[i].classList.contains('arrow')) {
                    addInternalLinkIcon(links[i]);
                }
            }
        }
    }

    function addExternalLinkStyling(link) {
        link.classList.add('external-link');
        addExternalLinkIcon(link);
    }

    function addExternalLinkIcon(link) {
        const svgArrow45 = '<span class="inline-svg rotate-45">'+ARROW_SVG+'</span>';
        const inlineSVG = link.querySelector('.inline-svg');

        if (inlineSVG === null) {
            jQuery(link).prepend(svgArrow45);
        }
    }

    function addInternalLinkIcon(link) {
        const svgArrow45 = '<span class="inline-svg rotate-0">'+ARROW_SVG+'</span>';
        const inlineSVG = link.querySelector('.inline-svg');

        if (inlineSVG === null) {
            jQuery(link).prepend(svgArrow45);
        }
    }
  },
  finalize() {},
};
