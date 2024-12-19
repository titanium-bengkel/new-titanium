<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = [
        'kode', 'nama', 'kode_group', 'sat_B', 'isi_B', 'sat_T', 'isi_T',
        'sat_K', 'stok_minimal', 'stok_maksimal', 'harga_beli', 'harga_jual',
        'user_id', 'tgl', 'kode_kategori', 'nama_kategori', 'stok', 'tahun',
        'periode', 'upd', 'hargabeli_B', 'hargabeli_T', 'hargajual_B',
        'hargajual_T', 'aktif'
    ];
    protected $useTimestamps = false;
    protected $createdField  = 'tgl';
    protected $dateFormat    = 'datetime';


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
