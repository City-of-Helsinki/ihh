<?php

namespace App;

/**
 * @param \WP_Query $query
 *
 * @return array|mixed
 */
function create_meta_query( \WP_Query $query ) {
    $meta_query   = $query->get( 'meta_query', [] );
    $meta_query[] = [
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
    ];

    return $meta_query;
}

/**
 * Unregister tag
 */
add_action( 'init', function () {
    unregister_taxonomy_for_object_type( 'post_tag', 'post' );
} );

/**
 * Add events to main query
 */
add_action( 'pre_get_posts', __NAMESPACE__ . '\pre_get_posts');

function pre_get_posts ( \WP_Query $query ) {
    if ( ( ($query->is_posts_page || ($query->get('is_news_and_events_query') === true)) && ! $query->is_admin)
        || (wp_doing_ajax() && $_REQUEST["action"] === 'myfilter') ) {
        
        $default_type = 'post';
        $all_types = array( $default_type, 'event');

        if ( wp_doing_ajax() ){
            $user_type = get_query_var('type');
        } else{
            $user_type = $query->get('type', '');
        }
     
        $names = get_post_categories('slug');

        if (!empty($user_type) && in_array($user_type, $all_types)){
            $type = $user_type;
        } else if ( !empty($user_type) && in_array($user_type, $names) ){
            $type = $default_type;
        } else{
            $type = $all_types;
        }

        $orderBy = 'event' === $type ? 'start_time' : 'publish_date';
        $order   = 'event' === $type ? 'ASC' : 'DESC';

        $query->set( 'post_type', $type );
        $query->set('orderby', $orderBy);
        $query->set('order', $order);

        $query->set( 'meta_query', create_meta_query( $query ) );
    }

    if ( $query->is_search ) {
        $query->set( 'meta_query', create_meta_query( $query ) );
    }

    return $query;
}

/**
 * Add chat-script to head
 */
add_action( 'wp_head', function () {
    if ( ! get_theme_mod( 'ihh_hide_chat' ) ) {
        echo get_theme_mod( 'ihh_chat_script' );
    }
}, 999 );

/**
 * Add flexible content renderer to the landing pages
 */
 add_action( 'ihh_render_flexible_content', function($field, $post_id = null){
    if (have_rows($field, $post_id) ){
        while(have_rows($field, $post_id)){
            the_row();
            $template = locate_template('resources/views/flexible/'. get_row_layout());
            include $template;
        }
    }

 }, 10, 2);