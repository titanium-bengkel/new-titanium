<script src="../dist/assets/static/js/initTheme.js"></script>
<div id="app">
    <div id="sidebar">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header position-relative">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo" style="font-size: 24px; font-weight: bold; color: #fff;">
                        <a href="dashboard/index" style="text-decoration: none; color: inherit;">TITANIUM</a>
                    </div>
                    <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                            <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                                <g transform="translate(-210 -1)">
                                    <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                    <circle cx="220.5" cy="11.5" r="4"></circle>
                                    <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                                </g>
                            </g>
                        </svg>
                        <div class="form-check form-switch fs-6">
                            <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                            <label class="form-check-label"></label>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                            </path>
                        </svg>
                    </div>
                    <div class="sidebar-toggler  x">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>
                    <li class="sidebar-item ">
                        <a href="dashboard/index" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item ">
                        <a href="<?= base_url('dashboard_keuangan') ?>" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard Keuangan</span>
                        </a>
                    </li>
                    <!-- mulai sidebar menu SuperAdmin -->
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Super Admin</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="<?= base_url('kel_user') ?>" class="submenu-link">Kelola User</a>
                            </li>
                            <li class="submenu-item">
                                <a href="<?= base_url('menu_akses') ?>" class="submenu-link">Kelola Akses Menu</a>
                            </li>
                        </ul>
                    </li>
                    <!-- mulai sidebar menu KLAIM -->
                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-stack"></i>
                            <span>Klaim</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="<?= base_url('klaim/preorder') ?>" class="submenu-link">Est. Perbaikan</a>
                            </li>
                            <li class="submenu-item">
                                <a href="<?= base_url('orderlist_asuransi') ?>" class="submenu-link">Approval Asuransi</a>
                            </li>
                            <li class="submenu-item">
                                <a href="<?= base_url('repair_order') ?>" class="submenu-link">Repair Order</a>
                            </li>
                            <!-- <li class="submenu-item">
                                <a href="<?= base_url('invoice_or') ?>" class="submenu-link">Cetak Kwitansi OR</a>
                            </li> -->
                            <li class="submenu-item">
                                <a href="<?= base_url('orderlist_pending') ?>" class="submenu-link">Pending Invoice</a>
                            </li>
                            <li class="submenu-item">
                                <a href="<?= base_url('kwitansi') ?>" class="submenu-link">Cetak Kwitansi</a>
                            </li>
                            <li class="submenu-item">
                                <a href="<?= base_url('bayar_piutang') ?>" class="submenu-link">Payment</a>
                            </li>
                            <li class="submenu-item">
                                <a href="<?= base_url('kwitansi_piutang') ?>" class="submenu-link">Pending Payment</a>
                            </li>

                            <li class="submenu-item has-sub">
                                <a href="#" class="submenu-link" onclick="toggleDropdown(event)">Mobil Status</a>
                                <ul class="submenu-dropdown" style="display: none;">
                                    <li>
                                        <a href="<?= base_url('klaim/mobil_batal') ?>" class="submenu-link">Batal Masuk</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('klaim/mobil_batal_asuransi') ?>" class="submenu-link">Batal Asuransi</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('klaim/mobil_selesai') ?>" class="submenu-link">Selesai</a>
                                    </li>
                                </ul>
                            </li>
                            <script>
                                function toggleDropdown(event) {
                                    event.preventDefault(); // Mencegah link dari berpindah halaman
                                    const submenuDropdown = event.target.nextElementSibling;

                                    // Mengecek dan mengubah display dropdown
                                    if (submenuDropdown.style.display === "none" || submenuDropdown.style.display === "") {
                                        submenuDropdown.style.display = "block";
                                    } else {
                                        submenuDropdown.style.display = "none";
                                    }
                                }
                            </script>
                        </ul>
                    </li>
                    <!-- selesai menu Sidebar Bahan-->
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-collection-fill"></i>
                            <span>Bahan</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item  ">
                                <a href="<?= base_url('po_bahan') ?>" class="submenu-link">Pemesanan Bahan (PO)</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('terima_bahan') ?>" class="submenu-link">Penerimaan Barang</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('repair_material') ?>" class="submenu-link">Repair Material</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('laporan_mutasi') ?>" class="submenu-link">Laporan Mutasi Gudang Bahan</a>
                            </li>
                        </ul>
                    </li>
                    <!-- selesai menu Sidebar Sparepart -->
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Sparepart</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item  ">
                                <a href="<?= base_url('permintaan_part') ?>" class="submenu-link">Permintaan Sparepart</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('pesan_part') ?>" class="submenu-link">Pemesanan Sparepart (PO)</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('terima_part') ?>" class="submenu-link">Penerimaan Sparepart</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('minta_part_supp') ?>" class="submenu-link">Permintaan Sparepart Supply</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('supp_asuransi') ?>" class="submenu-link">Supply Asuransi</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('repair_material_part') ?>" class="submenu-link">Repair Material Sparepart</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('mutasi_gudang_part') ?>" class="submenu-link">Laporan Mutasi Gudang Sparepart</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('waiting_part') ?>" class="submenu-link">Sparepart Dalam Pemesanan</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('sparepart_masuk') ?>" class="submenu-link">Sparepart Sudah Diterima</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('part_salvage') ?>" class="submenu-link">Sparepart Salvage</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('part_sisa') ?>" class="submenu-link">Sparepart Sisa (Belum Terpasang)</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('stok_part') ?>" class="submenu-link">Kartu Stok Sparepart</a>
                            </li>
                        </ul>
                    </li>
                    <!-- selesai menu Sidebar Keuangan -->
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-hexagon-fill"></i>
                            <span>Keuangan</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item  ">
                                <a href="<?= base_url('hutang') ?>" class="submenu-link">Hutang Per Supplier</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('bayar_hutang') ?>" class="submenu-link">Pembayaran Hutang</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('pembelian') ?>" class="submenu-link">Pembelian</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('kas_bank') ?>" class="submenu-link">Kas & Bank</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('kas_kecil') ?>" class="submenu-link">Kas Kecil</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('keluar_kasbesar') ?>">Pengeluaran Kas Besar</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('kas_masuk') ?>" class="submenu-link">Kas Masuk</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('kas_keluar') ?>" class="submenu-link">Kas Keluar</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('ro_list') ?>" class="submenu-link">Repair Order List</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('material_jasa') ?>" class="submenu-link">Repair Material Jasa</a>
                            </li>
                        </ul>
                    </li>
                    <!-- selesai menu Sidebar Report -->
                    <li class="sidebar-item  has-sub  ">
                        <a href="form-layout.html" class='sidebar-link'>
                            <i class="bi bi-file-earmark-medical-fill"></i>
                            <span>Report</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item  ">
                                <a href="<?= base_url('report_jurnal') ?>" class="submenu-link">Report Jurnal</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('buku_besar') ?>" class="submenu-link">General Ledger (Buku Besar)</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('laba_rugi') ?>" class="submenu-link">Income Statment (Laba Rugi)</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('neraca') ?>" class="submenu-link">Balance Sheet(Neraca)</a>
                            </li>
                        </ul>
                    </li>
                    <!-- selesai menu Sidebar Master -->
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-journal-check"></i>
                            <span>Master</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item  ">
                                <a href="<?= base_url('master/barangkategori') ?>" class="submenu-link">Kategori Barang</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('master/baranggroup') ?>" class="submenu-link">Grup Barang</a>
                            </li>
                            <!-- <li class="submenu-item  ">
                                <a href="<?= base_url('master/barang') ?>" class="submenu-link">Barang</a>
                            </li> -->
                            <li class="submenu-item  ">
                                <a href="<?= base_url('master/mastersparepart') ?>" class="submenu-link">Sparepart</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('master/masterbahan') ?>" class="submenu-link">Bahan</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('master/pengerjaan') ?>" class="submenu-link">Pengerjaan</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('master/alokasibarang') ?>" class="submenu-link">Alokasi Barang</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('master/jasa') ?>" class="submenu-link">Jasa</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('master/asuransi') ?>" class="submenu-link">Asuransi</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('master/gudang') ?>" class="submenu-link">Gudang</a>
                            </li>
                            <!-- <li class="submenu-item  ">
                                <a href="<?= base_url('master/salesman') ?>" class="submenu-link">Salesman</a>
                            </li> -->
                            <li class="submenu-item  ">
                                <a href="<?= base_url('master/coa') ?>" class="submenu-link">Chart of Account</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('master/supplier') ?>" class="submenu-link">Supplier</a>
                            </li>
                        </ul>
                        <!-- selesai menu Sidebar Monitoring -->
                    </li>
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-pen-fill"></i>
                            <span>Monitoring</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item  ">
                                <a href="<?= base_url('monitoring/history') ?>" class="submenu-link">Histori Edit</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="<?= base_url('monitoring/jadwal_keluar') ?>" class="submenu-link">Jadwal Mobil Keluar</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="form-editor-summernote.html" class="submenu-link">Traking Unit</a>
                            </li>
                        </ul>
                        <!-- selesai menu Sidebar Website -->
                    </li>
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                            <span>Website</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item  ">
                                <a href="<?= base_url('website/video_home') ?>" class="submenu-link">Video Home</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="table-datatable-jquery.html" class="submenu-link">Tentang Kami (About Us)</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="table-datatable-jquery.html" class="submenu-link">Layanan (Service)</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="table-datatable-jquery.html" class="submenu-link">Gallery</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="table-datatable-jquery.html" class="submenu-link">Testimoni Konsumen</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="main" class='layout-navbar navbar-fixed'>
        <header>
            <nav class="navbar navbar-expand navbar-light navbar-top">
                <div class="container-fluid">
                    <a href="#" class="burger-btn d-block">
                        <i class="bi bi-justify fs-3"></i>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-lg-0">
                            <li class="nav-item dropdown me-1">
                                <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bi bi-envelope bi-sub fs-4'></i>
                                </a>
                                <ul class="dropdown-menu  dropdown-menu-lg-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">Mail</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">No new mail</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown me-3">
                                <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <i class='bi bi-bell bi-sub fs-4'></i>
                                    <span class="badge badge-notification bg-danger">7</span>
                                </a>
                                <ul class="dropdown-menu dropdown-center  dropdown-menu-sm-end notification-dropdown" aria-labelledby="dropdownMenuButton">
                                    <li class="dropdown-header">
                                        <h6>Notifications</h6>
                                    </li>
                                    <li class="dropdown-item notification-item">
                                        <a class="d-flex align-items-center" href="#">
                                            <div class="notification-icon bg-primary">
                                                <i class="bi bi-cart-check"></i>
                                            </div>
                                            <div class="notification-text ms-4">
                                                <p class="notification-title font-bold">Successfully check out</p>
                                                <p class="notification-subtitle font-thin text-sm">Order ID #256</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown-item notification-item">
                                        <a class="d-flex align-items-center" href="#">
                                            <div class="notification-icon bg-success">
                                                <i class="bi bi-file-earmark-check"></i>
                                            </div>
                                            <div class="notification-text ms-4">
                                                <p class="notification-title font-bold">Homework submitted</p>
                                                <p class="notification-subtitle font-thin text-sm">Algebra math homework</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <p class="text-center py-2 mb-0"><a href="#">See all notification</a></p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-menu d-flex">
                                    <div class="user-name text-end me-3">
                                        <h6 class="mb-0 text-gray-600"><?= session()->get('nama_user'); ?></h6>
                                        <p class="mb-0 text-sm text-gray-600"><?= session()->get('level'); ?></p>
                                    </div>

                                    <div class="user-img d-flex align-items-center">
                                        <div class="avatar avatar-md">
                                            <img src="<?= base_url('./dist/assets/compiled/jpg/2.jpg') ?>">
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                <li>
                                    <h6 class="dropdown-header">Hello, Admin!</h6>
                                </li>
                                <li><a class="dropdown-item" href="<?= base_url('profile') ?>"><i class="icon-mid bi bi-person me-2"></i> My Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i>
                                        Settings</a></li>
                                <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <div id="main-content">