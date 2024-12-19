<?php

namespace App\Controllers;

use App\Models\M_Po;
use App\Models\M_Kendaraan;
use App\Models\M_JenisMobil;
use App\Models\M_Warna;
use App\Models\M_PengerjaanPo;
use App\Models\M_Pengerjaan;
use App\Models\M_SparepartPo;
use App\Models\M_GambarPo;
use App\Models\M_Part_Terima;
use App\Models\M_Pdetail_Terima;
use App\Models\M_Barang_Sparepart;
use App\Models\M_RepairOrder;
use App\Models\M_AccAsuransi;


class CetakController extends BaseController
{
    public function cetakEstimasi($id_terima_po)
    {
        // Load models
        $poModel = new M_Po();
        $kendaraanModel = new M_Kendaraan();
        $jenisMobilModel = new M_JenisMobil();
        $warnaModel = new M_Warna();
        $pengerjaanModel = new M_PengerjaanPo();
        $sparepartsModel = new M_SparepartPo();
        $gambarModel = new M_GambarPo();

        // Ambil data PO berdasarkan ID
        $poData = $poModel->where('id_terima_po', $id_terima_po)->first();

        if (!$poData) {
            return redirect()->to('/')->with('error', 'Data PO tidak ditemukan');
        }

        // Ambil data terkait berdasarkan ID PO
        $pengerjaanList = $pengerjaanModel->getPengerjaanByIdTerimaPo($id_terima_po);
        $asuransiData = $poModel->getAllAsuransi();
        $kendaraanData = $kendaraanModel->findAll();
        $jenisMobilData = $jenisMobilModel->findAll();
        $warnaData = $warnaModel->findAll();
        $pengerjaan = $pengerjaanModel->getAllPengerjaan();
        $spareparts = $sparepartsModel->getAllSparepartPo();
        $daftarPengerjaan = $pengerjaanModel->getPengerjaanByIdTerimaPo($id_terima_po);
        $daftarSparepart = $sparepartsModel->getSparepartByIdTerimaPo($id_terima_po);
        $gambarData = $gambarModel->getGambarByIdTerimaPo($id_terima_po);
        $hargaEstimasi = $poModel->getHargaEstimasi($id_terima_po);

        // Hitung Total Harga
        $totalHargaJasa = array_sum(array_column($daftarPengerjaan, 'harga'));
        $totalHargaSparepart = array_sum(array_column($daftarSparepart, 'harga'));

        $data = [
            'title' => 'Estimasi Perbaikan Kendaraan',
            'po' => $poData,
            'asuransi' => $asuransiData,
            'kendaraan' => $kendaraanData,
            'jenis_mobil' => $jenisMobilData,
            'warna' => $warnaData,
            'id_terima_po' => $id_terima_po,
            'pengerjaanList' => $pengerjaanList,
            'pengerjaan' => $pengerjaan,
            'spareparts' => $spareparts,
            'daftarPengerjaan' => $daftarPengerjaan,
            'daftarSparepart' => $daftarSparepart,
            'gambarData' => $gambarData,
            'hargaEstimasi' => $hargaEstimasi ? $hargaEstimasi->total_biaya : 0,
            'totalHargaJasa' => $totalHargaJasa,
            'totalHargaSparepart' => $totalHargaSparepart
        ];

        return view('cetak/est_perbaikan', $data);
    }

    public function cetakPKB($id_terima_po)
    {
        $pengerjaanModel = new M_PengerjaanPo();
        $sparepartModel = new M_SparepartPo();
        $addpengerjaan = new M_Pengerjaan();
        $newpart = new M_Part_Terima();
        $newsparepart = new M_Pdetail_Terima();
        $addsparepart = new M_Barang_Sparepart();
        $gambarModel = new M_GambarPo();
        $dataPO = new M_RepairOrder();
        $accAsuransiModel = new M_AccAsuransi(); // Tambahkan model ini

        // Ambil data Repair Order berdasarkan id_terima_po
        if ($id_terima_po) {
            $po = $dataPO->where('id_terima_po', $id_terima_po)->first();

            // Jika tidak ada data Repair Order, kembalikan dengan pesan error
            if (!$po) {
                return redirect()->back()->with('error', 'Data Repair Order tidak ditemukan untuk ID terima PO: ' . $id_terima_po);
            }

            // Ambil data pengerjaan dan gambar berdasarkan id_terima_po
            $pengerjaan = $pengerjaanModel->where('id_terima_po', $id_terima_po)->findAll();
            $gambar = $gambarModel->where('id_terima_po', $id_terima_po)->findAll();

            // Ambil semua id_penerimaan dari M_Part_Terima berdasarkan id_terima_po
            $partsTerima = $newpart->where('no_repair_order', $id_terima_po)->findAll();

            // Ambil data sparepart dari M_Pdetail_Terima berdasarkan id_penerimaan yang ditemukan
            $daftarSparepart = [];
            foreach ($partsTerima as $part) {
                $id_penerimaan = $part['id_penerimaan'];
                $spareparts = $newsparepart->where('id_penerimaan', $id_penerimaan)->findAll();
                $daftarSparepart = array_merge($daftarSparepart, $spareparts);
            }

            // Ambil harga_acc dari M_AccAsuransi berdasarkan id_terima_po
            $accAsuransi = $accAsuransiModel->where('id_terima_po', $id_terima_po)->first();
            $hargaAcc = $accAsuransi['harga_acc'] ?? null; // Pastikan data harga_acc tersedia
        } else {
            $po = $dataPO->findAll();
            $pengerjaan = $pengerjaanModel->findAll();
            $gambar = $gambarModel->findAll();
            $daftarSparepart = $sparepartModel->findAll();
            $hargaAcc = null; // Jika tidak ada id_terima_po
        }

        $partPesanan = $sparepartModel->getSparepartRepair($id_terima_po);

        // Siapkan data untuk tampilan
        $data = [
            'ro' => $po,
            'pengerjaan' => $pengerjaan,
            'addpengerjaan' => $addpengerjaan->findAll(),
            'daftarSparepart' => $daftarSparepart,
            'sparepartPesanan' => $partPesanan,
            'addsparepart' => $addsparepart->findAll(),
            'gambarData' => $gambar,
            'id_terima_po' => $id_terima_po,
            'harga_acc' => $hargaAcc, // Tambahkan harga_acc ke array data
            'is_sent' => $po['is_sent'] ?? 0 // Tambahkan is_sent untuk digunakan di tampilan
        ];

        return view('cetak/pkb', $data);
    }
}
