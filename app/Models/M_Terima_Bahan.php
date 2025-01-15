<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Terima_Bahan extends Model
{
    protected $table = 'terima_bahan';
    protected $primaryKey = 'id_penerimaan';
    protected $allowedFields = [
        'id_penerimaan',
        'tanggal',
        'kode_supplier',
        'supplier',
        'jatuh_tempo',
        'keterangan',
        'gudang',
        'nomor',
        'kota',
        'alamat',
        'pembayaran',
        'ppn',
        'term',
        'total_qty',
        'total_jumlah',
        'nilai_ppn',
        'netto',
        'disc_total',
        'user_id'
    ];

    // Method to generate a unique ID for 'terima_bahan'
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

    public function getAllSupplier()
    {
        $builder = $this->db->table('supplier');
        $builder->select('kode, nama, alamat, kota');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getAllBahan()
    {
        $builder = $this->db->table('barang_bahan');
        $builder->select('kode_bahan, nama_bahan, satuan, harga_beli');
        $query = $builder->get();
        return $query->getResult();
    }


    public function getPoBahanwithDetail()
    {
        // Mengambil data dari tabel po_bahan, detail_barang, dan supplier
        $builder = $this->db->table('po_bahan');
        $builder->select('po_bahan.id_po_bahan, po_bahan.no_kendaraan, po_bahan.total_qty, po_bahan.total_jumlah, po_bahan.tanggal, 
                        supplier.kode, supplier.nama as nama_supplier, supplier.alamat, supplier.kota');
        $builder->join('supplier', 'supplier.id_supplier = po_bahan.id_po_bahan', 'left');
        $query = $builder->get();

        // Mengembalikan hasil query
        return $query->getResultArray();
    }









    // public function getPoBahanwithDetail() {}
    // public function getDetailBahan()
    // {
    //     return $this->db->table('detail_barang')->get()->getResult();
    // }
}
