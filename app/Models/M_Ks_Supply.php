<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Ks_Supply extends Model
{
    protected $table      = 'ks_supply';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nomor', 'transaksi', 'debit', 'credit', 'saldo', 'tanggal'];

    protected $useTtimestamps = false;
}
