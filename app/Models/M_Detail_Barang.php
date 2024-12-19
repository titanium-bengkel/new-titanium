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
        'qty_b',
        'sat_b',
        'qty_t',
        'sat_t',
        'qty_k',
        'sat_k',
        'harga',
        'jumlah',
        'qty_beli',
        'qty_sisa',
        'no_faktur',
        'tgl_faktur',
        'ceklis',
        'id_po_bahan'
    ];

    public function getDetailByIdPoBahan($id_po_bahan)
    {
        return $this->where('id_po_bahan', $id_po_bahan)->findAll();
    }
}
