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
$ihh_error = function ($mesihh, $subtitle = '', $title = '') {
    $title = $title ?: pll__('IHH &rsaquo; Error');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/ihh/docs/</a>';
    $mesihh = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$mesihh}</p><p>{$footer}</p>";
    wp_die($mesihh, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $ihh_error(
        __('You must be using PHP 7.1 or greater.', 'ihh'),
        __('Invalid PHP version', 'ihh'),
    );
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $ihh_error(
        __('You must be using WordPress 4.7.0 or greater.', 'ihh'),
        __('Invalid WordPress version', 'ihh'),
    );
}

function add_theme_scripts()
{
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/ihh-style.css');
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__ . '/../vendor/autoload.php')) {
        $ihh_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'ihh'),
            __('Autoloader not found.', 'ihh'),
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
array_map(
    function ($file) use ($ihh_error) {
        $file = "../app/{$file}.php";
        if (!locate_template($file, true, true)) {
            $ihh_error(
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'ihh'), $file),
                'File not found',
            );
        }
    },
    ['helpers', 'setup', 'filters', 'admin', 'actions', 'walker', 'customizer'],
);

function amb_custom_post_type()
{
    register_post_type('amb_media_catalogue', [
        'labels' => [
            'name' => __('Media Bank', 'ihh'),
            'singular_name' => __('Media Bank Item', 'ihh'),
        ],
        'public' => false,
        'has_archive' => false,
        'show_ui' => true,
        'supports' => ['title'],
    ]);
}
add_action('init', 'amb_custom_post_type');

require_once 'integrations/complianz.php';
require_once 'integrations/show-cookie-banner.php';
require_once 'acf-field-normalize-colors.php';
require_once 'disable-comments.php';

require_once get_template_directory() . '/tinymce-editor-styles.php';

/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * https://codex.wordpress.org/Function_Reference/register_taxonomy
 */

// Target groups for news and events
function add_custom_taxonomies()
{
    register_taxonomy(
        'target_group',
        ['post', 'event'],
        [
            'hierarchical' => true,

            'labels' => [
                'name' => _x('Target group', 'taxonomy general name'),
                'singular_name' => _x('Target group', 'taxonomy singular name'),
                'search_items' => __('Search Target groups'),
                'all_items' => __('All Target groups'),
                'parent_item' => __('Parent Target group'),
                'parent_item_colon' => __('Parent Target group:'),
                'edit_item' => __('Edit Target group'),
                'update_item' => __('Update Target group'),
                'add_new_item' => __('Add New Target group'),
                'new_item_name' => __('New Target group Name'),
                'menu_name' => __('Target groups'),
            ],

            'rewrite' => [
                'slug' => 'target_group',
                'with_front' => false,
                'hierarchical' => true,
            ],
        ],
    );
}
add_action('init', 'add_custom_taxonomies', 0);

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
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname'),
);
Container::getInstance()->bindIf(
    'config',
    function () {
        return new Config([
            'assets' => require dirname(__DIR__) . '/config/assets.php',
            'theme' => require dirname(__DIR__) . '/config/theme.php',
            'view' => require dirname(__DIR__) . '/config/view.php',
        ]);
    },
    true,
);

function flattenArray(array $array)
{
    $return = [];
    array_walk_recursive($array, function ($a) use (&$return) {
        if (is_int($a)):
            $return[] = $a;
        endif;
    });
    return $return;
}

function ihh_acf_input_admin_footer()
{
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
add_shortcode('ihh-cta', function ($atts) {
    $a = shortcode_atts(
        [
            'text' => '',
            'href' => '',
            'rectangle' => false,
            'background' => '',
            'color' => '',
            'border' => 'false',
            'target' => '_self',
        ],
        $atts,
    );

    $text = esc_attr($a['text']);
    $href = esc_attr($a['href']);
    $rectangle = $a['rectangle'] !== 'false' ? 'rounded-0' : '';
    $background = !empty($a['background']) ? esc_attr($a['background']) : '#F7A091';
    $color = !empty($a['color']) ? esc_attr($a['color']) : '#000';
    $border = $a['border'] !== 'false' ? 'btn-outline-dark' : '';
    $target = esc_attr($a['target']);

    // Create a unique ID for this CTA ...
    $unique_id = 'ihh-cta-' . uniqid();

    // ... and limit SVG color style to this specific element only
    $svg_style = '<style>#' . $unique_id . ' .inline-svg svg { fill: ' . $color . '; }</style>';

    $cta_button =
        '<a id="' .
        $unique_id .
        '" style="background:' .
        $background .
        '; color:' .
        $color .
        ' !important;" class="btn ' .
        $border .
        ' mr-auto py-3 px-3 ihh-cta ' .
        $rectangle .
        '" href="' .
        $href .
        '" target="' .
        $target .
        '">' .
        $text .
        '</a>' .
        $svg_style;

    return $cta_button;
});

/**
 * Add ACF header code to wp_head
 * Makes it easier to handle custom code snippets for tracking etc.
 * without having to edit theme files
 */
add_action('wp_head', function () {
    // Get the ACF field value from the options page
    $header_code = get_field('code', 'option');

    if ($header_code) {
        echo $header_code;
    }
});

/**
 * Set custom background color for the News/Events page.
 *
 */
add_action('wp_head', function () {
    $id = get_queried_object_id();

    $color =
        get_field('events_page_background_color', $id) ?:
        get_field('news_page_background_color', $id);

    if (!empty($color)) {
        echo '<style>
            body { background-color: ' .
            esc_attr($color) .
            '; }
        </style>';
    }
});

/**
 * Force Classic editor for the Posts page (blog index)
 */
add_action('load-post.php', 'ihh_enable_classic_editor_for_posts_page');
add_action('load-post-new.php', 'ihh_enable_classic_editor_for_posts_page');

function ihh_enable_classic_editor_for_posts_page()
{
    $screen = get_current_screen();
    if (!$screen || $screen->id !== 'page') {
        return;
    }

    // Get the ID of the page assigned as the Posts page
    $posts_page_id = (int) get_option('page_for_posts');
    // Get the ID of the page being edited
    $editing_id = isset($_GET['post']) ? (int) $_GET['post'] : 0;

    // If posts page is not set or we're not editing the posts page, bail out
    if (!$posts_page_id || $editing_id !== $posts_page_id) {
        return;
    }

    // Add editor support for posts page if not already present
    add_action('add_meta_boxes_page', function () {
        if (!post_type_supports('page', 'editor')) {
            add_post_type_support('page', 'editor');
        }
    });
}

if (true) {
    function ihh_acf_get_field_by_name(string $name)
    {
        if (!function_exists('acf_get_field')) {
            return null;
        }
        $f = acf_get_field($name);
        return is_array($f) ? $f : null;
    }

    function ihh_acf_flex_layout_maps(array $flexField): array
    {
        $out = [];
        if (empty($flexField['layouts']) || !is_array($flexField['layouts'])) {
            return $out;
        }

        foreach ($flexField['layouts'] as $layout) {
            if (empty($layout['name'])) {
                continue;
            }

            $by_name = [];
            $by_key = [];
            foreach ($layout['sub_fields'] ?? [] as $sf) {
                if (!empty($sf['name'])) {
                    $by_name[$sf['name']] = $sf;
                }
                if (!empty($sf['key'])) {
                    $by_key[$sf['key']] = $sf;
                }
            }

            $out[$layout['name']] = [
                'layout' => $layout,
                'by_name' => $by_name,
                'by_key' => $by_key,
            ];
        }
        return $out;
    }

    function ihh_acf_map_value_by_field(array $srcField, array $dstField, $value)
    {
        $type = $dstField['type'] ?? ($srcField['type'] ?? null);

        if ($type === 'group' && is_array($value)) {
            $srcSubsByKey = [];
            foreach ($srcField['sub_fields'] ?? [] as $sf) {
                if (!empty($sf['key'])) {
                    $srcSubsByKey[$sf['key']] = $sf;
                }
            }

            $dstSubsByName = [];
            $dstSubsByKey = [];
            foreach ($dstField['sub_fields'] ?? [] as $sf) {
                if (!empty($sf['name'])) {
                    $dstSubsByName[$sf['name']] = $sf;
                }
                if (!empty($sf['key'])) {
                    $dstSubsByKey[$sf['key']] = $sf;
                }
            }

            $mapped = [];
            foreach ($value as $srcKey => $subVal) {
                if (!isset($srcSubsByKey[$srcKey])) {
                    $mapped[$srcKey] = $subVal;
                    continue;
                }
                $srcSub = $srcSubsByKey[$srcKey];
                $name = $srcSub['name'] ?? null;

                if (!$name || !isset($dstSubsByName[$name])) {
                    $mapped[$srcKey] = $subVal;
                    continue;
                }

                $dstSub = $dstSubsByName[$name];
                $dstKey = $dstSub['key'];

                $mapped[$dstKey] = ihh_acf_map_value_by_field($srcSub, $dstSub, $subVal);
            }
            return $mapped;
        }

        if ($type === 'repeater' && is_array($value)) {
            $srcSubsByKey = [];
            foreach ($srcField['sub_fields'] ?? [] as $sf) {
                if (!empty($sf['key'])) {
                    $srcSubsByKey[$sf['key']] = $sf;
                }
            }

            $dstSubsByName = [];
            foreach ($dstField['sub_fields'] ?? [] as $sf) {
                if (!empty($sf['name'])) {
                    $dstSubsByName[$sf['name']] = $sf;
                }
            }

            $rows = [];
            foreach ($value as $row) {
                if (!is_array($row)) {
                    $rows[] = $row;
                    continue;
                }

                $mappedRow = [];
                foreach ($row as $srcKey => $subVal) {
                    if (!isset($srcSubsByKey[$srcKey])) {
                        $mappedRow[$srcKey] = $subVal;
                        continue;
                    }
                    $srcSub = $srcSubsByKey[$srcKey];
                    $name = $srcSub['name'] ?? null;

                    if (!$name || !isset($dstSubsByName[$name])) {
                        $mappedRow[$srcKey] = $subVal;
                        continue;
                    }

                    $dstSub = $dstSubsByName[$name];
                    $dstKey = $dstSub['key'];

                    $mappedRow[$dstKey] = ihh_acf_map_value_by_field($srcSub, $dstSub, $subVal);
                }
                $rows[] = $mappedRow;
            }
            return $rows;
        }

        return $value;
    }

    function ihh_acf_remap_flexible_rows(array $rows, array $srcFlexDef, array $dstFlexDef): array
    {
        $srcLayouts = ihh_acf_flex_layout_maps($srcFlexDef);
        $dstLayouts = ihh_acf_flex_layout_maps($dstFlexDef);

        $out = [];
        foreach ($rows as $row) {
            if (!is_array($row) || empty($row['acf_fc_layout'])) {
                $out[] = $row;
                continue;
            }

            $layout = $row['acf_fc_layout'];
            $outRow = ['acf_fc_layout' => $layout];

            $srcL = $srcLayouts[$layout] ?? null;
            $dstL = $dstLayouts[$layout] ?? null;

            if (!$srcL || !$dstL) {
                $out[] = $row;
                continue;
            }

            foreach ($row as $k => $v) {
                if ($k === 'acf_fc_layout') {
                    continue;
                }

                $srcSub = $srcL['by_key'][$k] ?? null;
                if (!$srcSub) {
                    $outRow[$k] = $v;
                    continue;
                }

                $name = $srcSub['name'] ?? null;
                if (!$name || !isset($dstL['by_name'][$name])) {
                    $outRow[$k] = $v;
                    continue;
                }

                $dstSub = $dstL['by_name'][$name];
                $dstKey = $dstSub['key'];

                $outRow[$dstKey] = ihh_acf_map_value_by_field($srcSub, $dstSub, $v);
            }

            $out[] = $outRow;
        }

        return $out;
    }

    /**
     * ACF-suodatin: esitäytetään 'lift_100_wide' -kentän arvo lähteen 'components'-kentän datasta,
     * jos 'lift_100_wide' on tyhjä.
     *
     */
    add_filter(
        'acf/load_value/name=lift_100_wide',
        function ($value, $post_id, $field) {
            // Jos kentässä on jo arvoa, ei tehdä mitään (kunniotetaan olemassa olevaa sisältöä).
            if (!empty($value)) {
                return $value;
            }

            // Haetaan lähteen raakadata (false => raw, eli avaimet ovat field key -muodossa).
            $srcRows = get_field('components', $post_id, false);
            if (empty($srcRows) || !is_array($srcRows)) {
                // Ei lähdedataa -> palauta tyhjä arvo
                return $value;
            }

            // Haetaan molempien flexien field-määrittelyt (rakenne, sub_fields yms.)
            $srcFlex = ihh_acf_get_field_by_name('components');
            $dstFlex = ihh_acf_get_field_by_name('lift_100_wide');

            if (!$srcFlex || !$dstFlex) {
                // Jos määrittelyjä ei löydy, palautetaan edes lähdedata sellaisenaan.
                // (Editorissa näkyy jotain, vaikka keyt eivät täsmäisikään.)
                return $srcRows;
            }

            // Varsinainen remäppäys: lähteen keyt -> kohteen keyt nimen perusteella,
            // rekursiivinen tuki group/repeater-sisäkyvykkyyksille.
            $remapped = ihh_acf_remap_flexible_rows($srcRows, $srcFlex, $dstFlex);

            return $remapped;
        },
        10,
        3,
    );
}

/**
 * Custom JS for handling "Menu Section Title" ACF field in WP Menu editor
 */
add_action('admin_print_footer_scripts-nav-menus.php', function () {
    ?>
<script>
jQuery(function($) {

    function updateMenuSectionTitleUI() {

        jQuery('#menu-to-edit .menu-item').each(function() {
            var $item = jQuery(this);

            // Check depth from class menu-item-depth-X
            var match = $item.attr('class').match(/menu-item-depth-(\d+)/);
            var depth = match ? parseInt(match[1], 10) : 0;

            // ACF-field for "Menu Section Title" checkbox
            var $sectionField = $item.find('.acf-field[data-name="menu_section_title"]');
            if (!$sectionField.length) {
                return; // No such field in this item
            }

            var $checkbox = $sectionField.find('input[type="checkbox"]');
            var $urlField = $item.find('p.field-url');
            var $quickField = $item.find('.acf-field[data-name="quick_link"]'); // Quick links field

            // CHANGE this value if "level 2" means a different depth
            var allowedDepth = 1; // 0 = top level, 1 = next, etc.

            if (depth !== allowedDepth) {
                // NOT the allowed level: hide section-title field, but show URL + quick_link
                $sectionField.hide();
                $urlField.show();
                $quickField.show();
            } else {
                // Correct level: show section-title field
                $sectionField.show();

                if ($checkbox.is(':checked')) {
                    // This item is a title → hide URL field + quick_link field
                    $urlField.hide();
                    $quickField.hide();
                } else {
                    // Regular item → show URL and quick_link fields
                    $urlField.show();
                    $quickField.show();
                }
            }
        });
    }

    // BELOW: the event bindings to trigger the UI update function

    // 1) on initial page load
    updateMenuSectionTitleUI();

    // 2) when menu-items are sorted (level changes)
    $('#menu-to-edit').on('sortstop', function() {
        updateMenuSectionTitleUI();
    });

    // 3) when ACF checkbox is clicked
    $(document).on('change', '.acf-field[data-name="menu_section_title"] input[type="checkbox"]', function() {
        updateMenuSectionTitleUI();
    });

    // 4) when a new menu item is added via Ajax
    $(document).ajaxComplete(function(event, xhr, settings) {
        if (settings && settings.data && settings.data.indexOf('action=add-menu-item') !== -1) {
            updateMenuSectionTitleUI();
        }
    });

});
</script>
<?php
});
