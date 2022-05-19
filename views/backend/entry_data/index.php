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
                            <i class="icon ion-ios-photos"></i>Data Pelamar
                            </div>
                            <div class="tools">
                               
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <?php echo form_open('user/delete','id="form-user"'); ?>
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center no-sort" style="width:50px">
                                                <div class="checkbox checkbox-styled">
                                                    <label>
                                                        <input type="checkbox" id="select_all" class="iCheck">
                                                    </label>
                                                </div>
                                            </th>
                                            <th>Nama</th>
                                            <th>Tempat Tanggal Lahir</th>
                                            <th>Posisi Yang Di Lamar</th>
                                            
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
            url : baseurl + "entry_data/fetch_data",
            type : "POST"
        },
        "drawCallback": function() {
            // Call iCheck
            iCheck();
        },
        "createdRow": function( nRow, aData, iDataIndex ) {
            // Set row
            $('td:eq(0)', nRow).css('text-align','center');
            $('td:eq(4)', nRow).css('text-align','center');
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