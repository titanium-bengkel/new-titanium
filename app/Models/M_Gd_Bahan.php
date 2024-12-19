<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Gd_Bahan extends Model
{
    protected $table = 'gd_bahan'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key dari tabel
    protected $allowedFields = [
        'kode_bahan',
        'nama_bahan',
        'keterangan',
        'harga',
        'stok_awal',
        'debet',
        'credit',
        'stok'
    ]; // Kolom-kolom yang bisa diisi atau dimasukkan ke database
}