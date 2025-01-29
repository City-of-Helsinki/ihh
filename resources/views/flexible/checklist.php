<?php if( get_sub_field('line_color') ): ?>
<?php $bg_color = get_sub_field('line_color'); ?>
  <style>
    #faqs.checklist-container {
        margin: 0 !important;
        padding-top: 0;
        padding-bottom: 0;
    }
    #faqs .question.checklist .question-header:hover:before,
    #faqs .question.checklist .question-answer:before {
        background: none !important;
    }
   #faqs .question.checklist .question-header:hover {
        color: #000 !important;
   }
    #faqs .question.accordion.checklist {
        border-bottom: none !important;
        margin-bottom: .75rem;
    }
    #faqs .question.accordion.checklist .question-header {
        display: flex;
        align-items: center;
        padding: 25px !important;
    }
    #faqs .section-heading.checklist {
        font-weight: 600;
        padding-top: .75rem;
        margin-bottom: 1rem;
    }
    #faqs .question.checklist .accordion-body {
        padding: .5rem 1.85rem !important;
    }
  </style>
<?php endif; ?>

<div class="container checklist-container" id="faqs">
    <?php if( get_sub_field('section_heading')): ?>
        <h3 class="section-heading checklist" id="section-heading-<?php echo get_the_ID(); ?>"><?php the_sub_field('section_heading'); ?></h3>
    <?php endif; ?>

    <?php if( have_rows('faq_accordion') ) : ?>
        <?php while( have_rows('faq_accordion') ) : the_row(); $id = get_row_index(); ?>
            <?php $id_name = preg_replace('/[^A-Za-z0-9\-]/', '', get_sub_field('question')); ?>
            <div class="question accordion checklist" style="background: <?php echo $bg_color; ?>;">
                <div class="question-box">
                    <form>
                        <input type="checkbox" id="accordion_content_checkbox_<?php echo $id_name; ?>" class="input-checkbox" name="accordion_content_checkbox_name_<?php echo $id_name; ?>" value="<?php the_sub_field('question'); ?>">
                    </form>
                    <span class="question-header collapsed"
                        data-toggle="collapse"
                        data-target="#accordion_content_<?php echo $id_name; ?>"
                        aria-expanded="false"
                        aria-controls="accordion_content_<?php echo $id_name; ?>"
                        aria-owns="accordion_content_<?php echo $id_name; ?>">
                        <span><?php the_sub_field('question'); ?></span>
                    </span>
                </div>

                <div id="accordion_content_<?php echo $id_name; ?>"
                    class="collapse accordion-content question-answer"
                    data-parent="#faqs">

                    <div class="accordion-body">
                        <?php echo get_sub_field('answer'); ?>

                        <?php if ( have_rows('accordion_link_list') ) : ?>
                            <div class="accordion-link-list">
                            <?php while( have_rows('accordion_link_list') ) : the_row(); ?>
                                <strong><?php echo get_sub_field('accordion_link_list_title'); ?></strong>
                                <?php while( have_rows('accordion_links') ) : the_row(); ?>
                                    <?php $accordion_link = get_sub_field('accordion_links_link', false, false); ?>
                                    <span><a href="<?php echo $accordion_link['url']; ?>" target="<?php echo $accordion_link['target']; ?>"><?php echo $accordion_link['title']; ?></a></span>
                                <?php endwhile; ?>
                            <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button class="faq-answer-close-button" data-toggle="collapse" data-target="#accordion_content_<?php echo $id_name; ?>">Close</button>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>