<?php

namespace App\Models;

use CodeIgniter\Model;

class M_K_Pembayaran extends Model
{
    protected $table = 'k_pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $allowedFields = [
        'id_pembayaran',
        'no_faktur',
        'tanggal',
        'kode_supplier',
        'supplier',
        'kode_bayar',
        'jatuh_tempo',
        'keterangan',
        'jumlah',
        'discount_nilai',
        'subtotal',
        'ppn_persen',
        'ppn_value',
        'netto',
        'kredit',
        'debit',
        'saldo',
        'user_id',
        'created_at',
        'updated_at'
    ];

    // Gunakan auto-timestamps untuk otomatis mengisi created_at dan updated_at
    protected $useTimestamps = true;

    // Format waktu yang digunakan
    protected $dateFormat = 'datetime';

    // Nama kolom timestamps
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function generateId()
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_pembayaran');
        $builder->like('id_pembayaran', 'PH' . date('Ym'), 'after');
        $builder->orderBy('id_pembayaran', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $result = $query->getRow();

        if ($result) {
            $last_id = $result->id_pembayaran;
            $last_number = intval(substr($last_id, -3));
            $new_number = $last_number + 1;
            $new_id = 'PH' . date('Ym') . str_pad($new_number, 3, '0', STR_PAD_LEFT);
        } else {
            $new_id = 'PH' . date('Ym') . '001';
        }

        return $new_id;
    }
    /**
     * Ambil semua data pembayaran.
     * @return array
     */
    public function getAllPembayaran()
    {
        return $this->findAll();
    }

    /**
     * Ambil data pembayaran berdasarkan ID.
     * @param int $id
     * @return array
     */
    public function getPembayaranById($id_pembayaran)
    {
        return $this->where('id_pembayaran', $id_pembayaran)->first();
    }


    /**
     * Tambah data pembayaran baru.
     * @param array $data
     * @return bool
     */
    public function insertPembayaran($data)
    {
        return $this->insert($data);
    }

    /**
     * Update data pembayaran berdasarkan ID.
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updatePembayaran($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Hapus data pembayaran berdasarkan ID.
     * @param int $id
     * @return bool
     */
    public function deletePembayaran($id)
    {
        return $this->delete($id);
    }
}
