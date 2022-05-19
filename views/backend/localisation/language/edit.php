<!-- CONTENT -->
<div id="main-content">
    <div id="content">
        <div class="content-wrap scroll-view">
            <!-- <section class="content-header"></section> -->
            <section class="content-body">
                <?php if (isset($this->session->userdata['error'])) { echo '<div class="alert alert-warning alert-dismissable" role="alert">' . $this->session->userdata['error'] . '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>'; } ?>

                <div class="row">
                <?php echo form_open('','class="form"'); ?>
                    <input type="hidden" name="language_id" value="<?php echo $languages['language_id']; ?>">
                    <div class="col-md-8">
                        <div class="card card-line">
                            <div class="card-header">
                                <div class="card-header-title">
                                <i class="icon ion-earth"></i><?php echo lang('text_edit_language') ?>
                                </div>

                                <div class="tools">
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-icon-toggle btn-collapse"><i class="icon ion-chevron-down menu-caret"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group <?php if (form_error("name")) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $languages['name']; ?>">
                                    <label for="name"><?php echo lang('text_language_name') ?> <span class="required">*</span></label>
                                    <?php echo form_error("name", '<p class="help-block ">', '</p>'); ?>
                                </div>
                                <div class="form-group <?php if (form_error("language_code")) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="language_code" name="language_code" value="<?php echo $languages['language_code']; ?>">
                                    <label for="language_code"><?php echo lang('text_iso_code') ?> <span class="required">*</span></label>
                                    <?php echo form_error("language_code", '<p class="help-block ">', '</p>'); ?>
                                </div>
                                <div class="form-group <?php if (form_error("locale")) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="locale" name="locale" value="<?php echo $languages['locale']; ?>">
                                    <label for="locale"><?php echo lang('text_locale') ?> <span class="required">*</span></label>
                                    <?php echo form_error("locale", '<p class="help-block ">', '</p>'); ?>
                                </div>
                                <div class="form-group <?php if (form_error("image")) { echo 'has-error';  } ?>">
                                    <select id="image" name="image" class="form-control select2_single" style="width: 50%;">
                                        <?php foreach( $flags as $flag ): ?>
                                        <option value="<?php echo $flag ?>" <?php if($flag == $languages['image']) echo "selected"; ?> ><?php echo $flag; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="image"><?php echo lang('text_thumbnail') ?> <span class="required">*</span></label>
                                    <?php echo form_error("image", '<p class="help-block ">', '</p>'); ?>
                                </div>
                                <div class="form-group <?php if (form_error("date_format_lite")) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="date_format_lite" name="date_format_lite" value="<?php echo $languages['date_format_lite']; ?>">
                                    <label for="date_format_lite"><?php echo lang('text_date_format') ?> <span class="required">*</span></label>
                                    <?php echo form_error("date_format_lite", '<p class="help-block ">', '</p>'); ?>
                                </div>
                                <div class="form-group <?php if (form_error("date_format_full")) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="date_format_full" name="date_format_full" value="<?php echo $languages['date_format_full']; ?>">
                                    <label for="date_format_full"><?php echo lang('text_date_format_full') ?> <span class="required">*</span></label>
                                    <?php echo form_error("date_format_full", '<p class="help-block ">', '</p>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-line">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="sort_order" name="sort_order" value="<?php echo $languages['sort_order']; ?>">
                                    <label for="sort_order"><?php echo lang('text_sort_order') ?></label>
                                </div>
                                <div>
                                    <label class="radio-styled">
                                        <input type="radio" name="status" class="iCheck" value="1" <?php if( $languages['status'] == 1){ ?> checked <?php } ?>><span> <?php echo lang('text_enable') ?></span>
                                    </label>
                                    <label class="radio-inline radio-styled">
                                        <input type="radio" name="status" class="iCheck" value="0" <?php if( $languages['status'] == 0){ ?> checked <?php } ?>><span> <?php echo lang('text_disable') ?></span>
                                    </label>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="tools">
                                    <div class="btn-group">
                                        <a href="<?php echo site_url('localisation/language'); ?>" class="btn btn-default" role="button"><i class="icon ion-reply"></i> <?php echo lang('btn_back') ?></a>
                                        <button class="btn btn-primary" type="submit">
                                            <?php echo lang('btn_save') ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
                </div>
            </section>
        </div>
    </div>
</div>

<script>

</script>