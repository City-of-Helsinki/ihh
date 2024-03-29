<?php
    $hasHeading = false;
    $listElementType = 'ol';
    $cssClasses = 'timeline-steps'
?>

<div class="timeline container">
    <?php if( get_sub_field('section_heading') ) : ?>
        <h2 class="section-heading" id="timeline-heading"><?php the_sub_field('section_heading'); ?></h2>
        <?php $hasHeading = true; ?>
    <?php endif ?>

    <?php if(!get_sub_field('show_numbering')){
        $listElementType = 'ul';
        $cssClasses = 'timeline-steps without-numbers';
    } ?>

    <<?php echo $listElementType; ?> class="<?php echo $cssClasses; ?>" <?php if(hasHeading){ echo 'aria-labelledby="timeline-heading"'; }?> >
        <?php while( have_rows('steps') ) : the_row(); $id = get_row_index(); ?>
            <li class="step image__<?php the_sub_field('image_alignment'); ?>" id="step_<?php echo $id; ?>">
                <?php if( get_sub_field('image') ) : ?>
                    <div class="image-container">
                        <img alt="" src="<?php the_sub_field('image'); ?>" />
                    </div>
                <?php endif ?>

                <div class="text-container background-<?php the_sub_field('background_color') ?>">
                    <?php if( get_sub_field('heading') ) : ?><h3 class="heading"><?php the_sub_field('heading'); ?></h3><?php endif ?>
                    <div class="timeline-content"><?php the_sub_field('description'); ?></div>

                    <?php if( get_sub_field('cta_url') ) : ?>
                    <a class="cta" href="<?php the_sub_field('cta_url'); ?>">
                        <?php echo \App\ihh_inline_svg('icons/arrow-right') ?>
                        <?php the_sub_field('cta_text'); ?>
                    </a>
                    <?php endif ?>
                </div>
            </li>
        <?php endwhile; ?>
    </<?php echo $listElementType; ?>>
</div>