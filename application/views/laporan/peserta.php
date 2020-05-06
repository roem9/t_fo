<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div class="d-flex justify-content-begin mt-3">
                    <h1 class="h3 mb-0 text-gray-800 mr-3"><?= $title?></h1>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table text-dark" style="font-size: 12px" border=1>
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tgl Daftar</th>
                            <th>Nama Peserta</th>
                            <th>Tipe</th>
                            <th>Tempat Lahir</th>
                            <th>Tgl Lahir</th>
                            <th>JK</th>
                            <th>Pendidikan</th>
                            <th>Status</th>
                            <th>No. Handphone</th>
                            <th>Info</th>
                            <th>Program</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Tempat</th>
                            <th>Alamat</th>
                            <th>Provinsi</th>
                            <th>Kabupaten</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Kd Pos</th>
                            <th>No. Telp</th>
                            <th>Pekerjaan</th>
                            <th>Nama Ayah</th>
                            <th>Nama Ibu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 0;
                        foreach ($data as $data) :?>
                            <tr>
                                <td><?= ++$no?></td>
                                <td><?= date("d-m-Y", strtotime($data['tgl_masuk']))?></td>
                                <td><?= $data['nama_peserta']?></td>
                                <td><?= $data['tipe_peserta']?></td>
                                <td><?= $data['t4_lahir']?></td>
                                <td><?= $data['tgl_lahir']?></td>
                                <td><?= $data['jk']?></td>
                                <td><?= $data['pendidikan']?></td>
                                <td><?= $data['status_nikah']?></td>
                                <td>'<?= $data['no_hp']?></td>
                                <td><?= $data['info']?></td>
                                <td><?= $data['program']?></td>
                                <td><?= $data['hari']?></td>
                                <td><?= $data['jam']?></td>
                                <td><?= $data['tempat']?></td>
                                <td><?= $data['alamat']?></td>
                                <td><?= $data['provinsi']?></td>
                                <td><?= $data['kab_kota']?></td>
                                <td><?= $data['kec']?></td>
                                <td><?= $data['kel']?></td>
                                <td><?= $data['kd_pos']?></td>
                                <td><?= $data['no_telp']?></td>
                                <td><?= $data['pekerjaan']?></td>
                                <td><?= $data['nama_ayah']?></td>
                                <td><?= $data['nama_ibu']?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>