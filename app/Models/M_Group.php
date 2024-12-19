<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Group extends Model
{
    protected $table = 'baranggroup';
    protected $primaryKey = 'id_group'; // Sesuaikan dengan primary key tabel Anda

    public function getBarangGroupTableJoin()
    {
        $query = $this->db->table('baranggroup')
            ->select('baranggroup.*, barangkategori.nama AS nama_kategori, auth_user.username')
            ->join('barangkategori', 'barangkategori.kode = baranggroup.kodekategori', 'left')
            ->join('auth_user', 'auth_user.id = baranggroup.user_id', 'left')
            ->get();

        return $query->getResultArray();
    }
    public function getGroups()
    {
        $query = $this->db->table('baranggroup')
            ->select('kodegroup, namagroup')
            ->get();

        return $query->getResultArray();
    }

    public function getKategori()
    {
        $query = $this->db->table('barangkategori')
            ->select('kode, nama')
            ->get();

        return $query->getResultArray();
    }

    public function insertBarangGroup($data)
    {
        return $this->db->table('baranggroup')->insert($data);
    }

    public function updateBarangGroup($id, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where($this->primaryKey, $id);
        return $builder->update($data);
    }
}
