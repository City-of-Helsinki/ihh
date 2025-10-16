<?php
    $accordionAlignment = '';
    $ariaLabel = '';
    $LIs = '';

    if( get_sub_field('accordion_position')):
        $accordionAlignment = get_sub_field('accordion_position');
    endif;

    if( get_sub_field('section_heading')):
        $ariaLabel = 'aria-label="'.get_sub_field('section_heading').'"';
    endif;

    $accordionObj = get_sub_field_object('accordions');
    $accordionName = $accordionObj['name'];
    $accordionContentBgColor = 'background-color: '. get_sub_field('content_background_color');
?>

<?php if( get_sub_field('line_color')): ?>
<style>
.ihh-accordion .question .question-answer:before,
.ihh-accordion .question .question-header:hover:before {
    background: <?php the_sub_field('line_color');
    ?> !important;
}
</style>
<?php endif; ?>

<?php if( have_rows('accordions') ) : ?>
<div id="faqs_<?php echo $accordionName; ?>"
    class="container ihh-accordion accordion-with-description <?php echo $accordionAlignment; ?>">
    <?php while( have_rows('accordions') ) : the_row(); $id = get_row_index(); ?>
    <?php
            $assignedTags = '';

            foreach( get_sub_field("tags") as $k => $v ):
                $assignedTags .= $v .',';
            endforeach;

            $LIs .= '<li>
                <div class="question accordion" data-tags="'. rtrim($assignedTags, ',') .'">
                    <button class="question-header collapsed"
                        data-toggle="collapse"
                        data-target="#ac_'. $accordionName . $id .'"
                        aria-expanded="false"
                        aria-controls="ac_'. $accordionName . $id .'"
                        aria-owns="ac_'. $accordionName . $id .'">
                        <span>'. get_sub_field('accordion_heading') .'</span>
                    </button>

                    <div id="ac_'. $accordionName . $id .'"
                        class="collapse accordion-content question-answer"
                        data-parent="#faqs_'. $accordionName .'">

                        <div class="accordion-body">
                            '. get_sub_field('accordion_content') .'
                        </div>
                    </div>
                </div></li>'; ?>
    </li>
    <?php endwhile; ?>

    <div class="accordion-with-description--content" style="<?php echo $accordionContentBgColor; ?>">
        <?php if( get_sub_field('content')):
                the_sub_field('content');
            endif; ?>
    </div>

    <div class="accordion-with-description--accordions">
        <ul class="list-unstyled" <?php echo $ariaLabel;?>>
            <?php echo $LIs; ?>
        </ul>
    </div>
</div>
<?php endif; ?>