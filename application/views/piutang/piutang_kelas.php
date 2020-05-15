<!-- modal edit pj -->
    <div class="modal fade" id="modalEditPj" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit PJ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
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
                <input type="submit" class="btn btn-success btn-sm" value="Edit">
                </div>
            </form>
            </div>
        </div>
    </div>
<!-- modal edit pj -->

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $header?></h1>
            </div>
            
            
          <?php if( $this->session->flashdata('pesan') ) : ?>
              <div class="row">
                  <div class="col-12">
                        <?= $this->session->flashdata('pesan');?>
                  </div>
              </div>
          <?php endif; ?>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                            <thead>
                                <th style="max-width: 20px">No</th>
                                <th style="max-width: 35px">Status</th>
                                <th>Koor</th>
                                <th>PJ</th>
                                <th style="max-width: 65px">No HP</th>
                                <th style="max-width: 65px">Tgl Mulai</th>
                                <th>Pengajar</th>
                                <th>Piutang</th>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($kelas as $i => $kelas) :?>
                                    <tr>
                                        <td><center><?= ++$no?></center></td>
                                        <td><?= $kelas['status']?></td>
                                        <td><?= $kelas['nama_peserta']?></td>
                                        <?php if($kelas['pj'] == ""):?>
                                            <td><a href="#modalEditPj" class="modalEditPj" data-toggle="modal" data-id="<?=$kelas['id_kelas']?>|<?=$kelas['pj']?>">-</a></td>
                                        <?php else :?>
                                            <td><a href="#modalEditPj" class="modalEditPj" data-toggle="modal" data-id="<?=$kelas['id_kelas']?>|<?=$kelas['pj']?>"><?=$kelas['pj']?></a></td>
                                        <?php endif;?>
                                        <td><?= $kelas['no_hp']?></td>
                                        <td>
                                            <!-- <center> -->
                                                <?php  
                                                    if($kelas['tgl_mulai'] == "0000-00-00") {
                                                        echo "-";
                                                    } else {
                                                        echo date("d-m-Y", strtotime($kelas['tgl_mulai']));
                                                    }
                                                ?>
                                            <!-- </center> -->
                                        </td>
                                        <td><?= $kelas['nama_kpq']?></td>
                                        <?php if(($kelas['bayar'] - $kelas['piutang']) == 0):?>
                                            <td class="bg-warning text-white"><a class="text-light" href="<?=base_url()?>kartupiutang/kelas/<?=$kelas['id_kelas']?>"><?= rupiah(($kelas['bayar'] - $kelas['piutang']))?></a></td>
                                        <?php elseif(($kelas['bayar'] - $kelas['piutang']) < 0):?>
                                            <td class="bg-danger text-white"><a class="text-light" href="<?=base_url()?>kartupiutang/kelas/<?=$kelas['id_kelas']?>"><?= rupiah(($kelas['bayar'] - $kelas['piutang']))?></a></td>
                                        <?php elseif(($kelas['bayar'] - $kelas['piutang']) > 0):?>
                                            <td class="bg-success text-white"><a class="text-light" href="<?=base_url()?>kartupiutang/kelas/<?=$kelas['id_kelas']?>"><?= rupiah(($kelas['bayar'] - $kelas['piutang']))?></a></td>
                                        <?php endif;?>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#piutang").addClass("active");
    
    $(".modalEditPj").click(function(){
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
