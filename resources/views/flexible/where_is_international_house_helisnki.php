<?php
?>
<article class="content-block container ihhce">
    <?php if( get_field('title_contact') ) : ?>
    <h2 class="pb-3"><?php the_field('title_contact'); ?></h2>
    <?php endif; ?>
    <section class="contact-location">
        <div class="contact-location-body">
            <div class="contact-location-body-section">
                <img src="<?php echo App\asset_path('images/icons/location.png'); ?>" alt="">
                <p>
                    <?php the_field('basic_address'); ?> <br>
                    <a href="<?php the_field('basic_map_link'); ?>"
                        target="_blank"><?php pll_e('Show address on a map'); ?></a>
                </p>
            </div>
            <div class="contact-location-body-section">
                <img src="<?php echo App\asset_path('images/icons/time.png'); ?>" alt="">
                <?php the_field('basic_opening_hours'); ?>
            </div>
        </div>
        <div class="contact-location-map">
            <img src="<?php the_field('basic_map_image'); ?>" alt="">
        </div>
    </section>
</article>