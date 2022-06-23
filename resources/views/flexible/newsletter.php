<div class="newsletter container-fluid col-12 col-lg-6 p-4 mb-5">
  <h3><?php the_sub_field("newsletter_section_title"); ?></h3>
  <p><?php the_sub_field("newsletter_body_text");?></p>
  <form method="post" action=<?php the_sub_field("newsletter_mailer_domain") ?> class="lianamailer" id="lianamailer">
    <div class="mb-3 email">
      <label for="newsletterEmail" class="form-label">Email*</label>
      <input name="email" type="email" class="form-control border border-dark" required></input>
    </div>
    <div class="mb-3 radio-buttons">
      <div class="form-check target-group-employers">
        <input class="form-check-input" type="radio" name="flexRadio" id="flexRadioEmployers">
        <label class="form-check-label" for="flexRadioEmployers">
          Newsletter for employers
        </label>
      </div>
      <div class="form-check target-group-newcomers">
        <input class="form-check-input" type="radio" name="flexRadio" id="flexRadioNewcomers">
        <label class="form-check-label" for="flexRadioNewcomers">
          Newsletter for newcomers
        </label>
      </div>
    </div>
    <div class="mb-3 privacy-policy form-check">
      <input type="checkbox" class="form-check-input" id="privacyPolicyCheck">
      <label class="form-check-label" for="privacyPolicyCheck">I agree that my details can be processed according to the <a href="https://www.ambientia.fi">Privacy Policy</a></label>
    </div>
    <div class="mb-3">
      <button type="submit" class="btn rounded-pill subscribe px-5">Subscribe</button>
    </div>
  </form>
</div>