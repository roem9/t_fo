<?php 
    $mm = [
        1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember"
    ]
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $header . " " . $mm[$month] . " " . $year?> </h1>
    </div>

    <form action="<?=base_url()?>rekap/<?=$url?>" method="post">
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="max-width:850px">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link <?php if($tabs == 'pv khusus') echo 'active'?>" href="<?= base_url()?>rekap/pvkhusus">Pv Khusus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($tabs == 'pv luar') echo 'active'?>" href="<?= base_url()?>rekap/pvluar">Pv Luar</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font text-dark" id="dataTable" cellspacing="0">
                    <thead>
                        <th>No</th>
                        <th>Status</th>
                        <th>Koor</th>
                        <th>No HP</th>
                        <th>Program</th>
                        <th>Pengajar</th>
                        <th>KBM</th>
                        <th>Detail</th>
                    </thead>
                    <tfoot>
                        <th>No</th>
                        <th>Status</th>
                        <th>Koor</th>
                        <th>No HP</th>
                        <th>Program</th>
                        <th>Pengajar</th>
                        <th>KBM</th>
                        <th>Detail</th>
                    </tfoot>
                    <tbody>
                        <?php
                            $no = 0;
                            foreach ($kelas as $kelas) :?>
                            <tr>
                                <td><?=++$no?></td>
                                <td><?= $kelas['status']?>
                                <td><?= $kelas['nama_peserta']?></td>
                                <td><?= $kelas['no_hp']?>
                                <td><?= $kelas['program']?>
                                <td><?= $kelas['nama_kpq']?>
                                <td><center><a href="#" class="badge badge-success modalKbm" data-toggle="modal" data-target="#exampleModalScrollableKbm" data-id="<?= $kelas['id_kelas']?>"><?= $kelas['kbm']?></a></center></td>
                                <td><center><a href="#" class="badge badge-warning modalKelas" data-toggle="modal" data-target="#exampleModalScrollable" data-id="<?= $kelas['id_kelas']?>">detail</a></center></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#kelas").addClass("active");

    $(".modalKelas").click(function(){
        const id = $(this).data('id');
        $("#pesertaBaru").attr("href", "<?=base_url()?>pendaftaran/pesertabaru/"+id);
        $("#detailKelas").data('id', id);
        $("#detailPeserta").data('id', id);
        $("#detailJadwal").data('id', id);
        $.ajax({
            url : "<?=base_url()?>kelas/datakelasbyid",
            method : "POST",
            data : {id_kelas : id},
            async : true,
            dataType : 'json',
            success : function(data){
                $("#status").html(data.status);
                $("#program").html(data.program);
                $("#koordinator").html(data.nama_peserta);
                $("#kpq").html(data.nama_kpq);
                $("#pengajar").html(data.pengajar);
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
            url : "<?=base_url()?>kelas/datakelasbyid",
            method : "POST",
            data : {id_kelas : id},
            async : true,
            dataType : 'json',
            success : function(data){
                $("#status").html(data.status);
                $("#program").html(data.program);
                $("#koordinator").html(data.nama_peserta);
                $("#kpq").html(data.nama_kpq);
                $("#pengajar").html(data.pengajar);
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
                $('#totalJadwal').html(data.length);
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

    $(".modalKbm").click(function(){
        const id = $(this).data('id');
        const bulan = $("#bulan").val();
        const tahun = $("#tahun").val();

        $.ajax({
            url : "<?=base_url()?>rekap/datarekapbyid",
            method : "POST",
            data : {id_kelas : id, bulan : bulan, tahun : tahun},
            async : true,
            dataType : 'json',
            success : function(data){
                // console.log(data)
                $(".title-kbm").html(data[0].nama_peserta);
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<li class="list-group-item list-group-item-info">'+
                        '' + data[i].tgl + ' ' + data[i].hari + ' ' + data[i].jam +
                    '</li>';
                }
                $('#list-kbm').html(html);
            }
        })

    })

</script>