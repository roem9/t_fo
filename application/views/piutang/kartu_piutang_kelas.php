<!-- modal  -->
<div class="modal fade" id="modalTransaksi" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title nama-title" id="exampleModalScrollableTitle"><?= $nama?></h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <!-- <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs sticky-top">
                            <li class="nav-item">
                                <a href="#" class='nav-link' id="btn-form-1" data-id="">Transaksi Langsung</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class='nav-link' id="btn-form-2" data-id="">Piutang</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class='nav-link' id="btn-form-3" data-id="">Pembayaran</a>
                            </li>
                        </ul>
                    </div> -->
                    <div class="card-body">
                        <span class="badge bg-gradient-secondary btn-navigation-3" data-menu="menu-transaksi-langsung">
                            Transaksi Langsung
                        </span>
                        <span class="badge bg-gradient-secondary btn-navigation-3" data-menu="menu-transaksi-piutang">
                            Piutang
                        </span>
                        <span class="badge bg-gradient-secondary btn-navigation-3" data-menu="menu-pembayaran">
                            Pembayaran
                        </span>
                        
                        <div class="mt-3"></div>
                        <form action="<?= base_url()?>kartupiutang/add_transaksi_langsung" method="POST" enctype="multipart/form-data" class="menu-navigation-3" id="menu-transaksi-langsung">
                            <div class="alert alert-info" style="background-image: none"><i class="fa fa-info-circle text-info mr-1"></i>menu ini untuk menginputkan transaksi langsung</div>
                            <input type="hidden" name="tipe" value="<?= $tipe?>">
                            <input type="hidden" name="id" value="<?= $id?>">
                            <input type="hidden" name="pengajar" value="<?= $kpq?>">
                            <div class="form-group">
                                <label for="nama_kwitansi">Nama</label>
                                <input type="text" name="nama" class="form-control form-control-sm" value="<?= $nama?>">
                            </div>
                            <div class="form-group">
                                <label for="">Pembayaran Untuk?</label>
                                <select name="keterangan" id="" class="form-control form-control-sm" required>
                                    <option value="">Pilih Pembayaran Untuk</option>
                                    <option value="Buku">Buku</option>
                                    <option value="Pendaftaran Reguler">Pendaftaran Reguler</option>
                                    <option value="Pendaftaran PK">Pendaftran PV Khusus</option>
                                    <option value="Pendaftaran PL">Pendaftaran PV Luar</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tgl">Tgl Pembayaran</label>
                                <input type="date" name="tgl" id="tgl" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="metode">Metode Pembayaran</label>
                                <select name="metode" id="metode" class="form-control form-control-sm" required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Transfer">Transfer</option>
                                    <option value="Deposit">Deposit</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="uraian">Keterangan</label>
                                <textarea name="uraian" id="uraian" class="form-control form-control-sm" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="nominal_pembayaran">Nominal</label>
                                <input type="text" name="nominal" id="nominal_pembayaran" class="form-control form-control-sm rupiah" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type="submit" value="Tambah Pembayaran" class="btn btn-sm btn-success" id="btn-submit-1">
                            </div>
                        </form>

                        <form action="<?= base_url()?>kartupiutang/add_piutang" method="POST" enctype="multipart/form-data" class="menu-navigation-3" id="menu-transaksi-piutang">
                            <div class="alert alert-info" style="background-image: none"><i class="fa fa-info-circle text-info mr-1"></i>menu ini untuk menginputkan piutang</div>
                            <input type="hidden" name="tipe" value="<?= $tipe?>">
                            <input type="hidden" name="id" value="<?= $id?>">
                            <div class="form-group">
                                <label for="nama_tagihan">Nama</label>
                                <input type="text" name="nama" class="form-control form-control-sm" value="<?= $nama?>">
                            </div>
                            <div class="form-group">
                                <label for="piutang">Jenis Piutang</label>
                                <select name="ket" id="ket" class="form-control form-control-sm" required>
                                    <option value="">Pilih Jenis Piutang</option>
                                    <option value="Buku">Piutang Buku</option>
                                    <option value="Bulanan">Piutang Bulanan</option>
                                    <option value="Lainnya">Piutang Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tgl">Tgl Piutang</label>
                                <input type="date" name="tgl" id="tgl" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="uraian">Keterangan</label>
                                <textarea name="uraian" id="uraian" class="form-control form-control-sm" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="nominal_piutang">Nominal</label>
                                <input type="text" name="nominal" id="nominal_piutang" class="form-control form-control-sm rupiah" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type="submit" value="Tambah Piutang" class="btn btn-sm btn-success" id="btn-submit-2">
                            </div>
                        </form>

                        <form action="<?=base_url()?>kartupiutang/add_pembayaran" method="post" enctype="multipart/form-data" class="menu-navigation-3" id="menu-pembayaran">
                            <div class="alert alert-info" style="background-image: none"><i class="fa fa-info-circle text-info mr-1"></i>menu ini untuk menginputkan pembayaran piutang, pembayaran tagihan, dan menginputkan deposit</div>
                            <input type="hidden" name="tipe" value="<?= $tipe?>">
                            <input type="hidden" name="id" value="<?= $id?>">
                            <input type="hidden" name="pengajar" value="<?= $kpq?>">
                            <div class="form-group">
                                <label for="nama_deposit">Nama</label>
                                <input type="text" name="nama" class="form-control form-control-sm" value="<?= $nama?>">
                            </div>
                            <div class="form-group">
                                <label for="">Pembayaran Untuk?</label>
                                <select name="keterangan" id="" class="form-control form-control-sm" required>
                                    <option value="">Pilih Pembayaran Untuk</option>
                                    <option value="Bulanan PK">Bulanan PV Khusus</option>
                                    <option value="Bulanan PL">Bulanan PV Luar</option>
                                    <option value="Deposit">Deposit</option>
                                    <option value="MMQ 1 PT3">MMQ 1 Pra Tahsin 3</option>
                                    <option value="MMQ 1 T1">MMQ 1 Tahsin 1</option>
                                    <option value="MMQ 1 T2">MMQ 1 Tahsin 2</option>
                                    <option value="MMQ 1 T3">MMQ 1 Tahsin 3 </option>
                                    <option value="MMQ 1 T4">MMQ 1 Tahsin 4</option>
                                    <option value="MMQ 1 TL">MMQ 1 Tahsin Lanjutan</option>
                                    <option value="MMQ 2 TA">MMQ 2 Tahfidz Anak</option>
                                    <option value="MMQ 2 TD">MMQ 2 Tahfidz Dewasa</option>
                                    <option value="MMQ 2 TK">MMQ 2 Takhosus</option>
                                    <option value="MMQ 3">MMQ 3 Bahasa Arab</option>
                                    <option value="Piutang">Piutang</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tgl">Tgl</label>
                                <input type="date" name="tgl" id="tgl" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="metode">Metode Pembayaran</label>
                                <select name="metode" id="metode" class="form-control form-control-sm" required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="uraian">Keterangan</label>
                                <textarea name="uraian" id="uraian" class="form-control form-control-sm" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="nominal_deposit">Nominal</label>
                                <input type="text" name="nominal" class="form-control form-control-sm rupiah" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type="submit" value="Tambah Pembayaran" class="btn btn-sm btn-success" id="btn-submit-3">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
    </form>
</div>

<div class="modal fade" id="modal_edit" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-edit"></h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body cus-font">
            <form action="" method="POST" id="form-edit">
            <input type="hidden" name="id" id="id">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control form-control-sm" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label for="tgl_transaksi">Tanggal</label>
                <input type="date" name="tgl" id="tgl_transaksi" class="form-control form-control-sm" readonly>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="uraian" id="keterangan" rows="2" class="form-control form-control-sm"></textarea>
            </div>
            <div class="form-group">
                <label for="nominal_uang">Nominal</label>
                <input type="text" name="nominal" id="nominal_uang" class="form-control form-control-sm rupiah">
            </div>
            </div>
            <div class="modal-footer">
            <input type="submit" class="btn btn-success btn-sm" value="Edit" id="edit_transaksi">
            </div>
        </form>
        </div>
    </div>
</div>

<a href="javascript:void(0)" class="btn btn-info btn-sm btn-navigation" data-menu="menu-piutang">Kartu Piutang</a>
<!-- <a href="javascript:void(0)" class="btn btn-secondary btn-sm btn-navigation" data-menu="menu-akademik">Data Akademik</a> -->
<a href="javascript:void(0)" class="btn btn-success btn-sm modalTransaksi" data-bs-toggle="modal" data-bs-target="#modalTransaksi" data-id="<?= $id?>">
    <span class="d-block d-sm-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
        </svg>
    </span>
    <span class="d-none d-sm-block">
        Tambah Transaksi
    </span>
</a>

<div class="content">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-8 mb-3">
            <div class="card overflow-auto menu-navigation" id="menu-piutang">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <?php if($total >= 0):?>
                                <span class="d-none d-sm-block">
                                    <h5 class="text-success">Saldo : <?= rupiah($total)?></h5>
                                </span>
                                <span class="d-block d-sm-none">
                                    <p class="text-success text-sm">Saldo : <br><?= rupiah($total)?></p>
                                </span>
                            <?php else:?>
                                <span class="d-none d-sm-block">
                                    <h5 class="text-danger">Piutang : <?= rupiah($total)?></h5>
                                </span>
                                <span class="d-block d-sm-none">
                                    <p class="text-danger text-sm">Piutang : <br><?= rupiah($total)?></p>
                                </span>
                            <?php endif;?>
                        </div>
                        <!-- <div class="col">
                            <div class="d-flex justify-content-end">
                                <a href="javascript:void(0)" class="btn btn-success btn-sm modalTransaksi" data-bs-toggle="modal" data-bs-target="#modalTransaksi" data-id="<?= $id?>">
                                    <span class="d-block d-sm-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                        </svg>
                                    </span>
                                    <span class="d-none d-sm-block">
                                        Tambah Transaksi
                                    </span>
                                </a>
                            </div>
                        </div> -->
                    </div>
                    <table class="table table-hover align-items-center mb-0 text-dark text-xs">
                        <!-- <thead> -->
                            <th class="w-1">No</th>
                            <th class="w-1">Tgl</th>
                            <th>Keterangan</th>
                            <th class="w-1">Debit</th>
                            <th class="w-1">Kredit</th>
                            <th class="w-1">Metode</th>
                            <th class="w-1">Status</th>
                            <!-- <th class="w-1">Edit</th> -->
                            <th class="w-1">Action</th>
                        <!-- </thead>
                        <tbody> -->
                            <?php 
                                $no = 0;
                                foreach ($detail as $detail) :?>
                                <tr>
                                    <td><?= ++$no?></td>
                                    <td><?= date("d-M-Y", strtotime($detail['tgl']))?></td>
                                    <?php if($detail['status'] == 'tagihan'):?>
                                        <td><?= $detail['uraian']?></td>
                                        <td><?= rupiah($detail['nominal'])?></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <?php if($detail['ket'] == "piutang"):?>
                                            <td><center><a onclick="return confirm('Yakin akan mengubah staus piutang menjadi lunas?')" href="<?= base_url()?>kartupiutang/edit_status_piutang/<?= md5($detail['id_tagihan'])?>/lunas"><i class="fa fa-times-circle text-danger"></i></a></center></td>
                                        <?php elseif($detail['ket'] == "lunas"):?>
                                            <td><center><a onclick="return confirm('Yakin akan mengubah staus piutang menjadi piutang?')" href="<?= base_url()?>kartupiutang/edit_status_piutang/<?= md5($detail['id_tagihan'])?>/piutang"><i class="fa fa-check-circle text-success"></i></a></center></td>
                                        <?php endif;?>
                                        <!-- <td><a href="#" class="badge badge-success modalEditTagihan" data-toggle="modal" data-target="#modal_edit" data-id="<?= $detail['id_tagihan']?>">edit</a></td>
                                        <td>-</td> -->
                                        <td>
                                            <a href="javascript:void(0)" class="modalEditTagihan" data-bs-toggle="modal" data-bs-target="#modal_edit" data-id="<?= $detail['id_tagihan']?>">
                                                <span class="badge bg-gradient-info">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                                    </svg>
                                                </span>
                                            </a>
                                        </td>
                                    <?php elseif($detail['status'] == 'deposit') : ?>
                                        <td><?= $detail['uraian']?></td>
                                        <td><?= rupiah($detail['nominal'])?></td>
                                        <td>-</td>
                                        <td><center><?=$detail['metode']?></center></td>
                                        <td>-</td>
                                        <!-- <td><a href="#" class="badge badge-success modalEditDeposit" data-toggle="modal" data-target="#modal_edit" data-id="<?= $detail['id_deposit']?>">edit</a></td>
                                        <td>-</td> -->
                                        <td>
                                            <a href="javascript:void(0)" class="modalEditDeposit" data-bs-toggle="modal" data-bs-target="#modal_edit" data-id="<?= $detail['id_deposit']?>">
                                                <span class="badge bg-gradient-info">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                                    </svg>
                                                </span>
                                            </a>
                                        </td>
                                    <?php elseif($detail['status'] == 'cash') :?>
                                        <td><?= $detail['uraian']?></td>
                                        <td>-</td>
                                        <td><?= rupiah($detail['nominal'])?></td>
                                        <td><center><?=$detail['metode']?></center></td>
                                        <td>-</td>
                                        <td>
                                            <a href="javascript:void(0)" class="modalEditCash me-1" data-bs-toggle="modal" data-bs-target="#modal_edit" data-id="<?= $detail['id_pembayaran']?>">
                                                <span class="badge bg-gradient-info">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                                    </svg>
                                                </span>
                                            </a>
                                            <a href="<?=base_url()?>transaksi/kuitansi/<?= $detail['id_pembayaran']?>" target="_blank">
                                                <span class="badge bg-gradient-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                                                    </svg>
                                                </span>
                                            </a>
                                        </td>
                                        <!-- <td><a href="#" class="badge badge-success modalEditCash" data-toggle="modal" data-target="#modal_edit" data-id="<?= $detail['id_pembayaran']?>">edit</a></td>
                                        <td><a href="<?=base_url()?>transaksi/kuitansi/<?= MD5($detail['id_pembayaran'])?>" target=_blank><center><i class="fa fa-print"></i></center></a></td> -->
                                    <?php elseif($detail['status'] == 'transfer') :?>
                                        <td><?= $detail['uraian']?></td>
                                        <td>-</td>
                                        <td><?= rupiah($detail['nominal'])?></td>
                                        <td><center><?=$detail['metode']?></center></td>
                                        <td>-</td>
                                        <td>
                                            <a href="javascript:void(0)" class="modalEditTransfer" data-bs-toggle="modal" data-bs-target="#modal_edit" data-id="<?= $detail['id_transfer']?>">
                                                <span class="badge bg-gradient-info">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                                    </svg>
                                                </span>
                                            </a>
                                        </td>
                                        <!-- <td><a href="#" class="badge badge-success modalEditTransfer" data-toggle="modal" data-target="#modal_edit" data-id="<?= $detail['id_transfer']?>">edit</a></td>
                                        <td><center>-</center></td> -->
                                    <?php endif;?>
                                </tr>
                            <?php endforeach;?>
                        <!-- </tbody> -->
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-12 col-md-4">
            <!-- <div class="row"> -->
                <!-- <div class="col-12 col-sm-12 col-md-6 menu-navigation" id="menu-akademik" style="display:none"> -->
                    <div class="card">
                        <div class="card-body text-xs">
                            <span class="badge bg-gradient-secondary btn-navigation-2" data-menu="menu-data-kelas">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journals" viewBox="0 0 16 16">
                                    <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2"/>
                                    <path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0"/>
                                </svg>
                            </span>
                            <span class="badge bg-gradient-secondary btn-navigation-2" data-menu="menu-data-peserta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                                </svg>
                            </span>
                            <span class="badge bg-gradient-secondary btn-navigation-2" data-menu="menu-data-jadwal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-day" viewBox="0 0 16 16">
                                    <path d="M4.684 11.523v-2.3h2.261v-.61H4.684V6.801h2.464v-.61H4v5.332zm3.296 0h.676V8.98c0-.554.227-1.007.953-1.007.125 0 .258.004.329.015v-.613a2 2 0 0 0-.254-.02c-.582 0-.891.32-1.012.567h-.02v-.504H7.98zm2.805-5.093c0 .238.192.425.43.425a.428.428 0 1 0 0-.855.426.426 0 0 0-.43.43m.094 5.093h.672V7.418h-.672z"/>
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                </svg>
                            </span>
                            <span class="badge bg-gradient-secondary btn-navigation-2" data-menu="menu-data-kbm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                                </svg>
                            </span>
                            
                            <div class="mt-3"></div>
        
                            <ul class="list-group menu-navigation-2" id="menu-data-kelas">
                                <li class="list-group-item list-group-item-info">Data Akademik</li>
                                <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6">
                                    Status
                                    </div>
                                    <div class="col-6" id="status"> 
                                        <?= $kelas['status']?>
                                    </div>
                                </div>
                                </li>
                                <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6">
                                    Tipe Kelas
                                    </div>
                                    <div class="col-6" id="status"> 
                                        <?= $kelas['tipe_kelas']?>
                                    </div>
                                </div>
                                </li>
                                <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6">
                                    Program
                                    </div>
                                    <div class="col-6" id="program"> 
                                        <?= $kelas['program']?>
                                    </div>
                                </div>
                                </li>
                                <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6">
                                    Koordinator
                                    </div>
                                    <div class="col-6" id="koordinator"> 
                                        <?= $kelas['nama_peserta']?>
                                    </div>
                                </div>
                                </li>
                                <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6">
                                    Pengajar
                                    </div>
                                    <div class="col-6" id="kpq"> 
                                        <?= $kelas['nama_kpq']?>
                                    </div>
                                </div>
                                </li>
                                <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6">
                                    Tipe Pengajar
                                    </div>
                                    <div class="col-6" id="pengajar"> 
                                        <?= $kelas['pengajar']?>
                                    </div>
                                </div>
                                </li>
                            </ul>
                    
                            <ul class="list-group menu-navigation-2" id="menu-data-peserta">
                                <li class="list-group-item list-group-item-info">List Peserta <span class="badge bg-danger badge-pill" id="totalPeserta"><?= COUNT($peserta)?></span></li>
                                <?php foreach ($peserta as $peserta) :?>
                                    <li class="list-group-item"><?= $peserta['nama_peserta']?></li>
                                <?php endforeach;?>
                            </ul>
                            
                            <div class="menu-navigation-2" id="menu-data-jadwal">
                                <div class="table-responsive">
                                    <table class="table-sm w-100" border=1>
                                        <thead>
                                        <tr>
                                            <th colspan=3><center><b>List Jadwal</b></center></th>
                                        </tr>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th>Jadwal</th>
                                            <th><center>OT</center></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no = 0;
                                                foreach ($jadwal as $jadwal) :?>
                                                    <tr>
                                                        <td><center><?= ++$no?></center></td>
                                                        <td><?=$jadwal['tempat'] . " (" . $jadwal['hari'] . " " . $jadwal['jam'] . ")"?></td>
                                                        <td><center><?= $jadwal['ot'] * 30?></center></td>
                                                    </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    
                            <div class="menu-navigation-2" id="menu-data-kbm">
                                <div class="table-responsive">
                                    <table class="table-sm w-100" border=1>
                                        <thead>
                                            <th><center>No</center></th>
                                            <th>Periode</th>
                                            <th><center>KBM</center></th>
                                        </thead>
                                        <tbody>
                                            <?php if($kbm):?>
                                                <?php 
                                                    $no = 0;
                                                    foreach ($kbm['kbm'] as $kbm) :?>
                                                    <tr>
                                                        <td><center><?= ++$no?></center></td>
                                                        <td><?= $bulan[$kbm['bulan']] . " " . $kbm['tahun'] ?></td>
                                                        <td><center><?= $kbm['kbm']?></center></td>
                                                    </tr>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        <tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<?= footer()?>

<script>
    <?php if( $this->session->flashdata('pesan') ) : ?>
        Toast.fire({
            icon: "info",
            title: "<?= $this->session->flashdata('pesan')?>"
        });
    <?php endif; ?>

    let data = 'menu-data-kelas';
    // Remove and add classes to navigation buttons
    $(".btn-navigation-2").removeClass("bg-gradient-info").addClass("bg-gradient-secondary");
    $(`[data-menu='${data}']`).removeClass("bg-gradient-secondary").addClass("bg-gradient-info");

    // Hide all menu-navigation-2 elements and show the one with the specified data-menu
    $(".menu-navigation-2").hide();
    $("#" + data).show();

    $(".modalTransaksi").on("click", function(){
        let data = 'menu-transaksi-langsung';
        // Remove and add classes to navigation buttons
        $(".btn-navigation-3").removeClass("bg-gradient-info").addClass("bg-gradient-secondary");
        $(`[data-menu='${data}']`).removeClass("bg-gradient-secondary").addClass("bg-gradient-info");

        // Hide all menu-navigation-3 elements and show the one with the specified data-menu
        $(".menu-navigation-3").hide();
        $("#" + data).show();

        $(".content").hide();
    })

    // data kelas
        $("#detailKelas").removeClass('active');
        $("#detailPeserta").removeClass('active');
        $("#detailJadwal").removeClass('active');
        $("#detailKbm").addClass('active');
        $("#dataKelas").hide();
        $("#dataPeserta").hide();
        $("#dataJadwal").hide();
        $("#dataKbm").show();

        $("#detailKelas").click(function(){
            $("#detailKelas").addClass('active');
            $("#detailPeserta").removeClass('active');
            $("#detailJadwal").removeClass('active');
            $("#detailKbm").removeClass('active');
            $("#dataKelas").show();
            $("#dataPeserta").hide(); 
            $("#dataJadwal").hide();
            $("#dataKbm").hide();
        })
        
        $("#detailPeserta").click(function(){
            $("#detailKelas").removeClass('active');
            $("#detailPeserta").addClass('active');
            $("#detailJadwal").removeClass('active');
            $("#detailKbm").removeClass('active');
            $("#dataKelas").hide();
            $("#dataPeserta").show(); 
            $("#dataJadwal").hide();
            $("#dataKbm").hide();
        })

        $("#detailJadwal").click(function(){
            $("#detailKelas").removeClass('active');
            $("#detailPeserta").removeClass('active');
            $("#detailJadwal").addClass('active');
            $("#detailKbm").removeClass('active');
            $("#dataKelas").hide();
            $("#dataPeserta").hide(); 
            $("#dataJadwal").show();
            $("#dataKbm").hide();
        })
        
        $("#detailKbm").click(function(){
            $("#detailKelas").removeClass('active');
            $("#detailPeserta").removeClass('active');
            $("#detailJadwal").removeClass('active');
            $("#detailKbm").addClass('active');
            $("#dataKelas").hide();
            $("#dataPeserta").hide(); 
            $("#dataJadwal").hide();
            $("#dataKbm").show();
        })
    // data kelas

    $("#dataTable").DataTable({
        paging: false,
        searching: false
    })
    
    var modalTransaksi = document.getElementById('modalTransaksi')
    modalTransaksi.addEventListener('hidden.bs.modal', function (event) {
        $(".content").show();
    })

    var modal_edit = document.getElementById('modal_edit')
    modal_edit.addEventListener('hidden.bs.modal', function (event) {
        $(".content").show();
    })
    
    // modal edit tagihan
        $(".modalEditTagihan").click(function(){
            $("#modal-edit").html("Edit Tagihan");
            let id = $(this).data("id");
            $("#form-edit").attr("action", "<?= base_url()?>kartupiutang/edit_tagihan")
            $("#edit_alamat").attr("readonly", "readonly");
            $("#edit_alamat").val("");

            $.ajax ({
                url : "<?=base_url()?>kartupiutang/get_data_tagihan",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success : function(data){
                    $("#transaksi").val("tagihan");
                    $("#id").val(data.id_tagihan);
                    $("#nama").val(data.nama_tagihan);
                    $("#tgl_transaksi").val(data.tgl_tagihan);
                    $("#keterangan").val(data.uraian);
                    $("#nominal_uang").val(data.nominal);
                }
            })

            $(".content").hide();
        })
    // modal edit tagihan
    
    
    // modal edit transfer
        $(".modalEditTransfer").click(function(){
            $("#modal-edit").html("Edit Pembayaran");
            let id = $(this).data("id");
            $("#form-edit").attr("action", "<?=base_url()?>kartupiutang/edit_pembayaran_transfer")
            $("#edit_alamat").removeAttr("readonly");

            $.ajax ({
                url : "<?=base_url()?>kartupiutang/get_data_pembayaran_transfer",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success : function(data){
                    $("#edit_alamat").val(data.alamat);
                    $("#id").val(data.id_transfer);
                    $("#nama").val(data.nama_transfer);
                    $("#tgl_transaksi").val(data.tgl_transfer);
                    $("#keterangan").val(data.uraian);
                    $("#nominal_uang").val(data.nominal);
                }
            })

            $(".content").hide();
        })
    // modal edit transfer

    // modal edit cash
        $(".modalEditCash").click(function(){
            $("#modal-edit").html("Edit Pembayaran");
            let id = $(this).data("id");
            $("#form-edit").attr("action", "<?=base_url()?>kartupiutang/edit_pembayaran_cash")
            $("#edit_alamat").attr("readonly", "readonly");
            $("#edit_alamat").val("");

            $.ajax ({
                url : "<?=base_url()?>kartupiutang/get_data_pembayaran",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success : function(data){
                    $("#id").val(data.id_pembayaran);
                    $("#nama").val(data.nama_pembayaran);
                    $("#tgl_transaksi").val(data.tgl_pembayaran);
                    $("#keterangan").val(data.uraian);
                    $("#nominal_uang").val(data.nominal);
                }
            })

            $(".content").hide();
        })
    // modal edit cash
    
    // modal edit transfer
        $(".modalEditTransfer").click(function(){
            $("#modal-edit").html("Edit Pembayaran");
            let id = $(this).data("id");
            $("#form-edit").attr("action", "<?=base_url()?>kartupiutang/edit_pembayaran_transfer")
            $("#edit_alamat").removeAttr("readonly");

            $.ajax ({
                url : "<?=base_url()?>kartupiutang/get_data_pembayaran_transfer",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success : function(data){
                    $("#edit_alamat").val(data.alamat);
                    $("#id").val(data.id_transfer);
                    $("#nama").val(data.nama_transfer);
                    $("#tgl_transaksi").val(data.tgl_transfer);
                    $("#keterangan").val(data.uraian);
                    $("#nominal_uang").val(data.nominal);
                }
            })

            $(".content").hide();
        })
    // modal edit transfer
    
    // modal edit deposit
        $(".modalEditDeposit").click(function(){
            $("#modal-edit").html("Edit Pembayaran");
            let id = $(this).data("id");
            $("#form-edit").attr("action", "<?=base_url()?>kartupiutang/edit_deposit")
            $("#edit_alamat").attr("readonly", "readonly");
            $("#edit_alamat").val("");

            $.ajax ({
                url : "<?=base_url()?>kartupiutang/get_data_deposit",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success : function(data){
                    $("#transaksi").val("pembayaran");
                    $("#id").val(data.id_deposit);
                    $("#nama").val(data.nama_deposit);
                    $("#tgl_transaksi").val(data.tgl_deposit);
                    $("#keterangan").val(data.uraian);
                    $("#nominal_uang").val(data.nominal);
                }
            })

            $(".content").hide();
        })
    // modal edit deposit
    
    // validasi
        // $("input[name='nominal']").keyup(function(){
        //     $(this).val(formatRupiah(this.value, 'Rp. '))
        // })
    // validasi

    // submit
        $("#btn-submit-1, #btn-submit-2, #btn-submit-3, #btn-submit-4").click(function(){
            var c = confirm("Yakin akan menambahkan data?");
            return c;
        })
        
        $("#edit_transaksi").click(function(){
            var c = confirm("Yakin akan merubah data transaksi?");
            return c;
        })
    // submit

    $(".btn-navigation").on("click", function(){
        $(".alert-error").hide();

        let data = $(this).data("menu");

        $(".btn-navigation").removeClass("bg-gradient-info");
        $(".btn-navigation").removeClass("bg-gradient-secondary");
        $(".btn-navigation").addClass("bg-gradient-secondary");

        $(`[data-menu='${data}']`).removeClass("bg-gradient-secondary");
        $(`[data-menu='${data}']`).addClass("bg-gradient-info");

        $(".menu-navigation").hide();
        $("#" + data).show();
    })

    $(".btn-navigation-3").on("click", function(){
        $(".alert-error").hide();

        let data = $(this).data("menu");

        // console.log(data)

        $(".btn-navigation-3").removeClass("bg-gradient-info");
        $(".btn-navigation-3").removeClass("bg-gradient-secondary");
        $(".btn-navigation-3").addClass("bg-gradient-secondary");

        $(`[data-menu='${data}']`).removeClass("bg-gradient-secondary");
        $(`[data-menu='${data}']`).addClass("bg-gradient-info");

        $(".menu-navigation-3").hide();
        $("#" + data).show();
    })

    $(".btn-navigation-2").on("click", function(){
        $(".alert-error").hide();

        let data = $(this).data("menu");

        // console.log(data)

        $(".btn-navigation-2").removeClass("bg-gradient-info");
        $(".btn-navigation-2").removeClass("bg-gradient-secondary");
        $(".btn-navigation-2").addClass("bg-gradient-secondary");

        $(`[data-menu='${data}']`).removeClass("bg-gradient-secondary");
        $(`[data-menu='${data}']`).addClass("bg-gradient-info");

        $(".menu-navigation-2").hide();
        $("#" + data).show();
    })
</script>