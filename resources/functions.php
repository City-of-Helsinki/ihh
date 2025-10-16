<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 *
 * @param string $mesihh
 * @param string $subtitle
 * @param string $title
 */
$ihh_error = function ( $mesihh, $subtitle = '', $title = '' ) {
    $title  = $title ?: pll__( 'IHH &rsaquo; Error' );
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/ihh/docs/</a>';
    $mesihh = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$mesihh}</p><p>{$footer}</p>";
    wp_die( $mesihh, $title );
};

/**
 * Ensure compatible version of PHP is used
 */
if ( version_compare( '7.1', phpversion(), '>=' ) ) {
    $ihh_error( __( 'You must be using PHP 7.1 or greater.', 'ihh' ), __( 'Invalid PHP version', 'ihh' ) );
}

/**
 * Ensure compatible version of WordPress is used
 */
if ( version_compare( '4.7.0', get_bloginfo( 'version' ), '>=' ) ) {
    $ihh_error( __( 'You must be using WordPress 4.7.0 or greater.', 'ihh' ), __( 'Invalid WordPress version', 'ihh' ) );
}

function add_theme_scripts() {
    wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/ihh-style.css' );
}
add_action ( 'wp_enqueue_scripts', 'add_theme_scripts' );

/**
 * Ensure dependencies are loaded
 */
if ( ! class_exists( 'Roots\\Sage\\Container' ) ) {
    if ( ! file_exists( $composer = __DIR__ . '/../vendor/autoload.php' ) ) {
        $ihh_error(
            __( 'You must run <code>composer install</code> from the Sage directory.', 'ihh' ),
            __( 'Autoloader not found.', 'ihh' )
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map( function ( $file ) use ( $ihh_error ) {
    $file = "../app/{$file}.php";
    if ( ! locate_template( $file, true, true ) ) {
        $ihh_error( sprintf( __( 'Error locating <code>%s</code> for inclusion.', 'ihh' ), $file ), 'File not found' );
    }
}, [
    'helpers',
    'setup',
    'filters',
    'admin',
    'actions',
    'walker',
    'customizer',
] );

function amb_custom_post_type() {
    register_post_type('amb_media_catalogue',
        array(
            'labels'      => array(
                'name'          => __('Media Bank', 'ihh'),
                'singular_name' => __('Media Bank Item', 'ihh'),
            ),
            'public'      => false,
            'has_archive' => false,
            'show_ui' => true,
            'supports' => array('title')
        )
    );
}
add_action('init', 'amb_custom_post_type');

require_once('integrations/complianz.php');
require_once('integrations/show-cookie-banner.php');
require_once('acf-field-normalize-colors.php');
require_once('disable-comments.php');

require_once(get_template_directory().'/tinymce-editor-styles.php');


/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * https://codex.wordpress.org/Function_Reference/register_taxonomy
 */

 // Target groups for news and events
 function add_custom_taxonomies() {
    register_taxonomy('target_group', array('post', 'event'), array(
      'hierarchical' => true,

      'labels' => array(
        'name' => _x( 'Target group', 'taxonomy general name' ),
        'singular_name' => _x( 'Target group', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Target groups' ),
        'all_items' => __( 'All Target groups' ),
        'parent_item' => __( 'Parent Target group' ),
        'parent_item_colon' => __( 'Parent Target group:' ),
        'edit_item' => __( 'Edit Target group' ),
        'update_item' => __( 'Update Target group' ),
        'add_new_item' => __( 'Add New Target group' ),
        'new_item_name' => __( 'New Target group Name' ),
        'menu_name' => __( 'Target groups' ),
      ),

      'rewrite' => array(
        'slug' => 'target_group',
        'with_front' => false,
        'hierarchical' => true
      ),
    ));
}
add_action( 'init', 'add_custom_taxonomies', 0 );


/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/ihh/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/ihh/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/ihh/resources
 *
 * We do this so that the Template Hierarchy will look in themes/ihh/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/ihh/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/ihh/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/ihh/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/ihh/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/ihh/resources
 */
array_map(
    'add_filter',
    [ 'theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri' ],
    array_fill( 0, 4, 'dirname' )
);
Container::getInstance()
         ->bindIf( 'config', function () {
             return new Config( [
                 'assets' => require dirname( __DIR__ ) . '/config/assets.php',
                 'theme'  => require dirname( __DIR__ ) . '/config/theme.php',
                 'view'   => require dirname( __DIR__ ) . '/config/view.php',
             ] );
         }, true );

function flattenArray(array $array) {
    $return = array();
    array_walk_recursive($array, function($a) use (&$return) {
        if(is_int($a)) : $return[] = $a; endif;
    });
    return $return;
}

function ihh_acf_input_admin_footer() {

    ?>
<script type="text/javascript">
(function($) {
    acf.add_filter('color_picker_args', function(args, $field) {

        // Add colors to color palette
        args.palettes = ['#01a090', '#4dbdb1', '#83cac6', '#f7a091', '#f9bdb2', '#fad0c9', '#f0942f',
            '#f8ca97', '#f0e856', '#f4ee84', '#f7f3b7'
        ]


        // return
        return args;

    });
})(jQuery);
</script>
<?php

}

add_action('acf/input/admin_footer', 'ihh_acf_input_admin_footer');

// [ihh-cta text="some text" href="some url" background="#F7A091" color="#000000" rectangle="true|false" border="true|false" target="_self|_blank"]
add_shortcode('ihh-cta', function($atts) {
    $a = shortcode_atts(array(
        'text' => '',
        'href' => '',
        'rectangle' => false,
        'background' => '',
        'color' => '',
        'border' => 'false',
        'target' => '_self',
    ), $atts);

    $text = esc_attr($a['text']);
    $href = esc_attr($a['href']);
    $rectangle = ($a['rectangle'] !== "false") ? 'rounded-0' : '';
    $background = (!empty($a['background'])) ? esc_attr($a['background']) : '#F7A091';
    $color = (!empty($a['color'])) ? esc_attr($a['color']) : '#000';
    $border = ($a['border'] !== "false") ? 'btn-outline-dark' : '';
    $target = esc_attr($a['target']);

    // Create a unique ID for this CTA ...
    $unique_id = 'ihh-cta-' . uniqid();

    // ... and limit SVG color style to this specific element only
    $svg_style = '<style>#' . $unique_id . ' .inline-svg svg { fill: ' . $color . '; }</style>';

    $cta_button = '<a id="' . $unique_id . '" style="background:' . $background . '; color:' . $color . ' !important;" class="btn ' . $border . ' mr-auto py-3 px-3 ihh-cta ' . $rectangle . '" href="' . $href . '" target="' . $target . '">' . $text . '</a>' . $svg_style;

    return $cta_button;
});


/**
 * Add ACF header code to wp_head
 * Makes it easier to handle custom code snippets for tracking etc.
 * without having to edit theme files
 */
add_action('wp_head', function() {
    // Get the ACF field value from the options page
    $header_code = get_field('code', 'option');

    if ($header_code) {
        echo $header_code;
    }
});
