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
        'progres_dokumen',
        'progres_sparepart',
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
        $db = \Config\Database::connect();
        $query = $db->table('repair_order')
            ->select('repair_order.*, 
                      jasa.total AS jasa_total, 
                      sparepart.total_hpp AS sparepart_total, 
                      bahan.total_nilai AS bahan_total, 
                      kwitansi.nomor AS no_faktur, 
                      kwitansi.tanggal AS tgl_faktur,
                      acc_asuransi.biaya_total,
                      acc_asuransi.id_acc_asuransi')
            ->join('rm_jasa jasa', 'jasa.no_ro = repair_order.id_terima_po', 'left')
            ->join('part_repair sparepart', 'sparepart.no_repair = repair_order.id_terima_po', 'left')
            ->join('bahan_repair bahan', 'bahan.no_repair = repair_order.id_terima_po', 'left')
            ->join('kwitansi kwitansi', 'kwitansi.no_order = repair_order.id_terima_po', 'left')
            ->join('acc_asuransi', 'acc_asuransi.id_terima_po = repair_order.id_terima_po', 'left')
            ->where('repair_order.id_terima_po', $id_terima_po);

        return $query->orderBy('repair_order.tgl_masuk', 'DESC')->get()->getRowArray();
    }

    // M_RepairOrder.php
    public function getRepairOrder($filterName = null, $searchKeyword = null, $startDate = null, $endDate = null, $showAll = false)
    {
        $db = \Config\Database::connect();
        $query = $db->table('repair_order')
            ->select('repair_order.*, 
                      jasa.total AS jasa_total, 
                      sparepart.total_hpp AS sparepart_total, 
                      bahan.total_nilai AS bahan_total, 
                      kwitansi.nomor AS no_faktur, 
                      kwitansi.tanggal AS tgl_faktur,
                      acc_asuransi.biaya_total,
                      acc_asuransi.tgl_masuk as tgl_masuk_as')
            ->join('rm_jasa jasa', 'jasa.no_ro = repair_order.id_terima_po', 'left')
            ->join('part_repair sparepart', 'sparepart.no_repair = repair_order.id_terima_po', 'left')
            ->join('bahan_repair bahan', 'bahan.no_repair = repair_order.id_terima_po', 'left')
            ->join('kwitansi kwitansi', 'kwitansi.no_order = repair_order.id_terima_po', 'left')
            ->join('acc_asuransi', 'acc_asuransi.id_terima_po = repair_order.id_terima_po', 'left');

        if (!$showAll) {
            // Filter nama bengkel
            if (!empty($filterName)) {
                $query = $query->where('repair_order.bengkel', $filterName);
            }

            // Filter kata kunci pencarian
            if (!empty($searchKeyword)) {
                $query = $query->groupStart()
                    ->like('repair_order.id_terima_po', $searchKeyword)
                    ->orLike('repair_order.no_kendaraan', $searchKeyword)
                    ->groupEnd();
            }

            // Filter tanggal mulai
            if (!empty($startDate)) {
                $query = $query->where('repair_order.tgl_masuk >=', $startDate);
            }

            // Filter tanggal akhir
            if (!empty($endDate)) {
                $query = $query->where('repair_order.tgl_masuk <=', $endDate);
            }
        }

        // Urutkan berdasarkan ID terbaru
        return $query->orderBy('repair_order.tgl_masuk', 'DESC')->get()->getResultArray();
    }

    public function getRepairOrderDetails($id_terima_po)
    {
        $db = \Config\Database::connect();
        $query = $db->table('repair_order')
            ->select('repair_order.*, 
                      jasa.total AS jasa_total, 
                      sparepart.total_hpp, 
                      bahan.total_hpp AS bahan_total, 
                      kwitansi.nomor AS no_faktur, 
                      kwitansi.tanggal AS tgl_faktur,
                      acc_asuransi.biaya_total, 
                      acc_asuransi.tgl_acc,
                      rm_detail_jasa.kode_jasa,
                      rm_detail_jasa.nama_jasa,
                      rm_detail_jasa.harga,
                      detail_repair.id_kode_barang as id_kode_bahan,
                      detail_repair.nama_barang as nama_bahan,
                      detail_repair.qty as qty_bahan,
                      detail_repair.hpp as hpp_bahan,
                      detail_repair.nilai as nilai_bahan,
                      pdetail_repair.id_kode_barang,
                      pdetail_repair.nama_barang,
                      pdetail_repair.qty_B,
                      pdetail_repair.hpp')
            ->join('rm_jasa jasa', 'jasa.no_ro = repair_order.id_terima_po', 'left')
            ->join('rm_detail_jasa', 'rm_detail_jasa.no_order = repair_order.id_terima_po', 'left')
            ->join('part_repair sparepart', 'sparepart.no_repair = repair_order.id_terima_po', 'left')
            ->join('pdetail_repair', 'pdetail_repair.no_repair_order = repair_order.id_terima_po', 'left')
            ->join('bahan_repair bahan', 'bahan.no_repair = repair_order.id_terima_po', 'left')
            ->join('detail_repair', 'detail_repair.no_repair_order = repair_order.id_terima_po', 'left')
            ->join('kwitansi kwitansi', 'kwitansi.no_order = repair_order.id_terima_po', 'left')
            ->join('acc_asuransi', 'acc_asuransi.id_terima_po = repair_order.id_terima_po', 'left')
            ->where('repair_order.id_terima_po', $id_terima_po);

        $result = $query->get()->getResultArray();

        return $result;
    }


    // public function getRepairOrderDetails($id_terima_po)
    // {
    //     return $this->db->table('repair_order')
    //         ->select('repair_order.*, 
    //     jasa.total AS jasa_total, 
    //     sparepart.total_hpp AS sparepart_total, 
    //     bahan.total_hpp AS bahan_total, 
    //     kwitansi.nomor AS no_faktur, 
    //     kwitansi.tanggal AS tgl_faktur,
    //     acc_asuransi.biaya_total')
    //         ->join('rm_jasa jasa', 'jasa.no_ro = repair_order.id_terima_po', 'left')
    //         ->join('part_repair sparepart', 'sparepart.no_repair = repair_order.id_terima_po', 'left')
    //         ->join('bahan_repair bahan', 'bahan.no_repair = repair_order.id_terima_po', 'left')
    //         ->join('kwitansi kwitansi', 'kwitansi.no_order = repair_order.id_terima_po', 'left')
    //         ->join('acc_asuransi', 'acc_asuransi.id_terima_po = repair_order.id_terima_po', 'left')
    //         ->where('repair_order.id_terima_po', $id_terima_po)
    //         ->orderBy('repair_order.id_terima_po', 'DESC')
    //         ->get()
    //         ->getRowArray();
    // }









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

    public function countExceptLunas()
    {
        return $this->where('progres_pengerjaan !=', 'lunas')->countAllResults();
    }

    public function repairasuransi()
    {
        return $this->where('asuransi !=', 'UMUM/PRIBADI')
            ->where('status', 'Repair Order')
            ->countAllResults();
    }

    public function repairumum()
    {
        return $this->where('asuransi', 'UMUM/PRIBADI')
            ->where('status', 'Repair Order')
            ->countAllResults();
    }

    public function mobilkeluarasuransi()
    {
        return $this->where('asuransi !=', 'UMUM/PRIBADI')
            ->where('status', 'Mobil Keluar')
            ->countAllResults();
    }

    public function mobilkeluarumum()
    {
        return $this->where('asuransi', 'UMUM/PRIBADI')
            ->where('status', 'Mobil Keluar')
            ->countAllResults();
    }
}
