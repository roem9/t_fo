<div class="modal fade" id="modalTransaksi" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title nama-title" id="exampleModalScrollableTitle">Transaksi Lainnya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url()?>kartupiutang/tambah_deposit" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="tipe" id="" value="Lainnya">
                    <input type="hidden" name="pengajar" value="-">
                    <div class="form-group">
                        <label for="nama_deposit">Nama</label>
                        <input type="text" name="nama" id="nama_deposit" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="untuk">Pembayaran Untuk?</label>
                        <select name="keterangan" id="untuk" class="form-control form-control-sm" required>
                            <option value="">Pilih Pembayaran Untuk</option>
                            <option value="Buku">Buku</option>
                            <option value="Lainnya">Lainnya</option>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>