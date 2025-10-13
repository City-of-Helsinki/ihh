<?php
  $show_navigation = get_sub_field("show_nextprev_navigation", $post->ID);
  if( $show_navigation === false ) return;

  $prev_id = "";
  $next_id = "";
  if( get_sub_field('previous_page')):
      $prev_id = get_sub_field('previous_page');
  endif;
  if( get_sub_field('next_page')):
      $next_id =  get_sub_field('next_page');
  endif;
  $navigationAriaLabel = 'aria-label="Links to related topics"';
?>

<?php if(get_row_index() != 1): ?>
<div class="container">
    <div class="w-100 h-100 my-5">
        <?php endif ?>
        <div class="row content-footer">
            <div class="col-lg-12">
                <nav class="navigation-boxes container" <?php echo $navigationAriaLabel; ?>>
                    <ul class="list-unstyled row">
                        <?php if($prev_id): ?>
                        <li class="previous-article previous">
                            <a href="<?php echo get_permalink($prev_id); ?>">
                                <div class="link-heading">
                                    <?php echo \App\ihh_inline_svg('icons/arrow-right') ?>
                                    <?php echo get_the_title($prev_id); ?>
                                </div>
                            </a>
                        </li>
                        <?php endif ?>

                        <?php if($next_id): ?>
                        <li class="next-article next">
                            <a href="<?php echo get_permalink($next_id); ?>">
                                <div class="link-heading">
                                    <?php echo \App\ihh_inline_svg('icons/arrow-right') ?>
                                    <?php echo get_the_title($next_id); ?>
                                </div>
                            </a>
                        </li>
                        <?php endif ?>
                    </ul>
                </nav>
            </div>
        </div>
        <?php if(get_row_index() != 1): ?>
    </div>
</div>
<?php endif ?>