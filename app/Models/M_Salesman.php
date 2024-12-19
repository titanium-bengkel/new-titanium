<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Salesman extends Model
{
    protected $table = 'salesman';
    protected $primaryKey = 'id_salesman';
    protected $allowedFields = ['kode', 'nama', 'keterangan', 'alamat', 'kota', 'telp', 'target', 'user_id'];

    public function getSalesmanWithUser()
    {
        return $this->select('salesman.*, auth_user.username')
            ->join('auth_user', 'auth_user.id = salesman.user_id', 'left')
            ->findAll();
    }

    public function getSalesmanWithUsername()
    {
        return $this->select('salesman.id_salesman, salesman.kode, salesman.nama, salesman.keterangan, salesman.alamat, salesman.kota, salesman.telp, salesman.target, auth_user.username')
            ->join('auth_user', 'auth_user.id = salesman.user_id')
            ->findAll();
    }

    public function getSalesman($id = false)
    {
        if ($id === false) {
            return $this->select('salesman.id_salesman, salesman.kode, salesman.nama, salesman.keterangan, salesman.alamat, salesman.kota, salesman.telp, salesman.target, auth_user.username')
                ->join('auth_user', 'auth_user.id = salesman.user_id')
                ->findAll();
        } else {
            return $this->select('salesman.id_salesman, salesman.kode, salesman.nama, salesman.keterangan, salesman.alamat, salesman.kota, salesman.telp, salesman.target, auth_user.username')
                ->join('auth_user', 'auth_user.id = salesman.user_id')
                ->where('salesman.id_salesman', $id)
                ->first();
        }
    }

    public function insertSalesman($data)
    {
        return $this->insert($data);
    }

    public function updateSalesman($id, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_salesman', $id);
        $result = $builder->update($data);

        // Logging query for debugging
        log_message('debug', $this->db->getLastQuery());

        return $result;
    }
}
