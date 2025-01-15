<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Po extends Model
{
    protected $table = 'po';
    protected $primaryKey = 'id_po';
    protected $allowedFields = [
        'id_po',
        'id_terima_po',
        'tgl_klaim',
        'tgl_acc',
        'jam_klaim',
        'status',
        'progres',
        'user_id',
        'harga_estimasi',
        'harga_acc',
        'no_kendaraan',
        'jenis_mobil',
        'warna',
        'no_polis',
        'no_rangka',
        'tahun_kendaraan',
        'panel',
        'tingkat',
        'no_contact',
        'customer_name',
        'alamat',
        'kota',
        'asuransi',
        'keterangan',
        'biaya_pengerjaan',
        'biaya_sparepart',
        'total_biaya',
        'bengkel',
        'is_sent'
    ];

    public function updateSentStatus($id_terima_po)
    {
        $data = ['is_sent' => 1]; // Menandai sebagai sudah dikirim
        return $this->update(['id_terima_po' => $id_terima_po], $data);
    }

    public function getFilteredDataSparepartNotSent($id_terima_po = null)
    {
        $builder = $this->db->table('po')
            ->select('po.*, auth_user.username, sparepart_po.jenis_part')
            ->join('auth_user', 'auth_user.id = po.user_id', 'left')
            ->join('sparepart_po', 'sparepart_po.id_terima_po = po.id_terima_po', 'left') // Join dengan sparepart_po
            ->where('po.is_sent', 0);

        // Jika id_terima_po diberikan, tambahkan kondisi where
        if (!empty($id_terima_po)) {
            $builder->where('po.id_terima_po', $id_terima_po);
        }

        return $builder->get()->getResultArray();
    }
    public function getFilteredDataSparepartNotSentSupply($id_terima_po = null)
    {
        $builder = $this->db->table('po')
            ->select('po.*, auth_user.username, sparepart_po.jenis_part')
            ->join('auth_user', 'auth_user.id = po.user_id', 'left')
            ->join('sparepart_po', 'sparepart_po.id_terima_po = po.id_terima_po', 'left');

        if (!empty($id_terima_po)) {
            $builder->where('po.id_terima_po', $id_terima_po);
        }

        return $builder->get()->getResultArray();
    }

    public function updateData($id_terima_po, $data)
    {
        if (empty($id_terima_po) || empty($data)) {
            log_message('error', 'ID Terima PO atau data untuk update tidak valid.');
            return false;
        }

        $builder = $this->db->table($this->table);
        $builder->where('id_terima_po', $id_terima_po);
        if ($builder->update($data)) {
            return true;
        } else {
            log_message('error', 'Gagal memperbarui data PO dengan ID Terima PO: ' . $id_terima_po);
            log_message('error', 'Query terakhir: ' . $this->getLastQuery());
            return false;
        }
    }
    public function saveAccAsuransi($data)
    {
        if ($this->insert($data)) {
            return true;
        } else {
            log_message('error', 'Gagal menyimpan data asuransi: ' . $this->getLastQuery());
            return false;
        }
    }

    public function getFilteredData($search = null, $sa = null, $date = null, $month = null, $year = null)
    {
        $builder = $this->builder();

        if ($search) {
            $builder->like('customer_name', $search);
        }

        if ($sa) {
            $builder->like('sa', $sa);
        }

        if ($date) {
            $builder->where('tgl_klaim', $date);
        }

        if ($month && $year) {
            $builder->where('MONTH(tgl_klaim)', $month);
            $builder->where('YEAR(tgl_klaim)', $year);
        }

        $query = $builder->get();

        return $query->getResult();
    }

    public function generateIdTerimaPo()
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_terima_po');
        $builder->like('id_terima_po', 'T' . date('Ym'), 'after');
        $builder->orderBy('id_terima_po', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $result = $query->getRow();

        if ($result) {
            $last_id = $result->id_terima_po;
            $last_number = intval(substr($last_id, -3));
            $new_number = $last_number + 1;
            $new_id = 'T' . date('Ym') . str_pad($new_number, 3, '0', STR_PAD_LEFT);
        } else {
            $new_id = 'T' . date('Ym') . '001';
        }

        return $new_id;
    }


    public function generateIdPo()
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_po');
        $builder->like('id_po', 'PO' . date('Ym'), 'after');
        $builder->orderBy('id_po', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $result = $query->getRow();

        if ($result) {
            $last_id = $result->id_po;
            $last_number = intval(substr($last_id, -3));
            $new_number = $last_number + 1;
            $new_id = 'PO' . date('Ym') . str_pad($new_number, 3, '0', STR_PAD_LEFT);
        } else {
            $new_id = 'PO' . date('Ym') . '001';
        }

        return $new_id;
    }

    public function createPo($data)
    {
        if (empty($data['tgl_klaim'])) {
            $data['tgl_klaim'] = date('Y-m-d');
        }

        if ($this->insert($data) === false) {
            return false;
        }

        return true;
    }

    public function getPoById($id_terima_po)
    {
        return $this->where('id_terima_po', $id_terima_po)->first();  // Mengambil data berdasarkan id_terima_po
    }

    public function getPoData($id_terima_po)
    {
        return $this->where('id_terima_po', $id_terima_po)->first();
    }

    public function updatePo($id, $data)
    {
        return $this->update($id, $data);
    }

    public function getPoWithUsername()
    {
        $builder = $this->db->table($this->table);
        $builder->select('po.*, auth_user.username');
        $builder->join('auth_user', 'po.user_id = auth_user.id', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getPoWithAsuransi()
    {
        $builder = $this->db->table($this->table);
        $builder->select('po.*, asuransi.kode, asuransi.nama_asuransi');
        $builder->join('asuransi', 'po.asuransi = asuransi.id_asuransi', 'left');
        $query = $builder->get();
        return $query->getResult();
    }


    public function getAllAsuransi()
    {
        $builder = $this->db->table('asuransi');
        $builder->select('kode, nama_asuransi');
        $query = $builder->get();
        return $query->getResult();
    }
    public function getHargaEstimasi($id_terima_po)
    {
        $builder = $this->db->table('po');
        $builder->select('total_biaya');
        $builder->where('id_terima_po', $id_terima_po);
        $query = $builder->get();
        return $query->getRow();
    }
    public function getPoWithAccAsuransi()
    {
        return $this->select('po.*, acc_asuransi.tgl_acc, acc_asuransi.biaya_total as harga_acc')
            ->join('acc_asuransi', 'po.id_terima_po = acc_asuransi.id_terima_po', 'left')
            ->findAll();
    }


    private function saveRelatedData($data)
    {
        $kendaraanModel = new \App\Models\M_Kendaraan();
        $jenisMobilModel = new \App\Models\M_JenisMobil();
        $warnaModel = new \App\Models\M_Warna();

        if (isset($data['no_kendaraan'])) {
            $kendaraanModel->insertKendaraan([
                'no_kendaraan' => $data['no_kendaraan'],
                'customer' => $data['customer_name'],
                'no_contact' => $data['no_contact']
            ]);
        }

        if (isset($data['jenis_mobil'])) {
            $jenisMobilModel->insertJenisMobil([
                'kode' => $data['jenis_mobil'],
                'jenis_mobil' => $data['jenis_mobil']
            ]);
        }

        if (isset($data['warna'])) {
            $warnaModel->insertWarna([
                'kode' => $data['warna'],
                'warna' => $data['warna']
            ]);
        }
    }


    public function getAllPo()
    {
        return $this->db->table('po')->get()->getResult();
    }

    public function getDataWithJoin($startDate = null, $endDate = null)
    {
        // Jika tidak ada tanggal, gunakan default per bulan ini
        if (!$startDate || !$endDate) {
            $startDate = date('Y-m-01'); // Tanggal awal bulan ini
            $endDate = date('Y-m-t');   // Tanggal akhir bulan ini
        }

        $db = \Config\Database::connect();
        $builder = $db->table('po');

        // Pilih kolom yang diperlukan dari tabel po dan gambar_po
        $builder->select('po.id_terima_po, po.jenis_mobil, po.no_kendaraan, po.asuransi, po.keterangan, gambar_po.created_at, gambar_po.deskripsi, gambar_po.gambar');

        // Gabungkan tabel gambar_po dengan po berdasarkan id_terima_po
        $builder->join('gambar_po', 'po.id_terima_po = gambar_po.id_terima_po');

        // Tambahkan filter untuk hanya mengambil data dengan keterangan yang berisi 'sebelum'
        $builder->like('gambar_po.keterangan', 'sebelum');

        // Filter berdasarkan created_at
        $builder->where('gambar_po.created_at >=', $startDate);
        $builder->where('gambar_po.created_at <=', $endDate);

        $query = $builder->get();
        return $query->getResultArray(); // Mengembalikan hasil sebagai array
    }


    public function countBengkelTitanium()
    {
        return $this->where('bengkel', 'TITANIUM')
            ->where('is_sent', 0)
            ->countAllResults();
    }


    public function asuransistatus()
    {
        return $this->where('asuransi !=', 'UMUM/PRIBADI')
            ->where('status !=', 'Repair Order')
            ->countAllResults();
    }

    public function umumstatus()
    {
        return $this->where('asuransi', 'UMUM/PRIBADI')
            ->where('status !=', 'Repair Order')
            ->countAllResults();
    }
}
