<?php

namespace App\Models;

use CodeIgniter\Model;

class M_KasMasuk extends Model
{
    protected $table = 'k_kasmasuk';  // Nama tabel
    protected $primaryKey = 'id_kasmasuk';  // Primary key

    // Kolom yang diizinkan untuk diisi secara massal
    protected $allowedFields = [
        'no_doc',
        'tanggal',
        'kode_account',
        'nama_account',
        'debit',
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
