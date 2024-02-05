
<div class="card shadow mb-4 overflow-auto">
    <div class="card-body">
        <table id="tableData" class="table table-hover align-items-center mb-0 text-dark">
            <thead>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder w-1 desktop">Status</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Koor</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">No HP</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Program</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Pengajar</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder w-1 all">Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalDetailKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Detail Kelas</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
            <div class="card-body">
                <span class="badge bg-gradient-secondary btn-navigation active" data-menu="menu-data-kelas">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journals" viewBox="0 0 16 16">
                        <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2z"/>
                        <path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0z"/>
                    </svg>
                </span>
                <span class="badge bg-gradient-secondary btn-navigation" data-menu="menu-peserta">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                </span>
                <span class="badge bg-gradient-secondary btn-navigation" data-menu="menu-jadwal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                        <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23"/>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                    </svg>
                </span>
                
                <div class="mt-3"></div>

              <ul class="list-group text-sm menu-navigation" id="menu-data-kelas">
                <li class="list-group-item list-group-item-info">Data Akademik</li>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-6">
                      Status
                    </div>
                    <div class="col-6" id="status"> 
                      
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-6">
                      Program
                    </div>
                    <div class="col-6" id="program"> 
                      
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-6">
                      Koordinator
                    </div>
                    <div class="col-6" id="koordinator"> 
                      
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-6">
                      Pengajar
                    </div>
                    <div class="col-6" id="kpq"> 
                      
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-6">
                      Tipe Pengajar
                    </div>
                    <div class="col-6" id="pengajar"> 
                      
                    </div>
                  </div>
                </li>
              </ul>

              <ul class="list-group text-sm menu-navigation" id="menu-peserta">
                <li class="list-group-item list-group-item-info">List Peserta <span class="badge bg-danger badge-pill" id="totalPeserta"></span></li>
                <div id="list-peserta"></div>
                <a href="" class="list-group-item bg-success text-light" id="pesertaBaru">
                  <i class="fa fa-user-plus"></i> Tambah Peserta
                </a>
              </ul>
              
              <ul class="list-group text-sm menu-navigation" id="menu-jadwal">
                <li class="list-group-item list-group-item-info">List Jadwal <span class="badge bg-danger badge-pill" id="totalJadwal"></span></li>
                <div id="list-jadwal"></div>
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

<?= footer()?>

<script>
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
        ajax: { url: `<?= base_url()?>kelas/getListKelasPrivat/<?= $tipe?>`, type: "POST" },
        columns: [
            { data: "status", orderable: true, searchable: true, className: "text-sm w-1 text-center" },
            { data: "nama_peserta", orderable: true, searchable: true, className: "text-sm" },
            { data: "no_hp", orderable: true, searchable: true, className: "text-sm w-1" },
            { data: "program", orderable: true, searchable: true, className: "text-sm w-1 text-center" },
            { data: "nama_kpq", orderable: true, searchable: true, className: "text-sm" },
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

    $(document).on("click", ".modalKelas", function(){
        const id = $(this).data('id');
        $("#pesertaBaru").attr("href", "<?=base_url()?>pendaftaran/pesertabaru/"+id);
        $("#detailKelas").data('id', id);
        $("#detailPeserta").data('id', id);
        $("#detailJadwal").data('id', id);
        // console.log(id);
        $.ajax({
            url : "<?=base_url()?>kelas/datakelasreguler",
            method : "POST",
            data : {id_kelas : id},
            async : true,
            dataType : 'json',
            success : function(data){
                $("#status").html(data.status);
                $("#program").html(data.program);
                $("#kpq").html(data.nama_kpq);
                $("#pengajar").html(data.pengajar);
            }
        })

        $.ajax({
            url : "<?=base_url()?>kelas/datajadwalbyid",
            method : "POST",
            data : {id_kelas : id},
            async : true,
            dataType : 'json',
            success : function(data){
                // console.log(data)
                $('#totalJadwal').html(data.length);
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<li class="list-group-item">'+data[i].tempat+' ('+data[i].hari+' '+data[i].jam+')</li>';
                }
                $('#list-jadwal').html(html);
            }
        })

        $.ajax({
            url : "<?=base_url()?>kelas/datapesertabyid",
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