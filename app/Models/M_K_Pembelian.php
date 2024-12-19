<?php

namespace App\Models;

use CodeIgniter\Model;

class M_K_Pembelian extends Model
{
    protected $table = 'k_pembelian';
    protected $primaryKey = 'no_faktur';
    protected $allowedFields = [
        'no_faktur',
        'tanggal',
        'kode_supplier',
        'supplier',
        'jatuh_tempo',
        'keterangan',
        'gudang',
        'no_preor',
        'kota',
        'alamat',
        'nopol',
        'pembayaran',
        'ppn',
        'term',
        'total_qty',
        'total_jumlah',
        'nilai_ppn',
        'netto',
        'user_id'
    ];
    // Aktifkan fitur otomatis timestamps
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    public function getDetails($id_penerimaan)
    {
        // Pastikan parameter tidak kosong
        if (empty($id_penerimaan)) {
            return []; // atau tangani kesalahan sesuai kebutuhan
        }

        // Menggunakan query builder untuk join
        return $this->select('part_terima.*, pdetail_terima.*')
            ->join('pdetail_terima', 'pdetail_terima.id_penerimaan = part_terima.id_penerimaan', 'left')
            ->where('part_terima.id_penerimaan', $id_penerimaan)
            ->findAll();
    }
    public function getMergedData()
    {
        // Query untuk data dari terima_bahan
        $terimaBahanQuery = $this->db->table('terima_bahan')
            ->select('id_penerimaan as id, tanggal, kode_supplier, supplier, kota, alamat, nomor as nomor_terima, total_jumlah, jatuh_tempo, keterangan, gudang, pembayaran, ppn, netto, term')
            ->getCompiledSelect();

        // Query untuk data dari part_terima
        $partTerimaQuery = $this->db->table('part_terima')
            ->select('id_penerimaan as id, tanggal, kode_supplier, supplier, kota, alamat, no_preor as nomor_terima, total_jumlah, jatuh_tempo, keterangan, gudang, pembayaran, ppn, netto, term')
            ->getCompiledSelect();

        // Gabungkan kedua query dengan UNION dan tambahkan ORDER BY
        $query = $this->db->query("$terimaBahanQuery UNION $partTerimaQuery ORDER BY tanggal");

        return $query->getResultArray();
    }




    public function getAllSupplier()
    {
        $builder = $this->db->table('supplier');
        $builder->select('kode, nama, alamat, kota');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getAllBarang()
    {
        $builder = $this->db->table('barang');
        $builder->select('kode, nama, sat_B, hargabeli_B');
        $query = $builder->get();
        return $query->getResult();
    }


    public function getAllPoBahan()
    {
        return $this->db->table('part_po')->get()->getResult();
    }
}
