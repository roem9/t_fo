<!-- modal transaksi lain -->
    <div class="modal fade" id="modalTransaksi" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title nama-title" id="exampleModalScrollableTitle">Transaksi Lainnya</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?=base_url()?>transaksi/add_transaksi_lain" method="post">
                        <input type="hidden" name="tipe" id="" value="Lainnya">
                        <input type="hidden" name="pengajar" value="-">
                        <div class="form-group">
                            <label for="nama_pembayaran">Nama</label>
                            <input type="text" name="nama_pembayaran" id="nama_pembayaran" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="untuk">Pembayaran Untuk?</label>
                            <select name="keterangan" id="untuk" class="form-control form-control-sm" required>
                                <option value="">Pilih Pembayaran Untuk</option>
                                <option value="Buku">Buku</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl">Tgl</label>
                            <input type="date" name="tgl" id="tgl" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="metode">Metode Pembayaran</label>
                            <select name="metode" id="metode" class="form-control form-control-sm" required>
                                <option value="">Pilih Tipe</option>
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="uraian">Keterangan</label>
                            <textarea name="uraian" id="uraian" class="form-control form-control-sm" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nominal_deposit">Nominal</label>
                            <input type="text" name="nominal" id="nominal_deposit" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group" id="formAlamat">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="d-flex justify-content-end mb-3">
                            <input type="submit" value="Tambah Transaksi" class="btn btn-sm btn-primary" id="btn-submit-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal transaksi lain -->

<!-- modal edit transaksi -->
    <div class="modal fade" id="modalEditPembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit">Edit Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body cus-font">
                <form action="<?=base_url()?>transaksi/edit_transaksi" method="POST" id="form-edit">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_edit">Nama</label>
                        <input type="text" name="nama" id="nama_edit" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="tgl_edit">Tanggal</label>
                        <input type="date" name="tgl" id="tgl_edit" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="uraian_edit">Keterangan</label>
                        <textarea name="uraian" id="uraian_edit" rows="2" class="form-control form-control-sm"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nominal_edit">Nominal</label>
                        <input type="text" name="nominal" id="nominal_edit" class="form-control form-control-sm">
                    </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success btn-sm" value="Edit" id="submitEditPembayaran">
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- modal edit transaksi -->

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
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card" style="max-width: 1000px">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a href="#" class='nav-link active'>Transaksi</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link bg-success text-light modalTransaksi' data-toggle="modal" data-target="#modalTransaksi">Tambah Transaksi</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm cus-font" id="dataTable">
                                <thead>
                                    <th><center>No</center></th>
                                    <!-- <th>Tagihan</th> -->
                                    <th>Tgl</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Nominal</th>
                                    <th>Metode</th>
                                    <th>Edit</th>
                                    <th>Print</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 0;
                                        foreach ($detail as $detail) :
                                            if($detail['nama'] != "" || ($detail['nama'] == "" && $detail['nominal'] != 0)) :
                                        ?>
                                                <tr>
                                                    <td><center><?= ++$no?></center></td>
                                                    <td><?= date("d-M-Y", strtotime($detail['tgl']))?></td>
                                                    <td><?= $detail['nama']?></td>
                                                    <td><?= $detail['uraian']?></td>
                                                    <td><?= rupiah($detail['nominal'])?></td>
                                                    <td><?= $detail['metode']?></td>
                                                    <?php if($detail['metode'] == "Cash"):?>
                                                        <td><a href="#" class="badge badge-success modalEditPembayaran" data-toggle="modal" data-target="#modalEditPembayaran" data-id="<?= $detail['id_pembayaran']?>">edit</a></td>
                                                    <?php elseif($detail['metode'] == "Transfer"):?>
                                                        <td><center>-</center></td>
                                                    <?php endif;?>
                                                    <?php if($detail['metode'] == "Cash"):?>
                                                        <td><a href="<?=base_url()?>transaksi/kuitansi/<?= MD5($detail['id_pembayaran'])?>" target=_blank><center><i class="fa fa-print"></i></center></a></td>
                                                    <?php elseif($detail['metode'] == "Transfer"):?>
                                                        <td><center>-</center></td>
                                                    <?php endif;?>
                                                </tr>
                                            <?php endif;?>
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

    $("#metode").change(function(){
        let metode = $(this).val();
        if(metode == "Transfer"){
            $("#formAlamat").show();
        } else {
            $("#formAlamat").hide();
        }
    })

    $(".modalEditPembayaran").click(function(){
        let id = $(this).data("id");
        console.log(id)
        $.ajax ({
            url : "<?=base_url()?>transaksi/get_data_pembayaran",
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success : function(data){
                $("#id").val(data.id_pembayaran);
                $("#nama_edit").val(data.nama_pembayaran);
                $("#tgl_edit").val(data.tgl_pembayaran);
                $("#uraian_edit").val(data.uraian);
                $("#nominal_edit").val(data.nominal);
            }
        })
    })

    // validasi
    $("input[name='nominal']").keyup(function(){
        $(this).val(formatRupiah(this.value, 'Rp. '))
    })

    // submit
    $("#btn-submit-1, #btn-submit-2, #btn-submit-3").click(function(){
      var c = confirm("Yakin akan menambahkan data?");
      return c;
    })

    $("#submitEditPembayaran").click(function(){
        var c = confirm("Yakin akan mengubah data transaksi?");
        return c;
    })
</script>