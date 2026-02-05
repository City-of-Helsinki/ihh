/**
 * Event Preview Autosave
 * Based on the discussion at => https://support.advancedcustomfields.com/forums/topic/preview-with-acf-fields-are-incorrect/
 *
 */
(function ($) {
    $(function () {
        if ($('#post_type').val() !== 'event') return;

        var formEl = document.querySelector('#post');
        var linkEl = document.querySelector('#preview-action a');
        if (!formEl || !linkEl) return;

        var busy = false;
        var windowName = 'event_preview_tab';

        linkEl.addEventListener(
            'click',
            function (e) {
                // Block WP default + any other handlers (prevents new tab)
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                if (busy) return;
                busy = true;

                var fallbackUrl = linkEl.getAttribute('href');
                if (!fallbackUrl) {
                    busy = false;
                    return;
                }

                // Reuse same preview tab
                var win = window.open('about:blank', windowName);

                var formData = new FormData(formEl);
                formData.set('action', 'create_preview_autosave');

                if (window.EventPreviewAutosave && EventPreviewAutosave.nonce) {
                    formData.set('nonce', EventPreviewAutosave.nonce);
                }

                var url =
                    window.EventPreviewAutosave && EventPreviewAutosave.ajaxurl
                        ? EventPreviewAutosave.ajaxurl
                        : window.ajaxurl;

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                })
                    .done(function (res) {
                        var ajaxPreviewUrl =
                            res && res.success && res.data && res.data.preview_url
                                ? res.data.preview_url
                                : null;

                        var finalUrl = ajaxPreviewUrl || fallbackUrl;

                        // Force refresh
                        finalUrl += (finalUrl.indexOf('?') >= 0 ? '&' : '?') + '_ts=' + Date.now();

                        if (win && !win.closed) {
                            win.location = finalUrl;
                            win.focus();
                        } else {
                            window.open(finalUrl, windowName);
                        }
                    })
                    .always(function () {
                        busy = false;
                    });
            },
            true
        );
    });
})(jQuery);
