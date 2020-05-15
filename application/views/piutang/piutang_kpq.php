<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800 mt-3"><?=$header?></h1>
    </div>

    <?php if( $this->session->flashdata('piutang') ) : ?>
        <div class="row">
            <div class="col-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data piutang <strong>berhasil</strong> <?= $this->session->flashdata('piutang');?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="max-width: 700px">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th style="max-width: 20px">No</th>
                <th>Status</th>
                <th>Nama Civitas</th>
                <th>Tipe</th>
                <th>Piutang</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0;
              foreach ($kpq as $kpq) :?>
                  <tr>
                      <td><center><?=++$no?></center></td>
                      <td><center><?= $kpq['status']?></center></td>
                      <td><?=$kpq['nama_kpq']?></td>
                      <?php if(substr($kpq['nip'], 0, 3) == "012"):?>
                        <td><center>KPQ</center></td>
                      <?php else:?>
                        <td><center>Karyawan</center></td>
                      <?php endif;?>
                      <?php if(($kpq['bayar'] - $kpq['piutang']) == 0):?>
                          <td class="bg-warning text-white"><a class="text-light" href="<?=base_url()?>kartupiutang/kpq/<?=$kpq['nip']?>"><?= rupiah(($kpq['bayar'] - $kpq['piutang']))?></a></td>
                      <?php elseif(($kpq['bayar'] - $kpq['piutang']) < 0):?>
                          <td class="bg-danger text-white"><a class="text-light" href="<?=base_url()?>kartupiutang/kpq/<?=$kpq['nip']?>"><?= rupiah(($kpq['bayar'] - $kpq['piutang']))?></a></td>
                      <?php elseif(($kpq['bayar'] - $kpq['piutang']) > 0):?>
                          <td class="bg-success text-white"><a class="text-light" href="<?=base_url()?>kartupiutang/kpq/<?=$kpq['nip']?>"><?= rupiah(($kpq['bayar'] - $kpq['piutang']))?></a></td>
                      <?php endif;?>
                  </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>

<script>
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
