<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Po_Bahan extends Model
{
    protected $table = 'po_bahan';
    protected $primaryKey = 'id_po_bahan';
    protected $allowedFields = [
        'id_po_bahan',
        'status',
        'tanggal',
        'kode_supplier',
        'supplier',
        'jatuh_tempo',
        'keterangan',
        'total_qty',
        'total_jumlah',
        'no_faktur',
        'tgl_faktur',
        'user_id'
    ];



    public function getPoBahanWithSupplier()
    {
        return $this->select('po_bahan.*, 
                        supplier.kode AS supplier_kode, 
                        supplier.nama AS supplier_nama, 
                        supplier.kota, 
                        supplier.alamat')
            ->join('supplier', 'po_bahan.kode_supplier = supplier.kode')
            ->join(
                '(SELECT id_po_bahan, 
                    MIN(harga) AS harga, 
                    SUM(qty) AS total_qty 
                FROM detail_barang 
                GROUP BY id_po_bahan) AS detail',
                'po_bahan.id_po_bahan = detail.id_po_bahan'
            )
            ->findAll();
    }
    public function getByIdBahan($id_po_bahan)
    {
        return $this->where('id_po_bahan', $id_po_bahan)->first();
    }


    public function generateId()
    {
        // Ambil ID terakhir dari tabel
        $builder = $this->db->table($this->table);
        $lastRecord = $builder->select('id_po_bahan')
            ->orderBy('id_po_bahan', 'DESC')
            ->limit(1)
            ->get()
            ->getRow();

        // Jika ada ID, ambil nomor terakhir
        if ($lastRecord) {
            $lastId = $lastRecord->id_po_bahan;
            $lastNumber = intval(substr($lastId, -3)); // Ambil 3 digit terakhir sebagai nomor
        } else {
            // Jika tidak ada, mulai dari 0
            $lastNumber = 0;
        }

        // Generate nomor baru dengan menambah nomor terakhir
        $newNumber = $lastNumber + 1;
        $newId = 'POB' . date('Ym') . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $newId;
    }


    public function getAllSupplier()
    {
        $builder = $this->db->table('supplier');
        $builder->select('kode, nama');
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

    public function searchWithFilter($search, $date, $month, $year)
    {
        $builder = $this->table($this->table);

        if (!empty($search)) {
            $builder->like('supplier', $search)
                ->orLike('keterangan', $search)
                ->orLike('no_ro', $search)
                ->orLike('nama_pemilik', $search)
                ->orLike('no_kendaraan', $search);
        }

        if (!empty($date)) {
            $builder->where('DATE_FORMAT(tanggal, "%Y-%m-%d")', $date);
        } elseif (!empty($month) && !empty($year)) {
            $builder->where('MONTH(tanggal)', $month)
                ->where('YEAR(tanggal)', $year);
        }

        return $builder->get()->getResultArray();
    }
}
