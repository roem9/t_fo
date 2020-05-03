    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Front Office</div>
      </a>

      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Front Office
      </div>

      <li class="nav-item" id="home">
        <a class="nav-link" href="<?= base_url()?>home">
          <i class="fas fa-fw fa-home"></i>
          <span>home</span></a>
      </li>
      
      <li class="nav-item" id="tambahPeserta">
        <a class="nav-link" href="<?= base_url()?>pendaftaran/reguler">
          <i class="fas fa-fw fa-user-plus"></i>
          <span>tambah pendaftar</span></a>
      </li>

      <li class="nav-item" id="waitingList">
        <a class="nav-link" href="<?= base_url()?>wl/peserta">
          <i class="fas fa-fw fa-clock"></i>
          <span>waiting list</span></a>
      </li>
      
      <li class="nav-item" id="peserta">
        <a class="nav-link" href="<?= base_url()?>peserta/reguler">
          <i class="fas fa-fw fa-user"></i>
          <span>peserta</span></a>
      </li>
      
      <li class="nav-item" id="kelas">
        <a class="nav-link" href="<?= base_url()?>kelas/reguler">
          <i class="fas fa-fw fa-building"></i>
          <span>kelas</span></a>
      </li>

      <li class="nav-item" id="rekapKelas">
        <a class="nav-link" href="<?= base_url()?>rekap/pvkhusus">
          <i class="fas fa-fw fa-building"></i>
          <span>rekap kelas</span></a>
      </li>

      <li class="nav-item" id="piutang">
        <a class="nav-link" href="<?= base_url()?>piutang/pvkhusus">
          <i class="fas fa-fw fa-money-check-alt"></i>
          <span>piutang</span></a>
      </li>
      
      <li class="nav-item" id="transaksi-lain">
        <a class="nav-link" href="<?= base_url()?>transaksi/lainnya">
          <i class="fas fa-fw fa-money-check-alt"></i>
          <span>transaksi lain</span></a>
      </li>
      
      <li class="nav-item" id="laporan">
        <a class="nav-link" href="#modal-laporan" data-toggle="modal">
          <i class="fas fa-fw fa-money-check-alt"></i>
          <span>laporan</span></a>
      </li>

      <li class="nav-item" id="tambahPiutang">
        <a class="nav-link" href="<?= base_url()?>login/logout">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>keluar</span></a>
      </li>
    </ul>
    <!-- End of Sidebar -->
