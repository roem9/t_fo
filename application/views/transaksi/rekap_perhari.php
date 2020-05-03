<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $header?></h1>
            </div>
            <div class="card shadow mb-4" style="max-width: 500px">
                <div class="card-body">
                    <table id="dataTable" class="table table-sm cus-font">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl</th>
                                <th>Cash</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 0;
                                foreach ($tgl as $tgl) :?>
                                    <tr>
                                        <td style="width: 15px"><?= ++$no?></td>
                                        <td><?php echo date("d-M-Y", strtotime($tgl['tgl_pembayaran']))?></td>
                                        <td><?=rupiah($tgl['cash'])?></td>
                                        <td style="width: 20px"><center><a href="<?=base_url()?>transaksi/export/<?=$tgl['tgl_pembayaran']?>" target="_blank"><i class="fa fa-file-excel text-success"></i></a></center></td>
                                    </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#laporan").addClass("active");
</script>


