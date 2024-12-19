<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Warna extends Model
{
    protected $table = 'warna';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode', 'warna'];

    public function insertWarna($data)
    {
        return $this->insert($data);
    }
}
