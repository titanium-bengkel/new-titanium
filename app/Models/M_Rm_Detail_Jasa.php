<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Rm_Detail_Jasa extends Model
{
    protected $table = 'rm_detail_jasa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kode_jasa',
        'nama_jasa',
        'harga',
        'jenis_bayar',
        'id_jasa'
    ];

    // Tidak ada fungsi generateId karena primary key adalah AUTO_INCREMENT
}
