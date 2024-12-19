<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pdetail_Repair extends Model
{
    protected $table = 'pdetail_repair';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'id_kode_barang',
        'nama_barang',
        'qty_B',
        'sat_B',
        'qty_T',
        'sat_T',
        'qty_K',
        'sat_K',
        'hpp',
        'id_material'
    ];
}
