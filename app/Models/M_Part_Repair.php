<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Part_Repair extends Model
{
    protected $table = 'part_repair';
    protected $primaryKey = 'id_material';
    protected $allowedFields = [
        'id_material',
        'tanggal',
        'no_repair',
        'no_rangka',
        'gudang_masuk',
        'gudang_keluar',
        'tanggal_masuk',
        'nopol',
        'asuransi',
        'jenis_mobil',
        'warna',
        'tahun',
        'nama_pemilik',
        'keterangan',
        'total_qty_B',
        'total_qty_T',
        'total_qty_K',
        'total_hpp',
        'total_nilai',
        'user_id',
    ];

    public function generateId()
    {
        $prefix = 'RM' . date('Ym');
        $lastRecord = $this->where('id_material LIKE', $prefix . '%')->orderBy('id_material', 'DESC')->first();

        if ($lastRecord) {
            $lastId = substr($lastRecord['id_material'], -4);
            $newId = str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newId = '0001';
        }

        return $prefix . $newId;
    }
    public function getAllPO()
    {
        return $this->db->table('po')->get()->getResult();
    }

    public function getAllBarangSparepart()
    {
        $builder = $this->db->table('barang_sparepart');
        $builder->select('id_part, kode_part, nama_part, satuan, stok, harga_beliawal');
        $query = $builder->get();
        return $query->getResult();
    }
    public function getpenerimaanJoinedDataWithIsSent($search = null)
    {
        $builder = $this->db->table('part_terima')
            ->select('part_terima.*, pdetail_terima.*')
            ->join('pdetail_terima', 'pdetail_terima.id_penerimaan = part_terima.id_penerimaan', 'left')
            ->where('pdetail_terima.is_sent', 1);

        if ($search) {
            $builder->like('part_terima.kode_supplier', $search)
                ->orLike('part_terima.supplier', $search)
                ->orLike('part_terima.nama_pemilik', $search);
        }
        return $builder->get()->getResultArray();
    }



    public function getSparepartsByPenerimaan($id_penerimaan)
    {
        return $this->where('id_penerimaan', $id_penerimaan)
            ->where('is_sent', 1)
            ->findAll();
    }

    public function getJoinedData()
    {
        $builder = $this->db->table('part_terima');
        $builder->select('
            part_terima.no_repair_order, 
            part_terima.id_penerimaan, 
            part_terima.no_rangka, 
            part_terima.jenis_mobil, 
            part_terima.nopol, 
            part_terima.asuransi,
            part_terima.nama_pemilik,
            part_terima.gudang,
            GROUP_CONCAT(pdetail_terima.id_kode_barang SEPARATOR ", ") AS id_kode_barang,
            GROUP_CONCAT(pdetail_terima.nama_barang SEPARATOR ", ") AS nama_barang,
            GROUP_CONCAT(pdetail_terima.qty SEPARATOR ", ") AS qty,
            GROUP_CONCAT(pdetail_terima.satuan SEPARATOR ", ") AS satuan,
            GROUP_CONCAT(pdetail_terima.harga SEPARATOR ", ") AS harga,
            GROUP_CONCAT(pdetail_terima.jumlah SEPARATOR ", ") AS jumlah,
        ');
        $builder->join('pdetail_terima', 'part_terima.id_penerimaan = pdetail_terima.id_penerimaan', 'left');

        // Group berdasarkan kolom unik
        $builder->groupBy('
            part_terima.no_repair_order,
            part_terima.id_penerimaan,  
            part_terima.no_rangka, 
            part_terima.jenis_mobil, 
            part_terima.nopol, 
            part_terima.asuransi,
            part_terima.nama_pemilik,
            part_terima.gudang,
        ');

        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getPdetailTerimaByPenerimaan($idPenerimaan)
    {
        $builder = $this->db->table('pdetail_terima');
        $builder->select('*'); // Ambil semua kolom dari pdetail_terima
        $builder->where('id_penerimaan', $idPenerimaan); // Filter berdasarkan id_penerimaan

        $query = $builder->get();
        return $query->getResultArray();
    }
}
