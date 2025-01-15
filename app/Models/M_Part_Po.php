<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Part_Po extends Model
{
    protected $table      = 'part_po';
    protected $primaryKey = 'id_pesan';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_pesan',
        'no_faktur',
        'tanggal',
        'kode_supplier',
        'supplier',
        'gudang',
        'jatuh_tempo',
        'keterangan',
        'wo',
        'no_rangka',
        'asuransi',
        'jenis_mobil',
        'warna',
        'customer',
        'nopol',
        'total_qty',
        'total_jumlah',
        'user_id',
        'oke'
    ];

    public function updateNoFaktur($id_pesan, $no_faktur)
    {
        $this->where('id_pesan', $id_pesan)
            ->set('no_faktur', $no_faktur)
            ->update();
    }


    public function getByIdPesan($id_pesan)
    {
        return $this->where('id_pesan', $id_pesan)->first();
    }

    // Fungsi untuk generate ID otomatis
    public function generateId()
    {
        $prefix = 'POS' . date('Ym'); // Format prefix berdasarkan tahun dan bulan
        // Ambil record terakhir yang sesuai dengan prefix
        $lastRecord = $this->where('id_pesan LIKE', $prefix . '%')->orderBy('id_pesan', 'DESC')->first();

        if ($lastRecord) {
            // Ambil ID terakhir dari record yang ditemukan
            $lastId = substr($lastRecord['id_pesan'], -3); // Ambil 3 karakter terakhir
            $newId = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT); // Tambah 1 dan format menjadi 3 digit
        } else {
            // Jika tidak ada record sebelumnya, mulai dari 001
            $newId = '001';
        }

        return $prefix . $newId; // Kembalikan ID baru
    }





    public function hitungTotalQty($tableData)
    {
        $totalQty = 0;
        foreach ($tableData as $item) {
            $totalQty += $item['qty'];
        }
        return $totalQty;
    }

    public function hitungTotalJumlah($tableData)
    {
        $totalJumlah = 0;
        foreach ($tableData as $item) {
            $totalJumlah += $item['total_harga'];
        }
        return $totalJumlah;
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

    public function getAllPO()
    {
        return $this->db->table('po')->get()->getResult();
    }

    // public function getPartPoWithDetails()
    // {
    //     $db      = \Config\Database::connect();
    //     $builder = $db->table('part_po');
    //     $builder->select('part_po.id_pesan, part_po.tanggal, part_po.jenis_mobil, part_po.asuransi, part_po.supplier, part_po.no_kendaraan, pdetail_pesan.kode_barang, pdetail_pesan.nama_barang, pdetail_pesan.harga');
    //     $builder->join('pdetail_pesan', 'part_po.id_pesan = pdetail_pesan.id_pesan');
    //     $query = $builder->get();
    //     return $query->getResultArray(); // Mengembalikan hasil sebagai array
    // }

    public function getPartPoWithDetails($startDate = null, $endDate = null)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('part_po');

        // Query dengan Join dan Subquery untuk detail
        $builder->select('part_po.id_pesan, part_po.tanggal, part_po.jenis_mobil, part_po.asuransi, part_po.supplier, part_po.nopol, part_po.warna, part_po.oke, pdetail_pesan.id_kode_barang, pdetail_pesan.nama_barang, pdetail_pesan.is_sent, pdetail_pesan.harga');
        $builder->join('pdetail_pesan', 'part_po.id_pesan = pdetail_pesan.id_pesan', 'left');

        // Filter untuk is_sent = 0
        $builder->like('pdetail_pesan.is_sent', '0');

        // Jika tanggal tidak diberikan, gunakan default bulan ini
        if (!$startDate || !$endDate) {
            $startDate = date('Y-m-01'); // Tanggal awal bulan ini
            $endDate = date('Y-m-t');   // Tanggal akhir bulan ini
        }

        // Tambahkan filter periode tanggal
        $builder->where('part_po.tanggal >=', $startDate);
        $builder->where('part_po.tanggal <=', $endDate);

        // Eksekusi query
        $query = $builder->get();

        // Mengembalikan hasil sebagai array
        return $query->getResultArray();
    }
}
