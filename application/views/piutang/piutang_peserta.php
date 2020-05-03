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

          
          <?php if( $this->session->flashdata('piutang') ) : ?>
              <div class="row">
                  <div class="col-6">
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          Data Piutang<strong>berhasil</strong> <?= $this->session->flashdata('piutang');?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                  </div>
              </div>
          <?php endif; ?>

          <!-- DataTales Example -->
          <div class="card shadow mb-4" style="max-width: 1000px;">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link <?php if($tabs == 'reguler') echo 'active'?>" href="<?= base_url()?>piutang/reguler">Reguler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($tabs == 'pvkhusus') echo 'active'?>" href="<?= base_url()?>piutang/pvkhusus">Pv Khusus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($tabs == 'pvluar') echo 'active'?>" href="<?= base_url()?>piutang/pvluar">Pv Luar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($tabs == 'kpq') echo 'active'?>" href="<?= base_url()?>piutang/kpq">KPQ</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="max-width: 20px">No</th>
                      <th>Status</th>
                      <th>Nama Peserta</th>
                      <th>Program</th>
                      <th>Hari</th>
                      <th>Waktu</th>
                      <th>Pengajar</th>
                      <th>Piutang</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no = 0;
                      foreach ($peserta as $peserta) :?>
                        <tr>
                            <td><center><?= ++$no?></center></td>
                            <td><?= $peserta['status']?></td>
                            <td><?= $peserta['nama_peserta']?></td>
                            <td>
                              <?php 
                                if($peserta['program'] == ''){
                                  echo '<center>-</center>';
                                } else {
                                  echo $peserta['program'];
                                }
                              ?>
                            </td>
                            <td>
                              <?php 
                                if($peserta['hari'] == ''){
                                  echo '<center>-</center>';
                                } else {
                                  echo $peserta['hari'];
                                }
                              ?>
                            </td>
                            <td>
                              <?php 
                                if($peserta['jam'] == ''){
                                  echo '<center>-</center>';
                                } else {
                                  echo $peserta['jam'];
                                }
                              ?>
                            </td>
                            <td>
                              <?php 
                                if($peserta['nama_kpq'] == ''){
                                  echo '<center>-</center>';
                                } else {
                                  echo $peserta['nama_kpq'];
                                }
                              ?>
                            </td>
                            <?php if(($peserta['bayar'] - $peserta['piutang']) == 0):?>
                                <td class="bg-warning text-white"><a class="text-light" href="<?=base_url()?>kartupiutang/peserta/<?=$peserta['id_peserta']?>"><?= rupiah(($peserta['bayar'] - $peserta['piutang']))?></a></td>
                            <?php elseif(($peserta['bayar'] - $peserta['piutang']) < 0):?>
                                <td class="bg-danger text-white"><a class="text-light" href="<?=base_url()?>kartupiutang/peserta/<?=$peserta['id_peserta']?>"><?= rupiah(($peserta['bayar'] - $peserta['piutang']))?></a></td>
                            <?php elseif(($peserta['bayar'] - $peserta['piutang']) > 0):?>
                                <td class="bg-success text-white"><a class="text-light" href="<?=base_url()?>kartupiutang/peserta/<?=$peserta['id_peserta']?>"><?= rupiah(($peserta['bayar'] - $peserta['piutang']))?></a></td>
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
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

<script>
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