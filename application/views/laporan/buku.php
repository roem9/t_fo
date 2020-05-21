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
    
    function id_cash($id, $tgl){
        if($id > 0 && $id < 10){
            $id = '00000'.$id;
        } else if($id >= 10 && $id < 100){
            $id = '0000'.$id;
        } else if($id >= 100 && $id < 1000){
            $id = '000'.$id;
        } else if($id >= 1000 && $id < 10000){
            $id = '00'.$id;
        } else if($id >= 10000 && $id < 100000){
            $id = '0'.$id;
        } else {
            $id = $id;
        };

        $bulan = date("m", strtotime($tgl));
        $tahun = date("y", strtotime($tgl));

        return $tahun.$bulan.$id;
    }
?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div class="d-flex justify-content-begin mt-3">
                    <h3 class="h3 mb-0 text-gray-800 mr-3"><?= $title?></h3>
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
                            <th>Uraian</th>
                            <th>Nominal</th>
                            <th>Terbilang</th>
                            <th>Metode</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                            foreach ($data as $data) :?>
                            <tr>
                                <td><?= ++$no?></td>
                                <td><?= date("d-m-Y", strtotime($data['tgl']))?></td>
                                <?php if($data['metode'] == "Cash"):?>
                                    <td><?= id_cash($data['no_kuitansi'], $data['tgl'])?></td>
                                <?php elseif($data['metode'] == "Transfer"):?>
                                    <?php $id = substr($data['no_kuitansi'], 0, 3) . "/Keu-Im/" . date("n", strtotime($data['tgl'])) . "/" . date("Y", strtotime($data['tgl']));?>
                                    <td><?= $id?></td>
                                <?php else:?>
                                    <td><?= $data['no_kuitansi']?></td>
                                <?php endif;?>
                                <td><?= $data['nama']?></td>
                                <td><?= $data['pengajar']?></td>
                                <td><?= $data['uraian']?></td>
                                <td><?= rupiah($data['nominal'])?></td>
                                <td><?= ucfirst(terbilang($data['nominal']))?></td>
                                <td><?= $data['metode']?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>