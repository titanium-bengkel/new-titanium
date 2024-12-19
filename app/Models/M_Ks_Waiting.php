<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Ks_Waiting extends Model
{
    protected $table      = 'ks_waiting';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nomor', 'transaksi', 'debit', 'credit', 'saldo', 'tanggal'];

    protected $useTimestamps = false;
}
