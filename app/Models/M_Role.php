<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'label', 'fitur'];

    // Tambahkan jika ingin menyesuaikan dengan tipe data fitur
    protected $useTimestamps = false;  // Jika tidak menggunakan timestamp
}