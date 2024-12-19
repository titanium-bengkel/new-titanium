<?php

namespace App\Models;

use CodeIgniter\Model;

class M_K_Pembayaran_Detail extends Model
{
    protected $table = 'k_pembayaran_detail'; // Nama tabel
    protected $primaryKey = 'id'; // Nama kolom primary key
    protected $allowedFields = [
        'id_pembayaran',
        'kode_bayar',
        'no_bukti',
        'nominal',
        'no_faktur',
        'jatuh_tempo',
        'user_id',
        'created_at',
        'updated_at',
    ];

    // Mengaktifkan timestamp otomatis
    protected $useTimestamps = true;

    // Mengatur format waktu
    protected $dateFormat = 'datetime';

    // Tambahkan metode lain jika perlu
}
