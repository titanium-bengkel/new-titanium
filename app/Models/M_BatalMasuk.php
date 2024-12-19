<?php

namespace App\Models;

use CodeIgniter\Model;

class M_BatalMasuk extends Model
{
    protected $table = 'batal_masuk';
    protected $primaryKey = 'id_batal_masuk';
    protected $allowedFields = [
        'id_terima_po',
        'tgl_klaim',
        'tgl_acc',
        'status',
        'progres',
        'user_id',
        'harga_estimasi',
        'harga_acc',
        'no_kendaraan',
        'jenis_mobil',
        'warna',
        'no_polis',
        'no_rangka',
        'tahun_kendaraan',
        'no_contact',
        'customer_name',
        'alamat',
        'kota',
        'asuransi',
        'keterangan',
        'id_kendaraan',
        'biaya_pengerjaan',
        'biaya_sparepart',
        'total_biaya',
        'bengkel'
    ];

    protected $useTimestamps = false; // Ubah menjadi true jika Anda ingin menggunakan timestamps

    // Anda bisa menambahkan metode lain sesuai kebutuhan, seperti untuk melakukan pencarian atau filter
}
