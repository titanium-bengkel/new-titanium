<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Piutang extends Model
{
    protected $table = 'piutang';
    protected $primaryKey = 'id_piutang';

    protected $allowedFields = [
        'nomor',
        'tanggal',
        'no_order',
        'no_kendaraan',
        'jenis_mobil',
        'warna',
        'customer_name',
        'no_contact',
        'tahun_mobil',
        'asuransi',
        'jasa',
        'sparepart',
        'nilai_total',
        'jenis_bayar',
        'tanggal_masuk',
        'tanggal_selesai',
        'keterangan',
        'tanggal_kirim_kwitansi',
        'user_id',
        'nilai_bayar',
        'nilai_tagihan'
    ];
}
