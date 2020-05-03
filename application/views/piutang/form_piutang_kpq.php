<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $header?></h1>
    </div>

    <?php if( $this->session->flashdata('piutang') ) : ?>
        <div class="row">
            <div class="col-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data piutang <strong>berhasil</strong> <?= $this->session->flashdata('piutang');?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="max-width: 600px;">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
              <a class="nav-link <?php if($tabs == 'peserta') echo 'active'?>" href="<?= base_url()?>piutang/tambahpiutangpeserta">Reguler</a>
          </li>
          <li class="nav-item">
              <a class="nav-link <?php if($tabs == 'kelas') echo 'active'?>" href="<?= base_url()?>piutang/tambahpiutangkelas">Private</a>
          </li>
          <li class="nav-item">
              <a class="nav-link <?php if($tabs == 'kpq') echo 'active'?>" href="<?= base_url()?>piutang/tambahpiutangkpq">KPQ</a>
          </li>
        </ul>
      </div>
      <div class="card-body">
            <form action="<?= base_url()?>piutang/addpiutangkpq" method="post">
                <!-- nama  -->
                <div class="form-group">
                    <label for="nip">Nama Pengajar</label>
                    <select name="nip" id="nip" class="form-control form-control-sm" required>
                        <option value="">Pilih Pengajar</option>
                        <?php foreach ($pengajar as $pengajar) :?>
                            <option value="<?=$pengajar['nip']?>"><?=$pengajar['nama_kpq']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tgl_invoice">Tgl Invoice<span class="text-danger">*</span></label>
                    <input type="date" name="tgl_invoice" id="tgl_invoice" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label for="uraian">Uraian<span class="text-danger">*</span></label>
                    <textarea name="uraian" id="uraian" class="form-control form-control-sm" required></textarea>
                </div>
                <div class="form-group">
                    <label for="nominal">Nominal<span class="text-danger">*</span></label>
                    <input type="text" name="nominal" id="nominal" class="form-control form-control-sm" required>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-sm" id="tambah">Tambah Piutang</button>
                </div>
            </form>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<script type="text/javascript">
    $(document).ready(function(){

        $("#tambahPiutang").addClass("active");
        $("#tambah").click(function(){
            var c = confirm("Yakin akan menambahkan piutang?");
            return c;
        })

        $("#nominal").keyup(function(){
            $("#nominal").val(formatRupiah(this.value, 'Rp. '))
        })
    });
</script>