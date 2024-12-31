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
        'hpp',
        'id_material',
        'no_repair_order',
        'no_rangka',
        'asuransi',
        'jenis_mobil',
        'nopol',
        'supplier',
        'created_at',
        'updated_at'
    ];
}
