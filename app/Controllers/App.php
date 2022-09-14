<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use IHH;


class App extends Controller {
    use Partials\MediaCategory;
    /**
     * @return string|void
     */
    public function siteName() {
        return get_bloginfo( 'name' );
    }
    
    /**
     * @return \WP_Query
     */
    public static function notifications() {
        return new \WP_Query( [
            'post_type'  => 'notification',
            'meta_query' => [
                [
                    'key'     => 'expiry_date',
                    'value'   => date( 'Y-m-d H:i:s' ),
                    'compare' => '>=',
                    'type'    => 'DATETIME',
                ],
            ],
        ] );
    }

    /**
     * @return \WP_Query
     */
    public static function services() {
        return new \WP_Query( [
            'post_type'      => 'service',
            'posts_per_page' => - 1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ] );
    }

    /**
     * @return array|bool|mixed|object|void
     */
    public static function tweets() {
        return dude_twitter_feed()->get_user_tweets( get_theme_mod( 'ihh_twitter_username' ) );
    }

    /**
     * @return array|bool|mixed|object|void
     */
    public static function tweet_info() {
        return dude_twitter_feed()->get_user_info( get_theme_mod( 'ihh_twitter_username' ) );
    }

    /**
     * @return string|void
     */
    public static function title() {
        if ( is_home() ) {
            if ( $home = get_option( 'page_for_posts', true ) ) {
                return get_the_title( $home );
            }

            return pll__( 'Latest Posts' );
        }
        if ( is_archive() ) {
            return get_the_archive_title();
        }
        if ( is_search() ) {
            return pll__( 'Search' );
        }
        if ( is_404() ) {
            return pll__( 'Not found' );
        }

        return get_the_title();
    }

    public static function service_status(){
        return IHH\fetch_service_status();
    }

    public static function get_category(){
        if (function_exists('yoast_get_primary_term')){
            $cat = 'category';
            if ( 'event' === get_post_type() ){
                $cat = 'events_category';
            }

            $primary = \yoast_get_primary_term( $cat );
            
            if ($primary){
                return $primary;
            }

            // Fallback if primary category is not set
            if ( 'event' === get_post_type() ){
                $category = get_terms(array('taxonomy' => 'events_category'));
            } else {
                $category = get_the_category();
            }
            if (is_wp_error($category)){
                return;
            }

            if (count($category) > 0 ){
                return $category[0]->name;
            }
            
        }
    }

    public static function get_footer_text(){
        $footer_text  = 'ihh_footer_text';
        if (function_exists('pll_current_language')){
            $footer_text  .= '_' . pll_current_language();
        } else{
            $footer_text .= '_en';
        }

        return get_theme_mod( $footer_text );
    }

    public static function get_footer_contact(){
        $footer_text  = 'ihh_footer_contact';
        if (function_exists('pll_current_language')){
            $footer_text  .= '_' . pll_current_language();
        } else{
            $footer_text .= '_en';
        }

        return get_theme_mod( $footer_text );
    }

}
