<?php if (have_rows('content')): ?>
<div class="highlighted-content-x2 ihhce">
    <?php while (have_rows('content')):
        the_row(); ?>

    <?php
    // Get background color (hex or empty)
    $bg_raw = get_sub_field('background_color', false, false);

    // Normalize color: returns valid hex or empty
    $bg_norm = ihh_color_normalize(is_string($bg_raw) ? $bg_raw : '');

    // Inline style if using normalized hex
    $bg_style = $bg_norm ? ' style="background-color:' . esc_attr($bg_norm) . ';"' : '';
    ?>

    <div class="highlighted-content-box<?php echo esc_attr($bg_class); ?>" <?php echo $bg_style; ?>>
      <?php $anchor_link = get_sub_field('show_in_anchor_link'); ?>
      <div class="content-wrapper" <?= $anchor_link ? 'data-anchor="true"' : '';  ?>>
            <?php the_sub_field('text_content'); ?>
        </div>
    </div>

    <?php
    endwhile; ?>
</div>
<?php endif; ?>
