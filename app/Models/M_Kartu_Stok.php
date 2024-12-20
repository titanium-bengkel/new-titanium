<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Kartu_Stok extends Model
{
    protected $table      = 'kartu_stok';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nomor',
        'transaksi',
        'debit',
        'credit',
        'saldo',
        'tanggal',
        'id_kode_barang',
        'nama_barang',
        'gudang',
        'nopol'
    ];

    protected $useTimestamps = false;


    public function generateId()
{
    // Ambil tahun dan bulan saat ini
    $yearMonth = date('Ym'); // Format: YYYYMM, misalnya 202411 untuk November 2024

    // Cari ID terakhir yang ada dengan format yang sama
    $lastId = $this->db->table('kartu_stok')->select('nomor')->like('nomor', 'SK'.$yearMonth, 'after')->orderBy('nomor', 'desc')->get()->getRowArray();

    // Tentukan nomor urut ID berikutnya
    if ($lastId) {
        $lastNumber = (int) substr($lastId['nomor'], 8); // Ambil angka terakhir dari ID
        $newNumber = $lastNumber + 1; // Nomor baru adalah +1 dari yang terakhir
    } else {
        $newNumber = 1; // Jika belum ada, mulai dari 1
    }

    // Format nomor urut menjadi 3 digit
    $formattedNumber = str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    // Gabungkan format ID dengan nomor urut baru
    $newId = 'SK'.$yearMonth.$formattedNumber;

    return $newId;
}
}


