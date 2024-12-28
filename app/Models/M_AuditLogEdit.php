<?php

namespace App\Models;

use CodeIgniter\Model;

class M_AuditLogEdit extends Model
{
    protected $table = 'audit_log_edit';
    protected $allowedFields = [
        'table_name',
        'record_id',
        'column_name',
        'old_value',
        'new_value',
        'updated_by',
        'updated_at'
    ];

    protected $useTimestamps = false;

    protected $dateFormat = 'datetime';
}
