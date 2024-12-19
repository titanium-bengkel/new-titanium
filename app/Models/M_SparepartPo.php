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
        return $this->where('id_terima_po', $id_terima_po)->findAll();
    }
    public function getSparepartRepair($id_terima_po)
    {
        return $this->where('id_terima_po', $id_terima_po)->findAll();
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
