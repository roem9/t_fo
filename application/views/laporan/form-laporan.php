    <!-- Page Heading -->
    <?php if( $this->session->flashdata('pesan') ) : ?>
        <div class="row">
            <div class="col-12 col-md-6">
                <?= $this->session->flashdata("pesan")?>
            </div>
        </div>
    <?php endif; ?>
   
   <div class="col-12 col-md-6">
        <!-- <form action="<?=base_url()?>transaksi/cetak_laporan" method="post"> -->
        <form action="<?=base_url()?>laporan/cetak_laporan" method="post" target="_blank">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control form-control-md" required>
            </div>
            <div class="form-group">
                <label for="laporan">Laporan</label>
                <select name="laporan" id="jenis-laporan" class="form-control form-control-md" required>
                    <option value="">Pilih Laporan</option>
                    <option value="Buku">Laporan Buku</option>
                    <option value="Peserta Keseluruhan">Laporan Peserta Keseluruhan</option>
                    <option value="Peserta Reguler">Laporan Peserta Reguler</option>
                    <option value="Peserta PV Khusus">Laporan Peserta PV Khusus</option>
                    <option value="Peserta PV Luar">Laporan Peserta PV Luar</option>
                    <option value="Transaksi">Laporan Transaksi Cash</option>
                    <option value="Piutang PV Khusus">Laporan Piutang PV Khusus</option>
                    <option value="Piutang Reguler">Laporan Piutang Reguler</option>
                    <option value="PPU">Laporan PPU</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tgl_awal">Tgl Awal</label>
                <input type="date" name="tgl_awal" id="tgl_awal" class="form-control form-control-md" disabled>
            </div>
            <div class="form-group">
                <label for="tgl_akhir">Tgl Akhir</label>
                <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control form-control-md" disabled>
            </div>
            <div class="d-flex justify-content-end">
                <input type="submit" value="Cetak Laporan" class="btn btn-sm btn-success">
            </div>
        </form>
   </div>
   
<?= footer()?>
<script>
    $("#laporan").addClass("active");

    $("#jenis-laporan").change(function(){
        if($(this).val() == "Piutang Reguler" || $(this).val() == "Piutang PV Khusus" || $(this).val() == ""){
            $("#tgl_awal").prop('disabled', 'disabled')
            $("#tgl_akhir").prop('disabled', 'disabled')
            $("#tgl_awal").prop('required', false);
            $("#tgl_akhir").prop('required', false);
        } else {
            $("#tgl_awal").removeAttr('disabled')
            $("#tgl_akhir").removeAttr('disabled')
            $("#tgl_awal").prop('required', true);
            $("#tgl_akhir").prop('required', true);
        }
    })
</script>