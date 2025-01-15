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
        'no_repair_order',
        'no_rangka',
        'asuransi',
        'jenis_mobil',
        'nopol',
        'supplier',
        'tgl_terima',
        'tgl_pasang',
        'is_sent',
        'is_pasang',
        'created_at',
        'updated_at'
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

    public function getPartBelumpasang($startDate = null, $endDate = null)
    {
        // Gunakan default bulan berjalan jika tanggal tidak diberikan
        if (!$startDate || !$endDate) {
            $startDate = date('Y-m-01'); // Awal bulan ini
            $endDate = date('Y-m-t');   // Akhir bulan ini
        }

        // Hubungkan database dan builder
        $db = \Config\Database::connect();
        $builder = $db->table('pdetail_terima');

        // Pilih kolom yang dibutuhkan dari kedua tabel
        $builder->select('pdetail_terima.*, part_terima.id_penerimaan, part_terima.tanggal');

        // Lakukan join dengan tabel part_terima
        $builder->join('part_terima', 'part_terima.id_penerimaan = pdetail_terima.id_penerimaan');

        // Tambahkan filter is_pasang dan periode tanggal
        $builder->where('pdetail_terima.is_pasang', 0);
        $builder->where('part_terima.tanggal >=', $startDate);
        $builder->where('part_terima.tanggal <=', $endDate);

        // Eksekusi query dan kembalikan hasil sebagai array
        $query = $builder->get();
        return $query->getResultArray();
    }



    public function getPartPasang($startDate = null, $endDate = null)
    {
        // Gunakan default bulan berjalan jika tanggal tidak diberikan
        if (!$startDate || !$endDate) {
            $startDate = date('Y-m-01'); // Awal bulan ini
            $endDate = date('Y-m-t');   // Akhir bulan ini
        }

        // Filter data berdasarkan is_pasang dan periode tanggal
        return $this->where('is_pasang', 1)
            ->where('tanggal >=', $startDate)
            ->where('tanggal <=', $endDate)
            ->findAll();
    }


    public function getSparepartTerima($id_penerimaan)
    {
        return $this->where('id_penerimaan', $id_penerimaan)
            ->where('is_pasang', 0)
            ->findAll();
    }
}
