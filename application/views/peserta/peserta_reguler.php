<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $header?></h1>
            </div>
            <?php if( $this->session->flashdata('pesan') ) : ?>
                <div class="row">
                    <div class="col-6">
                            <?= $this->session->flashdata('pesan');?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-sm cus-font">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Nama Peserta</th>
                                    <th>No Hp</th>
                                    <th>Program</th>
                                    <th>Tempat</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Pengajar</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 0;
                                foreach ($peserta as $peserta) :?>
                                    <tr>
                                        <td><center><?= ++$i?></center></td>
                                        <td><?= $peserta['status']?> 
                                        <td><?= $peserta['nama_peserta']?></td>
                                        <td><?= $peserta['no_hp']?></td>
                                        <?php if($peserta['status'] == "wl" || $peserta['status'] == "nonaktif"):?>
                                            <td><?= $peserta['program_peserta']?></td>
                                            <td><center>-</center></td>
                                            <td><?= $peserta['hari_peserta']?></td>
                                            <td><?= $peserta['jam_peserta']?></td>
                                            <td><center>-</center></td>
                                        <?php else :?>
                                            <td><?= $peserta['program']?></td>
                                            <td><?= $peserta['tempat']?></td>
                                            <td><?= $peserta['hari']?></td>
                                            <td><?= $peserta['jam']?></td>
                                            <td><?= $peserta['nama_kpq']?></td>
                                        <?php endif;?>
                                        <td><a href="#" data-toggle="modal" data-target="#exampleModalScrollable" data-id="<?= $peserta['id_peserta']?>" class="detailPeserta">
                                        <span class="badge badge-warning">detail</span></a></td>
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
    $("#peserta").addClass("active");
    $("#btn-form-1").addClass("active");
    $("#form-1").show();
    $("#form-2").hide();
    
    $(".detailPeserta").click(function(){
        const id = $(this).data('id');
        $.ajax({
            url : "<?=base_url()?>peserta/detail",
            method : "POST",
            data : {id_peserta : id},
            async : true,
            dataType : 'json',
            success : function(data){
                // console.log(data)
                $(".modal-title").html(data.nama_peserta);
                $("#id_peserta").val(data.id_peserta);
                $("#nama").val(data.nama_peserta);
                $("#status").val(data.status);
                $("#no_hp").val(data.no_hp);
                $("#tgl_masuk").val(data.tgl_masuk);
                $("#jk").val(data.jk);
                $("#program").val(data.program);
                $("#hari").val(data.hari);
                $("#jam").val(data.jam);
                $("#tempat").val(data.tempat);
                $("#alamat_peserta").val(data.alamat);
            }
        })
    })

    $("#btn-form-1").click(function(){
        $("#btn-form-1").addClass("active")
        $("#btn-form-2").removeClass("active")
        $("#form-1").show();
        $("#form-2").hide();
    })

    $("#btn-form-2").click(function(){
        $("#btn-form-1").removeClass("active")
        $("#btn-form-2").addClass("active")
        $("#form-1").hide();
        $("#form-2").show();
    })

    $("#editPeserta").click(function(){
        var c = confirm('Yakin akan mengedit data?');
        return c;
    })
</script>
