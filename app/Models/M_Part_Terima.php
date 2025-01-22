<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Part_Terima extends Model
{
    protected $table = 'part_terima';
    protected $primaryKey = 'id_penerimaan';
    protected $allowedFields = [
        'id_penerimaan',
        'tanggal',
        'kode_supplier',
        'supplier',
        'jatuh_tempo',
        'keterangan',
        'gudang',
        'no_preor',
        'kota',
        'alamat',
        'no_repair_order',
        'asuransi',
        'jenis_mobil',
        'warna',
        'nama_pemilik',
        'nopol',
        'no_rangka',
        'pembayaran',
        'ppn',
        'term',
        'total_qty',
        'total_jumlah',
        'nilai_ppn',
        'netto',
        'disc_total',
        'user_id',
        'created_at'
    ];

    public function generateIdTerima()
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_penerimaan');
        $builder->orderBy('id_penerimaan', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $result = $query->getRow();

        if ($result) {
            $last_id = $result->id_penerimaan;
            $last_number = intval(substr($last_id, -3));
            $new_number = $last_number + 1;
            $new_id = 'PC' . date('Ym') . str_pad($new_number, 3, '0', STR_PAD_LEFT);
        } else {
            $new_id = 'PC' . date('Ym') . '001';
        }

        return $new_id;
    }
    public function generateIdSupply()
    {
        $prefix = 'SP' . date('Ym'); // Format prefix berdasarkan tahun dan bulan
        // Ambil record terakhir yang sesuai dengan prefix
        $lastRecord = $this->where('id_penerimaan LIKE', $prefix . '%')->orderBy('id_penerimaan', 'DESC')->first();

        if ($lastRecord) {
            // Ambil ID terakhir dari record yang ditemukan
            $lastId = substr($lastRecord['id_penerimaan'], -3); // Ambil 3 karakter terakhir
            $newId = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT); // Tambah 1 dan format menjadi 3 digit
        } else {
            // Jika tidak ada record sebelumnya, mulai dari 001
            $newId = '001';
        }

        return $prefix . $newId; // Kembalikan ID baru
    }
    public function getSupplyAsuransiWithSP()
    {
        return $this->where('id_penerimaan LIKE', 'SP%')->findAll();
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



    public function getPartTerimaWithDetails($startDate = null, $endDate = null)
    {
        // Jika tidak ada tanggal, gunakan default per bulan ini
        if (!$startDate || !$endDate) {
            $startDate = date('Y-m-01'); // Tanggal awal bulan ini
            $endDate = date('Y-m-t');   // Tanggal akhir bulan ini
        }

        $db      = \Config\Database::connect();
        $builder = $db->table('part_terima');

        // Select kolom yang diperlukan dari kedua tabel
        $builder->select('part_terima.id_penerimaan, part_terima.tanggal, part_terima.supplier, part_terima.no_preor, part_terima.nopol, part_terima.jenis_mobil, part_terima.asuransi, 
                    pdetail_terima.id_kode_barang, pdetail_terima.nama_barang, pdetail_terima.harga, pdetail_terima.jumlah');

        // Join tabel pdetail_terima dengan part_terima berdasarkan id_penerimaan
        $builder->join('pdetail_terima', 'part_terima.id_penerimaan = pdetail_terima.id_penerimaan');

        // Tambahkan filter tanggal
        $builder->where('part_terima.tanggal >=', $startDate);
        $builder->where('part_terima.tanggal <=', $endDate);

        $query = $builder->get();
        return $query->getResultArray(); // Mengembalikan hasil sebagai array
    }


    public function getPartTerimaWithDetailsisa($gudang = 'GUDANG WAITING')
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('part_terima');

        // Select kolom yang diperlukan dari kedua tabel
        $builder->select('part_terima.id_penerimaan, part_terima.tanggal, part_terima.supplier, part_terima.no_preor, part_terima.nopol, part_terima.gudang, 
                    pdetail_terima.id_kode_barang, pdetail_terima.nama_barang, pdetail_terima.harga, pdetail_terima.jumlah');

        // Join tabel pdetail_terima dengan part_terima berdasarkan id_penerimaan
        $builder->join('pdetail_terima', 'part_terima.id_penerimaan = pdetail_terima.id_penerimaan');

        // Filter berdasarkan gudang tertentu (misalnya Witting)
        $builder->where('part_terima.gudang', $gudang);

        $query = $builder->get();
        return $query->getResultArray(); // Mengembalikan hasil sebagai array
    }
    public function getSparepartsByPenerimaan($id_penerimaan)
    {
        return $this->where('id_penerimaan', $id_penerimaan)
            ->where('is_sent', 1)
            ->findAll();
    }
}
