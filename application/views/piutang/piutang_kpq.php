<div class="card shadow mb-4 overflow-auto">
    <div class="card-body">
        <table id="tableData" class="table table-hover align-items-center mb-0 text-dark">
            <thead>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder w-1 desktop">Status</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Nama Civitas</th>
                <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Tipe</th>
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
        ajax: { url: `<?= base_url()?>piutang/getListPiutangCivitas`, type: "POST" },
        columns: [
            { data: "status", orderable: false, searchable: false, className: "text-sm w-1 text-center" },
            { data: "nama_kpq", orderable: true, searchable: true, className: "text-sm" },
            { data: "tipe", orderable: false, searchable: false, className: "text-sm w-1" },
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
                      <a href="<?=base_url()?>kartupiutang/kpq/${row['nip']} " target="_blank"><span class="text-success">Rp ${piutangRupiah}</span></a>
                    `
                  } else if(piutang < 0){
                    return `
                      <a href="<?=base_url()?>kartupiutang/kpq/${row['nip']} " target="_blank"><span class="text-danger">Rp ${piutangRupiah}</span></a>
                    `
                  } else if(piutang == 0){
                    return `
                      <a href="<?=base_url()?>kartupiutang/kpq/${row['nip']} " target="_blank"><span class="text-warning">Rp ${piutangRupiah}</span></a>
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
      url : "<?=base_url()?>piutang/getinvoicekpq",
      method : "POST",
      data : {nip : id},
      async : true,
      dataType : 'json',
      success : function(data){
          $("#tipe").val("kpq");
          $("#id").val(id);
          $(".modal-title").html(data[0].nama_kpq);
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
              html += '<li class="list-group-item list-group-item-danger">'+
                  '<div class="row">'+
                      '<div class="col-3"><input type="checkbox" class="ce" id="id_invoice['+i+']" name="id_invoice[]" value="'+data[i].id_invoice+'"><label for="id_invoice['+i+']">'+
                          data[i].tgl_invoice+
                        '</label></div>'+
                      '<div class="col-6">'+
                          data[i].uraian+
                      '</div>'+
                      '<div class="col-3">'+
                          formatRupiah(data[i].nominal, 'Rp. ')+
                      '</div>'+
                  '</div>'+
              '</li>';
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
      var c = confirm('Yakin akan menghapus data?')
      return c;
  }
})

$(".modalTransaksi").click(function(){
$("#tipe_invoice").val("kpq");
$("#tipe_kwitansi").val("kpq");
$("#tipe_deposit").val("kpq");
const id = $(this).data('id');
$.ajax({
      url : "<?=base_url()?>kartupiutang/getdatakpq",
      method : "POST",
      data : {nip : id},
      async : true,
      dataType : 'json',
      success : function(data){
          // console.log(data);
          $(".nama-title").html(data.nama_kpq);
          $("#id_kwitansi").val(data.nip);
          $("#id_invoice").val(data.nip);
          $("#id_deposit").val(data.nip);
          $("#nama_invoice").val(data.nama_kpq);
          $("#nama_kwitansi").val(data.nama_kpq);
          $("#nama_deposit").val(data.nama_kpq);
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
