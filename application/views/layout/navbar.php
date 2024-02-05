<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white"
    id="sidenav-main" data-color="info">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/">
            <img src="<?= base_url()?>/assets/img/logo.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold"></span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-auto pb-0" id="sidenav-collapse-mai">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?= ($sidebar == "home") ? 'active' : '' ?>" href="
                    <?= base_url('home') ?>">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#pendaftarMenu" class="nav-link <?= ($sidebar == "tambah pendaftar") ? 'active' : '' ?>" aria-controls="pendaftarMenu"
                    role="button" aria-expanded="<?= ($sidebar == "tambah pendaftar") ? 'true' : 'false' ?>">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                            <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Tambah Pendaftar</span>
                </a>
                <div class="collapse <?= ($sidebar == "tambah pendaftar") ? 'show' : '' ?>" id="pendaftarMenu" style="">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "reguler") ? 'active' : '' ?>" href="
                                <?= base_url()?>pendaftaran/reguler">
                                <span class="sidenav-normal"> Reguler </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "pv khusus") ? 'active' : '' ?>" href="
                                <?=base_url()?>pendaftaran/pvkhusus">
                                <span class="sidenav-normal"> PV Khusus </span>
                            </a>
                        </li><li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "pv luar") ? 'active' : '' ?>" href="
                                <?=base_url()?>pendaftaran/pvluar">
                                <span class="sidenav-normal"> PV Luar </span>
                            </a>
                        </li><li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "pv instansi") ? 'active' : '' ?>" href="
                                <?=base_url()?>pendaftaran/pvinstansi">
                                <span class="sidenav-normal"> PV Instansi </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($sidebar == "ppu") ? 'active' : '' ?>" href="
                    <?= base_url('ppu') ?>">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-raised-hand" viewBox="0 0 16 16">
                            <path d="M6 6.207v9.043a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H6.236a.998.998 0 0 1-.447-.106l-.33-.165A.83.83 0 0 1 5 2.488V.75a.75.75 0 0 0-1.5 0v2.083c0 .715.404 1.37 1.044 1.689L5.5 5c.32.32.5.754.5 1.207"/>
                            <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">PPU</span>
                </a>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#transaksiMenu" class="nav-link <?= ($sidebar == "transaksi") ? 'active' : '' ?>" aria-controls="transaksiMenu"
                    role="button" aria-expanded="<?= ($sidebar == "transaksi") ? 'true' : 'false' ?>">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Transaksi</span>
                </a>
                <div class="collapse <?= ($sidebar == "transaksi") ? 'show' : '' ?>" id="transaksiMenu" style="">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "piutang reguler") ? 'active' : '' ?>" href="
                                <?= base_url()?>piutang/reguler">
                                <span class="sidenav-normal"> Piutang Reguler </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "piutang pv khusus") ? 'active' : '' ?>" href="
                                <?= base_url()?>piutang/pvkhusus">
                                <span class="sidenav-normal"> Piutang PV Khusus </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "piutang pv luar") ? 'active' : '' ?>" href="
                                <?= base_url()?>piutang/pvluar">
                                <span class="sidenav-normal"> Piutang PV Luar </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "piutang civitas") ? 'active' : '' ?>" href="
                                <?= base_url()?>piutang/civitas">
                                <span class="sidenav-normal"> Piutang Civitas </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "transaksi lainnya") ? 'active' : '' ?>" href="
                                <?= base_url()?>transaksi/lainnya">
                                <span class="sidenav-normal"> Transaksi Lainnya </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#watinglistMenu" class="nav-link <?= ($sidebar == "waiting list") ? 'active' : '' ?>" aria-controls="watinglistMenu"
                    role="button" aria-expanded="<?= ($sidebar == "waiting list") ? 'true' : 'false' ?>">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-top" viewBox="0 0 16 16">
                            <path d="M2 14.5a.5.5 0 0 0 .5.5h11a.5.5 0 1 0 0-1h-1v-1a4.5 4.5 0 0 0-2.557-4.06c-.29-.139-.443-.377-.443-.59v-.7c0-.213.154-.451.443-.59A4.5 4.5 0 0 0 12.5 3V2h1a.5.5 0 0 0 0-1h-11a.5.5 0 0 0 0 1h1v1a4.5 4.5 0 0 0 2.557 4.06c.29.139.443.377.443.59v.7c0 .213-.154.451-.443.59A4.5 4.5 0 0 0 3.5 13v1h-1a.5.5 0 0 0-.5.5m2.5-.5v-1a3.5 3.5 0 0 1 1.989-3.158c.533-.256 1.011-.79 1.011-1.491v-.702s.18.101.5.101.5-.1.5-.1v.7c0 .701.478 1.236 1.011 1.492A3.5 3.5 0 0 1 11.5 13v1z"/>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Waiting List</span>
                </a>
                <div class="collapse <?= ($sidebar == "waiting list") ? 'show' : '' ?>" id="watinglistMenu" style="">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "wl reguler") ? 'active' : '' ?>" href="
                                <?=base_url()?>wl/reguler">
                                <span class="sidenav-normal"> Reguler </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "wl privat") ? 'active' : '' ?>" href="
                                <?=base_url()?>wl/privat">
                                <span class="sidenav-normal"> Privat </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "wl pending") ? 'active' : '' ?>" href="
                                <?=base_url()?>wl/pending">
                                <span class="sidenav-normal"> Pending </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#pesertaMenu" class="nav-link <?= ($sidebar == "peserta") ? 'active' : '' ?>" aria-controls="pesertaMenu"
                    role="button" aria-expanded="<?= ($sidebar == "peserta") ? 'true' : 'false' ?>">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Peserta</span>
                </a>
                <div class="collapse <?= ($sidebar == "peserta") ? 'show' : '' ?>" id="pesertaMenu" style="">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "reguler aktif") ? 'active' : '' ?>" href="
                                <?= base_url()?>peserta/reguler/aktif">
                                <span class="sidenav-normal"> Reguler Aktif </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "reguler nonaktif") ? 'active' : '' ?>" href="
                                <?= base_url()?>peserta/reguler/nonaktif">
                                <span class="sidenav-normal"> Reguler Nonaktif </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "pv khusus aktif") ? 'active' : '' ?>" href="
                                <?= base_url()?>peserta/pvkhusus/aktif">
                                <span class="sidenav-normal"> Pv Khusus Aktif </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "pv khusus nonaktif") ? 'active' : '' ?>" href="
                                <?= base_url()?>peserta/pvkhusus/nonaktif">
                                <span class="sidenav-normal"> Pv Khusus Nonaktif </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "pv luar aktif") ? 'active' : '' ?>" href="
                                <?= base_url()?>peserta/pvluar/aktif">
                                <span class="sidenav-normal"> Pv Luar Aktif </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "pv luar nonaktif") ? 'active' : '' ?>" href="
                                <?= base_url()?>peserta/pvluar/nonaktif">
                                <span class="sidenav-normal"> Pv Luar Nonaktif </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#kelasMenu" class="nav-link <?= ($sidebar == "kelas") ? 'active' : '' ?>" aria-controls="kelasMenu"
                    role="button" aria-expanded="<?= ($sidebar == "kelas") ? 'true' : 'false' ?>">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building-fill" viewBox="0 0 16 16">
                            <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Kelas</span>
                </a>
                <div class="collapse <?= ($sidebar == "kelas") ? 'show' : '' ?>" id="kelasMenu" style="">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "reguler") ? 'active' : '' ?>" href="
                                <?=base_url()?>kelas/reguler">
                                <span class="sidenav-normal"> Reguler </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "pv khusus") ? 'active' : '' ?>" href="
                                <?=base_url()?>kelas/pvkhusus">
                                <span class="sidenav-normal"> PV Khusus </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?= ($sidebarDropdown == "pv luar") ? 'active' : '' ?>" href="
                                <?=base_url()?>kelas/pvluar">
                                <span class="sidenav-normal"> Pv Luar </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($sidebar == "laporan") ? 'active' : '' ?>" href="
                    <?= base_url('laporan') ?>">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag-fill" viewBox="0 0 16 16">
                                <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001"/>
                            </svg>
                    </div>
                    <span class="nav-link-text ms-1">Laporan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" onclick="logout()">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                            <path fill-rule="evenodd"
                                d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 border-radius-xl shadow-none" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                            href="javascript:void(0);">Pages</a></li>
                    <?php if (isset($breadcrumbs)) : ?>
                    <?php foreach ($breadcrumbs as $breadcrumb) : ?>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                        <?= $breadcrumb ?>
                    </li>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (isset($breadcrumbSelect)) : ?>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                        <select name="moveSelected" id="moveSelected" style="border:none; background-color: inherit">
                            <?php foreach ($breadcrumbSelect as $select) : ?>
                            <?= $select ?>
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <?php endif; ?>
                </ol>
                <h6 class="font-weight-bolder mb-0">
                    <?= $title ?>
                </h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 justify-content-end" id="navbar">
                <div
                    class="navbar-nav <?= (isset($searchButton) && $searchButton) ? 'justify-content-between' : 'justify-content-end' ?>">
                    <?php if (isset($searchButton) && $searchButton) : ?>
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search"
                                    aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="cari client" id="formSearch">
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->


    <div class="container-fluid py-4">
        