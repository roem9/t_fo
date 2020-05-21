<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                      <a href="#" class='nav-link' id="detailKelas" data-id=""><i class="fas fa-book"></i></a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class='nav-link' id="detailPeserta" data-id=""><i class="fas fa-user"></i></a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="<?=base_url()?>wl/editwl" id="dataKelas" method="POST">
                    <input type="hidden" name="id_kelas" id="id_kelas">
                    <div class="form-group">
                        <label for="status">Status<span class="text-danger">*</span></label>
                        <select name="status" id="status" class='form-control form-control-sm' required>
                            <option value="">Pilih Status</option>
                            <option value="wl">WL</option>
                            <option value="nonaktif">Nonaktif</option>
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
                    <button type="submit" class="btn btn-primary btn-sm btn-block" id="edit">Update</button>
                </form>
                <ul class="list-group cus-font" id="dataPeserta">
                  <li class="list-group-item list-group-item-info">List Peserta <span class="badge badge-danger badge-pill" id="totalPeserta"></span></li>
                  <div id="list-peserta"></div>
                  <a href="" class="list-group-item list-group-item-action active" id="pesertaBaru">
                    <i class="fa fa-user-plus"></i> Tambah Peserta
                  </a>
                </ul>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

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
    <?php if( $this->session->flashdata('pesan') ) : ?>
        <div class="col-6">
            <?= $this->session->flashdata('pesan');?>
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

  $("#detailKelas").addClass('active');
  $("#detailPeserta").removeClass('active');
  $("#detailJadwal").removeClass('active');
  $("#dataKelas").show();
  $("#dataPeserta").hide(); 
  $("#dataJadwal").hide();
})

$("#detailKelas").click(function(){
  $("#detailKelas").addClass('active');
  $("#detailPeserta").removeClass('active');
  $("#detailJadwal").removeClass('active');
  $("#dataKelas").show();
  $("#dataPeserta").hide(); 
  $("#dataJadwal").hide();
})

$("#detailPeserta").click(function(){
  $("#detailKelas").removeClass('active');
  $("#detailPeserta").addClass('active');
  $("#detailJadwal").removeClass('active');
  $("#dataKelas").hide();
  $("#dataPeserta").show();
  $("#dataJadwal").hide();
})

$("#edit").click(function(){
  var c = confirm("Yakin akan mengupdate data?");
  return c;
})

</script>