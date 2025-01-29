<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Detail_Terima extends Model
{
    protected $table      = 'detail_terima';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'id_kode_barang',
        'nama_barang',
        'qty',
        'satuan',
        'harga',
        'disc',
        'jumlah',
        'no_po',
        'po_id',
        'ceklis',
        'id_penerimaan',
        'kategori',
        'created_at'
    ];

    public function getAllDetails($no_po)
    {

        $details = $this->select('detail_terima.id_kode_barang as kode_barang, detail_terima.nama_barang, detail_terima.qty, detail_terima.satuan, detail_terima.harga, detail_terima.disc, detail_terima.jumlah, detail_terima.no_po, detail_terima.po_id, detail_terima.ceklis, detail_terima.id_penerimaan, pdetail_terima.no_po')
            ->join('pdetail_terima', 'pdetail_terima.no_po = detail_terima.no_po', 'left')
            ->where('detail_terima.no_po', $no_po)
            ->findAll();

        return $details;
    }



    public function calculateTotals($qty, $harga, $disc, $ppn_option)
    {
        $jumlah = array_map(function ($qty, $harga, $disc) {
            return $qty * $harga * (1 - $disc / 100);
        }, $qty, $harga, $disc);

        $total_qty = array_sum($qty);
        $total_jumlah = array_sum($jumlah);

        $nilai_ppn = 0;
        $netto = $total_jumlah;

        if ($ppn_option == 'PPN') {
            $nilai_ppn = 0.11 * $total_jumlah; // PPN 11%
            $netto += $nilai_ppn;
        }

        return [
            'jumlah' => $jumlah, // Menambahkan array jumlah
            'total_qty' => $total_qty,
            'total_jumlah' => $total_jumlah,
            'nilai_ppn' => $nilai_ppn,
            'netto' => $netto,
        ];
    }

    public function deleteByKodeBarang($id)
    {
        return $this->where('id', $id)->delete();
    }

    // Fungsi untuk mendapatkan id_penerimaan berdasarkan id
    public function getIdPenerimaanByKodeBarang($id)
    {
        return $this->where('id', $id)->first()['id_penerimaan'];
    }

    public function getDetailBarangByPoBahan($id_po_bahan)
    {
        return $this->db->table('detail_barang')
            ->where('id_po_bahan', $id_po_bahan)
            ->get()
            ->getResultArray();
    }
}
