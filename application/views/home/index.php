<form method="get">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2 mb-3">
            <select name="bulan" id="bulan" class="form-control form-control-md">
                <option value="">Bulan</option>
                <?php foreach ($bulan as $bulan) :?>
                    <option value="<?=$bulan['id']?>" <?php if($bulan['id'] == $month)echo "selected"?>><?=$bulan['bulan']?></option>
                <?php endforeach;?>
            </select>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-2 mb-3">
            <select name="tahun" id="tahun" class="form-control form-control-md">
                <option value="">Tahun</option>
                <?php for($i=date('Y');$i>=2019;$i--): ?>
                    <option value="<?= $i?>" <?php if($year == $i)echo "selected"?>><?= $i?></option>
                <?php endfor;?>
            </select>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 mb-3">
            <input type="submit" value="Go" class="btn btn-md btn-success">
        </div>
    </div>
</form>

<div class="row">
    <!-- gender  -->
    <div class="col-sm-12 col-md-4 mb-3">
      <div class="card" style="height: 100%">
        <div class="card-header pb-0 p-3">
          <div class="d-flex align-items-center">
            <h6 class="mb-0">Gender</h6>
          </div>
        </div>
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-0">
                          <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Ikhwan</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> <?= $peserta['pria']?> </span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-0">
                          <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Akhwat</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> <?= $peserta['wanita']?> </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- pendidikan -->
    <div class="col-sm-12 col-md-4 mb-3">
      <div class="card" style="height: 100%">
        <div class="card-header pb-0 p-3">
          <div class="d-flex align-items-center">
            <h6 class="mb-0">Pendidikan</h6>
          </div>
        </div>
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <tbody>
                        <?php foreach ($pendidikan as $pendidikan) :?>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-0">
                                        <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm"><?php if($pendidikan['pendidikan'] == ''){echo "Undefined";}else{echo $pendidikan['pendidikan'];}?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold"> <?= $pendidikan['peserta']?> </span>
                                </td>
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
    
    <!-- pekerjaan -->
    <div class="col-sm-12 col-md-4 mb-3">
      <div class="card" style="height: 100%">
        <div class="card-header pb-0 p-3">
          <div class="d-flex align-items-center">
            <h6 class="mb-0">Pekerjaan</h6>
          </div>
        </div>
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <tbody>
                        <?php foreach ($pekerjaan as $pekerjaan) :?>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-0">
                                        <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm"><?php if($pekerjaan['pekerjaan'] == ''){echo "Undefined";}else{echo $pekerjaan['pekerjaan'];}?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold"> <?= $pekerjaan['peserta']?> </span>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        <?php if($pekerjaan_lainnya) : ?>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-0">
                                        <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                                        <div class="d-flex flex-column justify-content-center">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal_lainnya_pekerjaan" data-id="<?= $month . '|' . $year?>" class="modalPekerjaan">
                                                    <h6 class="mb-0 text-sm">Lainnya</h6>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold"> <?= $pekerjaan_lainnya?> </span>
                                    </td>
                                </tr>
                        <?php endif;?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- pendaftar -->
    <div class="col-sm-12 col-md-4 mb-3">
      <div class="card" style="height: 100%">
        <div class="card-header pb-0 p-3">
          <div class="d-flex align-items-center">
            <h6 class="mb-0">Pendaftar</h6>
          </div>
        </div>
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-0">
                          <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Peserta</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> <?= $peserta['total']?> </span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-0">
                          <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Reguler</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> <?= $peserta_reguler?> </span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-0">
                          <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">PV Khusus</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> <?= $peserta_pv_khusus?> </span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-0">
                          <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Pv Luar</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> <?= $peserta_pv_luar?> </span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-0">
                          <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Kelompok</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> <?= $kelas?> </span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-0">
                          <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Kelompok Pv Khusus</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> <?= $kelas_pv_khusus?> </span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-0">
                          <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Kelompok Pv Luar</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> <?= $kelas_pv_luar?> </span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-0">
                          <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Kelompok Reguler</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> <?= $kelas_reguler?> </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- program -->
    <div class="col-sm-12 col-md-4 mb-3">
      <div class="card" style="height: 100%">
        <div class="card-header pb-0 p-3">
          <div class="d-flex align-items-center">
            <h6 class="mb-0">Program</h6>
          </div>
        </div>
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <tbody>
                    <?php foreach ($program as $program) :?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-0">
                            <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?= $program['program']?></h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-xs font-weight-bold"> <?= $program['peserta']?> </span>
                        </td>
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
    
    <!-- informasi -->
    <div class="col-sm-12 col-md-4 mb-3">
      <div class="card" style="height: 100%">
        <div class="card-header pb-0 p-3">
          <div class="d-flex align-items-center">
            <h6 class="mb-0">Informasi</h6>
          </div>
        </div>
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <tbody>
                        <?php foreach ($informasi as $informasi) :?>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-0">
                                        <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm"><?php if($informasi['info'] == ''){echo "Undefined";}else{echo $informasi['info'];}?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold"> <?= $informasi['peserta']?> </span>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        <?php if($informasi_lainnya) : ?>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-0">
                                        <span class="badge me-3" style="background-color: <?= randomColor()?>"> </span>
                                        <div class="d-flex flex-column justify-content-center">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal_lainnya_informasi" data-id="<?= $month . '|' . $year?>" class="modalInformasi">
                                                    <h6 class="mb-0 text-sm">Lainnya</h6>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold"> <?= $informasi_lainnya?> </span>
                                    </td>
                                </tr>
                        <?php endif;?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modal_lainnya_pekerjaan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Pekerjaan Lainnya</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">     
        <ul class="list-group cus-font">
          <li class="list-group-item list-group-item-info d-flex justify-content-between"><span>List Pekerjaan</span> Jumlah</li>
          <div id="list-pekerjaan"></div>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_lainnya_informasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Informasi Lainnya</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">     
        <ul class="list-group cus-font">
          <li class="list-group-item list-group-item-info d-flex justify-content-between"><span>Nama Civitas</span> Jumlah</li>
          <div id="list-informasi"></div>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<?= footer()?>

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