<div class="widget audio-widget">
    <?php if (isset($widget_title) && $widget_title != '') : ?>
    <div class="widget-header">
        <h3><?php echo $widget_title ?></h3>
    </div>
	<?php endif ?>
    <div class="widget-body">
        <div class="audio-images">
            <img src="<?php echo image_thumb($audio_image, 'small'); ?>" alt="">
        </div>
        <div class="audio-meta">
            <?php echo $audio_name ?>
        </div>
        <div class="audio-desc">
            <?php echo $audio_desc ?>
        </div>
        <audio controls>
            <source src="<?php echo $audio_path ?>" type="audio/ogg">
        </audio>
    </div>
</div>

<style>
    .audio-widget {
        /*background-image: url('../images/widget-info-bg.jpg');*/
        text-align: center;
        margin-bottom: 30px;
    }

    .audio-widget .widget-body {
        background: #368C5A;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .audio-widget .widget-body .audio-images img {
        border-radius: 0;
        width: 80px;
        height: auto;
    }

    .audio-widget .widget-body .audio-meta {
        font-weight: 600;
        margin-bottom: 0;
        text-transform: uppercase;
        margin-top: 10px;
    }

    .audio-widget .widget-body .audio-desc {
        margin-bottom: 20px;
    }

    .audio-widget .widget-body .audio-meta, .audio-widget .widget-body .audio-desc {
        color: #fff;
    }
</style>