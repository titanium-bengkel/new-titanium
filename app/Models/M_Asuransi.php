<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Asuransi extends Model
{
    protected $table = 'asuransi'; // Nama tabel dalam database untuk entitas asuransi
    protected $primaryKey = 'id_asuransi'; // Primary key dari tabel

    protected $allowedFields = [
        'id_asuransi', 'kode', 'nama_asuransi', 'status_member', 'kode_alokasi', 'kode_group',
        'alamat', 'kodepos', 'kota', 'telp', 'fax', 'no_hp_whatsapp', 'email', 'contact_person',
        'discount', 'npwp', 'plafond', 'max_bill', 'customer_pos', 'kode_gudang',
        'status', 'keterangan', 'user_id'
    ]; // Kolom-kolom yang diperbolehkan untuk diisi

    public function getAsuransiWithUser()
    {
        return $this->select('asuransi.*, auth_user.username')
            ->join('auth_user', 'auth_user.id = asuransi.user_id', 'left')
            ->findAll();
    }

    public function getAsuransiWithUsername()
    {
        return $this->select('asuransi.id_asuransi, asuransi.kode, asuransi.nama_asuransi, asuransi.status_member, asuransi.kode_alokasi, 
                             asuransi.kode_group, asuransi.alamat, asuransi.kodepos, asuransi.kota, asuransi.telp, asuransi.fax, asuransi.no_hp_whatsapp, 
                             asuransi.email, asuransi.contact_person, asuransi.discount, asuransi.npwp, asuransi.plafond, asuransi.max_bill, 
                             asuransi.customer_pos, asuransi.kode_gudang, asuransi.status, asuransi.keterangan, auth_user.username')
            ->join('auth_user', 'auth_user.id = asuransi.user_id')
            ->findAll();
    }

    public function getAsuransi($id = false)
    {
        if ($id === false) {
            return $this->select('asuransi.id_asuransi, asuransi.kode, asuransi.nama_asuransi, asuransi.status_member, asuransi.kode_alokasi, 
                                  asuransi.kode_group, asuransi.alamat, asuransi.kodepos, asuransi.kota, asuransi.telp, asuransi.fax, asuransi.no_hp_whatsapp, 
                                  asuransi.email, asuransi.contact_person, asuransi.discount, asuransi.npwp, asuransi.plafond, asuransi.max_bill, 
                                  asuransi.customer_pos, asuransi.kode_gudang, asuransi.status, asuransi.keterangan, auth_user.username')
                ->join('auth_user', 'auth_user.id = asuransi.user_id')
                ->findAll();
        } else {
            return $this->select('asuransi.id_asuransi, asuransi.kode, asuransi.nama_asuransi, asuransi.status_member, asuransi.kode_alokasi, 
                                  asuransi.kode_group, asuransi.alamat, asuransi.kodepos, asuransi.kota, asuransi.telp, asuransi.fax, asuransi.no_hp_whatsapp, 
                                  asuransi.email, asuransi.contact_person, asuransi.discount, asuransi.npwp, asuransi.plafond, asuransi.max_bill, 
                                  asuransi.customer_pos, asuransi.kode_gudang, asuransi.status, asuransi.keterangan, auth_user.username')
                ->join('auth_user', 'auth_user.id = asuransi.user_id')
                ->where('asuransi.id_asuransi', $id)
                ->first();
        }
    }

    public function insertAsuransi($data)
    {
        return $this->insert($data);
    }

    public function updateAsuransi($id, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_asuransi', $id);
        $result = $builder->update($data);

        // Logging query for debugging
        log_message('debug', $this->db->getLastQuery());

        return $result;
    }
}
