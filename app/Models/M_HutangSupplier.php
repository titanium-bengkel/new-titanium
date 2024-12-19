<?php

namespace App\Models;

use CodeIgniter\Model;

class M_HutangSupplier extends Model
{
    protected $table = 'laporan_hutang_supplier';
    protected $primaryKey = 'id_laporan';
    protected $returnType = 'array';
    protected $allowedFields = [
        'no_faktur',
        'tanggal',
        'term',
        'jatuh_tempo',
        'nilai_total',
        'pembayaran',
        'kode_supplier',
        'supplier',
    ];

    protected $useTimestamps = true; // Enable automatic timestamps
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
