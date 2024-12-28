<?php

namespace App\Models;

use CodeIgniter\Model;

class M_AuditLogDelete extends Model
{
    protected $table      = 'audit_log_delete';
    protected $primaryKey = 'id';

    protected $allowedFields = ['username', 'deleted_data', 'deleted_at'];

    protected $useTimestamps = false;
}
