<?php
function add_style_select_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

add_filter( 'mce_buttons', 'add_style_select_buttons' );

// Add custom styles to the WordPress editor
function ihh_custom_styles( $init_array ) {

    $style_formats = array(
        array(
            'title' => 'Ingress',
            'block' => 'p',
            'classes' => 'ingress',
            'wrapper' => false,
        ),
        array(
            'title' => 'Highlighted box green',
            'block' => 'div',
            'classes' => 'highlighted-content background-green',
            'wrapper' => true,
        ),
        array(
            'title' => 'Highlighted box red',
            'block' => 'div',
            'classes' => 'highlighted-content background-red',
            'wrapper' => true,
        )
    );

    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;
}

add_filter( 'tiny_mce_before_init', 'ihh_custom_styles' );