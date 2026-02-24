<?php if (get_sub_field('content')): ?>
<?php
$bg_raw = get_sub_field('background_color', false, false); // 'green' OR '#83cac6' etc.
// Returns hex color or empty string
$bg_norm = ihh_color_normalize(is_string($bg_raw) ? $bg_raw : '');
$bg_class = !$bg_norm && $bg_raw ? ' background-' . sanitize_html_class($bg_raw) : '';
$bg_style = $bg_norm ? ' style="background-color:' . esc_attr($bg_norm) . ';"' : '';
?>

<div class="highlighted-content<?php echo esc_attr($bg_class); ?> ihhce">
    <div class="content-wrapper" <?php echo $bg_style; ?>>
      <?php $anchor_link = get_sub_field('show_in_anchor_link'); ?>
        <div class="text-wrapper" <?= $anchor_link ? 'data-anchor="true"' : '';  ?>>
            <?php the_sub_field('content'); ?>
        </div>
    </div>
</div>
<?php endif; ?>
