<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Gd_Salvage extends Model
{
    protected $table = 'gd_salvage'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key

    // Kolom yang diizinkan untuk di-insert dan update
    protected $allowedFields = [
        'id_kode_barang',
        'nama_barang',
        'keterangan',
        'nopol',
        'stok_awal',
        'harga',
        'debit',
        'credit',
        'stok',
        'gudang'
    ];
}
