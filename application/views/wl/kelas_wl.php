<div class="modal fade" id="modalDetailKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailKelasTitle"></h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">        
                <div class="card">
                    <!-- <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                            <a href="#" class='nav-link' id="detailKelas" data-id=""><i class="fas fa-book"></i></a>
                            </li>
                            <li class="nav-item">
                            <a href="#" class='nav-link' id="detailPeserta" data-id=""><i class="fas fa-user"></i></a>
                            </li>
                        </ul>
                    </div> -->
                    <div class="card-body">
                        <span class="badge bg-gradient-secondary btn-navigation" data-menu="menu-data-kelas">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal" viewBox="0 0 16 16">
                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                            </svg>
                        </span>
                        <span class="badge bg-gradient-secondary btn-navigation" data-menu="menu-data-peserta">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                            </svg>
                        </span>
                        
                        <div class="mt-3"></div>

                        <div class="menu-navigation" id="menu-data-kelas">
                            <form action="<?=base_url()?>wl/editwl" id="dataKelas" method="POST">
                                <input type="hidden" name="id_kelas" id="id_kelas">
                                <div class="form-group">
                                    <label for="status">Status<span class="text-danger">*</span></label>
                                    <select name="status" id="status" class='form-control form-control-sm' required>
                                        <option value="">Pilih Status</option>
                                        <option value="wl">WL</option>
                                        <option value="nonaktif">Nonaktif</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="program">Program <span class="text-danger">*</span></label>
                                    <select name="program" id="program" class="form-control form-control-sm" required>
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
                                    <label for="pengajar">Pengajar<span class="text-danger">*</span></label>
                                    <select name="pengajar" id="pengajar" class='form-control form-control-sm' required>
                                        <option value="">Pilih Pengajar</option>
                                        <option value="Pria">Ikhwan</option>
                                        <option value="Wanita">Akhwat</option>
                                        <option value="Pria&Wanita">Ikhwan & Akhwat</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tempat">Tempat Belajar <span class="text-danger">*</span></label>
                                    <textarea name="tempat" id="tempat" class="form-control form-control-sm" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Catatan <span class="text-danger">*</span></label>
                                    <textarea name="catatan" id="catatan" class="form-control form-control-sm" required></textarea>
                                    <small id="" class="form-text text-muted">
                                        Catatan diisi dengan jumlah peserta ikhwan dan akhwat, kemudian waktu belajar.
                                    </small>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success btn-sm" id="edit">Update</button>
                                </div>
                            </form>
                        </div>

                        <ul class="list-group text-sm menu-navigation" id="menu-data-peserta">
                            <li class="list-group-item list-group-item-info">List Peserta <span class="badge bg-danger badge-pill" id="totalPeserta"></span></li>
                            <div id="list-peserta"></div>
                            <a href="" class="list-group-item bg-success text-light" id="pesertaBaru">
                                <i class="fa fa-user-plus"></i> Tambah Peserta
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4 overflow-auto">
    <div class="card-body">
        <table id="tableData" class="table table-hover align-items-center mb-0 text-dark">
            <thead>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder w-1 desktop">Status</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Koor</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Tipe</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Program</th>
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
        ajax: { url: `<?= base_url()?>wl/<?= $url?>`, type: "POST" },
        columns: [
            { data: "status", orderable: true, searchable: true, className: "text-sm w-1 text-center" },
            { data: "nama_peserta", orderable: true, searchable: true, className: "text-sm" },
            { data: "tipe_kelas", orderable: true, searchable: true, className: "text-sm w-1" },
            { data: "program", orderable: true, searchable: true, className: "text-sm w-1" },
            { 
                data: null, 
                orderable: false, 
                searchable: false, 
                className: "text-sm w-1 text-center",
                render: function(data, type, row) {
                    return `
                        <a href="javascript:void(0)" class="modalKelas" data-bs-toggle="modal" data-bs-target="#modalDetailKelas" data-id="${row['id_kelas']}">
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

    $("#waitingList").addClass("active");
    $(".detailWl").click(function(){
    var catatan = $(this).data("id");
    $("#catatan_wl").html(catatan);
    // console.log(catatan)
    })


    $(document).on("click", ".modalKelas", function(){
        const id = $(this).data('id');
        $("#pesertaBaru").attr("href", "<?=base_url()?>pendaftaran/pesertabaru/"+id);
        $("#detailKelas").data('id', id);
        $("#detailPeserta").data('id', id);
        $("#detailJadwal").data('id', id);
        // console.log(id);
        $.ajax({
            url : "<?=base_url()?>wl/datakelaswlbyid",
            method : "POST",
            data : {id_kelas : id},
            async : true,
            dataType : 'json',
            success : function(data){
                $(".modal-title").html(data.nama_peserta)
                $("#status").val(data.status);
                $("#program").val(data.program);
                $("#id_kelas").val(data.id_kelas);
                $("#koordinator").html(data.nama_peserta);
                $("#pengajar").val(data.pengajar);
                $("#tempat").val(data.tempat);
                $("#catatan").val(data.catatan);
            }
        })
        
        $.ajax({
            url : "<?=base_url()?>wl/datapesertabyid",
            method : "POST",
            data : {id_kelas : id},
            async : true,
            dataType : 'json',
            success : function(data){
                // console.log(data)
                $('#totalPeserta').html(data.length);
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<li class="list-group-item">'+data[i].nama_peserta+'</li>';
                }
                $('#list-peserta').html(html);
            }
        })

        let data = 'menu-data-kelas';
        // Remove and add classes to navigation buttons
        $(".btn-navigation").removeClass("bg-gradient-info").addClass("bg-gradient-secondary");
        $(`[data-menu='${data}']`).removeClass("bg-gradient-secondary").addClass("bg-gradient-info");

        // Hide all menu-navigation elements and show the one with the specified data-menu
        $(".menu-navigation").hide();
        $("#" + data).show();
    })

    $("#edit").click(function(){
        var c = confirm("Yakin akan mengupdate data?");
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