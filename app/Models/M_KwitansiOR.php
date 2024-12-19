<?php

namespace App\Models;

use CodeIgniter\Model;

class M_KwitansiOR extends Model
{
    protected $table      = 'kwitansi_or';
    protected $primaryKey = 'nomor';

    protected $allowedFields = [
        'nomor',
        'tanggal',
        'no_order',
        'no_kendaraan',
        'jenis_mobil',
        'warna',
        'customer_name',
        'no_contact',
        'tahun_mobil',
        'asuransi',
        'jasa',
        'sparepart',
        'nilai_total',
        'nilai_or',
        'qty_or',
        'total_or',
        'jenis_bayar',
        'tanggal_masuk',
        'tanggal_selesai',
        'keterangan',
        'tanggal_kirim_kwitansi',
        'user_id',
        'nilai_bayar',
        'nilai_tagihan'
    ];


    public function generateNomor()
    {
        $builder = $this->db->table($this->table);
        $builder->select('nomor');
        $builder->like('nomor', 'STKO' . date('Ym'), 'after');
        $builder->orderBy('nomor', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $result = $query->getRow();

        if ($result) {
            $last_id = $result->nomor;
            $last_number = intval(substr($last_id, -3));
            $new_number = $last_number + 1;
            $new_id = 'STKO' . date('Ym') . str_pad($new_number, 3, '0', STR_PAD_LEFT);
        } else {
            $new_id = 'STKO' . date('Ym') . '001';
        }

        return $new_id;
    }
    public function updateStatusBayar($no_order, $data)
    {
        return $this->where('no_order', $no_order)->set($data)->update();
    }
}
