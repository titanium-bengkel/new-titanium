<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Detail_Repair extends Model
{
    protected $table = 'detail_repair';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'id_kode_barang',
        'nama_barang',
        'qty',
        'satuan',
        'hpp',
        'nilai',
        'id_material',
        'no_repair_order',
        'no_rangka',
        'asuransi',
        'jenis_mobil',
        'nopol',
        'kategori',
    ];
}
