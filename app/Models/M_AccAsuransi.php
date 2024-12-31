<?php

namespace App\Models;

use CodeIgniter\Model;

class M_AccAsuransi extends Model
{
    public function getRepairOrderDetails()
    {
        return $this->db->table('repair_order')
            ->select(
                'repair_order.*, 
                      jasa.total AS jasa_total, 
                      sparepart.total_hpp AS sparepart_total, 
                      bahan.total_hpp AS bahan_total, 
                      kwitansi.nomor AS no_faktur, 
                      kwitansi.tanggal AS tgl_faktur,
                      detail_jasa.nama_jasa, 
                      detail_jasa.harga, 
                      detail_jasa.keterangan,
                      asuransi.no_kendaraan, 
                      asuransi.customer_name, 
                      asuransi.asuransi, 
                      asuransi.biaya_total'  // You can add more columns from acc_asuransi if needed
            )
            ->join('rm_jasa jasa', 'jasa.no_ro = repair_order.id_terima_po', 'left')
            ->join('part_repair sparepart', 'sparepart.no_repair = repair_order.id_terima_po', 'left')
            ->join('bahan_repair bahan', 'bahan.no_repair = repair_order.id_terima_po', 'left')
            ->join('kwitansi kwitansi', 'kwitansi.no_order = repair_order.id_terima_po', 'left')
            ->join('rm_detail_jasa detail_jasa', 'detail_jasa.id_jasa = jasa.id_jasa', 'left')
            ->join('acc_asuransi asuransi', 'asuransi.id_terima_po = repair_order.id_terima_po', 'left') // Added join on acc_asuransi
            ->orderBy('repair_order.id_terima_po', 'DESC')
            ->get()
            ->getResultArray();
    }


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
