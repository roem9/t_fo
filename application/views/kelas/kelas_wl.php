   <!-- Content Wrapper -->
   <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $header?></h1>
    </div>
    <?php if( $this->session->flashdata('wl') ) : ?>
      <div class="row">
          <div class="col-6">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  Data wl <strong>berhasil</strong> <?= $this->session->flashdata('wl');?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          </div>
      </div>
  <?php endif; ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="width: 900px">
      <div class="card-body">
        <form action="controllers/konfirmasiwl.php" method="POST">
          <div class="table-responsive">
            <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
              <thead>
                <th>No</th>
                <th>Status</th>
                <th>Program</th>
                <th>Tipe</th>
                <th>Koor</th>
                <th>Detail</th>
              </thead>
              <tbody>
                  <?php 
                  $no = 0;
                  foreach ($wl as $wl) :?>
                      <tr>
                          <td><center><?= ++$no?></center></td>
                          <td><?= $wl['status']?></td>
                          <td><?= $wl['program']?></td>
                          <td><?= $wl['tipe_kelas']?></td>
                          <td><?= $wl['nama_peserta']?></td>
                          <td><center><a href="#" class="badge badge-warning modalKelas" data-toggle="modal" data-target="#exampleModalScrollable" data-id="<?= $wl['id_kelas']?>">detail</a></center></td>
                      </tr>
                  <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </form>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

<script>
$("#waitingList").addClass("active");
$(".detailWl").click(function(){
var catatan = $(this).data("id");
$("#catatan_wl").html(catatan);
// console.log(catatan)
})


$(".modalKelas").click(function(){
  const id = $(this).data('id');
  $("#pesertaBaru").attr("href", "<?=base_url()?>pendaftaran/pesertabaru/"+id);
  $("#detailKelas").data('id', id);
  $("#detailPeserta").data('id', id);
  $("#detailJadwal").data('id', id);
  // console.log(id);
  $.ajax({
      url : "<?=base_url()?>kelas/datakelaswlbyid",
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

  $("#detailKelas").addClass('active');
  $("#detailPeserta").removeClass('active');
  $("#detailJadwal").removeClass('active');
  $("#dataKelas").show();
  $("#dataPeserta").hide(); 
  $("#dataJadwal").hide();
})

$("#detailKelas").click(function(){
  const id = $(this).data('id');
  // console.log(id)
  $.ajax({
      url : "<?=base_url()?>kelas/datakelaswlbyid",
      method : "POST",
      data : {id_kelas : id},
      async : true,
      dataType : 'json',
      success : function(data){
          $("#status").val(data.status);
          $("#id_kelas").val(data.id_kelas);
          $("#program").val(data.program);
          $("#koordinator").html(data.nama_peserta);
          $("#pengajar").val(data.pengajar);
          $("#tempat").val(data.tempat);
          $("#catatan").val(data.catatan);
      }
  })

  $("#detailKelas").addClass('active');
  $("#detailPeserta").removeClass('active');
  $("#detailJadwal").removeClass('active');
  $("#dataKelas").show();
  $("#dataPeserta").hide(); 
  $("#dataJadwal").hide();
})

$("#detailPeserta").click(function(){
  const id = $(this).data('id');
  // console.log(id)
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

  $("#detailKelas").removeClass('active');
  $("#detailPeserta").addClass('active');
  $("#detailJadwal").removeClass('active');
  $("#dataKelas").hide();
  $("#dataPeserta").show();
  $("#dataJadwal").hide();
})

$("#detailJadwal").click(function(){
  const id = $(this).data('id');
  // console.log(id)
  $.ajax({
      url : "<?=base_url()?>kelas/datajadwalbyid",
      method : "POST",
      data : {id_kelas : id},
      async : true,
      dataType : 'json',
      success : function(data){
          // console.log(data)
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
              html += '<li class="list-group-item">'+data[i].tempat+' ('+data[i].hari+' '+data[i].jam+')</li>';
          }
          $('#list-jadwal').html(html);
      }
  })

  $("#detailKelas").removeClass('active');
  $("#detailPeserta").removeClass('active');
  $("#detailJadwal").addClass('active');
  $("#dataKelas").hide();
  $("#dataPeserta").hide();
  $("#dataJadwal").show();
})

$("#edit").click(function(){
var c = confirm("Yakin akan mengupdate data?");
return c;
})

</script>