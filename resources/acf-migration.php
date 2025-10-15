<?php

// Map old values to new hex values
function ihh_color_map(): array {
    return [
        'yellow'     => '#f0e856',
        'midyellow'  => '#f4ee84',
        'lightyellow'=> '#f7f3b7',
        'green'      => '#83cac6',
        'red'        => '#f7a091',
        'midred'     => '#f9bdb2',
        'lightred'   => '#fad0c9',
        'orange'     => '#f8ca97',
    ];
}

/**
 * Normalize color value (hex, rgba or named color).
 * @return string|null
 */
function ihh_color_normalize(?string $val): ?string {
    if (!$val) return null;
    $val = strtolower(trim($val));
    // already a color value?
    if (preg_match('/^(#|rgba?\()/i', $val)) {
        return $val;
    }
    // named key -> map
    $map = ihh_color_map();
    return $map[$val] ?? null;
}

// Show hex in picker even for legacy named values
add_filter('acf/load_value/name=background_color', function($value){
    $norm = ihh_color_normalize($value);
    return $norm ?? $value;
}, 10, 1);

// Ensure saved value is normalized (covers imports / programmatic updates)
add_filter('acf/update_value/name=background_color', function($value){
    $norm = ihh_color_normalize($value);
    return $norm ?? $value;
}, 10, 1);