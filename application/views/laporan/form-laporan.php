   <!-- Content Wrapper -->
   <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $title?></h1>
    </div>
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
                <input type="password" name="password" id="password" class="form-control form-control-sm" required>
            </div>
            <div class="form-group">
                <label for="laporan">Laporan</label>
                <select name="laporan" id="jenis-laporan" class="form-control form-control-sm" required>
                    <option value="">Pilih Laporan</option>
                    <option value="Buku">Laporan Buku</option>
                    <option value="Peserta">Laporan Peserta</option>
                    <option value="Transaksi">Laporan Transaksi</option>
                    <option value="Piutang PV Khusus">Laporan Piutang PV Khusus</option>
                    <option value="Piutang Reguler">Laporan Piutang Reguler</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tgl_awal">Tgl Awal</label>
                <input type="date" name="tgl_awal" id="tgl_awal" class="form-control form-control-sm" disabled>
            </div>
            <div class="form-group">
                <label for="tgl_akhir">Tgl Akhir</label>
                <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control form-control-sm" disabled>
            </div>
            <div class="d-flex justify-content-end">
                <input type="submit" value="Cetak Laporan" class="btn btn-sm btn-success">
            </div>
        </form>
   </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

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