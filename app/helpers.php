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
        return date( 'D, j M Y, H:i', $start ) . ' - ' . date( 'D, j M Y, H:i', $end );
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
        ?>
        <div class="post-filter">
            <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter" class="filters d-flex flex-wrap" data-group="type" aria-label="Filter News and Events">

                <fieldset>
                    <legend>Content type</legend>
                    <ul class="list-unstyled list-group list-group-horizontal" aria-labelledby="content_type">
                        <li class="js-filter"><input type="radio" name="type" value="all" checked id="type_all" /><label for="type_all">All content</label></li>
                        <?php
                            $categories = get_categories(
                                array(
                                    'orderby' => 'name'
                                )
                            );

                            foreach ( $categories as $category ) {
                                echo '<li class="js-filter"><input type="radio" data-category="'. $category->name .'" name="type" value="post" id="type_post_'. $category->term_id .'" /><label for="type_post_'. $category->term_id .'">'. $category->name .'</label></li>';
                            }
                        ?>
                        <li class="js-filter"><input type="radio" name="type" value="event" id="type_event" /><label for="type_event">Event</label></li>
                    </ul>
                </fieldset>


                <fieldset>
                    <legend>Target group</legend>
                    <ul class="list-unstyled list-group list-group-horizontal" aria-labelledby="content_type">
                        <li class="js-filter"><input type="radio" name="target" value="all" checked id="target_group_all" /><label for="target_group_all">All groups</label></li>
                        <?php
                            $terms = get_terms([
                                'taxonomy' => 'target_group',
                                'hide_empty' => false,
                            ]);

                            foreach ($terms as $term){
                                echo '<li class="filter-item js-filter"><input type="radio" name="target" value="'. $term->term_id .'"  id="target_group_' . $term->term_id  . '"/>' . '<label for="target_group_' . $term->term_id  . '">' . $term->name . '</label></li>';
                            }
                        ?>
                    </ul>
                </fieldset>

                <input type="hidden" name="action" value="myfilter">
            </form>

        </div>
        <?php
    }
endif;



/*
* Post filter function
*/
function post_filter_function(){

    $posts_per_page = 2;
    $paged = $_POST['page'] ? ($_POST['page'] + 1) : 1;

    $type = $_POST['type'] !== 'all' ? $_POST['type'] : ['event', 'post'];
    $categoryNews = $_POST['type'] == 'post' ? 'news' : '';
    $targetGroup = $_POST['target'];

    $orderBy = $_POST['type'] == 'event' ? 'start_time' : 'publish_date';
    $order = $_POST['type'] == 'event' ? 'ASC' : 'DESC';

    $args = array(
        'post_type' => $type,
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'post_status' => 'publish',
        'orderby' => $orderBy,
        'order' => $order,

        'meta_query' => array(
            'relation' => 'OR',
            [
                'relation' => 'OR',
                [
                    'key'     => 'end_time',
                    'value'   => date( 'Y-m-d H:i:s' ),
                    'compare' => '>=',
                    'type'    => 'DATETIME',
                ],
                [
                    'key'     => 'end_time',
                    'value'   => '',
                    'compare' => '==',
                ],
            ],
            [
                [
                    'key'     => 'end_time',
                    'compare' => 'NOT EXISTS',
                    'value'   => '',
                ],
            ],
        ),
    );

    if($targetGroup !== NULL && $targetGroup !== 'all'){
        $args['tax_query'] = array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'target_group',
                'field'    => 'term_id',
                'terms'    =>  $targetGroup,
            ),
        );
    }

    $query = new \WP_Query($args);

    if ($query->have_posts()){

        while ($query->have_posts()): $query->the_post();
            echo '<div class="post-grid-item">';
        ?>

            <a href="<?= get_permalink(); ?>">
                <header>
                    <?php if(has_post_thumbnail()){ ?>
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'lift'); ?>" alt="<?php the_title(); ?>">
                    <?php }else{ ?>
                        <img role="presentation" src="<?php echo get_default_image('lift'); ?>" alt="">
                    <?php } ?>
                </header>
                <div class="post-content">
                <?php if('event' === get_post_type()) : ?>
                    <div class="post-content-event-meta">
                        <?php if($location = get_field('location')) : ?>
                            <p class="location"> <?php echo $location ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <h2><?php echo get_the_title(); ?></h2>

                <?php if('event' === get_post_type()) : ?>
                    <div class="post-content-event-meta">
                    <?php if($date = get_field('start_time')) : ?>
                        <p class="date"> <?php echo ihh_inline_svg('icons/clock_outlines'); ?> <?php echo format_event_date(); ?></p>
                    <?php endif; ?>
                    </div>
                <?php endif; ?>
                </div>
            </a>
        <?php
        echo '</div>';
        endwhile;

    }else{
        echo 'No posts found';
    }

    die();
}

add_action('wp_ajax_myfilter', __NAMESPACE__ . '\\post_filter_function');
add_action('wp_ajax_nopriv_myfilter', __NAMESPACE__ . '\\post_filter_function');