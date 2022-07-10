<?php
  $has_image_class = '';
  $phone = get_sub_field("info_box_phone_number");
  $phone_trim = preg_replace('/\s+/', '', $phone);

  $info_svg = '<svg class="hds-icon-info" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M0 0h24v24H0z"></path><path d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2zm0 2a8 8 0 100 16 8 8 0 000-16zm1 6v6.5h2V18H9v-1.5h2v-5H9V10h4zm-1.187-4a1.312 1.312 0 110 2.625 1.312 1.312 0 010-2.625z" fill="currentColor"></path></g></svg>'
?>
<div class="container">
  <div class="row">
    <div class="contact-liftoff col ">
      <div class="d-flex align-items-center justify-content-between mb-4">
        <h2><?php the_sub_field("contact_liftoff_section_title"); ?></h2>
          <?php if ( has_sub_field('contact_liftoff_external_link') ): ?>
          <div class="more-info">
            <a class="arrow" href=<?php the_sub_field('contact_liftoff_external_link') ?>><?php the_sub_field('contact_liftoff_description'); ?></a>
          </div>
          <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="container my-4 mb-lg-5">
      <div class="row position-relative">
              <?php if ( !empty(get_sub_field("contact_liftoff_background_image"))): $has_image_class = 'contact-liftoff__info-box--has-image'; ?>
                <img class="contact-liftoff__bg-img h-100 col-lg-8 p-0" src="<?php the_sub_field("contact_liftoff_background_image");?>">
              <?php endif ?>
              <div class="contact-liftoff__info-box <?php echo $has_image_class; ?> p-lg-4 p-sm-3 col-lg-6 d-flex flex-column justify-content-center" >
                  <h3 class="info-box__title"><?php the_sub_field("info_box_title"); ?></h3>
                  <p class="info-box__description"><?php echo $info_svg;?><?php the_sub_field("info_box_description"); ?></p>
                  <a class="info-box__phone_number" href="tel:+358<?php echo $phone_trim; ?>"><?php the_sub_field("info_box_phone_number"); ?></a>
                  <a class="info-box__email" href="mailto:<?php the_sub_field("info_box_email"); ?>"><?php the_sub_field("info_box_email"); ?></a>
                  <a href=<?php the_sub_field("info_box_external_link"); ?>><?php the_sub_field("info_box_external_link_description"); ?></a>
                  <div class="info-box__contact-hours mt-3 p-0">
                      <?php foreach (get_sub_field("contact_hours") as $row) {
                          $days = $row["contact_hours_days"];
                          $open = $row["contact_hours_opening_time"];
                          $close = $row["contact_hours_closing_time"];
                          printf('<p class="contact-hours m-0 p-0">%s %s - %s</p>', $days, $open, $close);
                      } ?>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>