<?php

namespace App\Controllers;

use App\Models\M_ReportJurnal;


class ReportController extends BaseController
{
    protected $reportModel;

    public function __construct()
    {
        $this->reportModel = new M_ReportJurnal();
    }

    public function jurnal_keuangan()
    {
        $data = [
            'title' => 'Report Jurnal Keuangan',
            'reports' => $this->reportModel->getAllReports()
        ];

        // Return view 'report_jurnal' dengan data title
        return view('report/report_jurnal', $data);
    }

    public function bukubesar_generalledger()
    {
        $data = [
            'title' => 'Report',
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
