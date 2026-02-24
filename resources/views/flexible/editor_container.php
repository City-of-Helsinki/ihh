<?php if( get_sub_field('content') ) : ?>
  <?php $anchor_link = get_sub_field('show_in_anchor_link'); ?>
  <div class="container">
      <div class="w-100 h-100 my-5 ihhce" <?= $anchor_link ? 'data-anchor="true"' : '';  ?>>

          <?php the_sub_field('content'); ?>
      </div>
  </div>
<?php endif ?>
