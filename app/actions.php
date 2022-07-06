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

add_filter( 'query_vars', function( $qvars){
    $qvars[] = 'type';
    return $qvars;
} );

/**
 * Add events to main query
 */
add_action( 'pre_get_posts', function ( \WP_Query $query ) {
    if ( $query->is_posts_page && ! $query->is_admin && $query->is_main_query() ) {
        $post_type = get_query_var('type');

        $post_types =  [ 'post', 'event' ];
        if ( in_array($post_type, $post_types, true)){
            $post_types = $post_type;
        }

        $query->set( 'post_type', $post_types );

        $query->set( 'meta_query', create_meta_query( $query ) );
    }

    if ( $query->is_search ) {
        $query->set( 'meta_query', create_meta_query( $query ) );
    }

    return $query;
} );

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