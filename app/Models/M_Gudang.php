<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Gudang extends Model
{
    protected $table = 'gudang';

    protected $allowedFields = ['id_gudang', 'telp', 'fax', 'kota', 'alamat', 'kode', 'gudangpos', 'nama', 'contactperson', 'keterangan', 'user_id'];

    public function getGudangWithUser()
    {
        return $this->select('gudang.*, auth_user.username')
            ->join('auth_user', 'auth_user.id = gudang.user_id', 'left')
            ->findAll();
    }
    public function getGudangWithUsername()
    {
        return $this->select('gudang.id_gudang, gudang.telp, gudang.fax , gudang.kota, gudang.alamat, gudang.kode, gudang.gudangpos, gudang.nama, gudang.contactperson, gudang.keterangan , auth_user.username')
            ->join('auth_user', 'auth_user.id = gudang.user_id')
            ->findAll();
    }

    public function getGudang($id = false)
    {
        if ($id === false) {
            return $this->select('gudang.id_gudang, gudang.telp, gudang.fax , gudang.kota, gudang.alamat, gudang.kode, gudang.gudangpos, gudang.nama, gudang.contactperson, gudang.keterangan , auth_user.username')
                ->join('auth_user', 'auth_user.id = gudang.user_id')
                ->findAll();
        } else {
            return $this->select('gudang.id_gudang, gudang.telp, gudang.fax , gudang.kota, gudang.alamat, gudang.kode, gudang.gudangpos, gudang.nama, gudang.contactperson, gudang.keterangan , auth_user.username')
                ->join('auth_user', 'auth_user.id = gudang.user_id')
                ->where('gudang.id_gudang', $id)
                ->first();
        }
    }


    public function insertGudang($data)
    {
        return $this->insert($data);
    }
    public function updateGudang($id, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_gudang', $id);
        $result = $builder->update($data);

        // Logging query for debugging
        log_message('debug', $this->db->getLastQuery());

        return $result;
    }
    // -----------------------------------------------------------------------------------------------------------------------------------------------------
}
