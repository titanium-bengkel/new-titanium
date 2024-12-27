<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Bahan_Repair extends Model
{
    protected $table = 'bahan_repair';
    protected $primaryKey = 'id_material'; // Jika id_material bukan auto-increment
    protected $allowedFields = [
        'id_material',
        'tanggal',
        'gudang',
        'no_repair',
        'tanggal_masuk',
        'no_kendaraan',
        'no_rangka',
        'asuransi',
        'jenis_mobil',
        'warna',
        'tahun',
        'nama_pemilik',
        'keterangan',
        'total_qty',
        'total_hpp'
    ];

    public function generateId()
    {
        $prefix = 'RM' . date('Ym');
        $lastRecord = $this->where('id_material LIKE', $prefix . '%')->orderBy('id_material', 'DESC')->first();

        if ($lastRecord) {
            $lastId = substr($lastRecord['id_material'], -4);
            $newId = str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newId = '0001';
        }

        return $prefix . $newId;
    }

    // Fungsi untuk mengambil semua data
    public function getAllPO()
    {
        return $this->db->table('po')->get()->getResult();
    }




    // public function calculateTotals($details)
    // {
    //     $totalQtyB = 0;
    //     $totalQtyT = 0;
    //     $totalQtyK = 0;
    //     $totalHpp = 0;

    //     foreach ($details as $detail) {
    //         $totalQtyB += $detail['qty_B'];
    //         $totalQtyT += $detail['qty_T'];
    //         $totalQtyK += $detail['qty_K'];
    //         $totalHpp += $detail['hpp'];
    //     }

    //     return [
    //         'total_qtyB' => $totalQtyB,
    //         'total_qtyT' => $totalQtyT,
    //         'total_qtyK' => $totalQtyK,
    //         'total_hpp' => $totalHpp
    //     ];
    // }
}

