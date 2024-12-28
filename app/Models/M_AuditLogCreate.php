<?php

namespace App\Models;

use CodeIgniter\Model;

class M_AuditLogCreate extends Model
{
    protected $table      = 'audit_log_create';
    protected $primaryKey = 'id_create';
    protected $allowedFields = [
        'table_name',
        'username',
        'tindakan',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
