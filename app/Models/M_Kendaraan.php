<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'id_kendaraan';
    protected $allowedFields = ['no_kendaraan', 'customer_name', 'no_contact'];

    public function getAllKendaraan()
    {
        return $this->findAll(); // Mengambil semua data dari tabel kendaraan
    }
}
