<!-- modal detail peserta -->
    <div class="modal fade" id="modalDetailPesertaPrivat" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailPesertaPrivatTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btn-form-1"><i class="fas fa-user"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btn-form-2"><i class="fas fa-map-marker-alt"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btn-form-3"><i class="fas fa-user-tie"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btn-form-4"><i class="fas fa-users"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link btn btn-sm btn-primary' id="ubah-data">ubah data</i></a>
                                </li>
                            </ul>
                        </div>
                        <form action="<?= base_url()?>peserta/edit_peserta" method="post" id="form-edit-peserta">
                            <input type="hidden" name="id_peserta" id="id_peserta">
                            <div class="card-body">
                                <div class="card" id="form-1">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold text-primary mb-1">Data Diri</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="tgl_masuk">Tgl Masuk</label>
                                            <input class='form-control form-control-sm' type="date" name="tgl_masuk" id="tgl_masuk" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_peserta">Nama Lengkap</label>
                                            <input class='form-control form-control-sm' type="text" name="nama_peserta" id="nama_peserta" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp">No Handphone</label>
                                            <input class='form-control form-control-sm' type="text" name="no_hp" id="no_hp" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="t4_lahir">Tempat Lahir</label>
                                            <input class='form-control form-control-sm' type="text" name="t4_lahir" id="t4_lahir" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input class='form-control form-control-sm' type="date" name="tgl_lahir" id="tgl_lahir">
                                        </div>
                                        <div class="form-group">
                                            <label for="umur">Umur</label></th>
                                            <input type="text" name="umur" id="umur" class="form-control form-control-sm" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="jk">Gender</label>
                                            <select name="jk" id="jk" class='form-control form-control-sm'>
                                                <option value="">Pilih Gender</option>
                                                <option value="Pria">Pria</option>
                                                <option value="Wanita">Wanita</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="pendidikan">Pendidikan</label>
                                            <select name="pendidikan" id="pendidikan" class='form-control form-control-sm'>
                                                <option value="">Pilih Pendidikan</option>
                                                <option value="SD/Sederajat">SD/Sederajat</option>
                                                <option value="SMP/Sederajat">SMP/Sederajat</option>
                                                <option value="SMA/Sederajat">SMA/Sederajat</option>
                                                <option value="Diploma I/II/III">Diploma I/II/III</option>
                                                <option value="S1/S2/S3">S1/S2/S3</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status_nikah">Status Menikah</label>
                                            <select name="status_nikah" id="status_nikah" class='form-control form-control-sm'>
                                                <option value="">Pilih Status</option>
                                                <option value="Menikah">Menikah</option>
                                                <option value="Belum Menikah">Belum Menikah</option>
                                                <option value="Janda/Duda">Janda/Duda</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="info">Informasi</label>
                                            <select name="info" id="info" class="form-control form-control-sm" required>
                                                <option value="">Pilih Informasi</option>
                                                <option value="Teman">Teman</option>
                                                <option value="Spanduk">Spanduk</option>
                                                <option value="Media Elektronik">Media Elektronik</option>
                                                <option value="Civitas Tar-Q">Civitas Tar-Q</option>
                                                <option value="Brosur">Brosur</option>
                                                <option value="Peserta">Peserta</option>
                                                <option value="Event">Event</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="civitas">Nama Civitas</label>
                                            <select name="civitas" id="civitas" class="form-control form-control-sm" disabled>
                                                <option value="">Pilih Civitas</option>
                                                <?php foreach ($kpq as $pengajar) :?>
                                                    <option value="<?= $pengajar['nip']?>"><?= $pengajar['nama_kpq']?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <a href="#" class="btn btn-success btn-sm" id="btn-form-1-next"><i class="fa fa-arrow-right"></i> Data Alamat</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="form-2">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold text-primary mb-1">Data Alamat</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea class='form-control form-control-sm' name="alamat" id="alamat" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="kel">Kelurahan</label>
                                            <input type="text" name="kel" id="kel" class="form-control form-control-sm" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="kd_pos">Kode Pos</label>
                                            <input type="text" name="kd_pos" id="kd_pos" class="form-control form-control-sm" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="kec">Kecamatan</label>
                                            <input type="text" name="kec" id="kec" class="form-control form-control-sm" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="kab_kota">Kabupaten / Kota</label>
                                            <input type="text" name="kab_kota" id="kab_kota" class="form-control form-control-sm" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="provinsi">Provinsi</label>
                                            <input type="text" name="provinsi" id="provinsi" class="form-control form-control-sm" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telp">No. Telepon</label>
                                            <input type="text" name="no_telp" id="no_telp" class="form-control form-control-sm" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="text" name="email" id="email" class="form-control form-control-sm" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <a href="#" class="btn btn-success btn-sm" id="btn-form-2-back"><i class="fa fa-arrow-left"></i> Data Diri</a>
                                            <a href="#" class="btn btn-success btn-sm" id="btn-form-2-next"><i class="fa fa-arrow-right"></i> Data Pekerjaan</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="form-3">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold text-primary mb-1">Data Pekerjaan</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <select name="pekerjaan" id="pekerjaan" class="form-control form-control-sm">
                                                <option value="">Pilih Pekerjaan</option>
                                                <option value="Pelajar">Pelajar</option>
                                                <option value="Mahasiswa">Mahasiswa</option>
                                                <option value="Swasta">Swasta</option>
                                                <option value="PNS/BUMN">PNS/BUMN</option>
                                                <option value="TNI/POLRI">TNI/POLRI</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan_lainnya">Pekerjaan</label>
                                            <input type="text" name="pekerjaan_lainnya" id="pekerjaan_lainnya" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_perusahaan">Nama Instansi</label>
                                            <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control form-control-sm" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_perusahaan">Alamat Instansi</label>
                                            <textarea name="alamat_perusahaan" id="alamat_perusahaan" rows="3" class="form-control form-control-sm"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telp_perusahaan">No. Telepon</label>
                                            <input type="text" name="no_telp_perusahaan" id="no_telp_perusahaan" class="form-control form-control-sm" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <a href="#" class="btn btn-success btn-sm" id="btn-form-3-back"><i class="fa fa-arrow-left"></i> Data Alamat</a>
                                            <a href="#" class="btn btn-success btn-sm" id="btn-form-3-next"><i class="fa fa-arrow-right"></i> Data Ortu</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="form-4">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold text-primary mb-1">Data Orang Tua</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama_ibu">Nama Ibu</label>
                                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control form-control-sm" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="t4_lahir_ibu">Tempat Lahir</label>
                                            <input type="text" name="t4_lahir_ibu" id="t4_lahir_ibu" class="form-control form-control-sm" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_lahir_ibu">Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir_ibu" id="tgl_lahir_ibu" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_ayah">Nama Ayah</label>
                                            <input type="text" name="nama_ayah" id="nama_ayah" class="form-control form-control-sm" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="t4_lahir_ayah">Tempat Lahir</label>
                                            <input type="text" name="t4_lahir_ayah" id="t4_lahir_ayah" class="form-control form-control-sm" autocomplete="off" autocorrect="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_lahir_ayah">Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir_ayah" id="tgl_lahir_ayah" class="form-control form-control-sm">
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <a href="#" class="btn btn-success btn-sm" id="btn-form-4-back"><i class="fa fa-arrow-left"></i> Data Pekerjaan</a>
                                            <button type="submit" class="btn btn-primary btn-sm" id="ubahData">Ubah Data</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- modal detail peserta -->

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $title?></h1>
            </div>

            <?php if( $this->session->flashdata('pesan') ) : ?>
                <div class="row">
                    <div class="col-6">
                        <?= $this->session->flashdata('pesan');?>    
                    </div>
                </div>
            <?php endif; ?>

            <!-- DataTales Example -->
            <div class="card shadow mb-4" style="max-width: 950px">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-sm cus-font">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th>Nama Peserta</th>
                                <th>No Hp</th>
                                <th>Program</th>
                                <th>Pengajar</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 0;
                            foreach ($peserta as $peserta) :?>
                                <tr>
                                    <td><center><?= ++$i?></center></td>
                                    <td><?= $peserta['status']?></td>
                                    <td><?= $peserta['nama_peserta']?></td>
                                    <td><?= $peserta['no_hp']?></td>
                                    <?php if($peserta['nama_kpq'] == ""):?>
                                        <td><center>-</center></td>
                                        <td><center>-</center></td>
                                    <?php else :?>
                                        <td><?= $peserta['program']?></td>
                                        <td><?= $peserta['nama_kpq']?></td>
                                    <?php endif;?>
                                    <td><a href="#modalDetailPesertaPrivat" data-toggle="modal" data-id="<?= $peserta['id_peserta']?>" class="modalDetailPesertaPrivat btn btn-sm btn-info">detail</a></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>

        </div>
    </div>
</div>

<script>
    $("#peserta").addClass("active");
    
    $("#btn-form-1").addClass('active');
    $("#btn-form-2").removeClass('active');
    $("#btn-form-3").removeClass('active');
    $("#btn-form-4").removeClass('active');
    
    $("#form-1").show();
    $("#form-2").hide();
    $("#form-3").hide();
    $("#form-4").hide();

    // modal button
        $("#btn-form-1, #btn-form-2-back").click(function(){
            $("#btn-form-1").addClass('active');
            $("#btn-form-2").removeClass('active');
            $("#btn-form-3").removeClass('active');
            $("#btn-form-4").removeClass('active');
            
            $("#form-1").show();
            $("#form-2").hide();
            $("#form-3").hide();
            $("#form-4").hide();
        })
        
        $("#btn-form-2, #btn-form-1-next, #btn-form-3-back").click(function(){
            $("#btn-form-1").removeClass('active');
            $("#btn-form-2").addClass('active');
            $("#btn-form-3").removeClass('active');
            $("#btn-form-4").removeClass('active');
            
            $("#form-1").hide();
            $("#form-2").show();
            $("#form-3").hide();
            $("#form-4").hide();
        })
        
        $("#btn-form-3, #btn-form-2-next, #btn-form-4-back").click(function(){
            $("#btn-form-1").removeClass('active');
            $("#btn-form-2").removeClass('active');
            $("#btn-form-3").addClass('active');
            $("#btn-form-4").removeClass('active');
            
            $("#form-1").hide();
            $("#form-2").hide();
            $("#form-3").show();
            $("#form-4").hide();
        })
        
        $("#btn-form-4, #btn-form-3-next").click(function(){
            $("#btn-form-1").removeClass('active');
            $("#btn-form-2").removeClass('active');
            $("#btn-form-3").removeClass('active');
            $("#btn-form-4").addClass('active');
            
            $("#form-1").hide();
            $("#form-2").hide();
            $("#form-3").hide();
            $("#form-4").show();
        })
    // modal button

    $("#info").change(function(){
        var info = $("#info").val();
        
        if(info == "Lainnya"){
            $("#civitas").attr("disabled", false);
            $("#civitas").val("");
        } else {
            $("#civitas").attr("disabled", true);
            $("#civitas").val("");
        }
    })

    $("#pekerjaan").change(function(){
        var pekerjaan = $("#pekerjaan").val();
        
        if(pekerjaan == "Lainnya"){
            $("#pekerjaan_lainnya").attr("disabled", false);
            $("#pekerjaan_lainnya").val("");
        } else {
            $("#pekerjaan_lainnya").attr("disabled", true);
            $("#pekerjaan_lainnya").val("");
        }
    })

    $(".modalDetailPesertaPrivat").click(function(){
        const id = $(this).data('id');
        $.ajax({
            url : "<?=base_url()?>peserta/get_detail_peserta",
            method : "POST",
            data : {id : id},
            async : true,
            dataType : 'json',
            success : function(data){
                $("#modalDetailPesertaPrivatTitle").html(data.diri.nama_peserta);

                // data diri
                $("#id_peserta").val(data.diri.id_peserta)
                $("#nama_peserta").val(data.diri.nama_peserta)
                $("#no_hp").val(data.diri.no_hp)
                $("#t4_lahir").val(data.diri.t4_lahir)
                $("#tgl_lahir").val(data.diri.tgl_lahir)
                $("#tgl_masuk").val(data.diri.tgl_masuk)
                $("#umur").val(data.diri.umur)
                $("#jk").val(data.diri.jk)
                $("#pendidikan").val(data.diri.pendidikan)
                $("#status_nikah").val(data.diri.status_nikah)
                $("#info").val(data.diri.info);
                
                var info = ["Teman", "Spanduk", "Media Elektronik", "Civitas Tar-Q", "Brosur", "Peserta", "Event"]
                if(data.diri.info == "" || data.diri.info == null){
                    $("#info").val("");
                    $("#civitas").attr("disabled", true);
                    $("#civitas").val("");
                } else if(info.includes(data.diri.info) == false){
                    $("#info").val("Lainnya");
                    $("#civitas").attr("disabled", false);
                    $("#civitas").val(data.diri.info);
                } else {
                    $("#info").val(data.diri.info);
                    $("#civitas").attr("disabled", true);
                    $("#civitas").val("");
                }

                // data alamat
                $("#alamat").val(data.alamat.alamat)
                $("#kel").val(data.alamat.kel)
                $("#kd_pos").val(data.alamat.kd_pos)
                $("#kec").val(data.alamat.kec)
                $("#kab_kota").val(data.alamat.kab_kota)
                $("#provinsi").val(data.alamat.provinsi)
                $("#no_telp").val(data.alamat.no_telp)
                $("#email").val(data.alamat.email)

                // data pekerjaan
                $("#nama_perusahaan").val(data.pekerjaan.nama_perusahaan)
                $("#alamat_perusahaan").val(data.pekerjaan.alamat_perusahaan)
                $("#no_telp_perusahaan").val(data.pekerjaan.no_telp_perusahaan)
                
                var pekerjaan = ["Pelajar", "Mahasiswa", "Swasta", "PNS/BUMN", "TNI/POLRI"]
                if(data.pekerjaan.pekerjaan == "" || data.pekerjaan.pekerjaan == null){
                    $("#pekerjaan").val(data.pekerjaan.pekerjaan)
                    $("#pekerjaan_lainnya").attr("disabled", true);
                    $("#pekerjaan_lainnya").val("");
                } else if(pekerjaan.includes(data.pekerjaan.pekerjaan) == false){
                    $("#pekerjaan").val("Lainnya");
                    $("#pekerjaan_lainnya").attr("disabled", false);
                    $("#pekerjaan_lainnya").val(data.pekerjaan.pekerjaan);
                } else {
                    $("#pekerjaan").val(data.pekerjaan.pekerjaan);
                    $("#pekerjaan_lainnya").attr("disabled", true);
                    $("#pekerjaan_lainnya").val("");
                }

                // data ortu
                $("#nama_ibu").val(data.ortu.nama_ibu)
                $("#t4_lahir_ibu").val(data.ortu.t4_lahir_ibu)
                $("#tgl_lahir_ibu").val(data.ortu.tgl_lahir_ibu)
                $("#nama_ayah").val(data.ortu.nama_ayah)
                $("#t4_lahir_ayah").val(data.ortu.t4_lahir_ayah)
                $("#tgl_lahir_ayah").val(data.ortu.tgl_lahir_ayah)

            }
        })
    })

    $("#ubahData").click(function(){
        var c = confirm("Yakin akan mengubah data peserta?")
        return c;
    })

    $("#ubah-data").click(function(){
        var c = confirm("Yakin akan mengubah data peserta?")
        if (c === true){
            $('#form-edit-peserta').submit();
        }
    })
</script>
