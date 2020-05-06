<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="row ml-2 mb-3">
                <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $header?></h1>
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a href="#" class='nav-link active' id="detailKelas" data-id="">Transaksi</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link bg-success text-light modalTransaksi' id="detailKelas" data-toggle="modal" data-target="#modalTransaksi">Tambah Transaksi</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm cus-font" id="dataTable">
                                <thead>
                                    <th><center>No</center></th>
                                    <!-- <th>Tagihan</th> -->
                                    <th>Tgl</th>
                                    <th>Keterangan</th>
                                    <th>Nominal</th>
                                    <th>Metode</th>
                                    <th>Edit</th>
                                    <th>Print</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 0;
                                        foreach ($detail as $detail) :?>
                                        <tr>
                                            <td><center><?= ++$no?></center></td>
                                            <td><?= date("d-M-Y", strtotime($detail['tgl_pembayaran']))?></td>
                                            <td><?= $detail['uraian']?></td>
                                            <td><?= rupiah($detail['nominal'])?></td>
                                            <td><?= $detail['metode']?></td>
                                            <td><a href="#" class="badge badge-success modalEditPembayaran" data-toggle="modal" data-target="#modal_edit" data-id="<?= $detail['id_pembayaran']?>">edit</a></td>
                                            <td><a href="<?=base_url()?>kartupiutang/kwitansi/<?= $detail['id_pembayaran']?>" target=_blank><center><i class="fa fa-print"></i></center></a></td>
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
</div>

<script>
    $("#piutang").addClass("active")
    
    $(".modalEditTagihan").click(function(){
        $("#modal-edit").html("Edit Tagihan");
        let id = $(this).data("id");

        $.ajax ({
            url : "<?=base_url()?>kartupiutang/get_data_tagihan",
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success : function(data){
                $("#transaksi").val("tagihan");
                $("#id").val(data.id_tagihan);
                $("#keterangan").val(data.uraian);
                $("#nominal_uang").val(data.nominal);
            }
        })
    })
    
    $(".modalEditPembayaran").click(function(){
        $("#modal-edit").html("Edit Pembayaran");
        let id = $(this).data("id");

        $.ajax ({
            url : "<?=base_url()?>kartupiutang/get_data_pembayaran",
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success : function(data){
                $("#transaksi").val("pembayaran");
                $("#id").val(data.id_pembayaran);
                $("#nama").val(data.nama_pembayaran);
                $("#tgl_transaksi").val(data.tgl_pembayaran);
                $("#keterangan").val(data.uraian);
                $("#nominal_uang").val(data.nominal);
            }
        })
    })

    
    $(".modalTransaksi").click(function(){
      $("#tipe_tagihan").val("kpq");
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
                $("#id_tagihan").val(data.nip);
                $("#id_deposit").val(data.nip);
                $("#nama_tagihan").val(data.nama_kpq);
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