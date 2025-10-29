<?php

  $section_title = esc_html(get_sub_field("section_title"));
  $body_text = get_sub_field("body_text");
  $background_color = esc_attr(get_sub_field("background_color"));
  $background_color_style = "style=\"background-color: {$background_color};\"";

  $cta = get_sub_field("cta");
  $cta_text = esc_html($cta['cta_text']);
  $cta_url = esc_attr($cta['cta_url']);
  $cta_background_color = esc_attr($cta['background_color']);
  $cta_background_color_style = "style=\"background-color: {$cta_background_color};\"";
?>

<div class="banner container-fluid" <?php echo $background_color_style; ?>>
    <div class="text-center ihhce">
        <div class="content">
            <h2 class="text-left"><?php echo $section_title; ?></h2>
            <?php if($body_text) the_sub_field("body_text") ?>
            <?php if ($cta_url && $cta_text): ?>
            <div class="cta-wrapper">
                <a class="btn ihh-cta" href="<?php echo $cta_url; ?>"
                    <?php echo $cta_background_color_style; ?>><?php echo $cta_text; ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>