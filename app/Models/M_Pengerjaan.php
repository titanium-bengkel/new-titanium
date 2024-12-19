<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pengerjaan extends Model
{
    protected $table = 'pengerjaan';
    protected $primaryKey = 'id_pengerjaan';

    protected $allowedFields = ['id_pengerjaan', 'kode_pengerjaan', 'nama_pengerjaan', 'keterangan_pengerjaan', 'user_id'];

    public function getPengerjaanWithUser()
    {
        return $this->select('pengerjaan.*, auth_user.username')
            ->join('auth_user', 'auth_user.id = pengerjaan.user_id', 'left')
            ->findAll();
    }
    public function getPengerjaanWithUsername()
    {
        return $this->select('pengerjaan.id_pengerjaan, pengerjaan.kode_pengerjaan, pengerjaan.nama_pengerjaan, pengerjaan.keterangan_pengerjaan, auth_user.username')
            ->join('auth_user', 'auth_user.id = pengerjaan.user_id')
            ->orderBy('pengerjaan.id_pengerjaan', 'DESC')
            ->findAll();
    }

    public function getPengerjaan($id = false)
    {
        if ($id === false) {
            return $this->select('pengerjaan.id_pengerjaan, pengerjaan.kode_pengerjaan, pengerjaan.nama_pengerjaan,  pengerjaan.keterangan_pengerjaan, auth_user.username')
                ->join('auth_user', 'auth_user.id = pengerjaan.userid')
                ->findAll();
        } else {
            return $this->select('pengerjaan.id_pengerjaan, pengerjaan.kode_pengerjaan, pengerjaan.nama_pengerjaan,  pengerjaan.keterangan_pengerjaan, auth_user.username')
                ->join('auth_user', 'auth_user.id = pengerjaan.user_id')
                ->where('pengerjaan.id_pengerjaan', $id)
                ->first();
        }
    }


    public function insertPengerjaan($data)
    {
        return $this->insert($data);
    }
    public function updatePengerjaan($id, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_pengerjaan', $id);
        $result = $builder->update($data);

        // Logging query for debugging
        log_message('debug', $this->db->getLastQuery());

        return $result;
    }

    public function deletePengerjaan($id)
    {
        return $this->where('id_pengerjaan', $id)->delete();
    }
    // -----------------------------------------------------------------------------------------------------------------------------------------------------
    // Model for 'baranggroup' table
}
