<?php

namespace App\Controllers;

use App\Models\M_ReportJurnal;
use App\Models\M_Coa;


class ReportController extends BaseController
{

    public function jurnal_keuangan()
    {
        $jurnalM = new M_ReportJurnal();

        // Ambil parameter dari GET request
        $searchKeyword = $this->request->getGet('search_keyword');
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-d');
        $showAll = $this->request->getGet('show_all');

        // Query dasar
        $query = $jurnalM;

        // Tambahkan filter jika tidak memilih "Tampilkan Semua"
        if (!$showAll) {
            if (!empty($searchKeyword)) {
                $query = $query->groupStart()
                    ->like('doc_no', $searchKeyword)
                    ->orLike('description', $searchKeyword)
                    ->groupEnd();
            }

            if (!empty($startDate) && !empty($endDate)) {
                $query = $query->where('date >=', $startDate)
                    ->where('date <=', $endDate);
            }
        }

        $report = $query->orderBy('doc_no', 'DESC')->findAll();

        $data = [
            'title' => 'Report Jurnal Keuangan',
            'reports' => $report,
            'searchKeyword' => $searchKeyword,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];

        return view('report/report_jurnal', $data);
    }


    public function bukubesar_generalledger()
    {
        $jurnalM = new M_ReportJurnal();

        // Ambil nilai filter dari input GET
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-d');
        $selectedCoa = $this->request->getGet('coa'); // Ambil nilai COA dari input

        // Ambil daftar COA yang unik dari tabel 'report_jurnal'
        $coaList = $jurnalM->select('account, name')
            ->groupBy('account, name') // Mengelompokkan berdasarkan account dan name
            ->findAll(); // Mengambil semua data yang sudah dikelompokkan

        // Mulai query untuk laporan
        $query = $jurnalM;

        // Tambahkan filter tanggal jika ada
        if (!empty($startDate) && !empty($endDate)) {
            $query = $query->where('date >=', $startDate)
                ->where('date <=', $endDate);
        }

        // Tambahkan filter COA jika ada
        if (!empty($selectedCoa)) {
            $query = $query->where('account', $selectedCoa); // 'account' adalah kolom ID COA
        }

        // Eksekusi query untuk mendapatkan data laporan, urutkan berdasarkan doc_no DESC
        $reports = $query->orderBy('date', 'DESC')->findAll();

        // Kirim data ke view
        $data = [
            'title' => 'Report Buku Besar',
            'reports' => $reports,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'coaList' => $coaList,  // Menambahkan daftar akun ke dalam view
            'selectedCoa' => $selectedCoa // Mengirimkan nilai filter akun yang dipilih
        ];

        return view('report/buku_besar', $data);
    }



    public function laporan_labarugi()
    {
        // Inisialisasi model
        $coaM = new M_Coa();
        $jurnalM = new M_ReportJurnal();

        // Ambil tanggal mulai dan akhir dari query string, jika ada
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01'); // Default ke awal bulan
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-d'); // Default ke tanggal hari ini


        // Ambil data coa dengan kode_head = 400 dan kelompok = 'LABA RUGI'
        $pendapatan = $coaM->where('kode_head', 400)
            ->where('kelompok', 'LABA RUGI')
            ->findAll();

        // Ambil data coa dengan kode_head = 401 dan kelompok = 'LABA RUGI' untuk Pendapatan Lain-Lain
        $pendapatanLain = $coaM->where('kode_head', 401)
            ->where('kelompok', 'LABA RUGI')
            ->findAll();

        // Ambil data coa dengan kode_head = 500 dan kelompok = 'LABA RUGI' untuk Beban Usaha
        $bebanUsaha = $coaM->where('kode_head', 500)
            ->where('kelompok', 'LABA RUGI')
            ->findAll();

        // Ambil data coa dengan kode_head = 501 dan kelompok = 'LABA RUGI' untuk Beban Usaha
        $bebanNon = $coaM->where('kode_head', 501)
            ->where('kelompok', 'LABA RUGI')
            ->findAll();

        // Ambil data coa dengan kode_head = 502 dan kelompok = 'LABA RUGI' untuk Beban Penjualan
        $bebanPenjualan = $coaM->where('kode_head', 502)
            ->where('kelompok', 'LABA RUGI')
            ->findAll();

        // Ambil data coa dengan kode_head = 503 dan kelompok = 'LABA RUGI' untuk Beban Pemasaran
        $bebanPemasaran = $coaM->where('kode_head', 503)
            ->where('kelompok', 'LABA RUGI')
            ->findAll();

        // Ambil data coa dengan kode_head = 504 dan kelompok = 'LABA RUGI' untuk Beban Administrasi
        $bebanAdministrasi = $coaM->where('kode_head', 504)
            ->where('kelompok', 'LABA RUGI')
            ->findAll();

        // Ambil data coa dengan kode_head = 505 dan kelompok = 'LABA RUGI' untuk Beban Transportasi
        $bebanTransportasi = $coaM->where('kode_head', 505)
            ->where('kelompok', 'LABA RUGI')
            ->findAll();

        // Ambil data coa dengan kode_head = 506 dan kelompok = 'LABA RUGI' untuk Biaya Penyusutan
        $biayaPenyusutan = $coaM->where('kode_head', 506)
            ->where('kelompok', 'LABA RUGI')
            ->findAll();

        // Ambil data coa dengan kode_head = 507 dan kelompok = 'LABA RUGI' untuk Biaya Sewa
        $biayaSewa = $coaM->where('kode_head', 507)
            ->where('kelompok', 'LABA RUGI')
            ->findAll();

        // Ambil data coa dengan kode_head = 508 dan kelompok = 'LABA RUGI' untuk Biaya Office
        $biayaOffice = $coaM->where('kode_head', 508)
            ->where('kelompok', 'LABA RUGI')
            ->findAll();

        // Ambil data coa dengan kode_head = 509 dan kelompok = 'LABA RUGI' untuk Biaya Lain
        $biayaLain = $coaM->where('kode_head', 509)
            ->where('kelompok', 'LABA RUGI')
            ->findAll();

        // Ambil data coa dengan kode_head = 610 dan kelompok = 'LABA RUGI' untuk Pendapatan Lain Lain
        $pendapatanLainLain = $coaM->where('kode_head', 610)
            ->where('kelompok', 'LABA RUGI')
            ->findAll();

        // Ambil data coa dengan kode_head = 710 dan kelompok = 'LABA RUGI' untuk Beban Lain
        $bebanLain = $coaM->where('kode_head', 710)
            ->where('kelompok', 'LABA RUGI')
            ->findAll();

        // Array untuk menyimpan data pendapatan dengan nilai kredit yang sesuai
        foreach ($pendapatan as &$item) {
            // Ambil total nilai kredit dari tabel report_jurnal berdasarkan account (kode)
            $kredit = $jurnalM->selectSum('kredit')
                ->where('account', $item['kode'])
                ->where('date >=', $startDate)  // Filter berdasarkan tanggal mulai
                ->where('date <=', $endDate)
                ->first(); // Menggunakan first() karena kita hanya butuh satu hasil

            // Jika ada nilai kredit, tambahkan ke item
            $item['kredit'] = $kredit['kredit'] ?? 0; // Gunakan 0 jika tidak ada nilai kredit
        }

        // Array untuk menyimpan data pendapatanLain dengan nilai kredit yang sesuai
        foreach ($pendapatanLain as &$item) {
            // Ambil total nilai kredit dari tabel report_jurnal berdasarkan account (kode)
            $kredit = $jurnalM->selectSum('kredit')
                ->where('account', $item['kode'])
                ->where('date >=', $startDate)  // Filter berdasarkan tanggal mulai
                ->where('date <=', $endDate)
                ->first(); // Menggunakan first() karena kita hanya butuh satu hasil

            // Jika ada nilai kredit, tambahkan ke item
            $item['kredit'] = $kredit['kredit'] ?? 0; // Gunakan 0 jika tidak ada nilai kredit
        }

        // Array untuk menyimpan data bebanUsaha dengan nilai debit yang sesuai
        foreach ($bebanUsaha as &$item) {
            // Ambil total nilai debit dari tabel report_jurnal berdasarkan account (kode)
            $debit = $jurnalM->selectSum('debit')
                ->where('account', $item['kode'])
                ->where('date >=', $startDate)  // Filter berdasarkan tanggal mulai
                ->where('date <=', $endDate)
                ->first(); // Menggunakan first() karena kita hanya butuh satu hasil

            // Jika ada nilai debit, tambahkan ke item
            $item['debit'] = $debit['debit'] ?? 0; // Gunakan 0 jika tidak ada nilai debit
        }

        // Array untuk menyimpan data bebanNon dengan nilai debit yang sesuai
        foreach ($bebanNon as &$item) {
            // Ambil total nilai debit dari tabel report_jurnal berdasarkan account (kode)
            $debit = $jurnalM->selectSum('debit')
                ->where('account', $item['kode'])
                ->where('date >=', $startDate)  // Filter berdasarkan tanggal mulai
                ->where('date <=', $endDate)
                ->first(); // Menggunakan first() karena kita hanya butuh satu hasil

            // Jika ada nilai debit, tambahkan ke item
            $item['debit'] = $debit['debit'] ?? 0; // Gunakan 0 jika tidak ada nilai debit
        }

        // Array untuk menyimpan data bebanPenjualan dengan nilai debit yang sesuai
        foreach ($bebanPenjualan as &$item) {
            // Ambil total nilai debit dari tabel report_jurnal berdasarkan account (kode)
            $debit = $jurnalM->selectSum('debit')
                ->where('account', $item['kode'])
                ->where('date >=', $startDate)  // Filter berdasarkan tanggal mulai
                ->where('date <=', $endDate)
                ->first(); // Menggunakan first() karena kita hanya butuh satu hasil

            // Jika ada nilai debit, tambahkan ke item
            $item['debit'] = $debit['debit'] ?? 0; // Gunakan 0 jika tidak ada nilai debit
        }

        // Array untuk menyimpan data bebanPemasaran dengan nilai debit yang sesuai
        foreach ($bebanPemasaran as &$item) {
            // Ambil total nilai debit dari tabel report_jurnal berdasarkan account (kode)
            $debit = $jurnalM->selectSum('debit')
                ->where('account', $item['kode'])
                ->where('date >=', $startDate)  // Filter berdasarkan tanggal mulai
                ->where('date <=', $endDate)
                ->first(); // Menggunakan first() karena kita hanya butuh satu hasil

            // Jika ada nilai debit, tambahkan ke item
            $item['debit'] = $debit['debit'] ?? 0; // Gunakan 0 jika tidak ada nilai debit
        }

        // Array untuk menyimpan data bebanAdministrasi dengan nilai debit yang sesuai
        foreach ($bebanAdministrasi as &$item) {
            // Ambil total nilai debit dari tabel report_jurnal berdasarkan account (kode)
            $debit = $jurnalM->selectSum('debit')
                ->where('account', $item['kode'])
                ->where('date >=', $startDate)  // Filter berdasarkan tanggal mulai
                ->where('date <=', $endDate)
                ->first(); // Menggunakan first() karena kita hanya butuh satu hasil

            // Jika ada nilai debit, tambahkan ke item
            $item['debit'] = $debit['debit'] ?? 0; // Gunakan 0 jika tidak ada nilai debit
        }

        // Array untuk menyimpan data bebanTransportasi dengan nilai debit yang sesuai
        foreach ($bebanTransportasi as &$item) {
            // Ambil total nilai debit dari tabel report_jurnal berdasarkan account (kode)
            $debit = $jurnalM->selectSum('debit')
                ->where('account', $item['kode'])
                ->where('date >=', $startDate)  // Filter berdasarkan tanggal mulai
                ->where('date <=', $endDate)
                ->first(); // Menggunakan first() karena kita hanya butuh satu hasil

            // Jika ada nilai debit, tambahkan ke item
            $item['debit'] = $debit['debit'] ?? 0; // Gunakan 0 jika tidak ada nilai debit
        }

        // Array untuk menyimpan data biayaPenyusutan dengan nilai debit yang sesuai
        foreach ($biayaPenyusutan as &$item) {
            // Ambil total nilai debit dari tabel report_jurnal berdasarkan account (kode)
            $debit = $jurnalM->selectSum('debit')
                ->where('account', $item['kode'])
                ->where('date >=', $startDate)  // Filter berdasarkan tanggal mulai
                ->where('date <=', $endDate)
                ->first(); // Menggunakan first() karena kita hanya butuh satu hasil

            // Jika ada nilai debit, tambahkan ke item
            $item['debit'] = $debit['debit'] ?? 0; // Gunakan 0 jika tidak ada nilai debit
        }

        // Array untuk menyimpan data biayaSewa dengan nilai debit yang sesuai
        foreach ($biayaSewa as &$item) {
            // Ambil total nilai debit dari tabel report_jurnal berdasarkan account (kode)
            $debit = $jurnalM->selectSum('debit')
                ->where('account', $item['kode'])
                ->where('date >=', $startDate)  // Filter berdasarkan tanggal mulai
                ->where('date <=', $endDate)
                ->first(); // Menggunakan first() karena kita hanya butuh satu hasil

            // Jika ada nilai debit, tambahkan ke item
            $item['debit'] = $debit['debit'] ?? 0; // Gunakan 0 jika tidak ada nilai debit
        }

        // Array untuk menyimpan data biayaOffice dengan nilai debit yang sesuai
        foreach ($biayaOffice as &$item) {
            // Ambil total nilai debit dari tabel report_jurnal berdasarkan account (kode)
            $debit = $jurnalM->selectSum('debit')
                ->where('account', $item['kode'])
                ->where('date >=', $startDate)  // Filter berdasarkan tanggal mulai
                ->where('date <=', $endDate)
                ->first(); // Menggunakan first() karena kita hanya butuh satu hasil

            // Jika ada nilai debit, tambahkan ke item
            $item['debit'] = $debit['debit'] ?? 0; // Gunakan 0 jika tidak ada nilai debit
        }

        // Array untuk menyimpan data biayaLain dengan nilai debit yang sesuai
        foreach ($biayaLain as &$item) {
            // Ambil total nilai debit dari tabel report_jurnal berdasarkan account (kode)
            $debit = $jurnalM->selectSum('debit')
                ->where('account', $item['kode'])
                ->where('date >=', $startDate)  // Filter berdasarkan tanggal mulai
                ->where('date <=', $endDate)
                ->first(); // Menggunakan first() karena kita hanya butuh satu hasil

            // Jika ada nilai debit, tambahkan ke item
            $item['debit'] = $debit['debit'] ?? 0; // Gunakan 0 jika tidak ada nilai debit
        }

        // Array untuk menyimpan data pendapatanLainLain dengan nilai debit yang sesuai
        foreach ($pendapatanLainLain as &$item) {
            // Ambil total nilai debit dari tabel report_jurnal berdasarkan account (kode)
            $debit = $jurnalM->selectSum('kredit')
                ->where('account', $item['kode'])
                ->where('date >=', $startDate)  // Filter berdasarkan tanggal mulai
                ->where('date <=', $endDate)
                ->first(); // Menggunakan first() karena kita hanya butuh satu hasil

            // Jika ada nilai kredit, tambahkan ke item
            $item['kredit'] = $kredit['kredit'] ?? 0; // Gunakan 0 jika tidak ada nilai debit
        }

        // Array untuk menyimpan data bebanLain dengan nilai debit yang sesuai
        foreach ($bebanLain as &$item) {
            // Ambil total nilai debit dari tabel report_jurnal berdasarkan account (kode)
            $debit = $jurnalM->selectSum('debit')
                ->where('account', $item['kode'])
                ->where('date >=', $startDate)  // Filter berdasarkan tanggal mulai
                ->where('date <=', $endDate)
                ->first(); // Menggunakan first() karena kita hanya butuh satu hasil

            // Jika ada nilai debit, tambahkan ke item
            $item['debit'] = $debit['debit'] ?? 0; // Gunakan 0 jika tidak ada nilai debit
        }

        // Total pendapatan
        $totalPendapatan = array_sum(array_column($pendapatan, 'kredit'));
        $totalPendapatanLain = array_sum(array_column($pendapatanLain, 'kredit'));
        $totalPendapatanLainLain = array_sum(array_column($pendapatanLainLain, 'kredit'));

        // Total beban
        $totalBebanUsaha = array_sum(array_column($bebanUsaha, 'debit'));
        $totalBebanNon = array_sum(array_column($bebanNon, 'debit'));
        $totalBebanPenjualan = array_sum(array_column($bebanPenjualan, 'debit'));
        $totalBebanPemasaran = array_sum(array_column($bebanPemasaran, 'debit'));
        $totalBebanAdministrasi = array_sum(array_column($bebanAdministrasi, 'debit'));
        $totalBebanTransportasi = array_sum(array_column($bebanTransportasi, 'debit'));
        $totalBiayaPenyusutan = array_sum(array_column($biayaPenyusutan, 'debit'));
        $totalBiayaSewa = array_sum(array_column($biayaSewa, 'debit'));
        $totalBiayaOffice = array_sum(array_column($biayaOffice, 'debit'));
        $totalBiayaLain = array_sum(array_column($biayaLain, 'debit'));
        $totalBebanLain = array_sum(array_column($bebanLain, 'debit'));

        // Hitung Laba Rugi (Pendapatan - Beban)
        $totalPendapatanSemua = $totalPendapatan + $totalPendapatanLain + $totalPendapatanLainLain;  // Total pendapatan
        $totalBebanSemua = $totalBebanUsaha + $totalBebanNon + $totalBebanPenjualan + $totalBebanPemasaran +
            $totalBebanAdministrasi + $totalBebanTransportasi + $totalBiayaPenyusutan +
            $totalBiayaSewa + $totalBiayaOffice + $totalBiayaLain + $totalBebanLain;  // Total beban

        $LabaRugi = $totalPendapatanSemua - $totalBebanSemua;  // Perhitungan Laba Rugi

        // Kirimkan data ke view
        $data = [
            'title' => 'Report Laba Rugi',
            'pendapatan' => $pendapatan,
            'pendapatanLain' => $pendapatanLain,
            'bebanUsaha' => $bebanUsaha,
            'bebanNon' => $bebanNon,
            'bebanPenjualan' => $bebanPenjualan,
            'bebanPemasaran' => $bebanPemasaran,
            'bebanAdministrasi' => $bebanAdministrasi,
            'bebanTransportasi' => $bebanTransportasi,
            'biayaPenyusutan' => $biayaPenyusutan,
            'biayaSewa' => $biayaSewa,
            'biayaOffice' => $biayaOffice,
            'biayaLain' => $biayaLain,
            'pendapatanLainLain' => $pendapatanLainLain,
            'bebanLain' => $bebanLain,
            'totalPendapatan' => $totalPendapatan,
            'totalPendapatanLain' => $totalPendapatanLain,
            'totalBebanUsaha' => $totalBebanUsaha,
            'totalBebanNon' => $totalBebanNon,
            'totalBebanPenjualan' => $totalBebanPenjualan,
            'totalBebanPemasaran' => $totalBebanPemasaran,
            'totalBebanAdministrasi' => $totalBebanAdministrasi,
            'totalBebanTransportasi' => $totalBebanTransportasi,
            'totalBiayaPenyusutan' => $totalBiayaPenyusutan,
            'totalBiayaSewa' => $totalBiayaSewa,
            'totalBiayaOffice' => $totalBiayaOffice,
            'totalBiayaLain' => $totalBiayaLain,
            'totalPendapatanLainLain' => $totalPendapatanLainLain,
            'totalBebanLain' => $totalBebanLain,
            'LabaRugiBersih' => $LabaRugi,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        return view('report/laba_rugi', $data);
    }



    public function laporan_neraca()
    {
        $data = [
            'title' => 'Report',
        ];
        return view('report/neraca', $data);
    }
}
