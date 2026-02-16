<?php

namespace App;

use Roots\Sage\Container;

/**
 * Get the ihh container.
 *
 * @param string    $abstract
 * @param array     $parameters
 * @param Container $container
 *
 * @return Container|mixed
 */
function sage($abstract = null, $parameters = [], Container $container = null)
{
    $container = $container ?: Container::getInstance();
    if (!$abstract) {
        return $container;
    }

    return $container->bound($abstract)
        ? $container->makeWith($abstract, $parameters)
        : $container->makeWith("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed        $default
 *
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link      https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null)
{
    if (is_null($key)) {
        return sage('config');
    }
    if (is_array($key)) {
        return sage('config')->set($key);
    }

    return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array  $data
 *
 * @return string
 */
function template($file, $data = [])
{
    if (is_redirection_page()) {
        $page_obj = get_redirection_page_object();
        $template = get_post_meta($page_obj->ID, '_wp_page_template', true);

        if (empty($template) || $template === 'default') {
            $template = 'page.blade.php';
        }
        $file = locate_template($template);
    }

    return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 *
 * @param       $file
 * @param array $data
 *
 * @return string
 */
function template_path($file, $data = [])
{
    return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 *
 * @return string
 */
function asset_path($asset)
{
    return sage('assets')->getUri($asset);
}

/**
 * @param string|string[] $templates Possible template files
 *
 * @return array
 */
function filter_templates($templates)
{
    $paths = apply_filters('ihh/filter_templates/paths', ['views', 'resources/views']);
    $paths_pattern = '#^(' . implode('|', $paths) . ')/#';

    return collect($templates)
        ->map(function ($template) use ($paths_pattern) {
            /** Remove .blade.php/.blade/.php from template names */
            $template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

            /** Remove partial $paths from the beginning of template names */
            if (strpos($template, '/')) {
                $template = preg_replace($paths_pattern, '', $template);
            }

            return $template;
        })
        ->flatMap(function ($template) use ($paths) {
            return collect($paths)
                ->flatMap(function ($path) use ($template) {
                    return ["{$path}/{$template}.blade.php", "{$path}/{$template}.php"];
                })
                ->concat(["{$template}.blade.php", "{$template}.php"]);
        })
        ->filter()
        ->unique()
        ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 *
 * @return string Location of the template
 */
function locate_template($templates)
{
    return \locate_template(filter_templates($templates));
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || ($display = apply_filters('ihh/display_sidebar', false));

    return $display;
}

/**
 * Make tweet links clickable
 */
function linkify_tweet($tweet)
{
    $tweet = preg_replace(
        '/([\w]+\:\/\/[\w\-?&;#~=\.\/\@]+[\w\/])/',
        '<a target="_blank" href="$1">$1</a>',
        $tweet,
    );
    $tweet = preg_replace(
        '/#([A-Öa-z0-9\/\.]*)/',
        '<a target="_new" href="http://twitter.com/search?q=$1">#$1</a>',
        $tweet,
    );
    $tweet = preg_replace(
        '/@([A-Öa-z0-9\/\.]*)/',
        '<a href="http://www.twitter.com/$1">@$1</a>',
        $tweet,
    );

    return $tweet;
}

/**
 * @return string
 */
function format_event_date()
{
    $start = strtotime(get_field('start_time'));
    $end = strtotime(get_field('end_time'));

    if (!$start || !$end) {
        return '';
    }

    $current_year = date('Y');
    $start_year = date('Y', $start);
    $end_year = date('Y', $end);

    // If the event spans different years
    // OR
    // is not in the current year, include the year in the format
    $include_year = $start_year !== $end_year || $start_year !== $current_year;

    if ($end - $start >= DAY_IN_SECONDS) {
        // Multiple day event
        $format = $include_year ? 'j F Y' : 'j F';
        return date_i18n($format, $start) . ' – ' . date_i18n($format, $end);
    }

    // One day event
    $date_format = $include_year ? 'j F Y' : 'j F';
    return date_i18n($date_format, $start) . ' ' . date('H.i', $start) . ' – ' . date('H.i', $end);
}

/**
 * Returns event date (or date range).
 *
 * @return string
 */
function format_event_date_only()
{
    $start = strtotime(get_field('start_time'));
    $end = strtotime(get_field('end_time'));

    // If the event spans multiple days
    if ($end - $start >= DAY_IN_SECONDS) {
        return date_i18n('j F Y', $start) . ' – ' . date_i18n('j F Y', $end);
    }

    // Otherwise, just one date
    return date_i18n('l j M Y', $start);
}

/**
 * Returns event time range only.
 *
 * @return string
 */
function format_event_time_only()
{
    $start = strtotime(get_field('start_time'));
    $end = strtotime(get_field('end_time'));

    return date_i18n('H.i', $start) . ' – ' . date_i18n('H.i', $end);
}

/**
 * @param string $size
 *
 * @return array|false
 */
function get_default_image($size = 'full')
{
    return wp_get_attachment_image_url(get_theme_mod('ihh_default_lift_image'), $size);
}

/*
 * SVG file to inline
 */
function ihh_inline_svg($file)
{
    $asset = sage('assets')->get('images/' . $file . '.svg');
    $filePath = get_theme_file_path() . '/dist/' . $asset;

    if (!file_exists($filePath)) {
        return;
    }

    $svg = '<span class="inline-svg">';
    $svg .= file_get_contents($filePath);
    $svg .= '</span>';

    return $svg;
}

function get_post_categories($list_pluck = false)
{
    $cats = get_categories([
        'orderby' => 'name',
    ]);
    if (!empty($list_pluck)) {
        $cats = wp_list_pluck($cats, $list_pluck);
    }

    return $cats;
}

/**
 * Get image caption by URL
 * @return string|null
 */
function get_image_caption_by_url($image_url)
{
    // Get attachment ID by URL
    $attachment_id = attachment_url_to_postid($image_url);
    if (!$attachment_id) {
        return null;
    }

    // Get caption
    $caption = wp_get_attachment_caption($attachment_id);
    return $caption;
}

/*
 * Post filter function
 */
function post_filter_function()
{
    set_query_var('type', $_GET['type']);
    set_query_var('paged', $_GET['paged']);
    set_query_var('lang', $_GET['lang']);

    $paged = !empty((int) $_GET['paged']) ? esc_attr($_GET['paged']) : 1;
    $args = [
        'is_posts_page' => true,
        'target_group' => 'all' !== $_GET['target_group'] ? esc_attr($_GET['target_group']) : 0,
        'paged' => $paged,
        'lang' => isset($_GET['lang']) ? esc_attr($_GET['lang']) : 'en',
    ];
    $query = apply_filters(__NAMESPACE__ . '\pre_get_posts', new \WP_Query($args));
    $GLOBALS['wp_query'] = $query;
    if ($_GET['type'] == 'event') {
        echo template('partials/content/blog-events-list');
    } else {
        echo template('partials/content/blog-post-list');
    }
    die();
}

add_action('wp_ajax_myfilter', __NAMESPACE__ . '\\post_filter_function');
add_action('wp_ajax_nopriv_myfilter', __NAMESPACE__ . '\\post_filter_function');

function is_redirection_page()
{
    if (str_contains(get_page_template(), 'template-redirection.blade.php')) {
        return true;
    }

    return false;
}

function is_external_link(string $link): bool
{
    $link_host = parse_url($link, PHP_URL_HOST);
    $site_host = parse_url(home_url(), PHP_URL_HOST);

    if (!$link_host || !$site_host) {
        return false; // treat relative/invalid as not external
    }

    $link_host = preg_replace('/^www\./i', '', $link_host);
    $site_host = preg_replace('/^www\./i', '', $site_host);

    return strcasecmp($link_host, $site_host) !== 0;
}


function get_redirection_page_object()
{
    return get_field('redirect_to', get_the_ID());
}

/**
 * Render Link section li content
 *
 * @param boolean $show_images
 * @return boolean
 */
function render_link_section_li(bool $show_images): void
{
    $url = get_sub_field('cta_url');
    $is_external = false;

    if ($url) {
        $site_host = parse_url(home_url(), PHP_URL_HOST);
        $link_host = parse_url($url, PHP_URL_HOST);

        $is_external = $link_host && $link_host !== $site_host;
    }
    ?>
<li class="list-item">
    <a href="<?php the_sub_field(
            'cta_url',
        ); ?>" class="arrow" target="<?php echo $is_external ? '_blank' : '_self'; ?>">
        <?php if ($show_images): ?>
        <div class="image-container aspect-ratio-1-96">
            <?php if (get_sub_field('image')): ?>
            <img src="<?php the_sub_field('image'); ?>" alt="" class="image-fit" />
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="list-content">
            <h3 class="item-heading"><?php the_sub_field('heading'); ?></h3>
            <p class="item-description"><?php the_sub_field('description'); ?></p>
            <span class="inline-svg rotate-<?php echo $is_external
                    ? '45'
                    : '0'; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.6 32.1" xml:space="preserve"
                    role="presentation">
                    <path style="fill-rule:evenodd;clip-rule:evenodd"
                        d="M32.6 16.1 16.5 0l-2.8 2.8 11.4 11.3H0v4h25L13.7 29.3l2.8 2.8z"></path>
                </svg>
            </span>
        </div>
    </a>
</li>
<?php
}

/**
 * AJAX handler to load more news
 *
 */
function ihh_load_more_news()
{
    check_ajax_referer('load_more_news', 'nonce');

    $page = isset($_POST['page']) ? max(1, (int) $_POST['page']) : 1;
    $ppp = isset($_POST['per_page']) ? max(1, (int) $_POST['per_page']) : 9;
    $offset = isset($_POST['offset']) ? max(0, (int) $_POST['offset']) : 6;

    // Basic query args
    $args = [
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $ppp,
        'offset' => $offset,
        'paged' => $page,
        'no_found_rows' => false,
        'meta_query' => [
            'relation' => 'OR',
            [
                'relation' => 'OR',
                [
                    'key' => 'end_time',
                    'value' => date('Y-m-d H:i:s'),
                    'compare' => '>=',
                    'type' => 'DATETIME',
                ],
                [
                    'key' => 'end_time',
                    'value' => '',
                    'compare' => '==',
                ],
            ],
            [
                [
                    'key' => 'end_time',
                    'compare' => 'NOT EXISTS',
                    'value' => '',
                ],
            ],
        ],
    ];

    $q = new \WP_Query($args);

    ob_start();
    if ($q->have_posts()) {
        while ($q->have_posts()) {
            $q->the_post();
            echo template('partials/content/grid');
        }
    }
    $html = ob_get_clean();
    wp_reset_postdata();

    // Has more?
    $total = (int) $q->found_posts;
    $has_more = $page * $ppp < $total;

    wp_send_json_success([
        'html' => $html,
        'has_more' => $has_more,
    ]);
}

add_action('wp_ajax_load_more_news', __NAMESPACE__ . '\\ihh_load_more_news');
add_action('wp_ajax_nopriv_load_more_news', __NAMESPACE__ . '\\ihh_load_more_news');

/**
 * AJAX handler to load more events
 *
 */
function ihh_load_more_events()
{
    check_ajax_referer('load_more_events', 'nonce');

    $page = isset($_POST['page']) ? max(1, (int) $_POST['page']) : 1;
    $ppp = isset($_POST['per_page']) ? max(1, (int) $_POST['per_page']) : 9;
    $offset = isset($_POST['offset']) ? max(0, (int) $_POST['offset']) : 6;
    $range = isset($_POST['range']) ? sanitize_text_field($_POST['range']) : 'upcoming';
    if ($range !== 'past' && $range !== 'upcoming') {
        $range = 'upcoming';
    }

    // Basic query args
    $args = [
        'post_type' => 'event',
        'post_status' => 'publish',
        'posts_per_page' => $ppp,
        'offset' => $offset,
        'paged' => $page,
        'no_found_rows' => false,
    ];

    // Range specific args
    if ($range === 'past') {
        $args['meta_query'] = [
            [
                'key' => 'end_time',
                'value' => current_time('mysql'),
                'compare' => '<',
                'type' => 'DATETIME',
            ],
        ];
        $args['meta_key'] = 'end_time';
        $args['orderby'] = 'meta_value';
        $args['order'] = 'DESC';
    } else {
        $args['meta_query'] = [
            [
                'key' => 'end_time',
                'value' => current_time('mysql'),
                'compare' => '>=',
                'type' => 'DATETIME',
            ],
        ];
        $args['meta_key'] = 'start_time';
        $args['orderby'] = 'meta_value';
        $args['order'] = 'ASC';
    }

    $q = new \WP_Query($args);

    ob_start();
    if ($q->have_posts()) {
        while ($q->have_posts()) {
            $q->the_post();
            echo template('partials/content/grid');
        }
    }
    $html = ob_get_clean();
    wp_reset_postdata();

    // Has more?
    $total = (int) $q->found_posts;
    $has_more = $page * $ppp < $total;

    wp_send_json_success([
        'html' => $html,
        'has_more' => $has_more,
    ]);
}

add_action('wp_ajax_load_more_events', __NAMESPACE__ . '\\ihh_load_more_events');
add_action('wp_ajax_nopriv_load_more_events', __NAMESPACE__ . '\\ihh_load_more_events');