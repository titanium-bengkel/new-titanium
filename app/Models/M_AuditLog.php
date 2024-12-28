<?php

namespace App\Models;

use CodeIgniter\Entity\Cast\StringCast;
use CodeIgniter\Model;

class M_AuditLog extends Model
{
    protected $table = 'audit_log';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'action',
        'table_name',
        'record_id',
        'username',
        'column_name',
        'old_value',
        'new_value',
        'deleted_data',
        'created_at',
        'updated_at',
        'deleted_at',
        'description'
    ];

    /**
     * Tambahkan log untuk tindakan CREATE.
     *
     * @param string $tableName
     * @param string $username
     * @param string $description
     * @return bool
     */
    public function logCreate(string $tableName, string $username, string $description = ''): bool
    {
        return $this->insert([
            'action' => 'CREATE',
            'table_name' => $tableName,
            'username' => $username,
            'description' => $description, // Menambahkan deskripsi
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Tambahkan log untuk tindakan DELETE.
     *
     * @param string $tableName
     * @param string $recordId
     * @param string $username
     * @param array $deletedData
     * @param string $description
     * @return bool
     */
    public function logDelete(string $tableName, string $recordId, string $username, array $deletedData, string $description = ''): bool
    {
        return $this->insert([
            'action' => 'DELETE',
            'table_name' => $tableName,
            'record_id' => $recordId,
            'username' => $username,
            'deleted_data' => json_encode($deletedData), // Simpan data yang dihapus dalam format JSON
            'description' => $description, // Menambahkan deskripsi
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Tambahkan log untuk tindakan EDIT.
     *
     * @param string $tableName
     * @param string $recordId
     * @param string $columnName
     * @param string $oldValue
     * @param string $newValue
     * @param string $username
     * @param string $description
     * @return bool
     */
    public function logEdit(
        string $tableName,
        string $recordId,
        string $columnName,
        string $oldValue,
        string $newValue,
        string $username,
        string $description = ''
    ): bool {
        return $this->insert([
            'action' => 'EDIT',
            'table_name' => $tableName,
            'record_id' => $recordId,
            'column_name' => $columnName,
            'old_value' => $oldValue,
            'new_value' => $newValue,
            'username' => $username,
            'description' => $description, // Menambahkan deskripsi
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
