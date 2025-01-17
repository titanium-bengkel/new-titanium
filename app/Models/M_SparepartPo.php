<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SparepartPo extends Model
{
    protected $table = 'sparepart_po';
    protected $primaryKey = 'id_sparepart_po';

    // Daftar field yang dapat diisi
    protected $allowedFields = [
        'id_terima_po',
        'kode_sparepart',
        'nama_sparepart',
        'qty',
        'harga',
        'total_qty',
        'total_harga',
        'kode_pengerjaan',
        'jenis_part',
        'keterangan',
        'is_sent'
    ];

    // Set time columns to true if you are using created_at and updated_at
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getJoinedPoData()
    {
        return $this->select('po.*, sparepart_po.*')
            ->join('po', 'po.id_terima_po = sparepart_po.id_terima_po')
            ->where('sparepart_po.is_sent', 1)
            ->findAll();
    }
    public function getSparepartById($id_po)
    {
        return $this->where('id_terima_po', $id_po)->findAll();
    }

    public function isSent($no_repair_order)
    {
        // Mengambil data dari database untuk memeriksa status is_sent
        $builder = $this->db->table('part_po');
        $builder->select('is_sent');
        $builder->where('no_repair_order', $no_repair_order);
        $query = $builder->get()->getRowArray();

        return isset($query['is_sent']) ? $query['is_sent'] : 0; // Mengembalikan 0 jika tidak ditemukan
    }

    public function getAllSparepartPo()
    {
        $builder = $this->db->table('barang_sparepart');
        $builder->select('kode_part, nama_part, harga_beliawal as harga');
        $query = $builder->get();
        return $query->getResultArray(); // Mengembalikan array asosiatif
    }

    public function getPengerjaanByIdTerimaPo($id_terima_po)
    {
        $builder = $this->db->table('pengerjaan_po');
        $builder->select('kode_pengerjaan, nama_pengerjaan');
        $builder->where('id_terima_po', $id_terima_po); // Filter berdasarkan id_terima_po
        $query = $builder->get();
        return $query->getResultArray(); // Mengembalikan array asosiatif
    }

    public function getSparepartByIdTerimaPo($id_terima_po)
    {
        $builder = $this->db->table($this->table);

        // Pilih kolom spesifik untuk menghindari ambiguitas
        $builder->select('
            sparepart_po.id_sparepart_po,
            sparepart_po.kode_sparepart, 
            sparepart_po.nama_sparepart, 
            sparepart_po.qty,
            sparepart_po.harga,
            sparepart_po.jenis_part,
            SUM(pdetail_pesan.qty) as qty_pesan, 
            MAX(part_po.tanggal) as tgl_pesan, 
            SUM(pdetail_terima.qty) as qty_beli, 
            MAX(pdetail_terima.tgl_terima) as tgl_beli
        ');

        // Join tabel terkait
        $builder->join('part_po', 'part_po.wo = sparepart_po.id_terima_po', 'left');
        $builder->join('pdetail_pesan', 'pdetail_pesan.wo = sparepart_po.id_terima_po AND pdetail_pesan.id_kode_barang = sparepart_po.kode_sparepart', 'left');
        $builder->join('pdetail_terima', 'pdetail_terima.no_repair_order = sparepart_po.id_terima_po AND pdetail_terima.id_kode_barang = sparepart_po.kode_sparepart', 'left');

        // Filter berdasarkan id_terima_po
        $builder->where('sparepart_po.id_terima_po', $id_terima_po);

        // Kelompokkan berdasarkan kode_sparepart dan nama sparepart
        $builder->groupBy('sparepart_po.id_sparepart_po, sparepart_po.kode_sparepart, sparepart_po.nama_sparepart, sparepart_po.qty, sparepart_po.harga, sparepart_po.jenis_part');

        // Eksekusi query
        $query = $builder->get();

        // Ambil hasil dalam bentuk array
        $results = $query->getResultArray();

        return $results;
    }
    public function getSparepartByRepair($id_terima_po)
    {
        $builder = $this->db->table($this->table);

        // Pilih kolom spesifik untuk menghindari ambiguitas
        $builder->select('
            sparepart_po.id_sparepart_po,
            sparepart_po.kode_sparepart, 
            sparepart_po.nama_sparepart, 
            sparepart_po.qty,
            sparepart_po.harga,
            sparepart_po.jenis_part,
            SUM(pdetail_pesan.qty) as qty_pesan, 
            MAX(part_po.tanggal) as tgl_pesan, 
            SUM(pdetail_terima.qty) as qty_beli, 
            MAX(pdetail_terima.tgl_terima) as tgl_beli,
            SUM(pdetail_repair.qty_B) as qty_repair
        ');

        // Join tabel terkait
        $builder->join('part_po', 'part_po.wo = sparepart_po.id_terima_po', 'left');
        $builder->join('pdetail_pesan', 'pdetail_pesan.wo = sparepart_po.id_terima_po AND pdetail_pesan.id_kode_barang = sparepart_po.kode_sparepart', 'left');
        $builder->join('pdetail_terima', 'pdetail_terima.no_repair_order = sparepart_po.id_terima_po AND pdetail_terima.id_kode_barang = sparepart_po.kode_sparepart', 'left');
        $builder->join('pdetail_repair', 'pdetail_repair.no_repair_order = sparepart_po.id_terima_po AND pdetail_repair.id_kode_barang = sparepart_po.kode_sparepart', 'left');

        // Filter berdasarkan id_terima_po
        $builder->where('sparepart_po.id_terima_po', $id_terima_po);

        // Kelompokkan berdasarkan kode_sparepart dan nama sparepart
        $builder->groupBy('sparepart_po.id_sparepart_po, sparepart_po.kode_sparepart, sparepart_po.nama_sparepart, sparepart_po.qty, sparepart_po.harga, sparepart_po.jenis_part');

        // Eksekusi query
        $query = $builder->get();

        // Ambil hasil dalam bentuk array
        $results = $query->getResultArray();

        return $results;
    }






    public function getSparepartRepair($id_terima_po)
    {
        $builder = $this->db->table($this->table);
        // Specify all columns needed or use '*' to select all columns
        $builder->select('sparepart_po.*, pdetail_pesan.qty as qty_po, pdetail_repair.*');
        $builder->join('pdetail_pesan', 'pdetail_pesan.wo = sparepart_po.id_terima_po', 'left');
        $builder->join('pdetail_repair', 'pdetail_repair.no_repair_order = sparepart_po.id_terima_po', 'left');
        $builder->where('sparepart_po.id_terima_po', $id_terima_po);
        $query = $builder->get();

        return $query->getResultArray();
    }


    public function getDetailByIdTerimaPo($id_terima_po)
    {
        return $this->where('id_terima_po', $id_terima_po)
            ->where('jenis_part', 'NON-SUPPLY')
            ->where('is_sent', '0')
            ->findAll();
    }

    public function getDetail($id_terima_po)
    {
        return $this->where('id_terima_po', $id_terima_po)
            ->where('jenis_part', 'SUPPLY')
            ->where('is_sent', '0')
            ->findAll();
    }


    public function updateJenisPart($id_terima_po, $jenis_part)
    {
        $this->db->table('sparepart_po')
            ->where('id_terima_po', $id_terima_po)
            ->update(['jenis_part' => $jenis_part]);
    }
}
