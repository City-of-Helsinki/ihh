<?php
  $has_image_class = '';

  $info_svg = '<svg class="hds-icon-info" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M0 0h24v24H0z"></path><path d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2zm0 2a8 8 0 100 16 8 8 0 000-16zm1 6v6.5h2V18H9v-1.5h2v-5H9V10h4zm-1.187-4a1.312 1.312 0 110 2.625 1.312 1.312 0 010-2.625z" fill="currentColor"></path></g></svg>'
?>
<div class="container">
  <div class="row">
    <div class="contact-liftoff col ">
      <div class="d-flex align-items-center justify-content-between">
        <h2><?php the_sub_field("contact_5050_title"); ?></h2>
      </div>
    </div>
  </div>
      <div class="row position-relative d-lg-flex flex-lg-nowrap my-4">
        <?php if( have_rows('info_box_5050')) : ?>
                <?php while( have_rows("info_box_5050")) : the_row();
                  $phone = get_sub_field("info_box_phone_number_5050");
                  $phone_trim = preg_replace('/\s+/', '', $phone);
                ?>
                  <div class="contact-liftoff__info-box pt-3 pb-5 m-2 col-lg-6 d-flex flex-column" >
                    <h3 class="info-box__title"><?php the_sub_field("info_box_title_5050"); ?></h3>
                    <p class="info-box__description"><?php echo $info_svg;?><?php the_sub_field("info_box_description_5050"); ?></p>
                    <a class="info-box__phone_number" href="tel:<?php echo $phone_trim; ?>"><?php the_sub_field("info_box_phone_number_5050"); ?></a>
                    <a class="info-box__email" href="mailto:<?php the_sub_field("info_box_email_5050"); ?>"><?php the_sub_field("info_box_email_5050"); ?></a>
                    <a href=<?php the_sub_field("info_box_external_link_5050"); ?>><?php the_sub_field("info_box_external_link_description_5050"); ?></a>

                    <div class="info-box__contact-hours mt-3 p-0">
                    <?php while( have_rows('contact_hours_5050') ): the_row();
                          $days = get_sub_field("contact_hours_days_5050");
                          $open = get_sub_field("contact_hours_opening_time_5050");
                          $close = get_sub_field("contact_hours_closing_time_5050");
                          printf('<p class="contact-hours m-0 p-0">%s %s - %s</p>', $days, $open, $close);
                    endwhile; ?>
                    </div>
                  </div>
                <?php endwhile; ?>
          <?php endif; ?>
        </div>
</div>