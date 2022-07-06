<?php if( get_sub_field('content')) : ?>
    <?php
        $highlightColor = 'background-' . get_sub_field('background_color');
        $divideIntoColumns = get_sub_field('divide_content_into_columns') ? ' columns-two' : '';
    ?>

    <div class="highlighted-content <?php echo $highlightColor; echo $divideIntoColumns; ?>">
        <?php the_sub_field('content'); ?>
    </div>
<?php endif ?>