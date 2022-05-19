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
                                    <input type="text" class="form-control" id="posisi" name="posisi" value="<?= $pelamar['posisi_dilamar'] ?>" readonly>
                                    <label for="posisi">Posisi Yang Dilamar<span class="required">*</span></label>
                                    <?php form_error('posisi', '<p class="help-block ">', '</p>');?>
                                </div>
                                <div class="form-group <?php if (form_error('nama')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $pelamar['nama'] ?>" readonly>
                                    <label for="nama">Nama<span class="required">*</span></label>
                                    <?php echo form_error('nama', '<p class="help-block ">', '</p>'); ?>
                                </div>
                                <div class="form-group <?php if (form_error('no_ktp')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="<?= $pelamar['no_ktp'] ?>" readonly>
                                    <label for="no_ktp">No KTP<span class="required">*</span></label>
                                    <?php echo form_error('no_ktp', '<p class="help-block ">', '</p>'); ?>
                                </div>
                                <div class="form-group <?php if (form_error('ttl')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="ttl" name="ttl" value="<?= $pelamar['ttl'] ?>" readonly>
                                    <label for="ttl">Tempat, Tanggal Lahir<span class="required">*</span></label>
                                    <?php echo form_error('ttl', '<p class="help-block ">', '</p>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="jk">Jenis Kelamin</label>
                                    <select id="jk" name="jk" class="form-control select2_single">
                                        <option value="">- Pilih Jenis Kelamin -</option>
                                        <?php foreach($jenis_kelamin as $key => $val ): ?>
                                        <option value="<?php echo $key;?>" <?php if($pelamar['jk'] === $key) echo "selected"; ?>><?php echo $val; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select id="agama" name="agama" class="form-control select2_single" readonly>
                                        <option value="">- Pilih Agama -</option>
                                        <?php foreach($agama as $key => $val ): ?>
                                        <option value="<?php echo $key;?>" <?php if($pelamar['agama'] === $key) echo "selected"; ?>><?php echo $val; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gol_darah">Golongan Darah</label>
                                    <select id="gol_darah" name="gol_darah" class="form-control select2_single" readonly>
                                        <option value="">- Pilih Golongan Darah -</option>
                                        <?php foreach($gol_darah as $key => $val ): ?>
                                        <option value="<?php echo $key;?>" <?php if($pelamar['gol_darah'] === $key) echo "selected"; ?>><?php echo $val; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control select2_single" readonly>
                                        <option value="">- Pilih Status -</option>
                                        <?php foreach($status as $key => $val ): ?>
                                        <option value="<?php echo $key;?>" <?php if($pelamar['status'] === $key) echo "selected"; ?>><?php echo $val; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <textarea name="alamat_ktp" id="alamat_ktp" class="form-control" rows="3" readonly><?= $pelamar['alamat_ktp'] ?></textarea>
                                    <label for="alamat_ktp">Alamat KTP</label>
                                </div>
                                <div class="form-group">
                                    <textarea name="alamat_tinggal" id="alamat_tinggal" class="form-control" rows="3" readonly><?= $pelamar['alamat_tinggal'] ?></textarea>
                                    <label for="alamat_tinggal">Alamat Tinggal</label>
                                </div>
                                <div class="form-group <?php if (form_error('email')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="email" name="email" <?= $pelamar['email'] ?> readonly>
                                    <label for="email">Email<span class="required">*</span></label>
                                    <?php echo form_error('email', '<p class="help-block ">', '</p>'); ?>
                                </div>

                                <div class="form-group <?php if (form_error('no_tlp')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="no_tlp" name="no_tlp" <?= $pelamar['no_tlp'] ?> readonly>
                                    <label for="no_tlp">NO TELP<span class="required">*</span></label>
                                    <?php echo form_error('no_tlp', '<p class="help-block ">', '</p>'); ?>
                                </div>

                                <div class="form-group <?php if (form_error('ot')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="ot" name="ot" <?= $pelamar['no_darurat'] ?> readonly>
                                    <label for="ot">Orang Terdekat yang Dapat Di Hubungi<span class="required">*</span></label>
                                    <?php echo form_error('ot', '<p class="help-block ">', '</p>'); ?>
                                </div>
                                <div class="form-group">
                                    <textarea name="skill" id="skill" class="form-control" rows="3" readonly><?= $pelamar['skill'] ?></textarea>
                                    <label for="skill">Skill</label>
                                </div>

                                <div class="form-group">
                                    <label for="bk">Bersedia Di tempatkan di Seluruh Kantor Perusahaan</label>
                                    <select id="bk" name="bk" class="form-control select2_single" readonly>
                                        <option value="">- Pilih Status -</option>
                                        <?php foreach($bk as $key => $val ): ?>
                                        <option value="<?php echo $key;?>" <?php if($pelamar['bersedia'] === $key) echo "selected"; ?>><?php echo $val; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group <?php if (form_error('gaji')) { echo 'has-error';  } ?>">
                                    <input type="text" class="form-control" id="gaji" name="gaji" value="<?= $pelamar['salary'] ?>" readonly>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php if(count($pendidikan)): foreach($pendidikan as $key => $val): ?>
                                        <tr>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control"  type="text" value="<?= $val['pendidikan_terakhir'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control"  type="text" value="<?= $val['nama_instansi'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control"  type="text" value="<?= $val['jurusan'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control"  type="text" value="<?= $val['th_lulus'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" value="<?= $val['ipk'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <?php $no++; endforeach; endif; ?>
                                       
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php if(count($pelatihan)): foreach($pelatihan as $key => $val): ?>
                                        <tr>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" value="<?= $val['nama_pelatihan'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" value="<?= $val['sertifikat'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" value="<?= $val['tahun'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <?php $no++; endforeach; endif; ?>
                                        
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php if(count($pekerjaan)): foreach($pekerjaan as $key => $val): ?>
                                        <tr>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" value="<?= $val['nama_perusahaan'] ?>"  readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" value="<?= $val['posisi_terakhir'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" value="<?= $val['pendapatan'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group ">
                                                    <div class="input-group-content">
                                                        <input class="form-control" value="<?= $val['tahun'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </td>
                                           
                                        </tr>
                                        <?php $no++; endforeach; endif; ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>

                           
                <?php echo form_close();?>
                </div>
            </section>
        </div>
    </div>
</div>