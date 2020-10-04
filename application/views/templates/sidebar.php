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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dropone" aria-expanded="true" aria-controls="dropone">
          <i class="fas fa-fw fa-user-plus"></i>
          <span>Tambah Pendaftar</span>
        </a>
        <div id="dropone" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header text-light">Tambah Pendaftar</h6>
            <a class="collapse-item text-light" href="<?=base_url()?>pendaftaran/reguler">Reguler</a>
            <a class="collapse-item text-light" href="<?=base_url()?>pendaftaran/pvkhusus">PV Khusus</a>
            <a class="collapse-item text-light" href="<?=base_url()?>pendaftaran/pvluar">PV Luar</a>
            <a class="collapse-item text-light" href="<?=base_url()?>pendaftaran/pvinstansi">PV Instansi</a>
          </div>
        </div>
      </li>
      
      
      <li class="nav-item" id="ppu">
        <a class="nav-link" href="<?= base_url()?>ppu/">
          <i class="fas fa-fw fa-share-alt"></i>
          <span>PPU</span></a>
      </li>

      <li class="nav-item" id="piutang">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#droptwo" aria-expanded="true" aria-controls="droptwo">
          <i class="fas fa-fw fa-money-check-alt"></i>
          <span>Transaksi</span>
        </a>
        <div id="droptwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header text-light">Transaksi</h6>
            <a class="collapse-item text-light" href="<?= base_url()?>piutang/reguler">Piutang Reguler</a>
            <a class="collapse-item text-light" href="<?= base_url()?>piutang/pvkhusus">Piutang PV Khusus</a>
            <a class="collapse-item text-light" href="<?= base_url()?>piutang/pvluar">Piutang PV Luar</a>
            <a class="collapse-item text-light" href="<?= base_url()?>piutang/civitas">Piutang Civitas</a>
            <a class="collapse-item text-light" href="<?= base_url()?>transaksi/lainnya">Transaksi Lainnya</a>
          </div>
        </div>
      </li>

      <li class="nav-item" id="waitingList">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dropfour" aria-expanded="true" aria-controls="dropfour">
          <i class="fas fa-fw fa-clock"></i>
          <span>Waiting List</span>
        </a>
        <div id="dropfour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header text-light">Waiting List</h6>
            <a class="collapse-item text-light" href="<?=base_url()?>wl/reguler">Reguler</a>
            <a class="collapse-item text-light" href="<?=base_url()?>wl/privat">Privat</a>
            <a class="collapse-item text-light" href="<?=base_url()?>wl/pending">Pending</a>
          </div>
        </div>
      </li>

      <li class="nav-item" id="peserta">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dropthree" aria-expanded="true" aria-controls="dropthree">
          <i class="fas fa-fw fa-users"></i>
          <span>Peserta</span>
        </a>
        <div id="dropthree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header text-light">Peserta</h6>
            <a class="collapse-item text-light" href="<?= base_url()?>peserta/reguler/aktif">Reguler Aktif</a>
            <a class="collapse-item text-light bg-danger" href="<?= base_url()?>peserta/reguler/nonaktif">Reguler Nonaktif</a>
            <a class="collapse-item text-light" href="<?= base_url()?>peserta/pvkhusus/aktif">Pv Khusus Aktif</a>
            <a class="collapse-item text-light bg-danger" href="<?= base_url()?>peserta/pvkhusus/nonaktif">Pv Khusus Nonaktif</a>
            <a class="collapse-item text-light" href="<?= base_url()?>peserta/pvluar/aktif">Pv Luar Aktif</a>
            <a class="collapse-item text-light bg-danger" href="<?= base_url()?>peserta/pvluar/nonaktif">Pv Luar Nonaktif</a>
          </div>
        </div>
      </li>
      
      <!-- <li class="nav-item" id="kelas">
        <a class="nav-link" href="<?= base_url()?>kelas/reguler">
          <i class="fas fa-fw fa-building"></i>
          <span>kelas</span></a>
      </li> -->
      <li class="nav-item" id="kelas">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dropfive" aria-expanded="true" aria-controls="dropfive">
          <i class="fas fa-fw fa-building"></i>
          <span>Kelas</span>
        </a>
        <div id="dropfive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header text-light">Waiting List</h6>
            <a class="collapse-item text-light" href="<?=base_url()?>kelas/reguler">Reguler</a>
            <a class="collapse-item text-light" href="<?=base_url()?>kelas/pvkhusus">PV Khusus</a>
            <a class="collapse-item text-light" href="<?=base_url()?>kelas/pvluar">PV Luar</a>
          </div>
        </div>
      </li>
      
      <li class="nav-item" id="laporan">
        <a class="nav-link" href="<?= base_url('laporan')?>">
          <i class="fas fa-fw fa-flag"></i>
          <span>laporan</span></a>
      </li>

      <li class="nav-item" id="tambahPiutang">
        <a class="nav-link" href="<?= base_url()?>login/logout">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>keluar</span></a>
      </li>
    </ul>
    <!-- End of Sidebar -->
