<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Remove redundand sections
    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('custom_css');
    $wp_customize->remove_section('static_front_page');
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script(
        'ihh/customizer.js',
        asset_path('scripts/customizer.js'),
        ['customize-preview'],
        null,
        true,
    );
});
