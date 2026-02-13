export default {
    init() {
        const ARROW_SVG_RIGHT =
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.6 32.1" xml:space="preserve" role="presentation"><path style="fill-rule:evenodd;clip-rule:evenodd" d="M32.6 16.1 16.5 0l-2.8 2.8 11.4 11.3H0v4h25L13.7 29.3l2.8 2.8z"></path></svg>';

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
            detectInternalLinks('.main a');
            createAnchorlinks('.anchorlink-navigation');

            window.CXBus.configure({
                pluginsPath: 'https://apps.mypurecloud.ie/widgets/9.0/plugins/',
            });
            window.CXBus.loadPlugin('widgets-core');
            $('a[target=_blank]').each(function () {
                $(this).append(' <span class="ihh-visually-hidden">opens in new tab</span>');
            });

            /* Animate view to anchorlink on page load */
            if (window.location.hash) {
                setTimeout(function () {
                    const jQueryTarget = jQuery('body').find(window.location.hash);

                    jQuery('html, body').animate({
                        scrollTop: jQueryTarget.offset().top,
                    });
                }, 1000);
            }

            // START ACCORDION SCROLL
            // Code for smooth scrolling to accordion header after closing
            // Responsive offset for accordion scroll
            function getAccordionOffset() {
                const header = document.querySelector('.main-nav-container');
                const headerHeight = Math.ceil(header.getBoundingClientRect().height);
                const margin = 10;
                const ww = window.innerWidth;
                return ww < 1110 ? margin : headerHeight + margin;
            }

            // Mark the panel when it is being closed by Close button
            // This is needed to differentiate between header click and Close button click
            $('.faqs-container').on('click', '.faq-answer-close-button', function () {
                const targetSel = $(this).attr('data-target') || $(this).attr('href');
                if (!targetSel) return;
                const $panel = $(targetSel);
                $panel.data('closeClicked', true);
            });

            // Code for scrolling
            $('.faqs-container').on('hide.bs.collapse', function (e) {
                const $panel = $(e.target);

                // If "closeClicked" flag is not set → no scroll (e.g. header click)
                if (!$panel.data('closeClicked')) return;

                // Remove flag
                $panel.removeData('closeClicked');

                // Get closest header
                const $header = $panel.closest('.question').find('.question-header').first();
                if (!$header.length) return;

                // Scroll to header with offset
                const y = Math.max(0, $header.offset().top - getAccordionOffset());
                $('html, body').stop(true).animate({ scrollTop: y }, 250);
            });
        });
        // END ACCORDION SCROLL

        /**
         * Handles clicks on navigation items that have children in the dropdown menu.
         * It toggles the visibility of the child menu and ensures that only one
         * child menu is open at a time within the same dropdown menu.
         *
         */
        $('.dropdown-menu').on(
            'click',
            '.has-children > .nav-heading, .has-children > a.nav-link',
            function (e) {
                const ww = window.innerWidth;
                // Only apply for mobile widths
                if (ww > 1300) return;

                // Link: toggle only if the <a> itself was clicked (i.e., the after area)
                if ($(this).is('a.nav-link')) {
                    if (e.target !== this) {
                        // Do navigation
                        return;
                    }
                    // Prevent navigation
                    e.preventDefault();
                    e.stopPropagation();
                }

                var $li = $(this).closest('li.has-children');
                var $menu = $(this).closest('.dropdown-menu');

                // Close all other open items anywhere in this dropdown menu
                $menu.find('li.has-children').not($li).removeClass('is-open');

                // Toggle current one
                $li.toggleClass('is-open');
            }
        );

        // ### Language menu START

        /**
         * Toggle language menu visibility on toggle click
         */
        $(document).on('click', '.language-menu__toggle', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const $menu = $(this).closest('.language-menu');
            const $caret = $menu.find('.language-menu__icon-caret');
            const $list = $menu.find('.language-menu__list');

            // Toggle visibility
            $list.toggle();
            $caret.toggleClass('show');
        });

        // Click outside → close all
        $(document).on('click', function () {
            $('.language-menu__list').hide();
            $('.language-menu__icon-caret').removeClass('show');
        });

        // Prevent closing when clicking inside the list
        $(document).on('click', '.language-menu__list', function (e) {
            e.stopPropagation();
        });

        // ### Language menu END

        function createAnchorlinks(navigationEl) {
            const anchorNavigation = document.querySelector(navigationEl);
            const headings = document.querySelectorAll('[data-anchor="true"]');
            const svgArrowRight =
                '<span class="inline-svg"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.6 32.1" xml:space="preserve" role="presentation"><path style="fill-rule:evenodd;clip-rule:evenodd" d="M32.6 16.1 16.5 0l-2.8 2.8 11.4 11.3H0v4h25L13.7 29.3l2.8 2.8z"></path></svg></span>';

            if (!headings && !headings.length) {
              return;
            }

            const ul = document.createElement('ul');

          headings.forEach(heading => {
            const headingText = heading.innerText.trim();

            if (!headingText) {
              return;
            }

            const elementID = headingText
              .toLowerCase()
              .replace(/^\d/, 'to-$&')
              .replace(/\s+/g, '-')
              .replace(/[^a-z0-9-]+/gi, '');

            heading.setAttribute('id', elementID);

            const li = document.createElement('li');
            const link = document.createElement('a');

            link.href = `#${elementID}`;
            link.innerHTML = `${svgArrowRight}${headingText}`;

            li.append(link);
            ul.append(li);

          });

          anchorNavigation.append(ul);
        }

        function scrollToTarget(element) {
            element.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth',
                });
            });
        }

        function isValidUrl(url) {
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
                if (isValidUrl(links[i])) {
                    let domain = new URL(links[i]);
                    let linkHostname = domain.hostname.replace('www.', '');

                    if (
                        linkHostname &&
                        locationHostname !== linkHostname &&
                        !links[i].classList.contains('venobox') &&
                        !links[i].classList.contains('fancybox-youtube')
                    ) {
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
            const svgArrow45 = '<span class="inline-svg rotate-45">' + ARROW_SVG_RIGHT + '</span>';
            const inlineSVG = link.querySelector('.inline-svg');

            if (inlineSVG === null) {
                jQuery(link).prepend(svgArrow45);
            }
        }

        function addInternalLinkIcon(link) {
            const svgArrow45 = '<span class="inline-svg rotate-0">' + ARROW_SVG_RIGHT + '</span>';
            const inlineSVG = link.querySelector('.inline-svg');

            if (inlineSVG === null) {
                jQuery(link).prepend(svgArrow45);
            }
        }

        /**
         * Finds internal links within the specified selector and adds an arrow icon and class to them.
         *
         * @param {string} selector
         */
        function detectInternalLinks(selector) {
            const currentHost = window.location.host;
            const links = document.querySelectorAll(selector);

            links.forEach((link) => {
                const isIhhCta = link.classList.contains('ihh-cta');

                // Skip only for non-CTA links
                if (!isIhhCta) {
                    // Skip links within content blocks
                    if (link.closest('.content-block-content')) return;
                    // Skip links within blog events section
                    if (link.closest('#blog-events')) return;
                    // Skip links within blog posts section
                    if (link.closest('#blog-posts')) return;
                    // Skip links within event body
                    if (link.closest('.event-body') && !link.closest('.banner-text')) return;
                    // Skip "go back" links
                    if (link.matches('.go-back')) return;
                    // Skip post grid items
                    if (link.closest('.post-grid-item')) return;
                    // Skip links within media bank items
                    if (link.closest('.media-bank-item')) return;
                }

                const href = link.getAttribute('href');

                // Bypass invalid hrefs
                if (!href || href.startsWith('#') || href.startsWith('javascript:')) return;

                // Create URL safely (handles relative links)
                const url = new URL(href, window.location.origin);

                // Check if the link is internal
                const isInternal = url.host === currentHost;

                if (isInternal) {
                    const svgArrow45 = '<span class="inline-svg">' + ARROW_SVG_RIGHT + '</span>';
                    const inlineSVG = link.querySelector('.inline-svg');

                    // Add the SVG icon if not already present
                    if (inlineSVG === null) {
                        jQuery(link).prepend(svgArrow45);
                    }

                    // Add internal-link class
                    link.classList.add('internal-link');
                }
            });
        }
    },
    finalize() {},
};
