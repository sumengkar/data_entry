<div class="widget">
    <?php if (isset($widget_title)) : ?>
    <div class="widget-header">
        <h3><?php echo $widget_title ?></h3>
    </div>
	<?php endif ?>
    <div class="widget-body">
        <div class="images">
            <img src="<?php echo image_thumb($user_image, 'small'); ?>" alt="">
        </div>
        <div class="meta">
            <?php echo $user_desc['user_name'] ?>
        </div>
        <div class="desc">
            <?php echo $user_desc['user_desc'] ?>
        </div>
    </div>
</div>