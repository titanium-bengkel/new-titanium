<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Ks_Repair extends Model
{
    protected $table      = 'ks_repair';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nomor', 'transaksi', 'debit', 'credit', 'saldo', 'tanggal'];

    protected $useTimestamps = false;
}
