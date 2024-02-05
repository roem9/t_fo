<!-- modal edit pj -->
    <div class="modal fade" id="modalEditPj" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit PJ</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body cus-font">
                <form action="<?=base_url()?>piutang/edit_pj_by_id" method="POST" id="form-edit">
                <input type="hidden" name="id" id="id_kelas">
                <div class="form-group">
                    <label for="pj">Nama PJ</label>
                    <input type="text" name="pj" id="pj" class="form-control form-control-sm">
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <input type="submit" class="btn btn-success btn-sm" value="Edit">
                </div>
            </form>
            </div>
        </div>
    </div>
<!-- modal edit pj -->

<div class="card shadow mb-4 overflow-auto">
    <div class="card-body">
        <table id="tableData" class="table table-hover align-items-center mb-0 text-dark">
            <thead>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder w-1 desktop">Status</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Koor</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">PJ</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">No HP</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder none">Tgl Mulai</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Pengajar</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Piutang</th>
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
        ajax: { url: `<?= base_url()?>piutang/getListPiutangPrivat/<?= $table?>`, type: "POST" },
        columns: [
            { data: "status", orderable: true, searchable: true, className: "text-sm w-1 text-center" },
            { data: "nama_peserta", orderable: true, searchable: true, className: "text-sm" },
            { 
                data: "pj", 
                orderable: true, 
                searchable: true, 
                className: "text-sm w-1",
                render: function(data, type, row){
                    return `
                        <a href="javascript:void(0)" class="modalEditPj" data-bs-toggle="modal" data-bs-target="#modalEditPj" data-id="${row['id_kelas']}|${row['pj']}">
                            ${row['pj']}
                        </a>
                    `
                }
            },
            { data: "no_hp", orderable: false, searchable: false, className: "text-sm w-1" },
            { data: "tgl_mulai", orderable: false, searchable: false, className: "text-sm" },
            { data: "nama_kpq", orderable: true, searchable: true, className: "text-sm" },
            { 
                data: 'piutang', 
                orderable: true, 
                searchable: false, 
                className: "text-sm w-1 text-center",
                render: function(data, type, row) {
                  let piutang = row['piutang'];

                  let piutangRupiah = parseInt(piutang).toLocaleString("id-ID");

                  if(piutang > 0){
                    return `
                      <a href="<?=base_url()?>kartupiutang/kelas/${row['id_kelas']} " target="_blank"><span class="text-success">Rp ${piutangRupiah}</span></a>
                    `
                  } else if(piutang < 0){
                    return `
                      <a href="<?=base_url()?>kartupiutang/kelas/${row['id_kelas']} " target="_blank"><span class="text-danger">Rp ${piutangRupiah}</span></a>
                    `
                  } else if(piutang == 0){
                    return `
                      <a href="<?=base_url()?>kartupiutang/kelas/${row['id_kelas']} " target="_blank"><span class="text-warning">Rp ${piutangRupiah}</span></a>
                    `
                  }
                }
            },
        ],
        order: [[1, "asc"]],
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

    $("#piutang").addClass("active");
    
    $(document).on("click", ".modalEditPj", function(){
        let data = $(this).data("id");
        // console.log(data);
        data = data.split("|");

        let id = data[0];
        let nama = data[1];
        $("#id_kelas").val(id);
        $("#pj").val(nama);
    })

    $(".modalInvoice").click(function(){
        const id = $(this).data('id');
        $.ajax({
            url : "<?=base_url()?>piutang/getinvoicekelas",
            method : "POST",
            data : {id_kelas : id},
            async : true,
            dataType : 'json',
            success : function(data){
                $("#tipe").val("kelas");
                $("#id").val(id);
                $("#exampleModalScrollableTitle").html(data.invoice[0].data.nama_peserta);
                var html = '<th>#</th><th>Tgl</th><th>Uraian</th><th>Nominal</th><th>KBM</th>';
                $('#head').html(html);

                var html = "";
            
                var i;
                var kbm;

                for(i=0; i<data.invoice.length; i++){
                    if(data.invoice[i].data.ket == "bulanan"){
                        kbm = data.invoice[i].kbm;
                    } else {
                        kbm = '-'
                    };
                    
                    html += 
                        '<tr>'+
                            '<td><input type="checkbox" class="ce" id="id_invoice['+i+']" name="id_invoice[]" value="'+data.invoice[i].data.id_invoice+'"></td>'+
                            '<td><label for="id_invoice['+i+']">'+
                                data.invoice[i].data.tgl_invoice+
                              '</label></td>'+
                            '<td>'+
                                data.invoice[i].data.uraian+
                            '</td>'+
                            '<td>'+
                                formatRupiah(data.invoice[i].data.nominal, 'Rp. ')+
                            '</td>'+
                            '<td><center>'+
                                kbm +
                            '</center></td>'+
                        '</tr>';
                }
                $('#list-invoice').html(html);
            }
        })
    })
    
    $("#hapusInvoice").click(function(){
      var count = $("input[name='id_invoice[]']").filter(":checked").length;
      if (count == 0){
        Swal.fire({
                icon: 'error',
                text: 'Harap memilih data terlebih dahulu'
            })
            return false;
        } else {
            var c = confirm('Yakin akan melakukan pembayaran?')
            return c;
        }
    })
    
    $(".modalTransaksi").click(function(){
      $("#tipe_invoice").val("kelas");
      $("#tipe_kwitansi").val("kelas");
      $("#tipe_deposit").val("kelas");
      const id = $(this).data('id');
      $.ajax({
            url : "<?=base_url()?>kartupiutang/getdatakelas",
            method : "POST",
            data : {id_kelas : id},
            async : true,
            dataType : 'json',
            success : function(data){
                $(".nama-title").html(data.nama_peserta);
                $("#id_kwitansi").val(data.id_kelas);
                $("#id_invoice").val(data.id_kelas);
                $("#id_deposit").val(data.id_kelas);
                $("#nama_invoice").val(data.nama_peserta);
                $("#nama_kwitansi").val(data.nama_peserta);
                $("#nama_deposit").val(data.nama_peserta);
            }
        })
    })
    
    $("#form-2").hide();
    $("#form-3").hide();
    $("#btn-form-1").addClass("active");

    $("#btn-form-1").click(function(){
      $("#form-1").show();
      $("#form-2").hide();
      $("#form-3").hide();

      $("#btn-form-1").addClass("active");
      $("#btn-form-2").removeClass("active");
      $("#btn-form-3").removeClass("active");
    })
    
    $("#btn-form-2").click(function(){
      $("#form-1").hide();
      $("#form-2").show();
      $("#form-3").hide();

      $("#btn-form-1").removeClass("active");
      $("#btn-form-2").addClass("active");
      $("#btn-form-3").removeClass("active");
    })
    
    $("#btn-form-3").click(function(){
      $("#form-1").hide();
      $("#form-2").hide();
      $("#form-3").show();

      $("#btn-form-1").removeClass("active");
      $("#btn-form-2").removeClass("active");
      $("#btn-form-3").addClass("active");
    })

    // validasi
    $("#nominal").keyup(function(){
        $("#nominal").val(formatRupiah(this.value, 'Rp. '))
    })

    $("#nominal_pembayaran").keyup(function(){
        $("#nominal_pembayaran").val(formatRupiah(this.value, 'Rp. '))
    })

    $("#nominal_piutang").keyup(function(){
        $("#nominal_piutang").val(formatRupiah(this.value, 'Rp. '))
    })

    $("#nominal_deposit").keyup(function(){
        $("#nominal_deposit").val(formatRupiah(this.value, 'Rp. '))
    })

    // submit
    $("#btn-submit-1, #btn-submit-2, #btn-submit-3").click(function(){
      var c = confirm("Yakin akan menambahkan data?");
      return c;
    })
</script>
