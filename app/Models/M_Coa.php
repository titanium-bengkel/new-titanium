<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Coa extends Model
{
    protected $table = 'coa';
    protected $primaryKey = 'id_coa';

    protected $allowedFields = [
        'kode',
        'nama_account',
        'level',
        'kode_head',
        'kelompok',
        'posisi',
        'keterangan',
        'user_id',
        'transaksi'
    ];

    public function getSpecificCoa()
    {
        return $this->whereIn('nama_account', ['REK BCA', 'PIUTANG USAHA', 'KAS BESAR', 'BEBAN DIBAYAR DIMUKA'])->findAll();
    }
    public function getCoaBahan()
    {
        return $this->whereIn('nama_account', ['REK BCA', 'KAS KECIL'])->findAll();
    }
    public function getCoaKeuangan()
    {
        return $this->findAll(); // Mengembalikan semua data dari tabel coa
    }
    protected $useTimestamps = true; // jika Anda memiliki field created_at dan updated_at

    // Method untuk mendapatkan data coa dengan username dari tabel auth_user
    public function getCoaWithUsername()
    {
        return $this->select('coa.id_coa, coa.kode, coa.nama_account, coa.level, coa.kode_head, coa.kelompok, coa.posisi, coa.keterangan, coa.transaksi, auth_user.username')
            ->join('auth_user', 'auth_user.id = coa.user_id')
            ->findAll();
    }

    // Method untuk mendapatkan data coa berdasarkan id (opsional)
    public function getCoa($id = false)
    {
        if ($id === false) {
            return $this->select('coa.id_coa, coa.kode, coa.nama_account, coa.level, coa.kode_head, coa.kelompok, coa.posisi, coa.keterangan, coa.transaksi, auth_user.username')
                ->join('auth_user', 'auth_user.id = coa.user_id')
                ->findAll();
        } else {
            return $this->select('coa.id_coa, coa.kode, coa.nama_account, coa.level, coa.kode_head, coa.kelompok, coa.posisi, coa.keterangan, coa.transaksi, auth_user.username')
                ->join('auth_user', 'auth_user.id = coa.user_id')
                ->where('coa.id_coa', $id)
                ->first();
        }
    }

    // Method untuk menambahkan data coa baru
    public function insertCoa($data)
    {
        return $this->db->table('coa')->insert($data);
    }

    // Method untuk memperbarui data coa
    public function updateCoa($id, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_coa', $id);
        $result = $builder->update($data);

        // Logging query untuk debugging
        log_message('debug', $this->db->getLastQuery());

        return $result;
    }

    // Method untuk menghapus data coa
    public function deleteCoa($id)
    {
        return $this->where('id_coa', $id)->delete();
    }
}
