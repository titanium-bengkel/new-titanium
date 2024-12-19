<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Barang_Bahan extends Model
{
    protected $table      = 'barang_bahan';
    protected $primaryKey = 'id_bahan';
    
    protected $allowedFields = [
        'kode_bahan', 
        'nama_bahan',
        'kode_group',
        'kode_kategori', 
        'sat_b', 
        'isi_b', 
        'sat_t', 
        'isi_t', 
        'sat_k', 
        'isi_k', 
        'stok', 
        'harga_beli', 
        'harga_jualawal',
        'harga_jualbaru', 
        'nama_kategori', 
        'user_id',
        'stok_minimal',
        'stok_maksimal',
        'tanggal',
    ];


    public function getAllBarangWithDetails()
    {
        return $this->select('barang.*, baranggroup.kodegroup AS kode_group, baranggroup.namagroup AS namagroup, barangkategori.kode AS kode_kategori, barangkategori.nama AS nama_kategori, auth_user.username')
            ->join('baranggroup', 'barang.kode_group = baranggroup.kodegroup', 'left')
            ->join('barangkategori', 'barang.kode_kategori = barangkategori.kode', 'left')
            ->join('auth_user', 'barang.user_id = auth_user.id', 'left')
            ->findAll();
    }


    public function insertBarang($data)
    {
        return $this->insert($data);
    }

    public function updateBarang($id, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_barang', $id);
        $result = $builder->update($data);

        // Logging query for debugging
        log_message('debug', $this->db->getLastQuery());

        return $result;
    }
}
