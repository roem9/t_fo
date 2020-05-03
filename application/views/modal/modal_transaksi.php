<div class="modal fade" id="modalTransaksi" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title nama-title" id="exampleModalScrollableTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a href="#" class='nav-link' id="btn-form-1" data-id="">Transaksi Langsung</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class='nav-link' id="btn-form-2" data-id="">Tagihan</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class='nav-link' id="btn-form-3" data-id="">Pembayaran</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                        <form action="<?= base_url()?>piutang/pembayaran" method="POST" enctype="multipart/form-data" id="form-1">
                            <input type="hidden" name="tipe" id="tipe_kwitansi">
                            <input type="hidden" name="id" id="id_kwitansi">
                            <input type="hidden" name="pengajar" id="pengajar_kwitansi">
                            <div class="form-group">
                                <label for="nama_kwitansi">Nama Kwitansi</label>
                                <input type="text" name="nama" id="nama_kwitansi" class="form-control form-control-sm" readonly>
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
                                <label for="tgl">Tgl Kwitansi</label>
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
                                <input type="text" name="nominal" id="nominal_pembayaran" class="form-control form-control-sm" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type="submit" value="Tambah Pembayaran" class="btn btn-sm btn-primary" id="btn-submit-1">
                            </div>
                        </form>

                        <form action="<?= base_url()?>kartupiutang/tambah_piutang" method="POST" enctype="multipart/form-data" id="form-2">
                            <input type="hidden" name="tipe" id="tipe_tagihan">
                            <!-- id dari kelas, peserta atau kpq -->
                            <input type="hidden" name="id" id="id_tagihan">
                            <div class="form-group">
                                <label for="nama_tagihan">Nama Invoice</label>
                                <input type="text" name="nama" id="nama_tagihan" class="form-control form-control-sm" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tgl">Tgl Invoice</label>
                                <input type="date" name="tgl" id="tgl" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="uraian">Keterangan</label>
                                <textarea name="uraian" id="uraian" class="form-control form-control-sm" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="nominal_piutang">Nominal</label>
                                <input type="text" name="nominal" id="nominal_piutang" class="form-control form-control-sm" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type="submit" value="Tambah Piutang" class="btn btn-sm btn-primary" id="btn-submit-2">
                            </div>
                        </form>

                        <form action="<?=base_url()?>kartupiutang/add_pembayaran" method="post" enctype="multipart/form-data" id="form-3">
                            <input type="hidden" name="tipe" id="tipe_deposit">
                            <input type="hidden" name="id" id="id_deposit">
                            <input type="hidden" name="pengajar" id="pengajar_deposit">
                            <div class="form-group">
                                <label for="nama_deposit">Nama</label>
                                <input type="text" name="nama" id="nama_deposit" class="form-control form-control-sm" readonly>
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
                                <input type="text" name="nominal" id="nominal_deposit" class="form-control form-control-sm" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type="submit" value="Tambah Pembayaran" class="btn btn-sm btn-primary" id="btn-submit-3">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
    </form>
</div>