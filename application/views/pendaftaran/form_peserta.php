
<!-- Page Heading -->
<h5>Koor : <?=$koor?></h5>
<div class="progress mb-2">
    <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100" id="progress">0%</div>
</div>
<form action="<?= base_url()?>pendaftaran/tambahpesertabaru" method="post">
    <input type="hidden" name="id_kelas" value="<?=$id_kelas?>">
    <input type="hidden" name="hari">
    <input type="hidden" name="jam">
    <input type="hidden" name="tipe_peserta" value="<?=$tipe_peserta?>">
    <textarea name="tempat" id="tempat" class="form-control form-control-sm" style="display:none;"><?=$tempat?></textarea>
    <div class="card" id="dataAkademik">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-dark mb-1">Data Akademik</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <a href="#generatePeserta" class="btn btn-success" data-bs-toggle="modal">Generate Peserta</a>
            </div>
            <div class="msg-generate"></div>
            <div class="form-group">
                <label for="tgl_daftar">Tgl Pendaftaran <span class="text-danger">*</span></label>
                <input type="date" name="tgl_daftar" id="tgl_daftar" class="form-control form-control-md" value="<?= date('Y-m-d')?>" required>
            </div>
            <div class="form-group">
                <label for="program">Program <span class="text-danger">*</span></label>
                <select name="program" id="program" class="form-control form-control-md" required>
                    <option value="">Pilih Program</option>
                    <?php foreach ($program as $program) :?>
                        <option value="<?=$program['nama_program']?>"><?=$program['nama_program']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="hari">Hari <span class="text-danger">*</span></label>
                <select name="hari" id="hari" class="form-control form-control-md" required>
                    <option value="">Pilih Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Ahad">Ahad</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jam">Jam <span class="text-danger">*</span></label>
                <select name="jam" id="jam" class="form-control form-control-md" required>
                    <option value="">Pilih Jam</option>
                    <option value="08.30-10.00">08.30-10.00</option>
                    <option value="10.00-11.30">10.00-11.30</option>
                    <option value="13.00-14.30">13.00-14.30</option>
                    <option value="15.30-17.00">15.30-17.00</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tempat">Tempat Belajar <span class="text-danger">*</span></label>
                <textarea name="tempat" id="tempat" class="form-control form-control-md" required></textarea>
            </div>
            <div class="form-group">
                <label for="info">Informasi <span class="text-danger">*</span></label>
                <select name="info" id="info" class="form-control form-control-md" required>
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
                <label for="civitas">Nama Civitas <span class="text-danger">*</span></label>
                <select name="civitas" id="civitas" class="form-control form-control-md" disabled>
                    <option value="">Pilih Civitas</option>
                    <?php foreach ($pengajar as $pengajar) :?>
                        <option value="<?= $pengajar['nip']?>"><?= $pengajar['nama_kpq']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="d-flex justify-content-end">
                <a href="javascript:void(0)" class="btn btn-success btn-sm" id="nextDiri">Data Diri <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="card" id="dataDiri">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-dark mb-1">Data Diri</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="nama_peserta">Nama Lengkap <span class="text-danger">*</span></label>
                <input class='form-control form-control-md' type="text" name="nama_peserta" id="nama_peserta" required autocomplete="off" autocorrect="off">
            </div>
            <div class="form-group">
                <label for="no_hp">No Handphone</label>
                <input class='form-control form-control-md' type="text" name="no_hp" id="no_hp" autocomplete="off" autocorrect="off">
            </div>
            <div class="form-group">
                <label for="t4_lahir">Tempat Lahir</label>
                <input class='form-control form-control-md' type="text" name="t4_lahir" id="t4_lahir" autocomplete="off" autocorrect="off">
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input class='form-control form-control-md' type="date" name="tgl_lahir" id="tgl_lahir">
            </div>
            <div class="form-group">
                <label for="umur">Umur</label></th>
                <input type="text" name="umur" id="umur" class="form-control form-control-md" autocomplete="off" autocorrect="off">
            </div>
            <div class="form-group">
                <label for="jk">Gender <span class="text-danger">*</span></label>
                <select name="jk" id="jk" class='form-control form-control-md' required>
                    <option value="">Pilih Gender</option>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pendidikan">Pendidikan <span class="text-danger">*</span></label>
                <select name="pendidikan" id="pendidikan" class='form-control form-control-md' required>
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
                <label for="status_nikah">Status Menikah <span class="text-danger">*</span></label>
                <select name="status_nikah" id="status_nikah" class='form-control form-control-md' required>
                    <option value="">Pilih Status</option>
                    <option value="Menikah">Menikah</option>
                    <option value="Belum Menikah">Belum Menikah</option>
                    <option value="Janda/Duda">Janda/Duda</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <a href="javascript:void(0)" class="btn btn-success btn-sm" id="backAkademik"><i class="fa fa-arrow-left"></i> Data Akademik</a>
                <a href="javascript:void(0)" class="btn btn-success btn-sm" id="nextAlamat">Data Alamat <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="card" id="dataAlamat">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-dark mb-dark">Data Alamat</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="alamat">Alamat <span class="text-danger">*</span></label>
                <textarea class='form-control form-control-md' name="alamat" id="alamat" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="kel">Kelurahan</label>
                <input type="text" name="kel" id="kel" class="form-control form-control-md" autocomplete="off" autocorrect="off">
            </div>
            <div class="form-group">
                <label for="kd_pos">Kode Pos</label>
                <input type="text" name="kd_pos" id="kd_pos" class="form-control form-control-md" autocomplete="off" autocorrect="off">
            </div>
            <div class="form-group">
                <label for="kec">Kecamatan</label>
                <input type="text" name="kec" id="kec" class="form-control form-control-md" autocomplete="off" autocorrect="off">
            </div>
            <div class="form-group">
                <label for="kab_kota">Kabupaten / Kota</label>
                <input type="text" name="kab_kota" id="kab_kota" class="form-control form-control-md" autocomplete="off" autocorrect="off">
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <input type="text" name="provinsi" id="provinsi" class="form-control form-control-md" autocomplete="off" autocorrect="off">
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telepon</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control form-control-md" autocomplete="off" autocorrect="off">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" class="form-control form-control-md" autocomplete="off" autocorrect="off">
            </div>
            <div class="d-flex justify-content-between">
                <a href="javascript:void(0)" class="btn btn-success btn-sm" id="backDiri"><i class="fa fa-arrow-left"></i> Data Diri</a>
                <a href="javascript:void(0)" class="btn btn-success btn-sm" id="nextPekerjaan">Data Pekerjaan<i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="card" id="dataPekerjaan">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-dark mb-dark">Data Pekerjaan</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
                <select name="pekerjaan" id="pekerjaan" class="form-control form-control-md" required>
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
                <label for="pekerjaan_lainnya">Pekerjaan <span class="text-danger">*</span></label>
                <input type="text" name="pekerjaan_lainnya" id="pekerjaan_lainnya" class="form-control form-control-md" disabled>
            </div>
            <div class="form-group">
                <label for="nama_perusahaan">Nama Instansi</label>
                <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control form-control-md" autocomplete="off" autocorrect="off">
            </div>
            <div class="form-group">
                <label for="alamat_perusahaan">Alamat Instansi</label>
                <textarea name="alamat_perusahaan" id="alamat_perusahaan" rows="3" class="form-control form-control-md"></textarea>
            </div>
            <div class="form-group">
                <label for="no_telp_perusahaan">No. Telepon</label>
                <input type="text" name="no_telp_perusahaan" id="no_telp_perusahaan" class="form-control form-control-md" autocomplete="off" autocorrect="off">
            </div>
            <div class="d-flex justify-content-between">
                <a href="javascript:void(0)" class="btn btn-success btn-sm" id="backAlamat"><i class="fa fa-arrow-left"></i> Data Alamat</a>
                <a href="javascript:void(0)" class="btn btn-success btn-sm" id="nextOrtu"><i class="fa fa-arrow-right"></i> Data Ortu</a>
            </div>
        </div>
    </div>

    <div class="card" id="dataOrtu">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-dark mb-dark">Data Orang Tua</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="nama_ibu">Nama Ibu <span class="text-danger">*</span></label>
                <input type="text" name="nama_ibu" id="nama_ibu" class="form-control form-control-md" autocomplete="off" autocorrect="off" required>
            </div>
            <div class="form-group">
                <label for="t4_lahir_ibu">Tempat Lahir</label>
                <input type="text" name="t4_lahir_ibu" id="t4_lahir_ibu" class="form-control form-control-md" autocomplete="off" autocorrect="off">
            </div>
            <div class="form-group">
                <label for="tgl_lahir_ibu">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir_ibu" id="tgl_lahir_ibu" class="form-control form-control-md">
            </div>
            <div class="form-group">
                <label for="nama_ayah">Nama Ayah <span class="text-danger">*</span></label>
                <input type="text" name="nama_ayah" id="nama_ayah" class="form-control form-control-md" autocomplete="off" autocorrect="off" required>
            </div>
            <div class="form-group">
                <label for="t4_lahir_ayah">Tempat Lahir</label>
                <input type="text" name="t4_lahir_ayah" id="t4_lahir_ayah" class="form-control form-control-md" autocomplete="off" autocorrect="off">
            </div>
            <div class="form-group">
                <label for="tgl_lahir_ayah">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir_ayah" id="tgl_lahir_ayah" class="form-control form-control-md">
            </div>
            <div class="d-flex justify-content-between">
                <a href="javascript:void(0)" class="btn btn-success btn-sm" id="backPekerjaan"><i class="fa fa-arrow-left"></i> Data Pekerjaan</a>
                <button type="submit" class="btn btn-info btn-sm" id="tambah">Tambah Peserta</button>
            </div>
        </div>
    </div>
</form>


<!-- modal detail peserta -->
    <div class="modal fade" id="generatePeserta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Generate Data Peserta</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tipe_generate">Tipe Peserta</label>
                        <select name="tipe_generate" id="tipe_generate" class="form-control form-control-md">
                            <option value="">Pilih Tipe Peserta</option>
                            <option value="reguler">Peserta Reguler</option>
                            <option value="pv khusus">Peserta Privat Khusus</option>
                            <option value="pv luar">Peserta Luar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="peserta">Peserta</label>
                        <select name="id_generate" id="id_generate" class="form-control form-control-md">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-info btn-sm" id="btnGenerate">Generate Peserta</button>
                </div>
            </div>
        </div>
    </div>
<!-- modal detail peserta -->

<?= footer()?>
<script>
    <?php if( $this->session->flashdata('pesan') ) : ?>
        Toast.fire({
            icon: "success",
            title: "<?= $this->session->flashdata('pesan')?>"
        });
    <?php endif; ?>
    
    $("#tambahPeserta").addClass("active");
    $("#dataDiri").hide();
    $("#dataAlamat").hide();
    $("#dataPekerjaan").hide();
    $("#dataOrtu").hide();

    <?php if( $this->session->flashdata('pesan') ) : ?>
        Toast.fire({
            icon: "success",
            title: "<?= $this->session->flashdata('pesan')?>"
        });
    <?php endif; ?>

    $("#info").change(function(){
        var info = $("#info").val();
        
        if(info == "Lainnya"){
            $("#civitas").attr("disabled", false);
        } else {
            $("#civitas").attr("disabled", true);
        }
    })

    $("#pekerjaan").change(function(){
        var pekerjaan = $("#pekerjaan").val();
        
        if(pekerjaan == "Lainnya"){
            $("#pekerjaan_lainnya").attr("disabled", false);
        } else {
            $("#pekerjaan_lainnya").attr("disabled", true);
        }
    })

    //data akademik
    $("#nextDiri").click(function(){
        if($("#tipe_peserta").val() == '' || $("#tgl_daftar").val() == '' || $("#program").val() == '' || $("#info").val() == ''){
            Swal.fire({
                icon: 'error',
                text: 'Harap mengisi yang bertanda *'
            })
        } else {
            var info = $("#info").val();

            if(info == "Lainnya" && $("#civitas").val() == ''){
                Swal.fire({
                    icon: 'error',
                    text: 'Harap mengisi yang bertanda *'
                })
            } else {
                $("#progress").css("width", "25%");
                $("#progress").html("25%");
                $("#dataAkademik").hide();
                $("#dataDiri").show();
                $("#dataAlamat").hide();
                $("#dataPekerjaan").hide();
                $("#dataOrtu").hide();
            }
        }
    })

    //data diri
    $("#backAkademik").click(function(){
        $("#progress").css("width", "0%");
        $("#progress").html("0%");
        $("#dataAkademik").show();
        $("#dataDiri").hide();
        $("#dataAlamat").hide();
        $("#dataPekerjaan").hide();
        $("#dataOrtu").hide();
    })

    $("#nextAlamat").click(function(){
        if($("#nama_peserta").val() == '' || $("#jk").val() == '' || $("#pendidikan").val() == '' || $("#status_nikah").val() == ''){
            Swal.fire({
                icon: 'error',
                text: 'Harap mengisi yang bertanda *'
            })
        } else {
            $("#progress").css("width", "50%");
            $("#progress").html("50%");
            $("#dataAkademik").hide();
            $("#dataDiri").hide();
            $("#dataAlamat").show();
            $("#dataPekerjaan").hide();
            $("#dataOrtu").hide();
        }
    })

    // data alamat
    $("#backDiri").click(function(){
        $("#progress").css("width", "25%");
        $("#progress").html("25%");
        $("#dataAkademik").hide();
        $("#dataDiri").show();
        $("#dataAlamat").hide();
        $("#dataPekerjaan").hide();
        $("#dataOrtu").hide();
    })

    $("#nextPekerjaan").click(function(){
        if($("#alamat").val() == ''){
            Swal.fire({
                icon: 'error',
                text: 'Harap mengisi yang bertanda *'
            })
        } else {
            $("#progress").css("width", "75%");
            $("#progress").html("75%");
            $("#dataAkademik").hide();
            $("#dataDiri").hide();
            $("#dataAlamat").hide();
            $("#dataPekerjaan").show();
            $("#dataOrtu").hide();
        }
    })
    
    //data pekerjaan
    $("#backAlamat").click(function(){
        $("#progress").css("width", "50%");
        $("#progress").html("50%");
        $("#dataAkademik").hide();
        $("#dataDiri").hide();
        $("#dataAlamat").show();
        $("#dataPekerjaan").hide();
        $("#dataOrtu").hide();
    })
    

    $("#nextOrtu").click(function(){
        if($("#pekerjaan").val() == ''){
            Swal.fire({
                icon: 'error',
                text: 'Harap mengisi yang bertanda *'
            })
        } else {
            var pekerjaan = $("#pekerjaan").val();

            if(pekerjaan == "Lainnya" && $("#pekerjaan_lainnya").val() == ''){
                Swal.fire({
                    icon: 'error',
                    text: 'Harap mengisi yang bertanda *'
                })
            } else {
                $("#progress").css("width", "100%");
                $("#progress").html("100%");
                $("#dataAkademik").hide();
                $("#dataDiri").hide();
                $("#dataAlamat").hide();
                $("#dataPekerjaan").hide();
                $("#dataOrtu").show();
            }
        }
    })

    // data ortu
    $("#backPekerjaan").click(function(){
        $("#progress").css("width", "75%");
        $("#progress").html("75%");
        $("#dataAkademik").hide();
        $("#dataDiri").hide();
        $("#dataAlamat").hide();
        $("#dataPekerjaan").show();
        $("#dataOrtu").hide();
    })

    $("#tambah").click(function(){
        if($("#nama_ayah").val() == '' || $("#nama_ibu").val() == ''){
            Swal.fire({
                icon: 'error',
                text: 'Harap mengisi yang bertanda *'
            })
        } else {
            var c = confirm('Yakin akan menambahkan data?')
            return c;
        }
    })

    // generate peserta 
        $("#tipe_generate").change(function(){
            let tipe = $(this).val();

            $.ajax({
                url: "<?= base_url()?>pendaftaran/get_peserta_by_tipe",
                dataType: "JSON",
                data: {tipe: tipe},
                method: "POST",
                success: function(result){
                    html = "";
                    result.forEach(peserta => {
                        html += `<option value="`+peserta.id_peserta+`">`+peserta.nama_peserta+`</option>`
                    });
                    $("#id_generate").html(html);
                }
            })
        })
        
        $("#btnGenerate").click(function(){
            let id_peserta = $("#id_generate").val();

            $.ajax({
                url: "<?= base_url()?>peserta/get_detail_peserta",
                dataType: "JSON",
                data: {id: id_peserta},
                method: "POST",
                success: function(data){
                    // console.log(data);
                    if(data.diri != null){
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

                        $("#generatePeserta").modal("hide");
                        Toast.fire({
                            icon: "success",
                            title: "Berhasil mengenerate data " + data.diri.nama_peserta
                        });
                        // $(".msg-generate").html(`<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil mengenerate data `+data.diri.nama_peserta+`<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`)
                    } else {
                        $("#formPendaftaran").trigger("reset");
                        $("#generatePeserta").modal("hide");

                        Toast.fire({
                            icon: "success",
                            title: "Gagal mengenerate data"
                        });
                        // $(".msg-generate").html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal mengenerate data<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`)
                    }
                    
                }
            })
        })
    // generate peserta 
</script>