<?php
  $current_url = home_url( $_SERVER['REQUEST_URI'] );
  $success_url = add_query_arg( array('newsletter' => 'success'), $current_url );
  $failure_url = add_query_arg( array('newsletter' => 'fail'), $current_url );
?>

<div class="newsletter alignfull container-fluid" id="newsletter">
  <div class="row justify-content-center">

    <div class="col-12 col-lg-4 col-md-6 py-lg-5 py-md-4 py-3">
      <?php
      $newsletter_status = isset( $_GET["newsletter"] ) ? esc_attr( $_GET["newsletter"] ) : '';
        if ( !empty($newsletter_status) && $newsletter_status === "success"){
          echo "<h3 class='py-5 d-flex justify-content-center'>" . pll__('Subscribed to the newsletter successfully.') . "</h3>";
        } else {
          if ($newsletter_status === "fail"){
            echo "<h3 class='pb-3 d-flex justify-content-center'>" . pll__('Subscription to the newsletter failed.') . "</h3>";
          } ?>
          <h3 class="font-weight-bold"><?php the_sub_field("newsletter_section_title"); ?></h3>
            <div class="liana-form" id="newsletter">
              <?php the_sub_field("newsletter_mailer_form"); ?>
              <p><?php the_sub_field("newsletter_body_text");?></p>
              <form method="post" action="<?php the_sub_field("liana_subscription_page"); ?>" class="lianamailer">
                <input type="hidden" name="success_url" value="<?php echo $success_url; ?>#newsletter">
                <input type="hidden" name="failure_url" value="<?php echo $failure_url; ?>#newsletter">
                <div class="mb-3 email">
                  <label for="newsletterEmail" class="form-label"><?php pll_e('Email') ?>*</label>
                  <input name="email" type="email" class="form-control border border-dark" required></input>
                </div>
                <div class="mb-3 radio-buttons row mx-0">
                  <?php if (have_rows("mailing_list_ids")):
                    while ( have_rows("mailing_list_ids") ) : the_row();
                      $target_group = get_sub_field("target_group");
                      $liana_id = get_sub_field("liana_id");
                      $target = sprintf(
                        '<div class="form-check target-group-%s col-6">
                          <input required class="form-check-input" type="radio" name="join" id="liana-id-%1$s" value="%1$s">
                          <label class="form-check-label" for="liana-id-%1$s">
                          %2$s
                          </label>
                        </div>', $liana_id, $target_group);
                      echo $target;
                    endwhile;
                  endif;
                  ?>
                </div>
            </div>
              <div class="mb-3 privacy-policy form-check">
                <input required type="checkbox" class="form-check-input" id="privacyPolicyCheck">
                <label class="form-check-label" for="privacyPolicyCheck"><?php pll_e('I agree that my details can be processed according to the'); ?> <a href="<?php echo get_privacy_policy_url(); ?>"><?php pll_e('Privacy Policy'); ?></a></label>
              </div>
              <div class="mb-3 d-flex justify-content-center">
                <button type="submit" class="btn rounded-pill subscribe px-5"><?php pll_e('Subscribe'); ?></button>
              </div>
            </form>
          </div>
        <?php
        }
      ?>

  </div>
</div>