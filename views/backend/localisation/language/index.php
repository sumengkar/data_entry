<!-- CONTENT -->
<div id="main-content">
    <div id="content">
        <div class="content-wrap scroll-view">
            <!-- <section class="content-header"></section> -->
            <section class="content-body">
                <?php if (isset($this->session->userdata['error'])) {
                    echo alert('error', $this->session->userdata['error']);
                } ?>

                <?php if (isset($this->session->userdata['success'])) {
                    echo alert('success', $this->session->userdata['success']);
                } ?>
                <div class="row">
                    <div class="col-md-12">
                    <div class="card card-line">
                        <div class="card-header">
                            <div class="card-header-title">
                            <i class="icon ion-earth"></i><?php echo lang('text_all_language') ?>
                            </div>
                            <div class="tools">
                                <div class="btn-group">
                                    <a href="<?php echo site_url('localisation/language/edit'); ?>" class="btn btn-primary" role="button"><i class="icon ion-compose"></i> <?php echo lang('btn_add') ?></a>
                                    <button type="button" class="btn btn-warning" onclick="confirm('<?php echo lang('notification_delete') ?>') ? $('#form').submit() : false;"><i class="icon ion-trash-a"></i> <span class="hidden-xs"><?php echo lang('btn_remove_selected') ?></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <?php echo form_open('localisation/language/delete','id="form"'); ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center no-sort" style="width:50px">
                                                <div class="checkbox checkbox-styled">
                                                    <label>
                                                        <input type="checkbox" id="select_all" class="iCheck">
                                                    </label>
                                                </div>
                                            </th>
                                            <th><?php echo lang('tbl_title_name') ?></th>
                                            <th class="text-center"><?php echo lang('tbl_title_iso_code') ?></th>
                                            <th class="text-center"><?php echo lang('tbl_title_thumbnail') ?></th>
                                            <th class="text-center"><?php echo lang('tbl_title_sort_order') ?></th>
                                            <th class="text-center"><?php echo lang('tbl_title_status') ?></th>
                                            <th class="text-center no-sort" style="width: 100px;"><?php echo lang('tbl_title_action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <?php echo form_close();?>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    var baseurl = '<?=base_url()?>';

    // Datatable
    var dataTable = $('#dataTable').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            url : baseurl + "localisation/language/fetch_data",
            type : "POST"
        },
        "drawCallback": function() {
            // Call iCheck
            iCheck();

            // Switch on-off
            $.fn.bootstrapSwitch.defaults.size = 'mini';
            $('.switch-onoff').bootstrapSwitch();

            // Call switchSet
            switchSet(baseurl + 'localisation/language/status', '<?php echo lang('status_update_failed') ?>');
        },
        "createdRow": function( nRow, aData, iDataIndex ) {
            $('td:eq(0)', nRow).css('text-align','center');
            $('td:eq(2)', nRow).css('text-align','center');
            $('td:eq(3)', nRow).css('text-align','center');
            $('td:eq(4)', nRow).css('text-align','center');
            $('td:eq(5)', nRow).css('text-align','center');
            $('td:eq(6)', nRow).css('text-align','center');
        },
        "columnDefs": [ { "targets": 'no-sort', "orderable": false } ],
        "autoWidth" : false,
        "language": {
            "processing": "<i class='icon ion-load-a ion-spin'></i>",
            "search": '<i class="icon ion-search"></i>',
            "paginate": {
                "previous": '<i class="icon ion-ios-arrow-left"></i>',
                "next": '<i class="icon ion-ios-arrow-right"></i>'
            }
        },
    });
});
</script>