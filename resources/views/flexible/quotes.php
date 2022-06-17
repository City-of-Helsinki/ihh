<div class="container">
    <?php if( get_sub_field('section_heading')): ?>
        <h2 class="section-heading"><?php the_sub_field('section_heading'); ?></h2>
    <?php endif; ?>

    <?php if( have_rows('quote') ) : ?>
        <div class="quotes">
            <?php while( have_rows('quote') ) : the_row(); ?>
                <blockquote>
                    <p class="quote">
                        <?php the_sub_field('text'); ?>
                    </p>
                    <div class="quote-footer">
                        <?php if ( get_sub_field('author_image') ): ?> 
                            <img src="<?php the_sub_field('author_image'); ?>" alt="" />
                        <?php endif; ?>
                        <span class="author-name"><?php the_sub_field('author'); ?></span>
                    </div>
                </blockquote>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>