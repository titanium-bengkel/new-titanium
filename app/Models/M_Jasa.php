<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Jasa extends Model
{
    protected $table = 'jasa';
    protected $primaryKey = 'id_jasa';

    protected $allowedFields = [
        'kode',
        'nama_jasa',
        'kode_biaya',
        'ket_biaya',
        'kode_alokasi',
        'ket_alokasi',
        'keterangan',
        'user_id'
    ];

    public function getAllJasaWithDetails()
    {
        return $this->select('jasa.*, coa.kode AS kode_biaya, coa.nama_account AS ket_biaya, coa2.kode AS kode_alokasi, coa2.nama_account AS ket_alokasi, auth_user.username')
            ->join('coa', 'jasa.kode_biaya = coa.kode', 'left')
            ->join('coa as coa2', 'jasa.kode_alokasi = coa2.kode', 'left')
            ->join('auth_user', 'jasa.user_id = auth_user.id', 'left')
            ->findAll();
    }


    public function insertJasa($data)
    {
        return $this->insert($data);
    }

    public function updateJasa($id, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_jasa', $id);
        $result = $builder->update($data);

        // Logging query for debugging
        log_message('debug', $this->db->getLastQuery());

        return $result;
    }
}
