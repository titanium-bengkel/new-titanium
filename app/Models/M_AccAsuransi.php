<?php

namespace App\Models;

use CodeIgniter\Model;

class M_AccAsuransi extends Model
{
    protected $table = 'acc_asuransi';
    protected $primaryKey = 'id_acc_asuransi';

    protected $allowedFields = [
        'id_acc_asuransi',
        'id_terima_po',
        'tgl_acc',
        'no_kendaraan',
        'jenis_mobil',
        'warna',
        'customer_name',
        'no_contact',
        'tahun_kendaraan',
        'asuransi',
        'tgl_masuk',
        'tgl_estimasi',
        'biaya_jasa',
        'biaya_sparepart',
        'biaya_total',
        'nilai_or',
        'qty_or',
        'keterangan',
        'file_lampiran',
        'user_id'
    ];

    public function updateAccAsuransi($id_acc_asuransi, $data)
    {
        return $this->update($id_acc_asuransi, $data);
    }


    public function generateId()
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_acc_asuransi');
        $builder->like('id_acc_asuransi', 'A' . date('Ym'), 'after');
        $builder->orderBy('id_acc_asuransi', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $result = $query->getRow();

        if ($result) {
            $last_id = $result->id_acc_asuransi;
            $last_number = intval(substr($last_id, -3));
            $new_number = $last_number + 1;
            $new_id = 'A' . date('Ym') . str_pad($new_number, 3, '0', STR_PAD_LEFT);
        } else {
            $new_id = 'A' . date('Ym') . '001';
        }

        return $new_id;
    }

    public function getAccAsuransiWithUser()
    {
        return $this->select('acc_asuransi.*, auth_user.username')
            ->join('auth_user', 'auth_user.id = acc_asuransi.user_id', 'left')
            ->findAll();
    }
    protected $useTimestamps = false; // Atur ke true jika Anda ingin menggunakan created_at dan updated_at

    // Menyediakan metode untuk mengambil data berdasarkan ID
    public function getAccAsuransi($id_acc_asuransi = null)
    {
        if ($id_acc_asuransi === null) {
            return $this->findAll(); // Mengambil semua data jika ID tidak diberikan
        }

        return $this->where(['id_acc_asuransi' => $id_acc_asuransi])->first(); // Mengambil data berdasarkan ID
    }

    // Menyediakan metode untuk menyimpan data baru
    public function saveAccAsuransi($data)
    {
        $builder = $this->db->table($this->table);
        if ($builder->insert($data)) {
            return true;
        } else {
            log_message('error', 'Database error: ' . $this->db->error());
            return false;
        }
    }


    // Menyediakan metode untuk menghapus data berdasarkan ID
    public function deleteAccAsuransi($id_acc_asuransi)
    {
        return $this->delete($id_acc_asuransi);
    }
}
