<?php

namespace App\Models;

use CodeIgniter\Model;

class M_GambarPo extends Model
{
    protected $table = 'gambar_po';
    protected $primaryKey = 'id_gambar_po';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = [
        'id_terima_po',
        'keterangan',
        'gambar',
        'deskripsi'
    ];


    public function getGambarByIdTerimaPo($id_terima_po)
    {
        return $this->where('id_terima_po', $id_terima_po)->findAll();
    }
}
