<div class="card shadow mb-4 overflow-auto">
    <div class="card-body">
        <table id="tableData" class="table table-hover align-items-center mb-0 text-dark">
            <thead>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder w-1 desktop">Status</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Nama Peserta</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Program</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Hari</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Waktu</th>
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
        ajax: { url: `<?= base_url()?>piutang/getListPiutangReguler`, type: "POST" },
        columns: [
            { data: "status", orderable: true, searchable: true, className: "text-sm w-1 text-center" },
            { data: "nama_peserta", orderable: true, searchable: true, className: "text-sm" },
            { data: "program", orderable: false, searchable: false, className: "text-sm w-1 text-center" },
            { data: "hari", orderable: true, searchable: false, className: "text-sm" },
            { data: "jam", orderable: false, searchable: false, className: "text-sm" },
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
                      <a href="<?=base_url()?>kartupiutang/peserta/${row['id_peserta']} " target="_blank"><span class="text-success">Rp ${piutangRupiah}</span></a>
                    `
                  } else if(piutang < 0){
                    return `
                      <a href="<?=base_url()?>kartupiutang/peserta/${row['id_peserta']} " target="_blank"><span class="text-danger">Rp ${piutangRupiah}</span></a>
                    `
                  } else if(piutang == 0){
                    return `
                      <a href="<?=base_url()?>kartupiutang/peserta/${row['id_peserta']} " target="_blank"><span class="text-warning">Rp ${piutangRupiah}</span></a>
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
    $(".modalInvoice").click(function(){
        const id = $(this).data('id');
        $.ajax({
            url : "<?=base_url()?>piutang/getinvoicepeserta",
            method : "POST",
            data : {id_peserta : id},
            async : true,
            dataType : 'json',
            success : function(data){
                $("#tipe").val("peserta");
                $("#id").val(id);
                $("#exampleModalScrollableTitle").html(data[0].nama_peserta);
                var html = '<th>#</th><th>Tgl</th><th>Uraian</th><th>Nominal</th>';
                $('#head').html(html);

                var html = "";
                
                var i;
                for(i=0; i<data.length; i++){
                    html += '<tr>'+
                            '<td><input type="checkbox" id="id_invoice['+i+']" name="id_invoice[]" value="'+data[i].id_invoice+'"></td><td><label for="id_invoice['+i+']">'+
                                data[i].tgl_invoice+
                              '</label></td>'+
                            '<td>'+
                                data[i].uraian+
                            '</td>'+
                            '<td>'+
                                formatRupiah(data[i].nominal, 'Rp. ')+
                            '</td>'+
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
      $("#tipe_invoice").val("peserta");
      $("#tipe_kwitansi").val("peserta");
      $("#tipe_deposit").val("peserta");
      const id = $(this).data('id');
      $.ajax({
            url : "<?=base_url()?>kartupiutang/getdatapeserta",
            method : "POST",
            data : {id_peserta : id},
            async : true,
            dataType : 'json',
            success : function(data){
                $(".nama-title").html(data.nama_peserta);
                $("#id_kwitansi").val(data.id_peserta);
                $("#id_invoice").val(data.id_peserta);
                $("#id_deposit").val(data.id_peserta);
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