<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action(
    'wp_enqueue_scripts',
    function () {
        wp_enqueue_style(
            'ihh/fontawesome',
            'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        );
        wp_enqueue_style('ihh/main.css', asset_path('styles/main.css'), ['ihh/fontawesome'], null);

        wp_enqueue_script('ihh/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
        wp_enqueue_script('CXBus', 'https://apps.mypurecloud.ie/widgets/9.0/cxbus.min.js', [
            'jquery',
        ]);

        /* Chatbot styles and script */
        if (!get_theme_mod('ihh_hide_chat')) {
            wp_enqueue_style(
                'ihh/genesys.css',
                get_template_directory_uri() . '/assets/styles/chat-genesys-gui-customization.css',
                [],
                null,
            );
            wp_enqueue_script(
                'Genesys',
                get_template_directory_uri() . '/assets/scripts/chat-genesys-gui-customization.js',
                ['CXBus'],
                null,
                true,
            );
        }

        wp_enqueue_script(
            'ihh-ajax',
            get_template_directory_uri() . '/assets/scripts/ajax.js',
            ['jquery'],
            null,
            true,
        );
        wp_localize_script('ihh-ajax', 'wp_ajax', ['ajax_url' => admin_url('admin-ajax.php')]);

        if (is_single() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    },
    100,
);

/**
 * Theme setup
 */
add_action(
    'after_setup_theme',
    function () {
        /**
         * Enable features from Soil when plugin is activated
         * @link https://roots.io/plugins/soil/
         */
        add_theme_support('soil-clean-up');
        add_theme_support('soil-jquery-cdn');
        add_theme_support('soil-nav-walker');
        add_theme_support('soil-nice-search');
        add_theme_support('soil-relative-urls');

        /**
         * Enable plugins to manage the document title
         * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
         */
        add_theme_support('title-tag');

        /**
         * Register navigation menus
         * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
         */
        register_nav_menus([
            'primary_navigation' => __('Primary Navigation', 'ihh'),
        ]);

        /**
         * Enable post thumbnails
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        /**
         * Enable HTML5 markup support
         * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
         */
        add_theme_support('html5', [
            'caption',
            'comment-form',
            'comment-list',
            'gallery',
            'search-form',
        ]);

        /**
         * Enable selective refresh for widgets in customizer
         * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
         */
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Use main stylesheet for visual editor
         * @see resources/assets/styles/layouts/_tinymce.scss
         */
        add_editor_style(asset_path('styles/main.css'));

        /**
         * Remove comments from page
         */
        remove_post_type_support('page', 'comments');

        /**
         * Add imagesizes
         */
        add_image_size('lift', 320, 225, true);

        /**
         * Register translations
         */
        foreach (config('theme.translations') as $str) {
            pll_register_string($str, $str, 'theme');
        }
    },
    20,
);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];
    register_sidebar(
        [
            'name' => pll__('Primary'),
            'id' => 'sidebar-primary',
        ] + $config,
    );
    register_sidebar(
        [
            'name' => pll__('Footer'),
            'id' => 'sidebar-footer',
        ] + $config,
    );
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        new BladeProvider($app)->register();

        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')
        ->compiler()
        ->directive('asset', function ($asset) {
            return '<?= ' . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
        });
});

register_post_type('notification', [
    'labels' => [
        'name' => __('Notification', 'ihh'),
        'singular_name' => __('Notifications', 'ihh'),
    ],
    'supports' => ['title', 'editor'],
    'public' => true,
    'has_archive' => false,
    'exclude_from_search' => true,
    'publicly_queryable' => false,
    'menu_position' => 5,
    'rewrite' => ['slug' => 'notifications'],
    'menu_icon' => 'dashicons-warning',
]);

register_post_type('event', [
    'labels' => [
        'name' => __('Event', 'ihh'),
        'singular_name' => __('Events', 'ihh'),
    ],
    'supports' => ['title', 'editor', 'thumbnail', 'revisions'],
    'public' => true,
    'has_archive' => false,
    'menu_position' => 6,
    'rewrite' => [
        'with_front' => false,
        'slug' => 'events',
    ],
    'menu_icon' => 'dashicons-calendar-alt',
]);

register_post_type('newsletter', [
    'labels' => [
        'name' => __('Newsletter', 'ihh'),
        'singular_name' => __('Newsletters', 'ihh'),
    ],
    'supports' => ['title', 'thumbnail'],
    'public' => true,
    'has_archive' => false,
    'hierarchical' => false,
    'exclude_from_search' => true,
    'publicly_queryable' => false,
    'menu_position' => 8,
    'rewrite' => [
        'slug' => 'newsletters',
    ],
    'menu_icon' => 'dashicons-edit',
]);

register_post_type('contact', [
    'labels' => [
        'name' => __('Contacts', 'ihh'),
        'singular_name' => __('Contact', 'ihh'),
    ],
    'supports' => ['title'],
    'public' => false,
    'has_archive' => false,
    'exclude_from_search' => true,
    'show_ui' => true,
    'publicly_queryable' => false,
    'menu_position' => 9,
    'rewrite' => false,
    'menu_icon' => 'dashicons-email-alt',
]);

/**
 * Register contact post type for Polylang
 */
add_filter(
    'pll_get_post_types',
    function ($types, $is_settings) {
        $types['contact'] = 'contact';
        return $types;
    },
    10,
    2,
);

/**
 * ACF validation: limit contact selection to 2
 */
add_filter(
    'acf/validate_value/key=field_69086caf3b2ad',
    function ($valid, $value) {
        if (!$valid) {
            return $valid;
        }

        if (is_array($value) && count($value) > 2) {
            return 'Too many contacts selected. Please select a maximum of 2 contacts.';
        }
        return $valid;
    },
    10,
    2,
);
