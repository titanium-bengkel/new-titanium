<?php

namespace App\Models;

use CodeIgniter\Model;

class M_JenisMobil extends Model
{
    protected $table = 'jenis_mobil';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode', 'jenis_mobil'];

    public function insertJenisMobil($data)
    {
        return $this->insert($data);
    }
}
