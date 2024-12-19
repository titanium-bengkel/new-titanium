<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Salvage extends Model
{
    protected $table = 'salvage'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key

    // Kolom-kolom yang diizinkan untuk diisi
    protected $allowedFields = [
        'id_terima_po', 
        'jenis_mobil', 
        'nopol', 
        'asuransi', 
        'nama_part', 
        'foto_rusak',  // Kolom foto_rusak
        'foto_detail',  // Kolom foto_detail
        'created_at'
    ];

    // Atur penggunaan timestamp otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
}
