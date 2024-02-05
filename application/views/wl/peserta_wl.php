<div class="modal fade" id="modalDetailWL" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailWLTitle">Modal title</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
        <form action="<?=base_url()?>peserta/edit" method="post">
            <div class="card">
                <!-- <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#" class='nav-link' id="btn-form-1" data-id=""><i class="fas fa-book"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class='nav-link' id="btn-form-2" data-id=""><i class="fas fa-user"></i></a>
                        </li>
                    </ul>
                </div> -->
                <div class="card-body">
                    <span class="badge bg-gradient-secondary btn-navigation" data-menu="menu-data-akademik">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal" viewBox="0 0 16 16">
                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                        </svg>
                    </span>
                    <span class="badge bg-gradient-secondary btn-navigation" data-menu="menu-data-diri">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                            <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5"/>
                            <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12z"/>
                        </svg>
                    </span>
                    
                    <div class="mt-3"></div>

                    <input type="hidden" name="id_peserta" id="id_peserta">
                    
                    <div class="form-detail menu-navigation" id="menu-data-akademik">
                        <h6 class="m-0 font-weight-bold text-dark mb-3">Data Akademik</h6>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="">Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="wl">WL</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="program">Program</label>
                            <select name="program" id="program" class="form-control form-control-sm">
                                <option value="">Pilih Program</option>
                                <option value="Pra Tahsin 1">Pra Tahsin 1</option>
                                <option value="Pra Tahsin 2">Pra Tahsin 2</option>
                                <option value="Pra Tahsin 3">Pra Tahsin 3</option>
                                <option value="Tahsin 1">Tahsin 1</option>
                                <option value="Tahsin 2">Tahsin 2</option>
                                <option value="Tahsin 3">Tahsin 3</option>
                                <option value="Tahsin 4">Tahsin 4</option>
                                <option value="Tahsin Lanjutan">Tahsin Lanjutan</option>
                                <option value="Tahfidz Anak">Tahfidz Anak</option>
                                <option value="Tahfidz Dewasa">Tahfidz Dewasa</option>
                                <option value="Bahasa Arab 1">Bahasa Arab 1</option>
                                <option value="Bahasa Arab 2">Bahasa Arab 2</option>
                                <option value="Bahasa Arab 3">Bahasa Arab 3</option>
                                <option value="Bahasa Arab 4">Bahasa Arab 4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <select name="hari" id="hari" class="form-control form-control-sm">
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
                            <select name="jam" id="jam" class="form-control form-control-sm">
                                <option value="">Pilih Jam</option>
                                <option value="05.00-06.30">05.00-06.30</option>
                                <option value="05.30-07.00">05.30-07.00</option>
                                <option value="06.00-07.30">06.00-07.30</option>
                                <option value="06.30-08.00">06.30-08.00</option>
                                <option value="07.00-08.30">07.00-08.30</option>
                                <option value="07.30-09.00">07.30-09.00</option>
                                <option value="08.00-09.30">08.00-09.30</option>
                                <option value="08.30-10.00">08.30-10.00</option>
                                <option value="09.00-10.30">09.00-10.30</option>
                                <option value="09.30-11.00">09.30-11.00</option>
                                <option value="10.00-11.30">10.00-11.30</option>
                                <option value="10.30-12.00">10.30-12.00</option>
                                <option value="11.00-12.30">11.00-12.30</option>
                                <option value="11.30-13.00">11.30-13.00</option>
                                <option value="12.00-13.30">12.00-13.30</option>
                                <option value="12.30-14.00">12.30-14.00</option>
                                <option value="13.00-14.30">13.00-14.30</option>
                                <option value="13.30-15.00">13.30-15.00</option>
                                <option value="14.00-15.30">14.00-15.30</option>
                                <option value="14.30-16.00">14.30-16.00</option>
                                <option value="15.00-16.30">15.00-16.30</option>
                                <option value="15.30-17.00">15.30-17.00</option>
                                <option value="16.00-17.30">16.00-17.30</option>
                                <option value="16.30-18.00">16.30-18.00</option>
                                <option value="17.00-18.30">17.00-18.30</option>
                                <option value="17.30-19.00">17.30-19.00</option>
                                <option value="18.00-19.30">18.00-19.30</option>
                                <option value="18.30-20.00">18.30-20.00</option>
                                <option value="19.00-20.30">19.00-20.30</option>
                                <option value="19.30-21.00">19.30-21.00</option>
                                <option value="20.00-21.30">20.00-21.30</option>
                                <option value="20.30-22.00">20.30-22.00</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat">Tempat Belajar</label>
                            <textarea name="tempat" id="tempat" class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tgl_masuk">Tgl Masuk</label>
                            <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    
                    <div class="form-detail menu-navigation" id="menu-data-diri">
                        <h6 class="m-0 font-weight-bold text-dark mb-3">Data Diri</h6>

                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input class='form-control form-control-sm' type="text" name="nama" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Handphone</label></td>
                            <input class='form-control form-control-sm' type="text" name="no_hp" id="no_hp">
                        </div>
                        <div class="form-group">
                            <label for="jk">Gender</label>
                            <select name="jk" id="jk" class='form-control form-control-sm'>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat_peserta">Alamat</label>
                            <textarea class='form-control form-control-sm' name="alamat_peserta" id="alamat_peserta" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                <input type="submit" class="btn btn-sm btn-success btn-sm" value="Update" id="editPeserta">
            </div>
        </form>
    </div>
  </div>
</div>

<div class="card shadow mb-4 overflow-auto">
    <div class="card-body">
        <table id="tableData" class="table table-hover align-items-center mb-0 text-dark">
            <thead>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder w-1 desktop">Status</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Nama Peserta</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Program</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Hari</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Jam</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Gender</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">No HP</th>
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
        ajax: { url: `<?= base_url()?>wl/getListWLReguler`, type: "POST" },
        columns: [
            { data: "status", orderable: true, searchable: true, className: "text-sm w-1 text-center" },
            { data: "nama_peserta", orderable: true, searchable: true, className: "text-sm" },
            { data: "program", orderable: true, searchable: true, className: "text-sm w-1" },
            { data: "hari", orderable: true, searchable: true, className: "text-sm w-1" },
            { data: "jam", orderable: true, searchable: true, className: "text-sm w-1" },
            { data: "jk", orderable: true, searchable: true, className: "text-sm w-1" },
            { data: "no_hp", orderable: true, searchable: true, className: "text-sm w-1" },
            { 
                data: null, 
                orderable: false, 
                searchable: false, 
                className: "text-sm w-1 text-center",
                render: function(data, type, row) {
                    return `
                        <a href="javascript:void(0)" class="modalDetailWL" data-bs-toggle="modal" data-bs-target="#modalDetailWL" data-id="${row['id_peserta']}">
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
    
    $(document).on("click", ".modalDetailWL", function(){
        const id = $(this).data('id');
        $.ajax({
            url : "<?=base_url()?>peserta/detail",
            method : "POST",
            data : {id : id},
            async : true,
            dataType : 'json',
            success : function(data){
                $(".modal-title").html(data.nama_peserta);
                $("#id_peserta").val(data.id_peserta);
                $("#nama").val(data.nama_peserta);
                $("#status").val(data.status);
                $("#no_hp").val(data.no_hp);
                $("#tgl_masuk").val(data.tgl_masuk);
                $("#jk").val(data.jk);
                $("#program").val(data.program);
                $("#hari").val(data.hari);
                $("#jam").val(data.jam);
                $("#tempat").val(data.tempat);
                $("#alamat_peserta").val(data.alamat);
            }
        })

        let data = 'menu-data-akademik';
        // Remove and add classes to navigation buttons
        $(".btn-navigation").removeClass("bg-gradient-info").addClass("bg-gradient-secondary");
        $(`[data-menu='${data}']`).removeClass("bg-gradient-secondary").addClass("bg-gradient-info");

        // Hide all menu-navigation elements and show the one with the specified data-menu
        $(".menu-navigation").hide();
        $("#" + data).show();
    })

    $("#editPeserta").click(function(){
        var c = confirm('Yakin akan mengedit data?');
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
