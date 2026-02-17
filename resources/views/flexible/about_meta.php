<?php

use function App\is_external_link;

if (have_rows('links')): ?>
<section class="about-services mt-2 mt-md-5">
    <div class="container">
        <div class="row">
            <?php if (get_field('links_header')): ?>
            <div class="col-12 pb-5">
                <h2><?php the_field('links_header'); ?></h2>
            </div>
            <?php endif; ?>

        </div>
        <div class="row">
            <?php while (have_rows('links')): ?>
            <?php the_row(); ?>
            <div class="service-link">
                <a href="<?php the_sub_field('link') ?>"
                    target="<?php echo is_external_link(get_sub_field('link')) ? '_blank' : '_self'; ?>">
                    <?php
              $image = get_sub_field('logo');
              ?>
                    <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
                </a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>