<?php

namespace App\Models;

use CodeIgniter\Model;

class LevelModel extends Model
{
    protected $table = 'auth_user_level';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $deletedField = 'deleted_at';

    protected $allowedFields = ['keterangan', 'updatedate', 'updateby', 'status'];

    protected $useTimestamps = false;

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
