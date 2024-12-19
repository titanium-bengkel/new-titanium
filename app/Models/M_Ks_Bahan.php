<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Ks_Bahan extends Model
{
    protected $table      = 'ks_bahan';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nomor', 'transaksi', 'debit', 'credit', 'saldo', 'tanggal'];

    protected $useTimestamps = false;
}
