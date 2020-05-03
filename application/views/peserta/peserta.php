<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $header?></h1>
        </div>

        <?php if( $this->session->flashdata('peserta') ) : ?>
            <div class="row">
                <div class="col-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data peserta <strong>berhasil</strong> <?= $this->session->flashdata('peserta');?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4" style="max-width: 700px;">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <?php if($header == 'Waiting List') : ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if($tabs == 'peserta') echo 'active'?>" href="<?= base_url()?>wl/peserta">Peserta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($tabs == 'kelas') echo 'active'?>" href="<?= base_url()?>wl/kelas">Kelas</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if($tabs == 'reguler') echo 'active'?>" href="<?= base_url()?>peserta/reguler">Reguler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($tabs == 'pv khusus') echo 'active'?>" href="<?= base_url()?>peserta/pvkhusus">Pv Khusus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($tabs == 'pv luar') echo 'active'?>" href="<?= base_url()?>peserta/pvluar">Pv Luar</a>
                    </li>
                <?php endif;?>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-sm cus-font">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Status</th>
                            <th>Nama Peserta</th>
                            <th>Gender</th>
                            <th>No Hp</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 0;
                        foreach ($peserta as $peserta) :?>
                            <tr>
                                <td><center><?= ++$i?></center></td>
                                <td><?= $peserta['status']?></td>
                                <td><?= $peserta['nama_peserta']?></td>
                                <td><?= $peserta['jk']?></td>
                                <td><?= $peserta['no_hp']?></td>
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
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>


<script>
    <?php if ($header == 'Waiting List'):?>
        $("#waitingList").addClass("active");
    <?php else : ?>
        $("#peserta").addClass("active");
    <?php endif;?>
    
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
