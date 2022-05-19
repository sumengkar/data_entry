<!-- CONTENT -->
<div id="main-content">
    <div id="content">
        <div class="content-wrap scroll-view">
            <!-- <section class="content-header"></section> -->
            <section class="content-body">
                <?php if (isset($this->session->userdata['error'])) {echo '<div class="alert alert-warning alert-dismissable" role="alert">' . $this->session->userdata['error'] . '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>'; } ?>
                <?php if (isset($this->session->userdata['success'])) {echo '<div class="alert alert-success alert-dismissable" role="alert">' . $this->session->userdata['success'] . '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>'; } ?>

                <div class="row">
                <?php echo form_open('','class="form"'); ?>
               
                    <div class="col-md-12">
                        <div class="card card-line">
                            <div class="card-header">
                                <div class="card-header-title">
                                <i class="icon ion-person"></i>Data Pelamar Pribadi
                                </div>

                                <div class="tools">
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-icon-toggle btn-collapse"><i class="icon ion-chevron-down menu-caret"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group <?php if (form_error('posisi')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="posisi" name="posisi" value="" >
                                    <label for="posisi">Posisi Yang Dilamar<span class="required">*</span></label>
                                    <?php form_error('posisi', '<p class="help-block ">', '</p>');?>
                                </div>
                                <div class="form-group <?php if (form_error('nama')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="nama" name="nama" value=" ">
                                    <label for="nama">Nama<span class="required">*</span></label>
                                    <?php echo form_error('nama', '<p class="help-block ">', '</p>'); ?>
                                </div>
                                <div class="form-group <?php if (form_error('no_ktp')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" value=" ">
                                    <label for="no_ktp">No KTP<span class="required">*</span></label>
                                    <?php echo form_error('no_ktp', '<p class="help-block ">', '</p>'); ?>
                                </div>
                                <div class="form-group <?php if (form_error('ttl')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="ttl" name="ttl" value=" ">
                                    <label for="ttl">Tempat, Tanggal Lahir<span class="required">*</span></label>
                                    <?php echo form_error('ttl', '<p class="help-block ">', '</p>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="jk">Jenis Kelamin</label>
                                    <select id="jk" name="jk" class="form-control select2_single">
                                        <option value="">- Pilih Jenis Kelamin -</option>
                                        <?php foreach($jenis_kelamin as $key => $val ): ?>
                                        <option value="<?php echo $key;?>"><?php echo $val; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select id="agama" name="agama" class="form-control select2_single">
                                        <option value="">- Pilih Agama -</option>
                                        <?php foreach($agama as $key => $val ): ?>
                                        <option value="<?php echo $key;?>"><?php echo $val; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gol_darah">Golongan Darah</label>
                                    <select id="gol_darah" name="gol_darah" class="form-control select2_single">
                                        <option value="">- Pilih Golongan Darah -</option>
                                        <?php foreach($gol_darah as $key => $val ): ?>
                                        <option value="<?php echo $key;?>"><?php echo $val; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control select2_single">
                                        <option value="">- Pilih Status -</option>
                                        <?php foreach($status as $key => $val ): ?>
                                        <option value="<?php echo $key;?>"><?php echo $val; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <textarea name="alamat_ktp" id="alamat_ktp" class="form-control" rows="3"> </textarea>
                                    <label for="alamat_ktp">Alamat KTP</label>
                                </div>
                                <div class="form-group">
                                    <textarea name="alamat_tinggal" id="alamat_tinggal" class="form-control" rows="3"> </textarea>
                                    <label for="alamat_tinggal">Alamat Tinggal</label>
                                </div>
                                <div class="form-group <?php if (form_error('email')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="email" name="email" value=" ">
                                    <label for="email">Email<span class="required">*</span></label>
                                    <?php echo form_error('email', '<p class="help-block ">', '</p>'); ?>
                                </div>

                                <div class="form-group <?php if (form_error('no_tlp')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="no_tlp" name="no_tlp" value=" ">
                                    <label for="no_tlp">NO TELP<span class="required">*</span></label>
                                    <?php echo form_error('no_tlp', '<p class="help-block ">', '</p>'); ?>
                                </div>

                                <div class="form-group <?php if (form_error('ot')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="ot" name="ot" value=" ">
                                    <label for="ot">Orang Terdekat yang Dapat Di Hubungi<span class="required">*</span></label>
                                    <?php echo form_error('ot', '<p class="help-block ">', '</p>'); ?>
                                </div>
                                <div class="form-group">
                                    <textarea name="skill" id="skill" class="form-control" rows="3"> </textarea>
                                    <label for="skill">Skill</label>
                                </div>

                                <div class="form-group">
                                    <label for="bk">Bersedia Di tempatkan di Seluruh Kantor Perusahaan</label>
                                    <select id="bk" name="bk" class="form-control select2_single">
                                        <option value="">- Pilih Status -</option>
                                        <?php foreach($bk as $key => $val ): ?>
                                        <option value="<?php echo $key;?>"><?php echo $val; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group <?php if (form_error('gaji')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="gaji" name="gaji" value=" ">
                                    <label for="gaji">Penghasilan Yang di Harapkan <span class="required">*</span></label>
                                    <?php echo form_error('gaji', '<p class="help-block ">', '</p>'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="card card-line">
                            <div class="card-header">
                                <div class="card-header-title">
                                    <i class="icon ion-clipboard" ></i>Pendidikan terakhir
                                </div>
                                <div class="tools">
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-icon-toggle btn-collapse"><i class="icon ion-chevron-down menu-caret"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="requirement-item" class="table" style="margin-bottom: 0;">
                                    <thead>
                                        <tr>
                                            <th>Jenjang Pendidikan Terakhir</th>
                                            <th>Nama Institusi Akademik</th>
                                            <th>Jurusan</th>
                                            <th>Tahun Lulus</th>
                                            <th>IPK</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php if(count($pendidikans)): foreach($pendidikans as $key => $doc): ?>
                                        <tr>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" id="" name="item[<?php echo $no; ?>][pendidikan_terakhir]" type="text" value=" " >
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" id="" name="item[<?php echo $no; ?>][nama_instansi]" type="text" value=" " >
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" id="" name="item[<?php echo $no; ?>][jurusan]" type="text" value=" " >
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" id="" name="item[<?php echo $no; ?>][th_lulus]" type="text" value=" " >
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" id="" name="item[<?php echo $no; ?>][ipk]" type="text" value=" " >
                                                    </div>
                                                </div>
                                            </td>
                                            <td><button class="btn btn-warning" data-loading-text="Loading..."  onclick="itemRemove(this);" type="button"><i class="icon ion-trash-a"></i></button></td>
                                        </tr>
                                        <?php $no++; endforeach; endif; ?>
                                        <tr>
                                            <td colspan="4"><button type="button" class="btn btn-primary" onclick="addPendidikan(<?php echo $no ?>); $(this).parent().parent().remove();"><i class="icon ion-plus"></i> Pendidikan Terakhir</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card card-line ">
                            <div class="card-header">
                                <div class="card-header-title">
                                    <i class="icon ion-clipboard" ></i>Riwayat Pelatihan
                                </div>
                                <div class="tools">
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-icon-toggle btn-collapse"><i class="icon ion-chevron-down menu-caret"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="requirement-pelatihan" class="table" style="margin-bottom: 0;">
                                    <thead>
                                        <tr>
                                            <th>Nama Kursus/ Seminar</th>
                                            <th>Sertifikat (Ada/Tidak)</th>
                                            <th>Tahun</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php if(count($pekerjaan)): foreach($pekerjaan as $key => $doc): ?>
                                        <tr>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" id="" name="pelatihan[<?php echo $no; ?>][nama_pelatihan]" type="text" value=" " >
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" id="" name="pelatihan[<?php echo $no; ?>][sertifikat]" type="text" value=" " >
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" id="" name="pelatihan[<?php echo $no; ?>][tahun]" type="text" value=" " >
                                                    </div>
                                                </div>
                                            </td>
                                            <td><button class="btn btn-warning" data-loading-text="Loading..."  onclick="itemRemove(this);" type="button"><i class="icon ion-trash-a"></i></button></td>
                                        </tr>
                                        <?php $no++; endforeach; endif; ?>
                                        <tr>
                                            <td colspan="4"><button type="button" class="btn btn-primary" onclick="addPelatihan(<?php echo $no; ?>); $(this).parent().parent().remove();"><i class="icon ion-plus"></i>Riwayat Pelatihan</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card card-line ">
                            <div class="card-header">
                                <div class="card-header-title">
                                    <i class="icon ion-clipboard" ></i>Riwayat Pekerjaan
                                </div>
                                <div class="tools">
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-icon-toggle btn-collapse"><i class="icon ion-chevron-down menu-caret"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="requirement-pekerjaan" class="table" style="margin-bottom: 0;">
                                    <thead>
                                        <tr>
                                            <th>Nama Perusahan</th>
                                            <th>Posisi Terakhir</th>
                                            <th>Pendapatan Terakhir</th>
                                            <th>Tahun</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php if(count($pendidikans)): foreach($pendidikans as $key => $doc): ?>
                                        <tr>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" id="" name="pekerjaan[<?php echo $no; ?>][nama_perusahaan]" type="text" value=" " >
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" id="" name="pekerjaan[<?php echo $no; ?>][posisi_terakhir]" type="text" value=" " >
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" id="" name="pekerjaan[<?php echo $no; ?>][pendapatan]" type="text" value=" " >
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" id="" name="pekerjaan[<?php echo $no; ?>][tahun]" type="text" value=" " >
                                                    </div>
                                                </div>
                                            </td>
                                            <td><button class="btn btn-warning" data-loading-text="Loading..."  onclick="itemRemove3(this);" type="button"><i class="icon ion-trash-a"></i></button></td>
                                        </tr>
                                        <?php $no++; endforeach; endif; ?>
                                        <tr>
                                            <td colspan="4"><button type="button" class="btn btn-primary" onclick="addPekerjaan(<?php echo $no; ?>); $(this).parent().parent().remove();"><i class="icon ion-plus"></i>Riwayat Pekerjaan</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card card-line ">
                            <div class="card-footer">
                                <div class="tools">
                                    <div class="btn-group">
                                        <button type="submit" id="save-op-form" class="btn btn-primary"><i class="icon ion-android-upload"></i> Simpan</button>
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
<script type="text/javascript">


function addPendidikan (no) {
    var add_row = no + 1;
    html    =   '<tr>';
    html    +=      '<td>';
    html    +=           '<div class="input-group ">';
    html    +=               '<div class="input-group-content">';
    html    +=                   '<input class="form-control" id="item['+ no + '][pendidikan_terakhir]" name="item['+ no + '][pendidikan_terakhir]" type="text" ></input>';
    html    +=               '</div>';
    html    +=           '</div>';
    html    +=      '</td>';
    html    +=      '<td>';
    html    +=           '<div class="input-group ">';
    html    +=               '<div class="input-group-content">';
    html    +=                   '<input class="form-control" id="item['+ no + '][nama_instansi]" name="item['+ no + '][nama_instansi]" type="text" ></input>';
    html    +=               '</div>';
    html    +=           '</div>';
    html    +=      '</td>';
    html    +=      '<td>';
    html    +=           '<div class="input-group ">';
    html    +=               '<div class="input-group-content">';
    html    +=                   '<input class="form-control" id="item['+ no + '][jurusan]" name="item['+ no + '][jurusan]" type="text" ></input>';
    html    +=               '</div>';
    html    +=           '</div>';
    html    +=      '</td>';
    html    +=      '<td>';
    html    +=           '<div class="input-group ">';
    html    +=               '<div class="input-group-content">';
    html    +=                   '<input class="form-control" id="item['+ no + '][th_lulus]" name="item['+ no + '][th_lulus]" type="text" ></input>';
    html    +=               '</div>';
    html    +=           '</div>';
    html    +=      '</td>';
    html    +=      '<td>';
    html    +=           '<div class="input-group ">';
    html    +=               '<div class="input-group-content">';
    html    +=                   '<input class="form-control" id="item['+ no + '][ipk]" name="item['+ no + '][ipk]" type="text" ></input>';
    html    +=               '</div>';
    html    +=           '</div>';
    html    +=      '</td>';
    html    +=         '<td>';
    html    +=         '<button class="btn btn-warning" data-loading-text="Loading..."  onclick="itemRemove(this);" type="button"><i class="icon ion-trash-a"></i></button>';
    html    +=         '</td>';
    html    +=    '</tr>';
    html    += '<tr><td colspan="4"><button type="button" class="btn btn-primary" onclick="addPendidikan(' + add_row + '); $(this).parent().parent().remove();"><i class="icon ion-plus"></i> Pendidikan Terakhir</button></td></tr>';

    $('#requirement-item').append(html);

    $.fn.bootstrapSwitch.defaults.size = 'mini';
    $('.switch-onoff').bootstrapSwitch();
    no++;
}
function itemRemove (select) {
    $(select).parent().parent().remove();
    $('.tooltip').remove();
}
function addPelatihan (nos) {
    var add_row = nos + 1;
    html    =   '<tr>';
    html    +=      '<td>';
    html    +=           '<div class="input-group ">';
    html    +=               '<div class="input-group-content">';
    html    +=                   '<input class="form-control" id="pelatihan['+ nos + '][nama_pelatihan]" name="pelatihan['+ nos + '][nama_pelatihan]" type="text" ></input>';
    html    +=               '</div>';
    html    +=           '</div>';
    html    +=      '</td>';
    html    +=      '<td>';
    html    +=           '<div class="input-group ">';
    html    +=               '<div class="input-group-content">';
    html    +=                   '<input class="form-control" id="pelatihan['+ nos + '][sertifikat]" name="pelatihan['+ nos + '][sertifikat]" type="text" ></input>';
    html    +=               '</div>';
    html    +=           '</div>';
    html    +=      '</td>';
    html    +=      '<td>';
    html    +=           '<div class="input-group ">';
    html    +=               '<div class="input-group-content">';
    html    +=                   '<input class="form-control" id="pelatihan['+ nos + '][tahun]" name="pelatihan['+ nos + '][tahun]" type="text" ></input>';
    html    +=               '</div>';
    html    +=           '</div>';
    html    +=      '</td>';
    html    +=         '<td>';
    html    +=         '<button class="btn btn-warning" data-loading-text="Loading..."  onclick="itemRemove2(this);" type="button"><i class="icon ion-trash-a"></i></button>';
    html    +=         '</td>';
    html    +=    '</tr>';
    html    += '<tr><td colspan="4"><button type="button" class="btn btn-primary" onclick="addPelatihan(' + add_row + '); $(this).parent().parent().remove();"><i class="icon ion-plus"></i> Riwayat Pekerjaan</button></td></tr>';

    $('#requirement-pelatihan').append(html);

    $.fn.bootstrapSwitch.defaults.size = 'mini';
    $('.switch-onoff').bootstrapSwitch();
    nos++;
}

// Remove Item
function itemRemove2 (select) {
    $(select).parent().parent().remove();
    $('.tooltip').remove();
}

function addPekerjaan (nos) {
    var add_row = nos + 1;
    html    =   '<tr>';
    html    +=      '<td>';
    html    +=           '<div class="input-group ">';
    html    +=               '<div class="input-group-content">';
    html    +=                   '<input class="form-control" id="pekerjaan['+ nos + '][nama_perusahaan]" name="pekerjaan['+ nos + '][nama_perusahaan]" type="text" ></input>';
    html    +=               '</div>';
    html    +=           '</div>';
    html    +=      '</td>';
    html    +=      '<td>';
    html    +=           '<div class="input-group ">';
    html    +=               '<div class="input-group-content">';
    html    +=                   '<input class="form-control" id="pekerjaan['+ nos + '][posisi_terakhir]" name="pekerjaan['+ nos + '][posisi_terakhir]" type="text" ></input>';
    html    +=               '</div>';
    html    +=           '</div>';
    html    +=      '</td>';
    html    +=      '<td>';
    html    +=           '<div class="input-group ">';
    html    +=               '<div class="input-group-content">';
    html    +=                   '<input class="form-control" id="pekerjaan['+ nos + '][pendapatan]" name="pekerjaan['+ nos + '][pendapatan]" type="text" ></input>';
    html    +=               '</div>';
    html    +=           '</div>';
    html    +=      '</td>';
    html    +=      '<td>';
    html    +=           '<div class="input-group ">';
    html    +=               '<div class="input-group-content">';
    html    +=                   '<input class="form-control" id="pekerjaan['+ nos + '][tahun]" name="pekerjaan['+ nos + '][tahun]" type="text" ></input>';
    html    +=               '</div>';
    html    +=           '</div>';
    html    +=      '</td>';
    html    +=         '<td>';
    html    +=         '<button class="btn btn-warning" data-loading-text="Loading..."  onclick="itemRemove3(this);" type="button"><i class="icon ion-trash-a"></i></button>';
    html    +=         '</td>';
    html    +=    '</tr>';
    html    += '<tr><td colspan="4"><button type="button" class="btn btn-primary" onclick="addPekerjaan(' + add_row + '); $(this).parent().parent().remove();"><i class="icon ion-plus"></i> Riwayat Pekerjaan</button></td></tr>';

    $('#requirement-pekerjaan').append(html);

    $.fn.bootstrapSwitch.defaults.size = 'mini';
    $('.switch-onoff').bootstrapSwitch();
    nos++;
}

// Remove Item
function itemRemove3 (select) {
    $(select).parent().parent().remove();
    $('.tooltip').remove();
}
</script>