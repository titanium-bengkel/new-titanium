<?php

namespace App\Controllers;

class MonitoringController extends BaseController
{
    public function history_edit()
    {
        $data = [
            'title' => 'Monitoring',
        ];
        return view('monitoring/history', $data);
    }

    public function jadwalkeluar_mobil()
    {
        $data = [
            'title' => 'Monitoring',
        ];
        return view('monitoring/jadwal_keluar', $data);
    }
}