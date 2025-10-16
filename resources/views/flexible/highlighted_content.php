<?php if (get_sub_field('content')) : ?>
<?php

// 'green' OR '#83cac6' etc.
  $bg_raw  = get_sub_field('background_color', false, false);
  // Returns hex color or empty string
  $bg_norm = ihh_color_normalize(is_string($bg_raw) ? $bg_raw : '');
  // Build classes and styles
  $bg_class = (!$bg_norm && $bg_raw) ? ' background-' . sanitize_html_class($bg_raw) : '';
  $bg_style = $bg_norm ? ' style="background-color:' . esc_attr($bg_norm) . ';"' : '';
  // Other classes
  $divideIntoColumns = get_sub_field('divide_content_into_columns') ? ' columns-two' : '';
  ?>

<div class="highlighted-content<?php echo esc_attr($bg_class . $divideIntoColumns); ?> ihhce" <?php echo $bg_style; ?>>
    <?php the_sub_field('content'); ?>
</div>
<?php endif; ?>
