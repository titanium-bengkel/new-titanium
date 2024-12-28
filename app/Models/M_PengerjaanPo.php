<?php

namespace App\Models;

use CodeIgniter\Model;

class M_PengerjaanPo extends Model
{
    protected $table = 'pengerjaan_po';
    protected $primaryKey = 'id_pengerjaan_po';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['kode_pengerjaan', 'nama_pengerjaan', 'harga', 'id_terima_po', 'total_harga'];

    public function getAllPengerjaan()
    {
        $builder = $this->db->table('pengerjaan');
        $builder->select('kode_pengerjaan, nama_pengerjaan');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getPengerjaanById($id_po)
    {
        return $this->where('id_terima_po', $id_po)->findAll();
    }

    public function getPengerjaanByKode($id)
    {
        return $this->where('id_pengerjaan_po', $id)->first();
    }

    public function getAllPengerjaanPo()
    {
        $builder = $this->db->table('pengerjaan_po');
        $builder->select('kode_pengerjaan, nama_pengerjaan, harga');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getPengerjaanByIdTerimaPo($id_terima_po)
    {
        return $this->where('id_terima_po', $id_terima_po)->findAll();
    }

    public function deletePengerjaan($kode_pengerjaan)
    {
        return $this->where('kode_pengerjaan', $kode_pengerjaan)->delete();
    }
}
