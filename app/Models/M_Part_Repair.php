<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Part_Repair extends Model
{
    protected $table = 'part_repair';
    protected $primaryKey = 'id_material';
    protected $allowedFields = [
        'id_material',
        'tanggal',
        'no_repair',
        'gudang_masuk',
        'gudang_keluar',
        'tanggal_masuk',
        'nopol',
        'jenis_mobil',
        'warna',
        'tahun',
        'nama_pemilik',
        'keterangan',
        'total_qty_B',
        'total_qty_T',
        'total_qty_K',
        'total_hpp',
        'user_id',
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
    public function getAllPO()
    {
        return $this->db->table('po')->get()->getResult();
    }

    public function getAllBarangSparepart()
    {
        $builder = $this->db->table('barang_sparepart');
        $builder->select('id_part, kode_part, nama_part, satuan, isi , stok, harga_beliawal');
        $query = $builder->get();
        return $query->getResult();
    }
}
