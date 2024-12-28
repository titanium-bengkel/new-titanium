<?php

namespace App\Models;

use CodeIgniter\Model;

class M_RepairOrder extends Model
{
    protected $table = 'repair_order';
    protected $primaryKey = 'id_repair_order';

    protected $allowedFields = [
        'id_terima_po',
        'tgl_klaim',
        'tgl_acc',
        'tgl_masuk',
        'tgl_keluar',
        'jam_keluar',
        'tingkat',
        'status_bayar',
        'status',
        'progres_pengerjaan',
        'user_id',
        'harga_estimasi',
        'harga_acc',
        'no_kendaraan',
        'jenis_mobil',
        'warna',
        'no_polis',
        'no_rangka',
        'tahun_kendaraan',
        'panel',
        'no_contact',
        'customer_name',
        'alamat',
        'kota',
        'asuransi',
        'keterangan',
        'biaya_pengerjaan',
        'biaya_sparepart',
        'total_biaya',
        'bengkel',
        'is_sent'
    ];

    protected $useTimestamps = false;


    public function getDataByAsuransi($id_terima_po, $asuransi)
    {
        if (strtoupper($asuransi) === 'UMUM/PRIBADI') {
            // Mengambil data dari tabel repair_order
            return $this->select('biaya_pengerjaan, biaya_sparepart, total_biaya, 0 as nilai_or, 0 as qty_or')
                ->where('id_terima_po', $id_terima_po)
                ->first();
        } else {
            // Mengambil data dari M_AccAsuransi jika bukan UMUM/PRIBADI
            $accAsuransiModel = new M_AccAsuransi();
            return $accAsuransiModel->select('biaya_jasa as biaya_pengerjaan, biaya_sparepart, biaya_total as total_biaya, nilai_or, qty_or')
                ->where('id_terima_po', $id_terima_po)
                ->first();
        }
    }

    public function findByTerimaPo($id_terima_po)
    {
        return $this->where('id_terima_po', $id_terima_po)->first();
    }

    // M_RepairOrder.php
    public function getRepairOrder()
    {
        return $this->db->table('repair_order')
            ->select('repair_order.*, 
                      jasa.total AS jasa_total, 
                      sparepart.total_hpp AS sparepart_total, 
                      bahan.total_hpp AS bahan_total, 
                      kwitansi.nomor AS no_faktur, 
                      kwitansi.tanggal AS tgl_faktur')
            ->join('rm_jasa jasa', 'jasa.no_ro = repair_order.id_terima_po', 'left')
            ->join('part_repair sparepart', 'sparepart.no_repair = repair_order.id_terima_po', 'left')
            ->join('bahan_repair bahan', 'bahan.no_repair = repair_order.id_terima_po', 'left')
            ->join('kwitansi kwitansi', 'kwitansi.no_order = repair_order.id_terima_po', 'left')
            // Tidak ada GROUP BY
            ->get()
            ->getResultArray();
    }
    public function getRepairOrderDetails($id_terima_po)
    {
        return $this->db->table('repair_order')
            ->select('repair_order.*, 
        jasa.total AS jasa_total, 
        sparepart.total_hpp AS sparepart_total, 
        bahan.total_hpp AS bahan_total, 
        kwitansi.nomor AS no_faktur, 
        kwitansi.tanggal AS tgl_faktur, asuransi.id_acc_asuransi, asuransi.tgl_acc')
            ->join('acc_asuransi asuransi', 'asuransi.id_terima_po = repair_order.id_terima_po', 'left')
            ->join('rm_jasa jasa', 'jasa.no_ro = repair_order.id_terima_po', 'left')
            ->join('part_repair sparepart', 'sparepart.no_repair = repair_order.id_terima_po', 'left')
            ->join('bahan_repair bahan', 'bahan.no_repair = repair_order.id_terima_po', 'left')
            ->join('kwitansi kwitansi', 'kwitansi.no_order = repair_order.id_terima_po', 'left')
            ->where('repair_order.id_terima_po', $id_terima_po) // Filter berdasarkan id_terima_po
            ->get()
            ->getRowArray();
    }




    public function dataAll()
    {
        $builder = $this->builder();

        $builder->select('repair_order.*, auth_user.username');

        $builder->join('auth_user', 'auth_user.id = repair_order.user_id', 'left');

        return $builder->get()->getResultArray();
    }

    public function getDailyReport()
    {
        $today = date('Y-m-d');
        return $this->where('tgl_masuk', $today)->countAllResults();
    }
}
