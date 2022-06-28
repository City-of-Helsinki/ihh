<div class="newsletter">
  <div class="container-fluid">

    <div class="offset-lg-4 col-12 col-lg-4 p-lg-5 p-4 mb-5">
      <h3><?php the_sub_field("newsletter_section_title"); ?></h3>
      <div class="liana-form">
        <?php the_sub_field("newsletter_mailer_form"); ?>
      </div>
      <p><?php the_sub_field("newsletter_body_text");?></p>
      <form method="post" action=<?php the_sub_field("newsletter_mailer_domain") ?> class="lianamailer" id="lianamailer">
        <div class="mb-3 email">
          <label for="newsletterEmail" class="form-label">Email*</label>
          <input name="email" type="email" class="form-control border border-dark" required></input>
        </div>
        <div class="mb-3 radio-buttons row mx-0">
          <div class="form-check target-group-employers col-6">
            <input class="form-check-input" type="radio" name="flexRadio" id="flexRadioEmployers">
            <label class="form-check-label" for="flexRadioEmployers">
              Newsletter for employers
            </label>
          </div>
          <div class="form-check target-group-newcomers col-6">
            <input class="form-check-input" type="radio" name="flexRadio" id="flexRadioNewcomers">
            <label class="form-check-label" for="flexRadioNewcomers">
              Newsletter for newcomers
            </label>
          </div>
        </div>
        <div class="mb-3 privacy-policy form-check">
          <input type="checkbox" class="form-check-input" id="privacyPolicyCheck">
          <label class="form-check-label" for="privacyPolicyCheck">I agree that my details can be processed according to the <a href="#">Privacy Policy</a></label>
        </div>
        <div class="mb-3 d-flex justify-content-center">
          <button type="submit" class="btn rounded-pill subscribe px-5">Subscribe</button>
        </div>
      </form>
    </div>
  </div>
</div>