<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Barang_Sparepart extends Model
{
    protected $table      = 'barang_sparepart';
    protected $primaryKey = 'id_part';

    protected $allowedFields = [
        'kode_part',
        'nama_part',
        'satuan',
        'stok',
        'harga_beliawal',
        'harga_jualawal',
        'nama_kategori',
        'user_id',
        'tanggal'
    ];

    // Fungsi untuk menghitung total stok
    public function getTotalStok()
    {
        return $this->selectSum('stok')->get()->getRow()->stok;
    }
}
