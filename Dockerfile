FROM helsinki.azurecr.io/ubi9/openshift-wordpress-base:6.9.11-php83

ARG MOUNT_SECRET="false"
ARG COMPOSER_AUTH="{}"

# Define theme versions
ARG WP_THEME_VERSION_IHH=""

# Define plugin versions
ARG WP_PLUGIN_VERSION_ACF_CONTENT_ANALYSIS_FOR_YOAST_SEO=""
ARG WP_PLUGIN_VERSION_CLASSIC_EDITOR=""
ARG WP_PLUGIN_VERSION_CLEAN_IMAGE_FILENAMES=""
ARG WP_PLUGIN_VERSION_EASY_FANCYBOX=""
ARG WP_PLUGIN_VERSION_IMSANITY=""
ARG WP_PLUGIN_VERSION_NATIVE_LAZYLOAD=""
ARG WP_PLUGIN_VERSION_POLYLANG=""
ARG WP_PLUGIN_VERSION_REDIRECTION=""
ARG WP_PLUGIN_VERSION_SIMPLE_PAGE_ORDERING=""
ARG WP_PLUGIN_VERSION_WORDFENCE=""
ARG WP_PLUGIN_VERSION_INSERT_HEADERS_AND_FOOTERS=""
ARG WP_PLUGIN_VERSION_DUPLICATE_POST=""
ARG WP_PLUGIN_VERSION_WORDPRESS_SEO=""
ARG WP_PLUGIN_VERSION_BEDROCK_AUTOLOADER=""

# build volume auth
RUN mkdir -p /opt/app-root/src/.config/composer && \
    if [ -n "$MOUNT_SECRET" ] && [ "${MOUNT_SECRET,,}" = "true" ]; then \
        cp /mnt/secrets/* /opt/app-root/src/.config/composer; \
    fi

# Install plugins via Composer
    #FIXME: add WP_THEME_VERSION_IHH constraint when realease tag is available
RUN composer config repositories.nuortenhelsinki vcs https://github.com/City-of-Helsinki/ihh && \
    composer require wphel/ihh && \ 
    composer config repositories.wpackagist composer https://wpackagist.org && \
    composer require wpackagist-plugin/acf-content-analysis-for-yoast-seo:${WP_PLUGIN_VERSION_ACF_CONTENT_ANALYSIS_FOR_YOAST_SEO} && \
    composer require wpackagist-plugin/classic-editor:${WP_PLUGIN_VERSION_CLASSIC_EDITOR} && \
    composer require wpackagist-plugin/clean-image-filenames:${WP_PLUGIN_VERSION_CLEAN_IMAGE_FILENAMES} && \
    composer require wpackagist-plugin/easy-fancybox:${WP_PLUGIN_VERSION_EASY_FANCYBOX} && \
    composer require wpackagist-plugin/imsanity:${WP_PLUGIN_VERSION_IMSANITY} && \
    composer require wpackagist-plugin/native-lazyload:${WP_PLUGIN_VERSION_NATIVE_LAZYLOAD} && \
    composer require wpackagist-plugin/polylang:${WP_PLUGIN_VERSION_POLYLANG} && \
    composer require wpackagist-plugin/redirection:${WP_PLUGIN_VERSION_REDIRECTION} && \
    composer require wpackagist-plugin/simple-page-ordering:${WP_PLUGIN_VERSION_SIMPLE_PAGE_ORDERING} && \
    composer require wpackagist-plugin/wordfence:${WP_PLUGIN_VERSION_WORDFENCE} && \
    composer require wpackagist-plugin/insert-headers-and-footers:${WP_PLUGIN_VERSION_INSERT_HEADERS_AND_FOOTERS} && \
    composer require wpackagist-plugin/duplicate-post:${WP_PLUGIN_VERSION_DUPLICATE_POST} && \
    composer require wpackagist-plugin/wordpress-seo:${WP_PLUGIN_VERSION_WORDPRESS_SEO} && \
    composer require roots/bedrock-autoloader:${WP_PLUGIN_VERSION_BEDROCK_AUTOLOADER} && \
    rm -f /opt/app-root/src/.config/composer/auth.json