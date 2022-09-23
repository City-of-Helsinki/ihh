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
function sage( $abstract = null, $parameters = [], Container $container = null ) {
    $container = $container ?: Container::getInstance();
    if ( ! $abstract ) {
        return $container;
    }

    return $container->bound( $abstract )
        ? $container->makeWith( $abstract, $parameters )
        : $container->makeWith( "sage.{$abstract}", $parameters );
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
function config( $key = null, $default = null ) {
    if ( is_null( $key ) ) {
        return sage( 'config' );
    }
    if ( is_array( $key ) ) {
        return sage( 'config' )->set( $key );
    }

    return sage( 'config' )->get( $key, $default );
}

/**
 * @param string $file
 * @param array  $data
 *
 * @return string
 */
function template( $file, $data = [] ) {
    return sage( 'blade' )->render( $file, $data );
}

/**
 * Retrieve path to a compiled blade view
 *
 * @param       $file
 * @param array $data
 *
 * @return string
 */
function template_path( $file, $data = [] ) {
    return sage( 'blade' )->compiledPath( $file, $data );
}

/**
 * @param $asset
 *
 * @return string
 */
function asset_path( $asset ) {
    return sage( 'assets' )->getUri( $asset );
}

/**
 * @param string|string[] $templates Possible template files
 *
 * @return array
 */
function filter_templates( $templates ) {
    $paths         = apply_filters( 'ihh/filter_templates/paths', [
        'views',
        'resources/views',
    ] );
    $paths_pattern = "#^(" . implode( '|', $paths ) . ")/#";

    return collect( $templates )
        ->map( function ( $template ) use ( $paths_pattern ) {
            /** Remove .blade.php/.blade/.php from template names */
            $template = preg_replace( '#\.(blade\.?)?(php)?$#', '', ltrim( $template ) );

            /** Remove partial $paths from the beginning of template names */
            if ( strpos( $template, '/' ) ) {
                $template = preg_replace( $paths_pattern, '', $template );
            }

            return $template;
        } )
        ->flatMap( function ( $template ) use ( $paths ) {
            return collect( $paths )
                ->flatMap( function ( $path ) use ( $template ) {
                    return [
                        "{$path}/{$template}.blade.php",
                        "{$path}/{$template}.php",
                    ];
                } )
                ->concat( [
                    "{$template}.blade.php",
                    "{$template}.php",
                ] );
        } )
        ->filter()
        ->unique()
        ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 *
 * @return string Location of the template
 */
function locate_template( $templates ) {
    return \locate_template( filter_templates( $templates ) );
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar() {
    static $display;
    isset( $display ) || $display = apply_filters( 'ihh/display_sidebar', false );

    return $display;
}

/**
 * Make tweet links clickable
 */
function linkify_tweet( $tweet ) {
    $tweet = preg_replace('/([\w]+\:\/\/[\w\-?&;#~=\.\/\@]+[\w\/])/', '<a target="_blank" href="$1">$1</a>', $tweet);
    $tweet = preg_replace('/#([A-Öa-z0-9\/\.]*)/', '<a target="_new" href="http://twitter.com/search?q=$1">#$1</a>', $tweet);
    $tweet = preg_replace('/@([A-Öa-z0-9\/\.]*)/', '<a href="http://www.twitter.com/$1">@$1</a>', $tweet);

    return $tweet;
}

/**
 * @return string
 */
function format_event_date() {
    $start = strtotime( get_field( 'start_time' ) );
    $end   = strtotime( get_field( 'end_time' ) );

    if ( ( $end - $start ) >= 1 * DAY_IN_SECONDS ) {
        return date_i18n( 'D, j M Y, H:i', $start ) . ' - ' . date_i18n( 'D, j M Y, H:i', $end );
    }

    return date( 'H:i', $start ) . ' - ' . date( 'H:i D, j M Y', $end );
}

/**
 * @param string $size
 *
 * @return array|false
 */
function get_default_image( $size = 'full' ) {
    return wp_get_attachment_image_url( get_theme_mod( 'ihh_default_lift_image' ), $size );
}

/*
* SVG file to inline
*/
function ihh_inline_svg($file) {
    $filePath = get_theme_file_path() . '/dist/images/' . $file . '.svg';

    if(!file_exists($filePath))
        return;

    $svg = '<span class="inline-svg">';
    $svg .= file_get_contents($filePath);
    $svg .= '</span>';

    return $svg;
}

/*
* Post Filters
*/
if (!function_exists(__NAMESPACE__ . '\\filter_posts')) :
    function filter_posts(){

        $data = array(
            "ajax_url" => \admin_url( 'admin-ajax.php' ),
            "categories" => get_post_categories(),
            "target_groups" => get_target_groups(),
            "base" => \home_url( $_SERVER['REQUEST_URI'] ),
        );
        echo template('partials/content/filter-posts', $data);
    }
endif;

function get_post_categories($list_pluck = false){
    $cats = get_categories(
        array(
            'orderby' => 'name'
        )
    );
    if (!empty($list_pluck)){
        $cats = wp_list_pluck( $cats, $list_pluck );
    }

    return $cats;

}

function get_target_groups(){
    $terms = get_terms([
        'taxonomy' => 'target_group',
        'hide_empty' => false,
    ]);
    return $terms;
}


/*
* Post filter function
*/
function post_filter_function(){

    set_query_var('type', $_GET['type']);
    set_query_var('paged', $_GET['paged']);
    set_query_var('lang', $_GET['lang']);

    $paged = (!empty( (int) $_GET['paged'] ) ) ? esc_attr($_GET['paged']) : 1;
    $args = array(
        'is_posts_page' => true,
        'target_group' => ( 'all' !== $_GET['targetgroup']) ? esc_attr( $_GET['targetgroup']) : 0,
        'paged' => $paged,
        'lang' => ( isset($_GET['lang'])) ? esc_attr( $_GET['lang']) : 'en',
    );
    $query = apply_filters(__NAMESPACE__ . '\pre_get_posts', (new \WP_Query($args)));
    $GLOBALS['wp_query'] = $query;
    echo template('partials/content/blog-post-list');
    die();
}

add_action('wp_ajax_myfilter', __NAMESPACE__ . '\\post_filter_function');
add_action('wp_ajax_nopriv_myfilter', __NAMESPACE__ . '\\post_filter_function');