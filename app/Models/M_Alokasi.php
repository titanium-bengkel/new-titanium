<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Alokasi extends Model
{
    protected $table = 'barangalokasi';
    protected $primaryKey = 'id_alokasi';

    protected $allowedFields = ['id_alokasi', 'kode_alokasi', 'kode_perkiraan', 'nama_alokasi', 'keterangan_alokasi', 'user_id'];

    public function getAlokasiWithUser()
    {
        return $this->select('barangalokasi.*, auth_user.username')
            ->join('auth_user', 'auth_user.id = barangalokasi.user_id', 'left')
            ->findAll();
    }
    public function getAlokasiWithUsername()
    {
        return $this->select('barangalokasi.id_alokasi, barangalokasi.kode_alokasi, barangalokasi.kode_perkiraan, barangalokasi.nama_alokasi, barangalokasi.keterangan_alokasi, auth_user.username')
            ->join('auth_user', 'auth_user.id = barangalokasi.user_id')
            ->findAll();
    }

    public function getAlokasi($id = false)
    {
        if ($id === false) {
            return $this->select('barangalokasi.id_alokasi, barangalokasi.kode_alokasi, barangalokasi.kode_perkiraan, barangalokasi.nama_alokasi,  barangalokasi.keterangan_alokasi, auth_user.username')
                ->join('auth_user', 'auth_user.id = barangalokasi.userid')
                ->findAll();
        } else {
            return $this->select('barangalokasi.id_alokasi, barangalokasi.kode_alokasi, barangalokasi.kode_perkiraan, barangalokasi.nama_alokasi,  barangalokasi.keterangan_alokasi, auth_user.username')
                ->join('auth_user', 'auth_user.id = barangalokasi.user_id')
                ->where('barangalokasi.id_alokasi', $id)
                ->first();
        }
    }


    public function insertAlokasi($data)
    {
        return $this->insert($data);
    }
    public function updateAlokasi($id, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_alokasi', $id);
        $result = $builder->update($data);

        // Logging query for debugging
        log_message('debug', $this->db->getLastQuery());

        return $result;
    }
    // -----------------------------------------------------------------------------------------------------------------------------------------------------
}
