<!-- modal transaksi lain -->
    <div class="modal fade" id="modalTransaksi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title nama-title" id="exampleModalScrollableTitle">Transaksi Lainnya</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?=base_url()?>transaksi/add_transaksi_lain" method="post">
                        <input type="hidden" name="tipe" id="" value="Lainnya">
                        <input type="hidden" name="pengajar" value="-">
                        <div class="form-group">
                            <label for="nama_pembayaran">Nama</label>
                            <input type="text" name="nama_pembayaran" id="nama_pembayaran" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="untuk">Pembayaran Untuk?</label>
                            <select name="keterangan" id="untuk" class="form-control form-control-sm" required>
                                <option value="">Pilih Pembayaran Untuk</option>
                                <option value="Buku">Buku</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl">Tgl</label>
                            <input type="date" name="tgl" id="tgl" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="metode">Metode Pembayaran</label>
                            <select name="metode" id="metode" class="form-control form-control-sm" required>
                                <option value="">Pilih Tipe</option>
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="uraian">Keterangan</label>
                            <textarea name="uraian" id="uraian" class="form-control form-control-sm" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nominal_deposit">Nominal</label>
                            <input type="text" name="nominal" id="nominal_deposit" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group" id="formAlamat">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="d-flex justify-content-end mb-3">
                            <input type="submit" value="Tambah Transaksi" class="btn btn-sm btn-success" id="btn-submit-3">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <!-- <input type="submit" value="Tambah Transaksi" class="btn btn-sm btn-success" id="btn-submit-3"> -->
                </div>
            </div>
        </div>
    </div>
<!-- modal transaksi lain -->

<!-- modal edit transaksi -->
    <div class="modal fade" id="modalEditPembayaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit">Edit Pembayaran</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body cus-font">
                <form action="<?=base_url()?>transaksi/edit_transaksi" method="POST" id="form-edit">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_edit">Nama</label>
                        <input type="text" name="nama" id="nama_edit" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="tgl_edit">Tanggal</label>
                        <input type="date" name="tgl" id="tgl_edit" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="form-group">
                        <label for="uraian_edit">Keterangan</label>
                        <textarea name="uraian" id="uraian_edit" rows="2" class="form-control form-control-sm"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nominal_edit">Nominal</label>
                        <input type="text" name="nominal" id="nominal_edit" class="form-control form-control-sm">
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <input type="submit" class="btn btn-success btn-sm" value="Edit" id="submitEditPembayaran">
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- modal edit transaksi -->

<div class="">
    <a href="javascript:void(0)" data-bs-toggle="modal" class="btn btn-success btn-sm mb-3 modalTransaksi" data-bs-toggle="modal" data-bs-target="#modalTransaksi">Tambah Transaksi</a>
</div>

<div class="card shadow mb-4 overflow-auto">
    <div class="card-body">
        <table id="tableData" class="table table-hover align-items-center mb-0 text-dark">
            <thead>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder w-1 desktop">Tgl</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Nama</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Keterangan</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Nominal</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Metode</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Action</th>
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
            icon: "info",
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
        ajax: { url: `<?= base_url()?>transaksi/getListTransaksiLainnya`, type: "POST" },
        columns: [
            { data: "tgl", orderable: true, searchable: false, className: "text-sm w-1 text-center" },
            { data: "nama", orderable: true, searchable: true, className: "text-sm" },
            { data: "uraian", orderable: false, searchable: false, className: "text-sm w-1" },
            { 
                data: "nominal", 
                orderable: false, 
                searchable: false, 
                className: "text-sm w-1",
                render : function(data, type, row){
                    return `Rp ${parseInt(row['nominal']).toLocaleString("id-ID")}`;
                }
            },
            { data: "metode", orderable: true, searchable: true, className: "text-sm w-1" },
            { 
                data: null, 
                orderable: false, 
                searchable: false, 
                className: "text-sm w-1 text-center",
                render: function(data, type, row) {
                    if(row['metode'] == 'Cash'){
                        return `
                            <a href="<?=base_url()?>transaksi/kuitansi/${row['id']}" target="_blank">
                                <span class="badge bg-gradient-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
                                        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                    </svg>
                                </span>
                            </a>
                            <a href="javascript:void(0)" class="modalEditPembayaran" data-bs-toggle="modal" data-bs-target="#modalEditPembayaran" data-id="${row['id']}">
                                <span class="badge bg-gradient-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                    </svg>
                                </span>
                            </a>
                        `;
                    } else {
                        return `-`;
                    }
                }
            },
        ],
        order: [[0, "desc"]],
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

    $("#piutang").addClass("active")

    $("#metode").change(function(){
        let metode = $(this).val();
        if(metode == "Transfer"){
            $("#formAlamat").show();
        } else {
            $("#formAlamat").hide();
        }
    })

    $(document).on("click", ".modalEditPembayaran", function(){
        let id = $(this).data("id");
        console.log(id)
        $.ajax ({
            url : "<?=base_url()?>transaksi/get_data_pembayaran",
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success : function(data){
                $("#id").val(data.id_pembayaran);
                $("#nama_edit").val(data.nama_pembayaran);
                $("#tgl_edit").val(data.tgl_pembayaran);
                $("#uraian_edit").val(data.uraian);
                $("#nominal_edit").val(data.nominal);
            }
        })
    })

    // validasi
    $("input[name='nominal']").keyup(function(){
        $(this).val(formFormatRupiah(this.value, 'Rp. '))
    })

    // submit
    $("#btn-submit-1, #btn-submit-2, #btn-submit-3").click(function(){
      var c = confirm("Yakin akan menambahkan data?");
      return c;
    })

    $("#submitEditPembayaran").click(function(){
        var c = confirm("Yakin akan mengubah data transaksi?");
        return c;
    })
</script>