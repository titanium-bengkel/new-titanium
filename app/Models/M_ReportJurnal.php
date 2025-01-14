<?php

namespace App\Models;

use CodeIgniter\Model;

class M_ReportJurnal extends Model
{
    protected $table = 'report_jurnal';    // Nama tabel di database
    protected $primaryKey = 'id_report';   // Primary key dari tabel

    // Kolom yang diizinkan untuk diisi secara massal
    protected $allowedFields = [
        'date',
        'doc_no',
        'account',
        'name',
        'description',
        'debit',
        'kredit',
        'aksi',
        'user_id',
        'created_at',
        'updated_at'
    ];

    // Tipe data waktu otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function  noKwitansi()
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
    public function  getJB()
    {
        $builder = $this->db->table($this->table);
        $builder->select('doc_no');
        $builder->like('doc_no', 'JB.PC' . date('Ym'), 'after');
        $builder->orderBy('doc_no', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $result = $query->getRow();

        if ($result) {
            $last_id = $result->doc_no;
            $last_number = intval(substr($last_id, -3));
            $new_number = $last_number + 1;
            $new_id = 'JB.PC' . date('Ym') . str_pad($new_number, 3, '0', STR_PAD_LEFT);
        } else {
            $new_id = 'JB.PC' . date('Ym') . '001';
        }

        return $new_id;
    }
    public function generateOCB()
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
    // Metode untuk mengambil semua data
    public function getAllReports()
    {
        return $this->findAll();  // Ambil semua data dari tabel
    }

    // Metode untuk mendapatkan satu report berdasarkan id
    public function getReportById($id_report)
    {
        return $this->where('id_report', $id_report)->first();  // Ambil data berdasarkan id_report
    }

    // Metode untuk menyimpan data baru
    public function saveReport($data)
    {
        return $this->insert($data);  // Masukkan data baru ke dalam tabel
    }

    // Metode untuk memperbarui data
    public function updateReport($id_report, $data)
    {
        return $this->update($id_report, $data);  // Update data berdasarkan id_report
    }

    // Metode untuk menghapus data
    public function deleteReport($id_report)
    {
        return $this->delete($id_report);  // Hapus data berdasarkan id_report
    }
}
