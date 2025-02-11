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
        $data = [
            'title' => 'Report',
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
