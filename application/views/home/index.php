<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $header?></h1>
        </div>

        <form action="<?=base_url()?>" method="post">
            <div class="form-row mb-3">
                <div class="col-2">
                    <select name="bulan" id="bulan" class="form-control form-control-sm">
                        <option value="">Bulan</option>
                        <?php foreach ($bulan as $bulan) :?>
                            <option value="<?=$bulan['id']?>" <?php if($bulan['id'] == $month)echo "selected"?>><?=$bulan['bulan']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                
                <div class="col-2">
                    <select name="tahun" id="tahun" class="form-control form-control-sm">
                        <option value="">Tahun</option>
                        <option value="2019" <?php if($year == '2019')echo "selected"?>>2019</option>
                        <option value="2020" <?php if($year == '2020')echo "selected"?>>2020</option>
                    </select>
                </div>

                <div class="col-1">
                    <input type="submit" value="Go" class="btn btn-sm btn-success">
                </div>
            </div>
        </form>

        <div class="row cus-font">
            <!-- jk -->
            <div class="md-col-3 mb-3 sm-col-4 col-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info d-flex justify-content-between">
                        <span>Gender</span>
                        <span><i class="fa fa-male"></i> <i class="fa fa-female"></i></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Ikhwan</span>
                        <?= $peserta['pria']?>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Akhwat</span>
                        <?= $peserta['wanita']?>
                    </li>
                </ul>
            </div>
            
            <!-- pendidikan -->
            <div class="md-col-3 mb-3 sm-col-4 col-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info d-flex justify-content-between">
                        <span>Pendidikan</span>
                        <i class="fa fa-book"></i>
                    </li>
                    <?php foreach ($pendidikan as $pendidikan) :?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><?php if($pendidikan['pendidikan'] == ''){echo "Undefined";}else{echo $pendidikan['pendidikan'];}?></span>
                            <?= $pendidikan['peserta']?>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
            
            <!-- pekerjaan -->
            <div class="md-col-3 mb-3 sm-col-4 col-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info d-flex justify-content-between">
                        <span>Pekerjaan</span>
                        <i class="fa fa-user-tie"></i>
                    </li>
                    <?php foreach ($pekerjaan as $pekerjaan) :?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><?php if($pekerjaan['pekerjaan'] == ''){echo "Undefined";}else{echo $pekerjaan['pekerjaan'];}?></span>
                            <?= $pekerjaan['peserta']?>
                        </li>
                    <?php endforeach;?>
                    <?php if($pekerjaan_lainnya) : ?>
                        <a href="#" data-toggle="modal" data-target="#modal_lainnya_pekerjaan" data-id="<?= $month . '|' . $year?>" class="modalPekerjaan">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Lainnya</span>
                                <?= $pekerjaan_lainnya?>
                            </li>
                        </a>
                    <?php endif;?>
                </ul>
            </div>

            <!-- pendaftar -->
            <div class="md-col-3 mb-3 sm-col-4 col-3"> 
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info d-flex justify-content-between">
                        <span>Pendaftar</span>
                        <i class="fa fa-user"></i>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Peserta</span>
                        <?= $peserta['total']?>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Reguler</span>
                        <?= $peserta_reguler?>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Pv Khusus</span>
                        <?= $peserta_pv_khusus?>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Pv Luar</span>
                        <?= $peserta_pv_luar?>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Kelompok</span>
                        <?= $kelas?>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Kelompok Pv Khusus</span>
                        <?= $kelas_pv_khusus?>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Kelompok Pv Luar</span>
                        <?= $kelas_pv_luar?>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Kelompok Reguler</span>
                        <?= $kelas_reguler?>
                    </li>
                </ul>
            </div>
            
            <!-- program -->
            <div class="md-col-3 mb-3 sm-col-4 col-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info d-flex justify-content-between">
                        <span>Program</span>
                        <i class="fa fa-book"></i>
                    </li>
                    <?php foreach ($program as $program) :?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><?= $program['program']?></span>
                            <?= $program['peserta']?>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
            
            <!-- informasi -->
            <div class="md-col-3 mb-3 sm-col-4 col-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info d-flex justify-content-between">
                        <span>Informasi</span>
                        <i class="fa fa-info"></i>
                    </li>
                    <?php foreach ($informasi as $informasi) :?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><?= $informasi['info']?></span>
                            <?= $informasi['peserta']?>
                        </li>
                    <?php endforeach;?>
                    <?php if($informasi_lainnya != 0):?>
                        <a href="#" data-toggle="modal" data-target="#modal_lainnya_informasi" data-id="<?= $month . '|' . $year?>" class="modalInformasi">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Lainnya</span>
                                <?= $informasi_lainnya?>
                            </li>
                        </a>
                    <?php endif;?>
                </ul>
            </div>

        </div>
    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>

<script>
    $("#home").addClass("active")

    $(".modalPekerjaan").click(function(){
        const id = $(this).data('id');
        const data = id.split("|");
        const bulan = data[0];
        const tahun = data[1]

        $.ajax({
            url : "<?=base_url()?>home/get_pekerjaan_lain_by_periode",
            method : "POST",
            data : {bulan : bulan, tahun : tahun},
            async : true,
            dataType : 'json',
            success : function(data){
                // console.log(data)
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<li class="list-group-item d-flex justify-content-between"><span>'+data[i].pekerjaan+'</span>' + data[i].peserta + '</li>';
                }
                $('#list-pekerjaan').html(html);
            }
        })
    })
    
    $(".modalInformasi").click(function(){
        const id = $(this).data('id');
        const data = id.split("|");
        const bulan = data[0];
        const tahun = data[1]

        $.ajax({
            url : "<?=base_url()?>home/get_informasi_lain_by_periode",
            method : "POST",
            data : {bulan : bulan, tahun : tahun},
            async : true,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<li class="list-group-item d-flex justify-content-between"><span>'+data[i].nama_kpq+'</span>' + data[i].peserta + '</li>';
                }
                $('#list-informasi').html(html);
            }
        })
    })
</script>