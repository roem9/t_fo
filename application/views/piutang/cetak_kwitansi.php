<?php

    function rupiah($angka){
            
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }

    function tgl_indo($tanggal){
        $bulan = array (1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
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
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        #data tr td{
            padding: 5px;
        }
    </style>
</head><body style="text-align: justify;">
    <div class="box" style="border: 1px solid black; padding-left: 50px; padding-right: 50px; padding-top: 10px; padding-bottom: 10px">
        <table style="width: 100%">
            <tr>
                <td><h4>Kuitansi</h4></td>
                <td>No : <?= $id?></td>
                <td><img src="<?=base_url()?>/assets/img/tarq.png" width=200px></td>
            </tr>
            <tr>
                <td colspan=3 style="text-align: right; font-size: 10px"><b><?= tgl_indo($kwitansi['tgl_pembayaran'])?></b></td>
            </tr>
        </table>
        <table border=1 style="width: 100%; margin-top: 10px; border-collapse: collapse; font-size: 10px" id="data">
            <tr>
                <td style="width: 30%">Nama Lengkap</td>
                <td>  <?= $kwitansi['nama_pembayaran']?></td>
            </tr>
            <tr>
                <td>Uang Sejumlah</td>
                <td>  <?= rupiah($kwitansi['nominal'])?> (<i><?= terbilang($kwitansi['nominal'])?> rupiah</i>)</td>
            </tr>
            <tr>
                <td>Untuk Pembayaran</td>
                <td> <?= $kwitansi['uraian']?></td>
            </tr>
        </table>
        <table style="margin-top: 10px; width: 100%">
            <tr>
                <td style="width: 80%"></td>
                <td><hr></td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 10px">
            <tr>
                <!-- <td><img src="<?=base_url()?>/assets/img/tarq.png" width=80px></td> -->
                <td style="font-size: 8px"><b><center><i>Pusat : TarQ Center Jl. Sidomukti no 34 Sukaluyu Bandung - 022 250641 / Cab Batam Kep Riau - 081270828618 / Cab Jatinangor
            Jawa Barat - 0813132265419 / Cab Padang Jl Kamang no 12 Padang - Sumatera Barat - 075131342 / Cab Parakan Muncang Jawa Barat - 08568970008 / Cab. Sumedang Jawa Barat - 085314026605</i></center></b></td>
                <!-- <td><img src="<?=base_url()?>/assets/img/tarq.png" width=80px></td> -->
            </tr>
        </table>
    </div>
</body></html>
