<?php

namespace App\Models;

use CodeIgniter\Model;


class M_P_KasBesar extends Model
{
    protected $table = 'k_p_kasbesar';
    protected $primaryKey = 'id_kb';

    protected $allowedFields = [
        'tanggal',
        'doc_no',
        'kode_account',
        'nama_account',
        'keterangan',
        'nilai',
        'user_id',
        'tgl_input',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
