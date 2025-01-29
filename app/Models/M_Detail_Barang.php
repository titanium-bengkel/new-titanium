<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Detail_Barang extends Model
{
    protected $table = 'detail_barang';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'id_kode_barang',
        'nama_barang',
        'qty',
        'satuan',
        'harga',
        'jumlah',
        'no_faktur',
        'tgl_faktur',
        'kategori',
        'ceklis',
        'id_po_bahan',
        'supplier',
        'created_at'
    ];

    public function getDetailByIdPoBahan($id_po_bahan)
    {
        return $this->where('id_po_bahan', $id_po_bahan)->findAll();
    }
}
