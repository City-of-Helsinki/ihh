<section class="timeline container">
    <?php if( get_sub_field('section_heading') ) : ?>
    <h2 class="section-heading"><?php the_sub_field('section_heading'); ?></h2>
    <?php endif ?>

    <ol class="timeline-steps" aria-labelledby="timeline-heading">
        <?php while( have_rows('steps') ) : the_row(); $id = get_row_index(); ?>
            <li class="step image__<?php the_sub_field('image_alignment'); ?>" id="step_<?php echo $id; ?>">
                <?php if( get_sub_field('image') ) : ?>
                    <div class="image-container">
                        <img alt="" src="<?php the_sub_field('image'); ?>" />
                    </div>
                <?php endif ?>

                <div class="text-container">
                    <?php if( get_sub_field('cta_url')) : ?>
                    <a href="<?php the_sub_field('cta_url'); ?>">
                    <?php endif ?>

                        <h3 class="heading"><?php the_sub_field('heading'); ?></h3>
                        <p class="description"><?php the_sub_field('description'); ?></p>

                        <?php if( get_sub_field('cta_url') ) : ?>
                        <div class="cta">
                            <?php echo \App\ihh_inline_svg('icons/arrow-right') ?>
                            <?php the_sub_field('cta_text'); ?>
                        </div>
                        <?php endif ?>

                    <?php if( get_sub_field('cta_url')) : ?>
                    </a>
                    <?php endif ?>
                </div>

            </li>
        <?php endwhile; ?>
    </ol>
</section>