<div class="modal fade" id="modalDetailPesertaReguler" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalDetailPesertaRegulerTitle"></h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <form action="<?= base_url()?>peserta/edit_peserta" method="post" id="form-edit-peserta">
                    <input type="hidden" name="id_peserta" id="id_peserta">
                    <div class="card-body">
                        <span class="badge bg-gradient-secondary btn-navigation active" data-menu="menu-data-diri">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5"/>
                                <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12z"/>
                            </svg>
                        </span>
                        <span class="badge bg-gradient-secondary btn-navigation" data-menu="menu-data-alamat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                            </svg>
                        </span>
                        <span class="badge bg-gradient-secondary btn-navigation" data-menu="menu-data-pekerjaan">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
                                <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                                <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z"/>
                            </svg>
                        </span>
                        <span class="badge bg-gradient-secondary btn-navigation" data-menu="menu-data-orangtua">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-hearts" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.5 1.246c.832-.855 2.913.642 0 2.566-2.913-1.924-.832-3.421 0-2.566M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276ZM15 2.165c.555-.57 1.942.428 0 1.711-1.942-1.283-.555-2.281 0-1.71Z"/>
                            </svg>
                        </span>
                        
                        <div class="mt-3"></div>

                        <div class="menu-navigation" id="menu-data-diri">
                            <h6 class="m-0 font-weight-bold text-dark mb-3">Data Diri</h6>
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
                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm btn-navigation" data-menu="menu-data-alamat">Data Alamat <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="menu-navigation" id="menu-data-alamat">
                            <h6 class="m-0 font-weight-bold text-dark mb-3">Data Alamat</h6>
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
                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm btn-navigation" data-menu="menu-data-diri"><i class="fa fa-arrow-left"></i> Data Diri</a>
                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm btn-navigation" data-menu="menu-data-pekerjaan">Data Pekerjaan <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="menu-navigation" id="menu-data-pekerjaan">
                            <h6 class="m-0 font-weight-bold text-dark mb-3">Data Pekerjaan</h6>
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
                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm btn-navigation" data-menu="menu-data-alamat"><i class="fa fa-arrow-left"></i> Data Alamat</a>
                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm btn-navigation" data-menu="menu-data-orangtua">Data Ortu <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="menu-navigation" id="menu-data-orangtua">
                            <h6 class="m-0 font-weight-bold text-dark mb-3">Data Orang Tua</h6>
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
                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm btn-navigation" data-menu="menu-data-pekerjaan"><i class="fa fa-arrow-left"></i> Data Pekerjaan</a>
                                <button type="submit" class="btn btn-success btn-sm" id="ubahData">Ubah Data</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalWlReguler" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalWlRegulerTitle">Pindah Waiting List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle text-info mr-1"></i> Menu ini untuk memindahkan peserta nonaktif ke waiting list
                    </div>
                    <form action="<?=base_url()?>peserta/pindah_peserta_reguler_wl" method="post">
                        <input type="hidden" name="id_peserta">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input class='form-control form-control-sm' type="text" name="nama" readonly>
                        </div>
                        <div class="form-group">
                            <label for="program">Program</label>
                            <select name="program" class="form-control form-control-sm" required>
                                <option value="">Pilih Program</option>
                                <?php foreach ($program as $prog) :?>
                                    <option value="<?= $prog['nama_program']?>"><?= $prog['nama_program']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <select name="hari" class="form-control form-control-sm" required>
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
                            <label for="jam">Jam</label>
                            <select name="jam" class="form-control form-control-sm" required>
                                <option value="">Pilih Jam</option>
                                <option value="08.30-10.00">08.30-10.00</option>
                                <option value="10.00-11.30">10.00-11.30</option>
                                <option value="13.00-14.30">13.00-14.30</option>
                                <option value="15.30-17.00">15.30-17.00</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Pindah WL" class="btn btn-warning" id="pindah-wl">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>


<div class="card shadow mb-4 overflow-auto">
    <div class="card-body">
        <table id="tableData" class="table table-hover align-items-center mb-0 text-dark">
            <thead>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder w-1 desktop">Status</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Nama Peserta</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">No Hp</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Program</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Tempat</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Hari</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Jam</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Pengajar</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder w-1 all">Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<?= footer()?>

<script>
    <?php if( $this->session->flashdata('pesan') ) : ?>
        Toast.fire({
            icon: "success",
            title: "<?= $this->session->flashdata('pesan')?>"
        });
    <?php endif; ?>
    
    $("#peserta").addClass("active");
    
    $("#btn-form-1").addClass('active');
    $("#btn-form-2").removeClass('active');
    $("#btn-form-3").removeClass('active');
    $("#btn-form-4").removeClass('active');
    
    $("#form-1").show();
    $("#form-2").hide();
    $("#form-3").hide();
    $("#form-4").hide();

    var dataTable = $('#tableData').DataTable({
        initComplete: function () {
            var api = this.api();
            $("#mytable_filter input")
                .off(".DT")
                .on("input.DT", function () {
                    api.search(this.value).draw();
                });
        },
        oLanguage: {
            sProcessing: "loading...",
        },
        language: {
            paginate: {
                first: '<<',
                previous: '<',
                next: '>',
                last: '>>'
            }
        },
        processing: true,
        serverSide: true,
        ajax: { url: `<?= base_url()?>peserta/getListPesertaReguler/<?= $status?>`, type: "POST" },
        columns: [
            { data: "status", orderable: true, searchable: true, className: "text-sm w-1 text-center" },
            { data: "nama_peserta", orderable: true, searchable: true, className: "text-sm" },
            { data: "no_hp", orderable: true, searchable: true, className: "text-sm w-1" },
            { 
                data: 'program', 
                orderable: true, 
                searchable: true, 
                className: "text-sm w-1",
                render: function(data, type, row){
                    if(row['status'] == 'nonaktif'){
                        return row['program_peserta']
                    } else {
                        return row['program']
                    }
                }
            },
            { 
                data: 'tempat', 
                orderable: true, 
                searchable: true, 
                className: "text-sm w-1",
                render: function(data, type, row){
                    if(row['status'] == 'nonaktif'){
                        return `-`
                    } else {
                        return row['tempat']
                    }
                }
            },
            { 
                data: 'hari', 
                orderable: false, 
                searchable: false, 
                className: "text-sm w-1",
                render: function(data, type, row){
                    if(row['status'] == 'nonaktif'){
                        return row['hari_peserta']
                    } else {
                        return row['hari']
                    }
                }
            },
            { 
                data: null, 
                orderable: false, 
                searchable: false, 
                className: "text-sm w-1",
                render: function(data, type, row){
                    if(row['status'] == 'nonaktif'){
                        return row['jam_peserta']
                    } else {
                        return row['jam']
                    }
                }
            },
            { 
                data: 'nama_kpq', 
                orderable: true, 
                searchable: true, 
                className: "text-sm w-1",
                render: function(data, type, row){
                    if(row['status'] == 'nonaktif'){
                        return '-'
                    } else {
                        return row['nama_kpq']
                    }
                }
            },
            { 
                data: null, 
                orderable: false, 
                searchable: false, 
                className: "text-sm w-1 text-center",
                render: function(data, type, row) {
                    return `
                        <a href="javascript:void(0)" class="modalDetailPesertaReguler" data-bs-toggle="modal" data-bs-target="#modalDetailPesertaReguler" data-id="${row['id_peserta']}">
                            <span class="badge bg-gradient-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                </svg>
                            </span>
                        </a>
                    `;
                }
            },
        ],
        order: [[0, "asc"]],
        rowReorder: {
            selector: "td:nth-child(0)",
        },
        responsive: true,
        pageLength: 5,
        lengthMenu: [
        [5, 10, 20],
        [5, 10, 20]
        ]
    });

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

    $(document).on("click", ".modalDetailPesertaReguler", function(){
        const id = $(this).data('id');
        $.ajax({
            url : "<?=base_url()?>peserta/get_detail_peserta",
            method : "POST",
            data : {id : id},
            async : true,
            dataType : 'json',
            success : function(data){
                $("#modalDetailPesertaRegulerTitle").html(data.diri.nama_peserta);

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

        let data = 'menu-data-diri';
        // Remove and add classes to navigation buttons
        $(".btn-navigation").removeClass("bg-gradient-info").addClass("bg-gradient-secondary");
        $(`[data-menu='${data}']`).removeClass("bg-gradient-secondary").addClass("bg-gradient-info");

        // Hide all menu-navigation elements and show the one with the specified data-menu
        $(".menu-navigation").hide();
        $("#" + data).show();
    })
    
    $(".modalWlReguler").click(function(){
        const id = $(this).data('id');
        
        $.ajax({
            url : "<?=base_url()?>peserta/detail",
            method : "POST",
            data : {id : id},
            async : true,
            dataType : 'json',
            success : function(data){
                // console.log(data);
                $("input[name='id_peserta']").val(data.id_peserta);
                $("input[name='nama']").val(data.nama_peserta);
                $("select[name='program']").val(data.program);
                $("select[name='hari']").val(data.hari);
                $("select[name='jam']").val(data.jam);
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
    
    $("#pindah-wl").click(function(){
        var c = confirm("Yakin akan memindahkan peserta ke waiting list?");
        return c;
    })

    $(".btn-navigation").on("click", function(){
        $(".alert-error").hide();

        let data = $(this).data("menu");

        $(".btn-navigation").removeClass("bg-gradient-info");
        $(".btn-navigation").removeClass("bg-gradient-secondary");
        $(".btn-navigation").addClass("bg-gradient-secondary");

        $(`[data-menu='${data}']`).removeClass("bg-gradient-secondary");
        $(`[data-menu='${data}']`).addClass("bg-gradient-info");

        $(".menu-navigation").hide();
        $("#" + data).show();
    })
</script>
