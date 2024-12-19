<?php

namespace App\Models;

use CodeIgniter\Model;

class M_KasKecil extends Model
{
    protected $table = 'k_kaskecil';
    protected $primaryKey = 'id_kc';

    protected $allowedFields = [
        'tanggal',
        'doc_no',
        'kode_account',
        'nama_account',
        'keterangan',
        'debit',
        'kredit',
        'user_id',
        'tgl_input',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
