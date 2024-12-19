<?php

namespace App\Models;

use CodeIgniter\Model;

class M_KasBank_Form extends Model
{
    protected $table = 'k_kasbank_form';
    protected $primaryKey = 'id_form';
    protected $allowedFields = [
        'doc_no',
        'tanggal',
        'account_debit',
        'account_credit',
        'keterangan',
        'debit',
        'kredit',
        'created_at',
        'updated_at',
        'user_id'
    ];

    // Tambahkan method jika perlu untuk mendapatkan relasi dengan k_kasbank
    public function getKasBank()
    {
        return $this->join('k_kasbank', 'k_kasbank.doc_no = k_kasbank_form.doc_no')
            ->select('k_kasbank.*')
            ->findAll();
    }
    public function generateDoc()
    {
        $builder = $this->db->table($this->table);
        $builder->select('doc_no');

        // Menggunakan format OCB/YYYY/MM/DD untuk pencarian
        $datePrefix = 'OCB/' . date('Y') . '/' . date('m') . '/' . date('d');
        $builder->like('doc_no', $datePrefix, 'after');
        $builder->orderBy('LENGTH(doc_no)', 'DESC'); // Mengurutkan berdasarkan panjang `doc_no` terlebih dahulu
        $builder->orderBy('doc_no', 'DESC'); // Lalu mengurutkan berdasarkan `doc_no` itu sendiri
        $builder->limit(1);

        $query = $builder->get();
        $result = $query->getRow();

        if ($result) {
            $last_id = $result->doc_no;
            $last_parts = explode('/', $last_id);

            // Pastikan elemen terakhir dari `last_parts` adalah angka dan mengonversinya ke integer
            $last_number = isset($last_parts[4]) ? intval($last_parts[4]) : 0;

            // Increment nomor terakhir dengan 1
            $new_number = $last_number + 1;
            $new_id = $datePrefix . '/' . $new_number;
        } else {
            // Jika tidak ada data, mulai dari 1
            $new_id = $datePrefix . '/1';
        }

        return $new_id;
    }
}
