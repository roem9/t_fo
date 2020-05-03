<?php
    function rupiah($angka){
            
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }

    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div class="d-flex justify-content-begin mt-3">
                    <h1 class="h3 mb-0 text-gray-800 mr-3"><?= $header?></h1>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table text-dark" style="font-size: 12px" border=1>
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No Kuitansi</th>
                            <th>Nama Lengkap</th>
                            <th>Pengajar</th>
                            <th>Nominal</th>
                            <th>Terbilang</th>
                            <th>Keterangan</th>
                            <th>Piutang</th>
                            <th>TL</th>
                            <th>BA</th>
                            <th>PK</th>
                            <th>PL</th>
                            <th>Buku</th>
                            <th>PT3</th>
                            <th>T1</th>
                            <th>T2</th>
                            <th>T3</th>
                            <th>T4</th>
                            <th>Deposit</th>
                            <th>Daftar Reg</th>
                            <th>Daftar PK</th>
                            <th>Daftar PL</th>
                            <th>TA</th>
                            <th>TD</th>
                            <th>Lain2</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php $no = 0;
                            $total = ["piutang" => 0, "tl" => 0, "ba" => 0, "pk" => 0, "pl" => 0, "buku" => 0, "pt3" => 0, "t1" => 0, "t2" => 0, "t3" => 0, "t4" => 0, "deposit" => 0, "daftar_reg" => 0, "daftar_pk" => 0, "daftar_pl" => 0, "ta" => 0, "td" => 0, "lain" => 0];
                        ?>
                        <?php foreach ($tgl as $tgl) :?>
                            <tr>
                                <td><center><?= ++$no?></center></td>
                                <td><?= date("d-m-Y", strtotime($tgl['tgl_pembayaran']))?></td>
                                <?php
                                    if($tgl['id_pembayaran'] > 0 && $tgl['id_pembayaran'] < 10){
                                        $tgl['id_pembayaran'] = '00000'.$tgl['id_pembayaran'];
                                    } else if($tgl['id_pembayaran'] >= 10 && $tgl['id_pembayaran'] < 100){
                                        $tgl['id_pembayaran'] = '0000'.$tgl['id_pembayaran'];
                                    } else if($tgl['id_pembayaran'] >= 100 && $tgl['id_pembayaran'] < 1000){
                                        $tgl['id_pembayaran'] = '000'.$tgl['id_pembayaran'];
                                    } else if($tgl['id_pembayaran'] >= 1000 && $tgl['id_pembayaran'] < 10000){
                                        $tgl['id_pembayaran'] = '00'.$tgl['id_pembayaran'];
                                    } else if($tgl['id_pembayaran'] >= 10000 && $tgl['id_pembayaran'] < 100000){
                                        $tgl['id_pembayaran'] = '0'.$tgl['id_pembayaran'];
                                    } else {
                                        $tgl['id_pembayaran'] = $tgl['id_pembayaran'];
                                    };

                                    $bulan = date("m", strtotime($tgl['tgl_pembayaran']));
                                    $tahun = date("y", strtotime($tgl['tgl_pembayaran']));

                                    $id = $tahun.$bulan.$tgl['id_pembayaran'];
                                ?>
                                <td><?= $id?></td>
                                <td><?= $tgl['nama_pembayaran']?></td>
                                <td><?= $tgl['pengajar']?></td>
                                <td><?= $tgl['nominal']?></td>
                                <td><?= terbilang($tgl['nominal']) . " rupiah"?></td>
                                <td><?= $tgl['uraian']?></td>
                                <?php if ($tgl['keterangan'] == "Piutang") :?>
                                    <?php $total['piutang'] += $tgl['nominal']?>
                                    <td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "MMQ 1 TL") :?>
                                    <?php $total['tl'] += $tgl['nominal']?>
                                    <td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "MMQ 3 BA") :?>
                                    <?php $total['ba'] += $tgl['nominal']?>
                                    <td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "Bulanan PK") :?>
                                    <?php $total['pk'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "Bulanan PL") :?>
                                    <?php $total['pl'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "Buku") :?>
                                    <?php $total['buku'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "MMQ 1 PT3") :?>
                                    <?php $total['pt3'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "MMQ 1 T1") :?>
                                    <?php $total['t1'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "MMQ 1 T2") :?>
                                    <?php $total['t2'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "MMQ 1 T3") :?>
                                    <?php $total['t3'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "MMQ 1 T4") :?>
                                    <?php $total['t4'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "Deposit") :?>
                                    <?php $total['deposit'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "Pendaftaran Reguler") :?>
                                    <?php $total['daftar_reg'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "Pendaftaran PK") :?>
                                    <?php $total['daftar_pk'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "Pendaftaran PL") :?>
                                    <?php $total['daftar_pl'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "MMQ 2 TA") :?>
                                    <?php $total['ta'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "MMQ 2 TD") :?>
                                    <?php $total['td'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td><td></td>
                                <?php elseif ($tgl['keterangan'] == "Lainnya") :?>
                                    <?php $total['lain'] += $tgl['nominal']?>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= $tgl['nominal']?></td>
                                <?php endif;?>  
                            </tr>
                        <?php endforeach;?>
                        <tr>
                            <td colspan=8><center>Total</center></td>
                            <td><?= $total['piutang']?></td>
                            <td><?= $total['tl']?></td>
                            <td><?= $total['ba']?></td>
                            <td><?= $total['pk']?></td>
                            <td><?= $total['pl']?></td>
                            <td><?= $total['buku']?></td>
                            <td><?= $total['pt3']?></td>
                            <td><?= $total['t1']?></td>
                            <td><?= $total['t2']?></td>
                            <td><?= $total['t3']?></td>
                            <td><?= $total['t4']?></td>
                            <td><?= $total['deposit']?></td>
                            <td><?= $total['daftar_reg']?></td>
                            <td><?= $total['daftar_pk']?></td>
                            <td><?= $total['daftar_pl']?></td>
                            <td><?= $total['ta']?></td>
                            <td><?= $total['td']?></td>
                            <td><?= $total['lain']?></td>
                            <td><b><?= $total['piutang']+$total['tl']+$total['ba']+$total['pk']+$total['pl']+$total['buku']+$total['pt3']+$total['t1']+$total['t2']+$total['t3']+$total['t4']+$total['deposit']+$total['daftar_reg']+$total['daftar_pk']+$total['daftar_pl']+$total['ta']+$total['td']+$total['lain']?></b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>