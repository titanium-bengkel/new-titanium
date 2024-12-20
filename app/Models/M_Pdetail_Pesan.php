<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pdetail_Pesan extends Model
{
    protected $table      = 'pdetail_pesan';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id',
        'id_kode_barang',
        'nama_barang',
        'qty',
        'satuan',
        'harga',
        'jumlah',
        'no_faktur',
        'tgl_faktur',
        'id_pesan',
        'is_sent',
        'is_checked',
        'wo',
        'no_rangka',
        'nopol'
    ];

    // Fungsi untuk menghitung jumlah berdasarkan qty dan harga
    public function calculateJumlah($qty, $harga)
    {
        return $qty * $harga;
    }
    public function getSparepartsByPesan($id_pesan)
    {
        return $this->where('id_pesan', $id_pesan)
            ->where('is_sent', 0)
            ->findAll();
    }
    public function updateIsSent($id_kode_barang, $nopol, $isSent)
    {
        return $this->where('id_kode_barang', $id_kode_barang) // Validasi berdasarkan id_kode_barang
            ->where('nopol', $nopol) // Validasi berdasarkan nopol
            ->set(['is_sent' => $isSent])
            ->update();
    }
}
