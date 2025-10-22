<?php

  // Get ACF group
  $banner = get_field('event__activity_banner');
  $banner = is_array($banner) ? $banner : [];

  // Display banner?
  $show_banner = isset($banner['show_banner']) ? $banner['show_banner'] : false;
  if(!$show_banner) return;

  $banner_bg_image  = isset($banner['background_image']) ? $banner['background_image'] : '';
  $banner_title     = isset($banner['title']) ? $banner['title'] : '';
  $banner_text_body = isset($banner['text_body']) ? $banner['text_body'] : '';

  $id_name = !empty($banner['title']) ? $banner['title'] : (isset($banner['text_body']) ? $banner['text_body'] : '');
  $id_name = sanitize_title( wp_strip_all_tags( $id_name ) );
  $id_name = substr($id_name, 0, 12);
  $img_id  = 'img_' . $id_name;

  // Banner settings
  $settings = isset($banner['banner_settings']) ? $banner['banner_settings'] : [];
  $settings = is_array($settings) ? $settings : [];

  // Individual settings
  $banner_img_only      = !empty($settings['image_only']);
  $banner_bg_color      = isset($settings['banner_background_color']) ? sanitize_hex_color($settings['banner_background_color']) : '';
  $banner_accent_color  = isset($settings['banner_accent_color'])     ? sanitize_hex_color($settings['banner_accent_color'])     : '';
  $banner_text_color    = isset($settings['text_color'])              ? sanitize_hex_color($settings['text_color'])              : '';

?>

<div class="banner-container" style="color: <?php echo esc_attr($banner_text_color); ?>; background-color: <?php echo esc_attr($banner_bg_color); ?>;">
  <div id="<?php echo esc_attr($id_name); ?>" class="lift-100-wide lift-100-wide-drop lift-100-wide-- w-100 h-100 my-5" >
    <?php if( !$banner_img_only ):?>
      <div class="banner-shape" style="background-image: url('<?php echo esc_url($banner_bg_image); ?>');"></div>
        <div class="row position-relative">
          <div class="col-lg-6 d-flex flex-column justify-content-center banner-content">
            <h3 class="banner-title" style="color: <?php echo esc_attr($banner_accent_color); ?>;"><?php echo esc_html($banner_title) ; ?></h3>
            <div class="banner-text"><?php echo wp_kses_post($banner_text_body); ?></div>
            <?php if (have_rows('event__activity_banner_extra_fields')): ?>
              <div class="banner-extras">
                <ul class="m-0 p-0">
                  <?php while( have_rows('event__activity_banner_extra_fields') ): the_row();
                    $extra_prefix = get_sub_field("extra_field_prefix");
                    $extra = get_sub_field("extra_field");
                    printf('<li><span style="color: %s;">%s</span> - %s</li>', esc_attr($banner_accent_color), esc_html($extra_prefix), esc_html($extra));
                  endwhile; ?>
                </ul>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="banner-full" style="background-image: url('<?php echo esc_url($banner_bg_image); ?>');"></div>
    <?php endif; ?>
  </div>
</div>
