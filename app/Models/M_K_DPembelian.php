<?php

namespace App\Models;

use CodeIgniter\Model;

class M_K_DPembelian extends Model
{
    protected $table = 'kdetail_pembelian';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_kode_barang',
        'nama_barang',
        'qty',
        'satuan',
        'harga',
        'disc',
        'jumlah',
        'no_po',
        'po_id',
        'no_faktur'
    ];

    // Aktifkan fitur otomatis timestamps
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';



    public function calculateTotals($qty, $harga, $disc, $ppn_option)
    {
        $jumlah = array_map(function ($qty, $harga, $disc) {
            return $qty * $harga * (1 - $disc / 100);
        }, $qty, $harga, $disc);

        $total_qty = array_sum($qty);
        $total_jumlah = array_sum($jumlah);

        $nilai_ppn = 0;
        $netto = $total_jumlah;

        if ($ppn_option == 'PPN') {
            $nilai_ppn = 0.11 * $total_jumlah; // PPN 11%
            $netto += $nilai_ppn;
        }

        return [
            'jumlah' => $jumlah, // Menambahkan array jumlah
            'total_qty' => $total_qty,
            'total_jumlah' => $total_jumlah,
            'nilai_ppn' => $nilai_ppn,
            'netto' => $netto,
        ];
    }
    public function deleteByKodeBarang($id)
    {
        return $this->where('id', $id)->delete();
    }

    public function getIdPenerimaanByKodeBarang($id)
    {
        $result = $this->where('id', $id)->first();

        // Periksa apakah hasil query tidak null
        if ($result !== null) {
            return $result['id_pembelian'];
        } else {
            return null; // Atau Anda bisa menangani error sesuai kebutuhan
        }
    }
}
