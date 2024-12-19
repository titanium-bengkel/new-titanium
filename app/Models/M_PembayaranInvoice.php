<?php

namespace App\Models;

use CodeIgniter\Model;

class M_PembayaranInvoice extends Model
{
    protected $table = 'pembayaran_invoice';
    protected $primaryKey = 'id_pembayaran_invoice';
    protected $allowedFields = [
        'id_pembayaran',
        'kode_bayar',
        'metode_pembayaran',
        'no_bukti',
        'kode_bank',
        'debet',
        'jatuh_tempo'
    ];
}
