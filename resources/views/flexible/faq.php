<div class="container" id="faqs">
    <?php if( get_sub_field('section_heading')): ?>
        <h2 class="section-heading" id="section-heading-<?php echo get_the_ID(); ?>"><?php the_sub_field('section_heading'); ?></h2>
    <?php endif; ?>

    <?php if( have_rows('faq_accordion') ) : ?>
        <?php while( have_rows('faq_accordion') ) : the_row(); $id = get_row_index(); ?>
            <div class="question accordion">
                <button class="question-header collapsed"
                    data-toggle="collapse"
                    data-target="#accordion_content_<?php echo $id; ?>"
                    aria-expanded="false"
                    aria-controls="accordion_content_<?php echo $id; ?>"
                    aria-owns="accordion_content_<?php echo $id; ?>">
                    <span><?php the_sub_field('question'); ?></span>
                </button>

                <div id="accordion_content_<?php echo $id; ?>"
                    class="collapse accordion-content question-answer"
                    data-parent="#faqs">

                    <div class="accordion-body">
                        <?php echo get_sub_field('answer'); ?>
                    </div>
                    <button class="faq-answer-close-button" data-toggle="collapse" data-target="#accordion_content_<?php echo $id; ?>">Close</button>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>