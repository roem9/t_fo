<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="row ml-2 mb-3">
                <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $header?></h1>
            </div>

            <div class="row">
            <?php if( $this->session->flashdata('pesan') ) : ?>
                <div class="col-6">
                    <?= $this->session->flashdata('pesan');?>
                </div>
            <?php endif; ?>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a href="#" class='nav-link active' id="btn-1">Kartu Piutang</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class='nav-link bg-success text-light modalTransaksi' id="detailKelas" data-toggle="modal" data-target="#modalTransaksi" data-id="<?= $id?>">Transaksi</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <?php if($total >= 0):?>
                            <h5 class="text-success">Saldo : <?= rupiah($total)?></h5>
                        <?php else:?>
                            <h5 class="text-danger">Piutang : <?= rupiah($total)?></h5>
                        <?php endif;?>
                        <table class="table table-sm cus-font">
                            <thead>
                                <th><center>No</center></th>
                                <th>Tgl</th>
                                <th>Keterangan</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Print</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 0;
                                    foreach ($detail as $detail) :?>
                                    <tr>
                                        <td><?= ++$no?></td>
                                        <td><?= date("d-M-Y", strtotime($detail['tgl']))?></td>
                                            <?php if($detail['status'] == 'tagihan'):?>
                                                <td><?= $detail['uraian']?></td>
                                                <td><?= rupiah($detail['nominal'])?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <?php if($detail['ket'] == "piutang"):?>
                                                    <td><center><a onclick="return confirm('Yakin akan mengubah staus piutang menjadi lunas?')" href="<?= base_url()?>kartupiutang/edit_status_piutang/<?= md5($detail['id_tagihan'])?>/lunas"><i class="fa fa-times-circle text-danger"></i></a></center></td>
                                                <?php elseif($detail['ket'] == "lunas"):?>
                                                    <td><center><a onclick="return confirm('Yakin akan mengubah staus piutang menjadi piutang?')" href="<?= base_url()?>kartupiutang/edit_status_piutang/<?= md5($detail['id_tagihan'])?>/piutang"><i class="fa fa-check-circle text-success"></i></a></center></td>
                                                <?php endif;?>
                                                <td><a href="#" class="badge badge-success modalEditTagihan" data-toggle="modal" data-target="#modal_edit" data-id="<?= $detail['id_tagihan']?>">edit</a></td>
                                                <td>-</td>
                                            <?php elseif($detail['status'] == 'deposit') : ?>
                                                <td><?= $detail['uraian']?></td>
                                                <td><?= rupiah($detail['nominal'])?></td>
                                                <td>-</td>
                                                <td><center><?=$detail['metode']?></center></td>
                                                <td>-</td>
                                                <td><a href="#" class="badge badge-success modalEditDeposit" data-toggle="modal" data-target="#modal_edit" data-id="<?= $detail['id_deposit']?>">edit</a></td>
                                                <td>-</td>
                                            <?php elseif($detail['status'] == 'cash') :?>
                                                <td><?= $detail['uraian']?></td>
                                                <td>-</td>
                                                <td><?= rupiah($detail['nominal'])?></td>
                                                <td><center><?=$detail['metode']?></center></td>
                                                <td>-</td>
                                                <td><a href="#" class="badge badge-success modalEditCash" data-toggle="modal" data-target="#modal_edit" data-id="<?= $detail['id_pembayaran']?>">edit</a></td>
                                                <td><a href="<?=base_url()?>kartupiutang/kwitansi/<?= $detail['id_pembayaran']?>" target=_blank><center><i class="fa fa-print"></i></center></a></td>
                                            <?php elseif($detail['status'] == 'transfer') :?>
                                                <td><?= $detail['uraian']?></td>
                                                <td>-</td>
                                                <td><?= rupiah($detail['nominal'])?></td>
                                                <td><center><?=$detail['metode']?></center></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
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
</div>

<script>
    $("#piutang").addClass("active")
    $("#dataTable").DataTable({
        paging: false,
        searching: false
    })

    // modal edit tagihan
        $(".modalEditTagihan").click(function(){
            $("#modal-edit").html("Edit Tagihan");
            let id = $(this).data("id");
            $("#form-edit").attr("action", "<?= base_url()?>kartupiutang/edit_tagihan")
            $("#edit_alamat").attr("readonly", "readonly");
            $("#edit_alamat").val("");

            $.ajax ({
                url : "<?=base_url()?>kartupiutang/get_data_tagihan",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success : function(data){
                    $("#id").val(data.id_tagihan);
                    $("#nama").val(data.nama_tagihan);
                    $("#tgl_transaksi").val(data.tgl_tagihan);
                    $("#keterangan").val(data.uraian);
                    $("#nominal_uang").val(data.nominal);
                }
            })
        })
    // modal edit tagihan

    // modal edit pembayaran cash
        $(".modalEditCash").click(function(){
            $("#modal-edit").html("Edit Pembayaran");
            let id = $(this).data("id");
            $("#form-edit").attr("action", "<?=base_url()?>kartupiutang/edit_pembayaran_cash")
            $("#edit_alamat").attr("readonly", "readonly");
            $("#edit_alamat").val("");

            $.ajax ({
                url : "<?=base_url()?>kartupiutang/get_data_pembayaran",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success : function(data){
                    $("#id").val(data.id_pembayaran);
                    $("#nama").val(data.nama_pembayaran);
                    $("#tgl_transaksi").val(data.tgl_pembayaran);
                    $("#keterangan").val(data.uraian);
                    $("#nominal_uang").val(data.nominal);
                }
            })
        })
    // modal edit pembayaran cash
    
    // modal edit deposit
        $(".modalEditDeposit").click(function(){
            $("#modal-edit").html("Edit Pembayaran");
            let id = $(this).data("id");
            $("#form-edit").attr("action", "<?=base_url()?>kartupiutang/edit_deposit")
            $("#edit_alamat").attr("readonly", "readonly");
            $("#edit_alamat").val("");

            $.ajax ({
                url : "<?=base_url()?>kartupiutang/get_data_deposit",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success : function(data){
                    $("#id").val(data.id_deposit);
                    $("#nama").val(data.nama_deposit);
                    $("#tgl_transaksi").val(data.tgl_deposit);
                    $("#keterangan").val(data.uraian);
                    $("#nominal_uang").val(data.nominal);
                }
            })
        })
    // modal edit deposit

    // modal transaksi
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
    // modal transaksi

    // validasi
        $("input[name='nominal']").keyup(function(){
            $(this).val(formatRupiah(this.value, 'Rp. '))
        })
    // validasi

    // submit
        $("#btn-submit-1, #btn-submit-2, #btn-submit-3").click(function(){
            var c = confirm("Yakin akan menambahkan data?");
            return c;
        })

        $("#edit_transaksi").click(function(){
            var c = confirm("Yakin akan merubah data transaksi?");
            return c;
        })
    // submit
</script>