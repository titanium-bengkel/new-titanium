<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $allowedFields = [
        'kode',
        'nama',
        'alamat',
        'email',
        'contactperson',
        'telp',
        'kota',
        'fax',
        'hp',
        'rekening',
        'term',
        'npwp',
        'status',
        'inisial',
        'keterangan',
        'user_id'
    ];

    public function getSupplierWithUser()
    {
        return $this->select('supplier.*, auth_user.username')
            ->join('auth_user', 'auth_user.id = supplier.user_id', 'left')
            ->orderBy('supplier.id_supplier', 'DESC') // Urutkan berdasarkan id_supplier secara descending
            ->findAll();
    }

    public function getSupplier($id = false)
    {
        if ($id === false) {
            return $this->select('supplier.*, auth_user.username')
                ->join('auth_user', 'auth_user.id = supplier.user_id')
                ->findAll();
        } else {
            return $this->select('supplier.*, auth_user.username')
                ->join('auth_user', 'auth_user.id = supplier.user_id')
                ->where('supplier.id_supplier', $id)
                ->first();
        }
    }

    public function insertSupplier($data)
    {
        return $this->insert($data);
    }

    public function updateSupplier($id, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_supplier', $id);
        $result = $builder->update($data);

        // Logging query for debugging
        log_message('debug', $this->db->getLastQuery());

        return $result;
    }
}
