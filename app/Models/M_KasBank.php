<?php

namespace App\Models;

use CodeIgniter\Model;

class M_KasBank extends Model
{
    protected $table = 'k_kasbank';
    protected $primaryKey = 'id_kasbank';
    protected $allowedFields = [
        'tanggal',
        'doc_no',
        'kode_account',
        'nama_account',
        'deskripsi',
        'debit',
        'kredit',
        'user_id',
        'tgl_input',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true; // Mengaktifkan timestamp
    protected $createdField = 'created_at'; // Kolom untuk menyimpan waktu dibuat
    protected $updatedField = 'updated_at'; // Kolom untuk menyimpan waktu diperbarui

}
