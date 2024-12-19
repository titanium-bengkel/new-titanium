<?php

namespace App\Models;

use CodeIgniter\Model;

class M_KasKeluar extends Model
{
    protected $table = 'k_kaskeluar';  // Nama tabel
    protected $primaryKey = 'id_kaskeluar';  // Primary key

    // Kolom yang diizinkan untuk diisi secara massal
    protected $allowedFields = [
        'no_doc',
        'tanggal',
        'kode_account',
        'nama_account',
        'kredit',
        'keterangan',
        'user_id',
        'created_at',
        'updated_at'
    ];

    // Timestamp otomatis
    protected $useTimestamps = true;
    protected $createdField = 'created_at';  // Kolom created_at untuk waktu pembuatan
    protected $updatedField = 'updated_at';  // Kolom updated_at untuk waktu update
}
