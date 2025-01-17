<?php

namespace App\Controllers;

use App\Models\AuditLog;
use App\Models\M_AuditLog;

class MonitoringController extends BaseController
{
    public function history_edit()
    {
        $auditLogModel = new M_AuditLog();

        $logs = $auditLogModel
            ->where('action', 'EDIT')
            ->orderBy('updated_at', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Monitoring - Riwayat Edit',
            'logs' => $logs
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
