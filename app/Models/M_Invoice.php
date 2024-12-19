<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Invoice extends Model
{
    protected $table = 'invoice';
    protected $primaryKey = 'id_invoice';
    protected $allowedFields = [
        'no_invoice',
        'tgl_invoice',
        'keterangan_invoice',
        'asuransi',
        'jasa',
        'sparepart',
        'nilai_or',
        'total',
        'id_pembayaran',
        'no_order'
    ];
}
