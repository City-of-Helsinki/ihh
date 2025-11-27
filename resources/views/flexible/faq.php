<?php if (get_sub_field('line_color')): ?>
<style>
#faqs .question .question-answer:before,
#faqs .question .question-header:hover:before {
    background: <?php the_sub_field('line_color');
    ?> !important;
}
</style>
<?php endif; ?>

<div class="container ihhce" id="faqs">

    <?php if (get_sub_field('section_heading')): ?>
    <div class="accordion-header" id="section-heading-<?php echo get_the_ID(); ?>">
        <?php the_sub_field('section_heading'); ?>
    </div>
    <?php endif; ?>

    <?php if (have_rows('faq_accordion')): ?>
    <?php while (have_rows('faq_accordion')):

        the_row();
        $id = get_row_index();
        ?>
    <?php $id_name = preg_replace('/[^A-Za-z0-9\-]/', '', get_sub_field('question')); ?>
    <div class="question accordion">
        <button class="question-header collapsed" data-toggle="collapse"
            data-target="#accordion_content_<?php echo $id_name; ?>" aria-expanded="false"
            aria-controls="accordion_content_<?php echo $id_name; ?>"
            aria-owns="accordion_content_<?php echo $id_name; ?>">
            <span><?php the_sub_field('question'); ?></span>
        </button>

        <div id="accordion_content_<?php echo $id_name; ?>" class="collapse accordion-content question-answer"
            data-parent="#faqs">

            <div class="accordion-body">
                <?php echo get_sub_field('answer'); ?>
            </div>
            <button class="faq-answer-close-button" data-toggle="collapse"
                data-target="#accordion_content_<?php echo $id_name; ?>">Close</button>
        </div>
    </div>
    <?php
    endwhile; ?>
    <?php endif; ?>
</div>
