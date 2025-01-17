<?php

namespace App\Controllers;

use App\Models\M_Po;
use App\Models\M_RepairOrder;
use App\Models\M_ReportJurnal;
use App\Models\M_Kwitansi;


class Home extends BaseController
{
    public function index()
    {

        $poModel = new M_Po();
        $repairModel = new M_RepairOrder();
        $jurnalModel = new M_ReportJurnal();
        $kwitansiModel = new M_Kwitansi();
        // Mengambil bulan dan tahun saat ini
        $bulanIni = date('m');
        $tahunIni = date('Y');

        $today = date('Y-m-d');

        // Menghitung jumlah hari dalam bulan ini
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulanIni, $tahunIni);

        // Menghitung jumlah invoice berdasarkan tanggal hari ini
        $dailyInvoiceCount = $kwitansiModel->where('tanggal', $today)->countAllResults();


        // Menyusun laporan pendapatan berdasarkan tanggal
        $reportPendapatan = [];
        for ($i = 1; $i <= $jumlahHari; $i++) {
            $tanggal = sprintf('%04d-%02d-%02d', $tahunIni, $bulanIni, $i);

            // Mengambil total kredit berdasarkan kode COA dan tanggal
            $totalJasa = $jurnalModel->where('account', '41110')->where('date', $tanggal)->selectSum('kredit')->get()->getRow()->kredit ?? 0;
            $totalCat = $jurnalModel->where('account', '41140')->where('date', $tanggal)->selectSum('kredit')->get()->getRow()->kredit ?? 0;
            $totalNonCat = $jurnalModel->where('account', '41130')->where('date', $tanggal)->selectSum('kredit')->get()->getRow()->kredit ?? 0;
            $totalSparepart = $jurnalModel->where('account', '41120')->where('date', $tanggal)->selectSum('kredit')->get()->getRow()->kredit ?? 0;

            $reportPendapatan[] = [
                'tanggal' => $tanggal,
                'jasa' => $totalJasa,
                'cat' => $totalCat,
                'non_cat' => $totalNonCat,
                'sparepart' => $totalSparepart,
                'total' => $totalJasa + $totalCat + $totalNonCat + $totalSparepart
            ];
        }

        // Data lain untuk dashboard
        $prosesKlaimCount = $poModel->where('status', 'Pre-Order')->countAllResults();
        $asuransi = $poModel->where('asuransi !=', 'UMUM/PRIBADI')->countAllResults();

        $InvoiceCount = $kwitansiModel->countAllResults();
        $InvoiceasuransiCount = $kwitansiModel->where('asuransi !=', 'UMUM/PRIBADI')->countAllResults();
        $InvoiceumumCount = $kwitansiModel->where('asuransi', 'UMUM/PRIBADI')->countAllResults();

        $menungguSparepartCount = $poModel->where('progres', 'Menunggu Sparepart')->countAllResults();
        $menungguSupplyCount = $poModel->where('progres', 'Menunggu Supply')->countAllResults();
        $siapMasukCount = $poModel->where('progres', 'Siap Masuk')->countAllResults();
        $bengkelTitaniumCount = $poModel->countBengkelTitanium();
        $bengkelTandameCount = $poModel->where('bengkel', 'TANDEM')->countAllResults();
        $repairOrderCount = $repairModel->where('status', 'Repair Order')->countAllResults();
        $repairasuransiCount = $repairModel->repairasuransi();
        $repairumumCount = $repairModel->repairumum();
        $unitkeluarCount = $repairModel->where('status', 'Mobil Keluar')->countAllResults();
        $mobilKeluarasuransi = $repairModel->mobilkeluarasuransi();
        $mobilkeluarumum = $repairModel->mobilkeluarumum();
        $mobilMasuk = $repairModel->getDailyReport();
        $unitrepair = $repairModel->countExceptLunas();
        $asuransistatus = $poModel->Asuransistatus();
        $umumststus = $poModel->umumstatus();
        $roleLabel = session()->get('role_label');
        $title = ($roleLabel === 'keuangan') ? 'Dashboard Keuangan' : 'Home';

        if (!$roleLabel) {
            $roleLabel = 'Role tidak tersedia';
        }

        // Menyusun data untuk dikirim ke view
        $data = [
            'title' => $title,
            'poData' => $poModel->findAll(),
            'preOrderCount' => $poModel->where('status !=', 'Repair Order')->countAllResults(),
            'prosesKlaimCount' => $prosesKlaimCount,
            'menungguSparepartCount' => $menungguSparepartCount,
            'menungguSupplyCount' => $menungguSupplyCount,
            'kwitasniCount' => $InvoiceCount,
            'kwitansiasuransi' => $InvoiceasuransiCount,
            'kwitansiumum' => $InvoiceumumCount,
            'siapMasukCount' => $siapMasukCount,
            'asuransistatus' => $asuransistatus,
            'umumststus' => $umumststus,
            'bengkelTitaniumCount' => $bengkelTitaniumCount,
            'bengkelTandameCount' => $bengkelTandameCount,
            'repairOrder' => $repairOrderCount,
            'repairasuransi' => $repairasuransiCount, // Jumlah repair order asuransi
            'repairumum' => $repairumumCount, // Jumlah repair order umum
            'unitkeluarCount' => $unitkeluarCount, // Jumlah unit yang sudah keluar (Mobil Keluar)
            'mobilKeluarasuransi' => $mobilKeluarasuransi,
            'mobilkeluarumum' => $mobilkeluarumum,
            'mobilMasuk' => $mobilMasuk,
            'reportPendapatan' => $reportPendapatan, // Laporan pendapatan harian
            'dailyInvoiceCount' => $dailyInvoiceCount,
            'unitrepair' => $unitrepair, // Jumlah unit yang belum lunas
            'role' => $roleLabel
        ];

        return view('dashboard/index', $data);
    }



    public function dsb_keuangan()
    {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('dashboard/dashboard_keuangan', $data);
    }
}
