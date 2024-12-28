<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// routes for login
/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'AuthController::login_page');
$routes->get('dashboard/index', 'Home::index');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');
$routes->get('/profile', 'AuthController::profile');
$routes->post('updateProfile', 'AuthController::updateProfile');
$routes->get('dashboard_keuangan', 'Home::dsb_keuangan');

// Register dan Forget Password
$routes->get('register', 'AuthController::register');
$routes->post('registerSubmit', 'AuthController::registerSubmit');
$routes->get('forgot-password', 'AuthController::forgotPassword');
$routes->post('forgotPasswordSubmit', 'AuthController::forgotPasswordSubmit');
$routes->get('resetPassword', 'AuthController::resetPassword');
$routes->post('resetPasswordSubmit', 'AuthController::resetPasswordSubmit');

//routes superadmin
$routes->get('kel_user', 'SuperController::kelola_user');
$routes->get('menu_akses', 'SuperController::kelola_menu');
$routes->post('/supercontroller/createUser', 'SuperController::createUser');
$routes->post('/supercontroller/updateUser', 'SuperController::updateUser');
$routes->get('/supercontroller/deleteUser/(:num)', 'SuperController::deleteUser/$1');
$routes->get('pengaturan_role', 'SuperController::pengaturan_role');
$routes->post('role/update_permissions/(:num)', 'SuperController::update_permissions/$1');

// TAMPILAN USER
$routes->get('user_view', 'UserController::viewuser');

// routes for klaim

// produksi
// $routes->get('produksi', 'ProduksiController::produksi');
$routes->get('/produksi/headproduksi', 'ProduksiController::headproduksi');
$routes->get('/produksi/kelolaproduksi', 'ProduksiController::kelolaproduksi');
$routes->post('/produksi/updateProgres', 'ProduksiController::updateProgres');




// Pre Order
$routes->get('klaim/preorder', 'KlaimController::preorder');
$routes->post('preorder/create', 'KlaimController::createPo');
$routes->get('order_posprev/(:any)', 'KlaimController::input_order_posprev/$1');
$routes->post('updatePo/(:any)', 'KlaimController::updatePo/$1');
$routes->post('createPengerjaanPo', 'KlaimController::createPengerjaanPo');
$routes->post('updatePengerjaanPo/(:any)', 'KlaimController::updatePengerjaanPo/$1');
$routes->get('getPengerjaanData/(:segment)', 'KlaimController::getPengerjaanData/$1');
$routes->get('deletePengerjaanPo/(:any)', 'KlaimController::deletePengerjaanPo/$1');
$routes->get('klaim/mobil_batal', 'KlaimController::mobil_batal');
$routes->get('klaim/mobil_batal_asuransi', 'KlaimController::mobil_batal_asuransi');
$routes->get('klaim/mobil_selesai', 'KlaimController::mobil_selesai');



$routes->post('/createSparepart/(:any)', 'KlaimController::createSparepartPo/$1');
$routes->post('updateSparepartPo/(:any)', 'KlaimController::updateSparepartPo/$1');
$routes->get('getSparepartData/(:segment)', 'KlaimController::getSparepartData/$1');
$routes->get('deleteSparepartPo/(:num)', 'KlaimController::deleteSparepartPo/$1');

$routes->post('/createGambarPo', 'KlaimController::createGambarPo');
$routes->delete('deleteGambarPo/(:num)', 'KlaimController::deleteGambarPo/$1');
$routes->get('downloadAllGambar/(:any)', 'KlaimController::downloadAllGambar/$1');


$routes->post('/createAccAsuransi', 'KlaimController::createAccAsuransi');
$routes->post('/updateAccAsuransi/(:any)', 'KlaimController::UpdateAccAsuransi/$1');
$routes->get('/order_pos_asprev/(:any)', 'KlaimController::prev_as/$1');












$routes->get('orderlist_asuransi', 'KlaimController::orderlist_asuransi');
$routes->get('repair_order', 'KlaimController::repair_order');
$routes->get('orderlist_pending', 'KlaimController::orderlist_pending');
$routes->get('kwitansi', 'KlaimController::kwitansi');
$routes->get('kwitansi_piutang', 'KlaimController::kwitansi_piutang');
$routes->get('bayar_piutang', 'KlaimController::bayar_piutang');
$routes->get('invoice_or', 'KlaimController::invoice_or');
// Add
$routes->get('order_pos', 'KlaimController::input_order');
$routes->get('order_posprev', 'KlaimController::input_order_prev');
$routes->get('order_pos_as', 'KlaimController::input_od_asuransi');
// $routes->get('order_pos_asprev', 'KlaimController::prev_as');
$routes->get('order_repair/(:any)', 'KlaimController::input_repair/$1');
$routes->post('cetakKwitansi/(:any)', 'KlaimController::cetakKwitansi/$1');
$routes->post('update_ro/(:any)', 'KlaimController::update_ro/$1');
$routes->get('add_invo', 'KlaimController::add_invoice');
$routes->get('add_invo_or', 'KlaimController::add_invoice_or');
$routes->get('add_invoprev/(:any)', 'KlaimController::add_invoice_prev/$1');
$routes->post('createKwitansi', 'KlaimController::createKwitansi');
$routes->post('updateKwitansi/(:any)', 'KlaimController::updateKwitansi/$1');
$routes->get('deleteKwitansi/(:any)', 'KlaimController::deleteKwitansi/$1');
$routes->post('createKwitansiOR', 'KlaimController::createKwitansiOR');
$routes->post('updateKwitansiOR/(:any)', 'KlaimController::updateKwitansiOR/$1');
$routes->get('deleteKwitansiOR/(:any)', 'KlaimController::deleteKwitansiOR/$1');
$routes->get('add_invoprev_or/(:any)', 'KlaimController::add_invoice_prev_or/$1');
$routes->get('order_pospending/(:any)', 'KlaimController::order_pos_pending/$1');
$routes->get('kwitansi_piutangprev/(:any)', 'KlaimController::kwitansi_pending_preview/$1');
$routes->post('updatePiutang/(:any)', 'KlaimController::updatePiutang/$1');
$routes->get('add_bayar', 'KlaimController::add_pembayaran');
$routes->get('add_bayarprev/(:any)', 'KlaimController::add_pembayaran_prev/$1');
$routes->post('createInvoice', 'KlaimController::createInvoice');
$routes->post('addInvoice', 'KlaimController::addInvoice');
$routes->post('addPembayaran', 'KlaimController::addPembayaran');

$routes->get('repair_selesai', 'KlaimController::Repair_Selesai');
$routes->post('buttonExit/(:any)', 'KlaimController::buttonExit/$1');



//routes for bahan

// po bahan--------------------------------------------------------------------------------------------------------------------
$routes->get('po_bahan', 'BahanController::pemesanan_bahan');
$routes->get('order_bahan', 'BahanController::add_bahan');
$routes->get('/bahan', 'BahanController::add_bahan');
$routes->post('/bahan/create_bahan', 'BahanController::create_bahan');
$routes->get('/bahan/delete/(:any)', 'BahanController::delete_bahan/$1');
$routes->get('order_bahanprev/(:any)', 'BahanController::prev_bahan/$1');
$routes->get('/bahan/filter', 'BahanController::search');

// $routes->get('order_terima_bahanprev', 'BahanController::prev_bahan');

// terima bahan---------------------------------------------------------------------------------------------------------
$routes->get('order_terima_bahan', 'BahanController::bahan_terima_add');
$routes->get('order_terima_bahanprev/(:any)', 'BahanController::bahan_terima_prev/$1');
$routes->get('terima_bahan', 'BahanController::penerimaan_bahan');
$routes->post('/bahan/create_terima', 'BahanController::create_terima');
$routes->get('/bahan/deleteterima/(:any)', 'BahanController::delete_terima/$1');
$routes->post('/terima_bahan/update', 'BahanController::updateTerima');
$routes->post('/bahan/createDetailTambah', 'BahanController::createDetailTambah');
$routes->get('/bahan/hapus_detailterima/(:any)', 'BahanController::hapus_detailterima/$1');
$routes->get('getDetailBarang/(:any)', 'BahanController::getDetailBarang/$1');





// REPAIR MATERIAL BAHAN-----------------------------------------------------------------------------------------------
$routes->get('repair_material', 'BahanController::repair_materialbahan');
$routes->get('order_repair_bahan', 'BahanController::bahan_repair_add');
$routes->post('/repair/createRepairBahan', 'BahanController::createRepairBahan');
$routes->get('order_repair_bahanprev/(:any)', 'BahanController::bahan_repair_prev/$1');
$routes->post('/repair/update', 'BahanController::updateRepairBahan');
$routes->get('/repair/deleterepair/(:any)', 'BahanController::delete_repair/$1');




// LAPORAN MUTASI GUDANG BAHAN------------------------------------------------------------------------------------------------
$routes->get('laporan_mutasi', 'BahanController::laporan_mutasigudang');




// route for sparepart
//PERMINTAAN SPAREPART-------------------------------------------------------------------------------------------------
$routes->get('pesan_part', 'SparepartController::pemesanan_sparepart');
$routes->get('permintaan_part', 'SparepartController::permintaan_sparepart');
$routes->get('get_data', 'SparepartController::getData');
$routes->get('beli_part', 'SparepartController::add_part');
$routes->get('beli_partprev/(:any)', 'SparepartController::add_partpreview/$1');
$routes->post('create_part_po', 'SparepartController::create_part_po');
$routes->post('create_partadd', 'SparepartController::create_partadd');
$routes->get('/sparepart/delete/(:any)', 'SparepartController::delete_part/$1');
$routes->get('sparepart/get/(:any)', 'SparepartController::getSparepart/$1');
$routes->post('updateJenisPart/(:any)', 'SparepartController::updateJenisPartNonSupp/$1');










//PENERIMAAN SPAREPART ----------------------------------------------------------------------------------------------------------------------
$routes->get('terima_part', 'SparepartController::penerimaan_sparepart');
$routes->get('order_pos_terimapart', 'SparepartController::add_terimapart');
$routes->get('get_spareparts', 'SparepartController::getSpareparts');
$routes->post('/sparepart/create_part', 'SparepartController::create_terima');
$routes->get('/order_pos_terimapartprev/(:any)', 'SparepartController::add_terimapart_preview/$1');
$routes->post('/sparepart/update/(:any)', 'SparepartController::updateTerima/$1');
$routes->post('/sparepart/createDetailTambah', 'SparepartController::createDetailTambah');
$routes->get('/sparepart/deleteterima/(:any)', 'SparepartController::delete_terima/$1');
$routes->get('/sparepart/delete_detailterima/(:any)', 'SparepartController::delete_detailterima/$1');
// -------------------------------------------------------------------------------------------------------------------------------

//REPAIR MATERIAL SPAREPART--------------------------------------------------------------------------------------------
$routes->get('repair_material_part', 'SparepartController::repair_material_sparepart');
$routes->get('repair_material_add', 'SparepartController::add_repair_material');
$routes->get('get_spareparts_terima', 'Controller::getSparepartsTerima');
$routes->post('/sparepart/createRepairpart', 'SparepartController::createRepairPart');
$routes->get('repair_material_prev/(:any)', 'SparepartController::prev_repair_preview/$1');
$routes->post('/sparepart/updaterepair', 'SparepartController::updateRepairPart');
$routes->get('/sparepart/deleterepairpart/(:any)', 'SparepartController::delete_repair_part/$1');
// ------------------------------------------------------------------------------------------------------------------


$routes->get('mutasi_gudang_part', 'SparepartController::mutasi_gudang_sparepart');
$routes->post('sparepart/mutasiKeGudang', 'SparepartController::mutasigudangStokKeGudang');
$routes->post('sparepart/mutasigudangRepairKeGudang', 'SparepartController::mutasigudangRepairKeGudang');
$routes->post('sparepart/mutasigudangSupplyKeGudang', 'SparepartController::mutasigudangSupplyKeGudang');
$routes->post('sparepart/mutasigudangWaitingKeGudang', 'SparepartController::mutasigudangWaitingKeGudang');
$routes->post('sparepart/mutasigudangSalvageKeGudang', 'SparepartController::mutasigudangSalvageKeGudang');





$routes->get('minta_part_supp', 'SparepartController::permintaan_sparepart_supply');
$routes->get('supp_asuransi', 'SparepartController::supply_asuransi');


$routes->get('waiting_part', 'SparepartController::part_dalam_pesanan');
$routes->get('sparepart_masuk', 'SparepartController::part_diterima');

$routes->get('part_salvage', 'SparepartController::sparepart_salvage');

$routes->get('part_sisa', 'SparepartController::sparepart_sisa');
$routes->get('stok_part', 'SparepartController::stok_sparepart');
// add sparepart


$routes->get('supp_asuransi_add', 'SparepartController::add_supp_asuransi');
$routes->get('supp_asuransi_prev/(:any)', 'SparepartController::prev_supp_asuransi/$1');


// ----------------------------------------------------------------------------------------------------------------
//route for keuangan
$routes->add('hutang', 'KeuanganController::hutang_supp');
$routes->get('bayar_hutang', 'KeuanganController::pembayaran_hutang');
$routes->post('/keuangan/createFaktur', 'KeuanganController::createFaktur');
$routes->post('/keuangan/addPembayaran', 'KeuanganController::addPembayaran');
$routes->get('ro_list', 'KeuanganController::repairoder_list');
$routes->get('ro_listprev/(:any)', 'KeuanganController::repairorder_listprev/$1');




$routes->get('pembelian', 'KeuanganController::laporan_pembelian');
$routes->get('pembelian_add', 'KeuanganController::add_pembelian');
$routes->get('getDetail/(:any)', 'KeuanganController::getDetail/$1');
$routes->post('/keuangan/createPembelian', 'KeuanganController::createPembelian');
$routes->get('pembelian_prev/(:any)', 'KeuanganController::prev_pembelian/$1');
$routes->post('/keuangan/updatepembelian', 'KeuanganController::updatePembelian');
$routes->post('/keuangan/createDetailTambah', 'KeuanganController::createDetailTambah');
$routes->get('/keuangan/hapuspembelian/(:any)', 'KeuanganController::delete_pembelian/$1');
$routes->get('/keuangan/delete_detailpembelian/(:any)', 'KeuanganController::delete_detailpembelian/$1');
$routes->get('kas_bank', 'KeuanganController::jurnal_kasbank');
$routes->get('keuangan/getCoa', 'KeuanganController::getCoa');
$routes->post('keuangan/createKasBank', 'KeuanganController::createKasBank');
$routes->post('keuangan/createPKasbesar', 'KeuanganController::createPKasbesar');
$routes->post('keuangan/createKasKecil', 'KeuanganController::createKasKecil');
$routes->post('getDataKeluarkasbesar', 'KeuanganController::getDataKeluarkasbesar');

$routes->get('keuangan/getKasBesarData', 'KeuanganController::getKasBesarData');
$routes->get('keuangan/getKasKecilData', 'KeuanganController::getKasKecilData');





$routes->get('kas_kecil', 'KeuanganController::kaskecil');
$routes->get('keluar_kasbesar', 'KeuanganController::keluarkasbesar');

$routes->get('kas_masuk', 'KeuanganController::jurnal_kasmasuk');
$routes->get('kas_keluar', 'KeuanganController::jurnal_kaskeluar');



$routes->get('material_jasa', 'KeuanganController::repair_materialjasa');
$routes->get('material_jasaadd', 'KeuanganController::repair_materialjasaadd');
$routes->post('createRepairJasa', 'KeuanganController::createRepairJasa');
$routes->get('material_jasaprev/(:any)', 'KeuanganController::repair_materialjasaprev/$1');
$routes->post('updateOrCreateJasa', 'KeuanganController::updateOrCreateJasa');
$routes->post('update_rmjasa', 'KeuanganController::updateJasa');


// add
$routes->get('bayar_hutang_add', 'KeuanganController::add_bayar_hutang');
$routes->get('bayar_hutang_prev/(:any)', 'KeuanganController::prev_bayar_hutang/$1');



//route for report
$routes->get('report_jurnal', 'ReportController::jurnal_keuangan');
$routes->get('buku_besar', 'ReportController::bukubesar_generalledger');
$routes->get('laba_rugi', 'ReportController::laporan_labarugi');
$routes->get('neraca', 'ReportController::laporan_neraca');

// route for master
$routes->get('master/barangkategori', 'MasterController::barangkategori');
$routes->post('/master/createBarang', 'MasterController::createBarang');
$routes->post('/master/updateBarang', 'MasterController::updateBarang');
$routes->post('/master/deleteBarang/(:num)', 'MasterController::deleteBarang/$1');
// -------------------------------------------------------------------------------
// Barang Kategori
$routes->get('master/barangkategori', 'MasterController::barangkategori');
$routes->post('master/createBarang', 'MasterController::createBarang');
$routes->post('master/updateBarang/(:num)', 'MasterController::updateBarang/$1');
$routes->post('master/deleteBarang/(:num)', 'MasterController::deleteBarang/$1');

// Barang Group
$routes->get('master/baranggroup', 'MasterController::baranggroup');
$routes->post('master/createBarangGroup', 'MasterController::createBarangGroup');
$routes->post('master/updateBarangGroup/(:segment)', 'MasterController::updateBarangGroup/$1');
$routes->post('deleteBarangGroup/(:num)', 'MasterController::deleteBarangGroup/$1');

// Barang
$routes->get('master/barang', 'MasterController::barang');
$routes->post('createBar', 'MasterController::createBar');
$routes->post('updateBar/(:num)', 'MasterController::updateBar/$1');
$routes->post('deleteBar/(:num)', 'MasterController::deleteBar/$1');

// Pengerjaan
$routes->get('master/pengerjaan', 'MasterController::pengerjaan');
$routes->post('createPengerjaan', 'MasterController::createPengerjaan');
$routes->post('updatePengerjaan/(:num)', 'MasterController::updatePengerjaan/$1');
$routes->post('deletePengerjaan/(:num)', 'MasterController::deletePengerjaan/$1');

// Jasa
$routes->get('master/jasa', 'MasterController::jasa');
$routes->post('createJasa', 'MasterController::createJasa');
$routes->post('updateJasa/(:num)', 'MasterController::updateJasa/$1');
$routes->post('deleteJasa/(:num)', 'MasterController::deleteJasa/$1');

// Alokasi Barang
$routes->get('master/alokasibarang', 'MasterController::alokasibarang');
$routes->post('createAlokasi', 'MasterController::createAlokasi');
$routes->post('updateAlokasi/(:num)', 'MasterController::updateAlokasi/$1');
$routes->post('deleteAlokasi/(:num)', 'MasterController::deleteAlokasi/$1');

// Asuransi
$routes->get('master/asuransi', 'MasterController::asuransi');
$routes->post('createAsuransi', 'MasterController::createAsuransi');
$routes->post('updateAsuransi/(:num)', 'MasterController::updateAsuransi/$1');
$routes->post('deleteAsuransi/(:num)', 'MasterController::deleteAsuransi/$1');

// Gudang
$routes->get('master/gudang', 'MasterController::gudang');
$routes->post('createGudang', 'MasterController::createGudang');
$routes->post('updateGudang/(:num)', 'MasterController::updateGudang/$1');
$routes->post('deleteGudang/(:num)', 'MasterController::deleteGudang/$1');

// Salesman
$routes->get('master/salesman', 'MasterController::salesman');
$routes->post('createSalesman', 'MasterController::createSalesman');
$routes->post('updateSalesman/(:num)', 'MasterController::updateSalesman/$1');
$routes->post('deleteSalesman/(:num)', 'MasterController::deleteSalesman/$1');

// Chart Of Account
$routes->get('master/coa', 'MasterController::coa');
$routes->post('createCoa', 'MasterController::createCoa');
$routes->post('updateCoa/(:num)', 'MasterController::updateCoa/$1');
$routes->post('deleteCoa/(:num)', 'MasterController::deleteCoa/$1');


// Supplier
$routes->get('master/supplier', 'MasterController::supplier');
$routes->post('createSupplier', 'MasterController::createSupplier');
$routes->post('updateSupplier/(:num)', 'MasterController::updateSupplier/$1');
$routes->post('deleteSupplier/(:num)', 'MasterController::deleteSupplier/$1');



$routes->get('master/barang', 'MasterController::barang');
$routes->get('master/jasa', 'MasterController::jasa');
$routes->get('master/asuransi', 'MasterController::asuransi');
$routes->get('master/coa', 'MasterController::coa');


//Monitoring
$routes->get('monitoring/history', 'MonitoringController::history_edit');
$routes->get('monitoring/jadwal_keluar', 'MonitoringController::jadwalkeluar_mobil');
//trac mobil belum

//Website
$routes->get('website/video_home', 'WebsiteController::videohome_website');

$routes->get('master/masterbahan', 'MasterController::masterbahan');
$routes->post('createbahan', 'MasterController::createBahan');
$routes->post('updatebahan/(:num)', 'MasterController::updateBahan/$1');



$routes->get('master/mastersparepart', 'MasterController::mastersparepart');
$routes->post('createsparepart', 'MasterController::createsparepart');
$routes->post('updatesparepart/(:num)', 'MasterController::updatesparepart/$1'); // Untuk meng-update sparepart
$routes->post('deletesparepart/(:num)', 'MasterController::deletesparepart/$1');
$routes->post('deleteBahan/(:num)', 'MasterController::deleteBahan/$1');




// Cetak SPK
$routes->get('cetakEstimasi/(:any)', 'CetakController::cetakEstimasi/$1');
$routes->get('cetakPKB/(:any)', 'CetakController::cetakPKB/$1');






$routes->get('cetak-spk-b/(:any)', 'CetakController::cetakSPKB/$1');
$routes->get('cetakpopart', 'CetakController::cetakPermintaan');


// Route untuk mengakses file di folder 'uploads'
$routes->get('uploads/acc-asuransi/(:any)', function ($file) {
    $path = FCPATH . 'uploads/acc-asuransi/' . $file;

    if (file_exists($path)) {
        $mimeType = mime_content_type($path);
        header('Content-Type: ' . $mimeType);
        readfile($path);
        exit;
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
});