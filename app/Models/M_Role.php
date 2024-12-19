<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Role extends Model
{
    protected $table = 'role';
    protected $allowedFields = [
        'label', 'fitur'
    ];
}