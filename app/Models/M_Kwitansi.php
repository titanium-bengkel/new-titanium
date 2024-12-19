<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Kwitansi extends Model
{
    protected $table      = 'kwitansi';
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
        'jenis_bayar',
        'tanggal_masuk',
        'tanggal_selesai',
        'keterangan',
        'tanggal_kirim_kwitansi',
        'user_id',
        'nilai_bayar',
        'nilai_tagihan',
        'nilai_or',
        'qty_or',
        'jatuh_tempo',
        'pemb_asuransi',
        'pemb_or'
    ];


    public function  generateNomor()
    {
        $builder = $this->db->table($this->table);
        $builder->select('nomor');
        $builder->like('nomor', 'STK' . date('Ym'), 'after');
        $builder->orderBy('nomor', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $result = $query->getRow();

        if ($result) {
            $last_id = $result->nomor;
            $last_number = intval(substr($last_id, -3));
            $new_number = $last_number + 1;
            $new_id = 'STK' . date('Ym') . str_pad($new_number, 3, '0', STR_PAD_LEFT);
        } else {
            $new_id = 'STK' . date('Ym') . '001';
        }

        return $new_id;
    }
    public function  generateNomorJurnal()
    {
        $builder = $this->db->table($this->table);
        $builder->select('nomor');
        $builder->like('nomor', 'JP.STK' . date('Ym'), 'after');
        $builder->orderBy('nomor', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $result = $query->getRow();

        if ($result) {
            $last_id = $result->nomor;
            $last_number = intval(substr($last_id, -3));
            $new_number = $last_number + 1;
            $new_id = 'JP.STK' . date('Ym') . str_pad($new_number, 3, '0', STR_PAD_LEFT);
        } else {
            $new_id = 'JP.STK' . date('Ym') . '001';
        }

        return $new_id;
    }
}
