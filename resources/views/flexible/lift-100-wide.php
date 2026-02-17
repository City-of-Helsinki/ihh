<?php
$raw = get_sub_field('background_color');
$bg = ihh_color_normalize($raw);

// Fallback for invalid color values
$style = $bg ? ' style="background-color:' . esc_attr($bg) . ';"' : '';

$show_caption = (bool) get_sub_field('show_image_caption');

$image = get_sub_field('background_image'); // array (ACF Image field)

$caption = '';
$image_id = 0;

if (is_array($image) && !empty($image['ID'])) {
  $image_id = (int) $image['ID'];
}

/**
 * Get image caption by attachment ID
 */
if ($show_caption && $image_id) {
  $caption = wp_get_attachment_caption($image_id) ?: '';
}

/**
 * Determine if image is "tall" (portrait) or not
 */
$is_tall = false;
if (is_array($image) && !empty($image['width']) && !empty($image['height'])) {
  $is_tall = ((int) $image['height'] > (int) $image['width']);
}

$overlay_class = get_sub_field('text_overlay') !== false ? 'overlay' : '';
$card_title = (string) get_sub_field('title');
$side = (string) get_sub_field('side');
?>

<div class="container">
  <div class="lift-100-wide">
    <div class="lift-100-wide-wrapper <?php echo esc_attr($side); ?> <?php echo esc_attr($overlay_class); ?> ihhce">
      <figure class="<?php echo $is_tall ? 'is-tall' : ''; ?>">
        <div class="lift-media">
          <?php
          if ($image_id) {
            echo wp_get_attachment_image(
              $image_id,
              'large',
              false,
              [
                'alt' => '',
                'loading' => 'lazy',
                'decoding' => 'async',
              ]
            );
          }
          ?>
        </div>

        <?php if ($show_caption && $caption): ?>
          <figcaption><?php echo esc_html($caption); ?></figcaption>
        <?php endif; ?>
      </figure>

      <div class="card" <?php echo $style; ?>>
        <?php $anchor_link = get_sub_field('show_in_anchor_link'); ?>
        <h3 class="title" <?= $anchor_link ? 'data-anchor="true"' : '';  ?>><?php the_sub_field('title'); ?></h3>

        <?php the_sub_field('text_body'); ?>

        <div class="links">
          <ul>
            <?php while (have_rows('links')):
              the_row();
              $link = (string) get_sub_field('link');
              $text = (string) get_sub_field('link_text');

              $arialabel = '';
              if ($text && str_contains($text, 'more')) {
                $arialabel = 'aria-label="More about ' . esc_attr($card_title) . '"';
              } elseif ($text && str_contains($text, 'lisää')) {
                $arialabel = 'aria-label="Lisää aiheesta ' . esc_attr($card_title) . '"';
              }

              printf(
                '<li class="my-2"><a class="arrow" %s href="%s">%s</a></li>',
                $arialabel,
                esc_url($link),
                esc_html($text)
              );
            endwhile; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
