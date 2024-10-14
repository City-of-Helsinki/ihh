<?php
$anchorTag = get_sub_field('anchor_tag');
?>

<?php if($anchorTag): ?>
<div class="anchor-target">
    <span id="<?php echo $anchorTag; ?>"></span>
</div>
<?php endif; ?>