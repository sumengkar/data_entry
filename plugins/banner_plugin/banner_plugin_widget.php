<div class="widget">
    <?php if ($widget_title) : ?>
    <div class="widget-header">
        <h3><?php echo $widget_title ?></h3>
    </div>
	<?php endif ?>
    <div class="widget-body">
        <?php foreach ($banners as $banner) : ?>
        <div class="banner-image">
            <a href="<?php echo $banner['banner_url'] ?>"><img src="<?php echo base_url($banner['banner_image']) ?>" alt=""></a>
        </div>
    	<?php endforeach ?>
    </div>
</div>