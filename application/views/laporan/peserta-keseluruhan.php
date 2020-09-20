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
                <br><br>
                <table>
                    <tr>
                        <td colspan="3">
                            <h3>Rekap Peserta</h3>
                        </td>
                    </tr>
                    <thead>
                        <th>Gender</th>
                        <th>Jumlah</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ikhwan</td>
                            <td><?= $rekap['gender']['pria']?></td>
                        </tr>
                        <tr>
                            <td>Akhwat</td>
                            <td><?= $rekap['gender']['wanita']?></td>
                        </tr>
                    </tbody>
                    <thead>
                        <th>Pendidikan</th>
                        <th>Jumlah</th>
                    </thead>
                    <tbody>
                        <?php foreach ($rekap['pendidikan'] as $data) :?>
                            <tr>
                                <td><?= $data['pendidikan']?></td>
                                <td><?= $data['peserta']?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                    <thead>
                        <th>Pekerjaan</th>
                        <th>Jumlah</th>
                    </thead>
                    <tbody>
                        <?php foreach ($rekap['pekerjaan'] as $data):?>
                            <tr>
                                <td><?= $data['pekerjaan']?></td>
                                <td><?= $data['peserta']?></td>
                            </tr>
                        <?php endforeach;?>
                        <tr>
                            <td>Lainnya</td>
                            <td><?= $rekap['pekerjaan_lainnya']?></td>
                        </tr>
                    </tbody>
                    <thead>
                        <th>Informasi</th>
                        <th>Jumlah</th>
                    </thead>
                    <tbody>
                        <?php foreach ($rekap['informasi'] as $data):?>
                            <tr>
                                <td><?= $data['informasi']?></td>
                                <td><?= $data['peserta']?></td>
                            </tr>
                        <?php endforeach;?>
                        <tr>
                            <td>Lainnya</td>
                            <td><?= $rekap['informasi_lainnya']?></td>
                        </tr>
                    </tbody>
                    <thead>
                        <th>Program</th>
                        <th>Jumlah</th>
                    </thead>
                    <tbody>
                        <?php foreach ($rekap['program'] as $data):?>
                            <tr>
                                <td><?= $data['program']?></td>
                                <td><?= $data['peserta']?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                    <thead>
                        <th>Pendaftar</th>
                        <th>Jumlah</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Peserta</td>
                            <td><?= $rekap['total']?></td>
                        </tr>
                        <tr>
                            <td>Reguler</td>
                            <td><?= $rekap['peserta_reguler']?></td>
                        </tr>
                        <tr>
                            <td>Pv Khusus</td>
                            <td><?= $rekap['peserta_pv_khusus']?></td>
                        </tr>
                        <tr>
                            <td>Pv Luar</td>
                            <td><?= $rekap['peserta_pv_luar']?></td>
                        </tr>
                        <tr>
                            <td>Kelompok</td>
                            <td><?= $rekap['kelas']?></td>
                        </tr>
                        <tr>
                            <td>Kelompok PV Khusus</td>
                            <td><?= $rekap['kelas_pv_khusus']?></td>
                        </tr>
                        <tr>
                            <td>Kelompok PV Luar</td>
                            <td><?= $rekap['kelas_pv_luar']?></td>
                        </tr>
                        <tr>
                            <td>Kelompok Reguler</td>
                            <td><?= $rekap['kelas_reguler']?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>