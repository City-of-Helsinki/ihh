<?php
$hasHeading = false;
$listElementType = 'ol';
$cssClasses = 'timeline-steps';
$targetgroup_buttons = false;
while (have_rows('steps')):
  the_row();
  $id = get_row_index();
  if (get_sub_field('target_group')) {
    if (get_sub_field('target_group') > 1) {
      $targetgroup_buttons = true;
    }
  }
endwhile;
?>

<div class="timeline container ihhce">
  <?php if (get_sub_field('section_heading')): ?>
    <h2 class="section-heading" id="timeline-heading"><?php the_sub_field(
      'section_heading',
    ); ?></h2>
    <?php $hasHeading = true; ?>
  <?php endif; ?>

  <?php if ($targetgroup_buttons): ?>
    <ul class="list-unstyled list-group list-group-horizontal mb-4" aria-labelledby="content_type">
      <li class="js-filter js-filter-service">
        <input type="radio" name="service_targetgroup" value="2" checked="" id="service_targetgroup_2">
        <label for="service_targetgroup_2"><?php pll_e('EU'); ?></label>
      </li>
      <li class="filter-item js-filter js-filter-service">
        <input type="radio" name="service_targetgroup" value="3" id="service_targetgroup_3">
        <label for="service_targetgroup_3"><?php pll_e('NON EU'); ?></label>
      </li>
    </ul>
  <?php endif; ?>

  <?php if (!get_sub_field('show_numbering')) {
    $listElementType = 'ul';
    $cssClasses = 'timeline-steps without-numbers';
  } ?>

  <<?php echo $listElementType; ?> class="<?php echo $cssClasses; ?>" <?php if ($hasHeading) {
           echo 'aria-labelledby="timeline-heading"';
         } ?>>
    <?php while (have_rows('steps')):

      the_row();
      $id = get_row_index();
      ?>
      <?php
      // e.g. green or #83cac6
      $bg_raw = get_sub_field('background_color');
      // Normalize color value
      $bg_norm = ihh_color_normalize(is_string($bg_raw) ? $bg_raw : '');
      // Create style or class based on normalized value
      $bg_style = $bg_norm ? 'style="background-color:' . esc_attr($bg_norm) . ';"' : '';
      $bg_class = !$bg_norm && $bg_raw ? 'background-' . sanitize_html_class($bg_raw) : '';
      ?>
      <?php
      $targetgroup_acf = 1;
      if (get_sub_field('target_group')) {
        $targetgroup_acf = get_sub_field('target_group');
      }
      ?>
      <?php $card_title = get_sub_field('heading'); ?>
      <li class="step image__<?php the_sub_field(
        'image_alignment',
      ); ?> service_targetgroup_<?php echo $targetgroup_acf; ?>" id="step_<?php echo $id; ?>">
        <?php if (get_sub_field('image')): ?>
          <div class="image-container">
            <img alt="" src="<?php the_sub_field('image'); ?>" />
          </div>
        <?php endif; ?>

            <div class="text-container <?php echo $bg_class; ?>" <?php echo $bg_style; ?>>
                <?php if (get_sub_field('heading')): ?><h3 class="heading"><?php the_sub_field(
              'heading',
            ); ?></h3>
          <?php endif; ?>
          <div class="timeline-content"><?php the_sub_field('description'); ?></div>

          <?php if (have_rows('links')): ?>
            <div class="list-wrapper">
              <ul class="m-0 p-0 no-list-style">
                <?php while (have_rows('links')):
                  the_row();
                  $link = get_sub_field('link');
                  $text = get_sub_field('link_text');
                  $arialabel = '';
                  if (str_contains($text, 'more')):
                    $arialabel = 'aria-label="More about ' . $card_title . '"';
                  elseif (str_contains($text, 'lisää')):
                    $arialabel = 'aria-label="Lisää aiheesta ' . $card_title . '"';
                  endif;
                  printf(
                    '<li class="my-2"><a class="arrow" %s href="%s">%s</a></li>',
                    $arialabel,
                    $link,
                    $text,
                  );
                endwhile; ?>
              </ul>
            </div>
          <?php elseif (get_sub_field('cta_url')): ?>
            <?php
            $arialabel = '';
            $cta_text = get_sub_field('cta_text');
            if (str_contains($cta_text, 'more')):
              $arialabel = 'aria-label="More about ' . $card_title . '"';
            elseif (str_contains($cta_text, 'lisää')):
              $arialabel = 'aria-label="Lisää aiheesta ' . $card_title . '"';
            endif;
            ?>
            <a class="cta" href="<?php the_sub_field('cta_url'); ?>" <?php echo $arialabel; ?>>
              <?php echo \App\ihh_inline_svg('icons/arrow-right'); ?>
              <?php the_sub_field('cta_text'); ?>
            </a>
          <?php endif; ?>
        </div>
      </li>
      <?php
    endwhile; ?>

    </<?php echo $listElementType; ?>>
</div>
