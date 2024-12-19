<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Gd_Repair extends Model
{
    protected $table = 'gd_repair'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key

    // Kolom yang diizinkan untuk di-insert dan update
    protected $allowedFields = [
        'kode_barang',
        'nama_barang',
        'keterangan',
        'mobil',
        'nomor',
        'harga',
        'debit',
        'credit',
        'stok',
        'gudang'
    ];
}
