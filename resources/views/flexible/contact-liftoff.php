<?php
  $phone = get_sub_field("info_box_phone_number");
  $phone_trim = preg_replace('/\s+/', '', $phone);
?>

<div class="contact-liftoff w-100 h-100">
  <div class="container row d-flex align-items-center">
    <h2><?php the_sub_field("contact_liftoff_section_title"); ?></h2>
      <div class="more-info">
        <a class="arrow" href=<?php the_sub_field('contact_liftoff_external_link') ?>><?php the_sub_field('contact_liftoff_description'); ?></a>
      </div>
  </div>
</div>
<div class="container">
    <div class="row position-relative">
            <img class="contact_liftoff__bg-img h-100 col-lg-8 p-0" src="<?php the_sub_field("contact_liftoff_background_image");?>">
            <div class="contact_liftoff__info-box p-lg-4 p-sm-3 col-lg-6 d-flex flex-column justify-content-center" >
                <h3 class="info_box__title"><?php the_sub_field("info_box_title"); ?></h3>
                <p class="info_box__description"><?php the_sub_field("info_box_description"); ?></p>
                <a class="info_box__phone_number" href="tel:+358<?php echo $phone_trim; ?>"><?php the_sub_field("info_box_phone_number"); ?></a>
                <a class="info_box__email" href="mailto:<?php the_sub_field("info_box_email"); ?>"><?php the_sub_field("info_box_email"); ?></a>
                <a href=<?php the_sub_field("info_box_external_link"); ?>><?php the_sub_field("info_box_external_link_description"); ?></a>
                <div class="info_box__contact-hours mt-3 p-0">
                    <?php foreach (get_sub_field("contact_hours") as $row) {
                        $days = $row["days"];
                        $open = $row["contact_hours_opening_time"];
                        $close = $row["contact_hours_closing_time"];
                        printf('<p class="contact-hours m-0 p-0">%s %s - %s</p>', $days, $open, $close);
                    } ?>
                </div>
            </div>
        </div>
  </div>
</div>