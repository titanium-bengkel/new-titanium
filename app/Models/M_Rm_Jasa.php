<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Rm_Jasa extends Model
{
    protected $table = 'rm_jasa';
    protected $primaryKey = 'id_jasa';
    protected $allowedFields = [
        'id_jasa',
        'tanggal',
        'no_ro',
        'tanggal_masuk',
        'nopol',
        'no_rangka',
        'jenis_mobil',
        'warna',
        'tahun',
        'nama_pemilik',
        'keterangan',
        'total',
        'user_id',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Fungsi untuk generate ID dengan format RMJYYYYMM001
    public function generateId()
    {
        // Ambil tahun dan bulan saat ini
        $yearMonth = date('Y') . date('m');

        // Cari ID terakhir yang dibuat untuk bulan yang sama
        $lastRecord = $this->where('id_jasa LIKE', 'RMJ' . $yearMonth . '%')
            ->orderBy('id_jasa', 'DESC')
            ->first();

        // Default number jika belum ada record
        $nextNumber = 1;

        if ($lastRecord) {
            // Ambil 3 digit terakhir dari id_jasa dan increment
            $lastId = (int)substr($lastRecord['id_jasa'], -3);
            $nextNumber = $lastId + 1;
        }

        // Format ID dengan padding 3 digit
        $newId = 'RMJ' . $yearMonth . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return $newId;
    }
}
