<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $header?></h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="max-width:850px">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th>No</th>
                        <th>Status</th>
                        <th>Koor</th>
                        <th>No HP</th>
                        <th>Program</th>
                        <th>Pengajar</th>
                        <th>Detail</th>
                    </thead>
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
        // console.log(id);
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

</script>