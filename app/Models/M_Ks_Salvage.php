<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Ks_Salvage extends Model
{
    protected $table      = 'ks_salvage';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nomor', 'transaksi', 'debit', 'credit', 'saldo', 'tanggal'];

    protected $useTimestamps = false;
}
