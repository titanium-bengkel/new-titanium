<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Bengkel extends Model
{
    protected $table = 'bengkel';
    protected $primaryKey = 'id_bengkel';
    protected $allowedFields = ['nama_bengkel'];
    protected $useTimestamps = true;
}
