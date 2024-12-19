<?php

namespace App\Models;

use CodeIgniter\Model;

class M_BarangK extends Model
{
    protected $table = 'barangkategori';
    protected $primaryKey = 'userid';

    protected $allowedFields = ['userid', 'kode', 'nama', 'stok', 'keterangan', 'status'];

    public function getBarangKategoriWithUsername()
    {
        return $this->select('barangkategori.id, barangkategori.kode, barangkategori.nama, barangkategori.stok, barangkategori.keterangan, auth_user.username')
            ->join('auth_user', 'auth_user.id = barangkategori.userid')
            ->findAll();
    }

    public function getBarangKategori($id = false)
    {
        if ($id === false) {
            return $this->select('barangkategori.id, barangkategori.kode, barangkategori.nama, barangkategori.stok, barangkategori.keterangan, auth_user.username')
                ->join('auth_user', 'auth_user.id = barangkategori.userid')
                ->findAll();
        } else {
            return $this->select('barangkategori.id, barangkategori.kode, barangkategori.nama, barangkategori.stok, barangkategori.keterangan, auth_user.username')
                ->join('auth_user', 'auth_user.id = barangkategori.userid')
                ->where('barangkategori.id', $id)
                ->first();
        }
    }


    public function insertBarangKategori($data)
    {
        return $this->insert($data);
    }
    public function updateBarangKategori($id, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $id);
        $result = $builder->update($data);

        // Logging query for debugging
        log_message('debug', $this->db->getLastQuery());

        return $result;
    }

    public function deleteBarangKategori($id)
    {
        return $this->where('id', $id)->delete();
    }
}
