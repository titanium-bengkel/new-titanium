<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pdetail_Terima extends Model
{
    protected $table = 'pdetail_terima';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'id_kode_barang',
        'nama_barang',
        'qty',
        'satuan',
        'harga',
        'disc',
        'jumlah',
        'no_po',
        'po_id',
        'id_penerimaan',
        'is_sent'
    ];
    // Aktifkan fitur otomatis timestamps
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function calculateTotals($qty, $harga, $disc, $ppn_option)
    {
        // Pastikan semua elemen dalam array adalah float
        $jumlah = array_map(function ($qty, $harga, $disc) {
            return floatval($qty) * floatval($harga) * (1 - floatval($disc) / 100);
        }, $qty, $harga, $disc);

        $total_qty = array_sum(array_map('floatval', $qty));
        $total_jumlah = array_sum($jumlah);

        $nilai_ppn = 0;
        $netto = $total_jumlah;

        // Kalkulasi tambahan berdasarkan ppn_option, jika diperlukan
        if ($ppn_option == 'include') {
            $nilai_ppn = $total_jumlah * 0.1; // 10% PPN
            $netto = $total_jumlah + $nilai_ppn;
        }

        return [
            'jumlah' => $jumlah,  // Kembalikan array dari jumlah per item
            'total_qty' => $total_qty,
            'total_jumlah' => $total_jumlah, // Total keseluruhan dari semua jumlah
            'nilai_ppn' => $nilai_ppn,
            'netto' => $total_jumlah, // Misalnya netto adalah total_jumlah
        ];
    }


    public function deleteByKodeBarang($id)
    {
        return $this->where('id', $id)->delete();
    }

    // Fungsi untuk mendapatkan id_penerimaan berdasarkan id
    public function getIdPenerimaanByKodeBarang($id)
    {
        $result = $this->where('id', $id)->first();

        // Periksa apakah hasil query tidak null
        if ($result !== null) {
            return $result['id_penerimaan'];
        } else {
            return null; // Atau Anda bisa menangani error sesuai kebutuhan
        }
    }
    public function getSparepartsByPesan($id_pesan)
    {
        return $this->where('id_pesan', $id_pesan)->findAll(); // Ambil semua sparepart berdasarkan id_pesan
    }
}
