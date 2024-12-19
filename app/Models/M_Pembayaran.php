<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $allowedFields = [
        'id_pembayaran',
        'tanggal',
        'keterangan',
        'total_kredit',
        'total_debet',
        'selisih'
    ];

    public function generatePembayaran()
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_pembayaran');
        $builder->like('id_pembayaran', 'P' . date('Ym'), 'after');
        $builder->orderBy('id_pembayaran', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $result = $query->getRow();

        if ($result) {
            $last_id = $result->id_pembayaran;
            $last_number = intval(substr($last_id, -3));
            $new_number = $last_number + 1;
            $new_id = 'P' . date('Ym') . str_pad($new_number, 3, '0', STR_PAD_LEFT);
        } else {
            $new_id = 'P' . date('Ym') . '001';
        }

        return $new_id;
    }
    public function getPembayaranWithInvoice()
    {
        return $this->select('pembayaran.id_pembayaran, pembayaran.tanggal, pembayaran.keterangan, pembayaran.total_kredit, pembayaran.total_debet, pembayaran.selisih, invoice.no_invoice, invoice.keterangan_invoice, invoice.asuransi, invoice.jasa, invoice.sparepart')
            ->join('invoice', 'pembayaran.id_pembayaran = invoice.id_pembayaran', 'left') // Sesuaikan hubungan antar kolom
            ->findAll();
    }
}
