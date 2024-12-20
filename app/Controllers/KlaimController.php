<?php

namespace App\Controllers;

use App\Models\M_Barang_Sparepart;
use App\Models\M_Pdetail_Terima;
use App\Models\M_Po;
use App\Models\M_Kendaraan;
use App\Models\M_JenisMobil;
use App\Models\M_Warna;
use App\Models\M_PengerjaanPo;
use App\Models\M_Pengerjaan;
use App\Models\M_SparepartPo;
use App\Models\M_GambarPo;
use App\Models\M_AccAsuransi;
use App\Models\M_RepairOrder;
use App\Models\M_Kwitansi;
use App\Models\M_KwitansiOR;
use App\Models\M_Piutang;
use App\Models\M_Pembayaran;
use App\Models\M_PembayaranInvoice;
use App\Models\M_Invoice;
use App\Models\M_ReportJurnal;
use App\Models\M_Coa;
use App\Models\M_Part_Terima;
use App\Models\UserModel;

class KlaimController extends BaseController
{

    public function preorder()
    {
        // Membuat instance model M_Po
        $poM = new M_Po();

        // Mengambil data PO dengan urutan menurun berdasarkan created_at
        $poData = $poM->orderBy('tgl_klaim', 'DESC')->findAll();

        // Menyiapkan data untuk dikirim ke view
        $data = [
            'title' => 'Pre-Order',
            'po' => $poData
        ];

        // Mengirim data ke view klaim/preorder
        return view('klaim/preorder', $data);
    }



    public function input_order($id_terima_po = null)
    {
        $poModel = new M_Po();
        $kendaraanModel = new M_Kendaraan();
        $jenisMobilModel = new M_JenisMobil();
        $warnaModel = new M_Warna();
        $pengerjaanModel = new M_PengerjaanPo();

        // Generate new IDs
        $preOrderId = $poModel->generateIdTerimaPo();
        $newPoId = $poModel->generateIdPo();

        // If $id_terima_po is provided, fetch the PO data
        $poData = null;
        if ($id_terima_po) {
            $poData = $poModel->where('id_terima_po', $id_terima_po)->first();
        }

        // Fetch data
        $asuransiData = $poModel->getAllAsuransi();
        $kendaraanData = $kendaraanModel->getAllKendaraan();
        $jenisMobilData = $jenisMobilModel->findAll();
        $warnaData = $warnaModel->findAll();
        $pengerjaanData = $pengerjaanModel->getAllPengerjaan();

        $data = [
            'title' => 'Pre-Order',
            'preOrderId' => $preOrderId,
            'idPo' => $newPoId,
            'asuransiData' => $asuransiData,
            'kendaraan' => $kendaraanData,
            'jenis_mobil' => $jenisMobilData,
            'warna' => $warnaData,
            'pengerjaan' => $pengerjaanData,
            'id_terima_po' => $id_terima_po,
            'poData' => $poData
        ];

        return view('klaim/order_pos', $data);
    }



    public function input_order_posprev($id_terima_po)
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

        // Ambil data pengerjaan berdasarkan id_terima_po
        $pengerjaanList = $pengerjaanModel->getPengerjaanByIdTerimaPo($id_terima_po);

        // Fetch related data
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

        // Pastikan status update untuk PO
        $isApproved = !empty($poData) && $poData['status'] === 'Acc Asuransi';

        $data = [
            'title' => 'Pre-Order',
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
            'isApproved' => $isApproved,
            'hargaEstimasi' => $hargaEstimasi ? $hargaEstimasi->total_biaya : 0
        ];

        return view('klaim/order_posprev', $data);
    }


    public function createPo()
    {
        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $poModel = new M_Po();
        $kendaraanModel = new M_Kendaraan();
        $jenisMobilModel = new M_JenisMobil();
        $warnaModel = new M_Warna();

        // Generate new IDs
        $newPoId = $poModel->generateIdPo();
        $newIdTerimaPo = $poModel->generateIdTerimaPo();

        // Ambil data dari form
        $progres = $this->request->getPost('progres');
        $bengkel = $this->request->getPost('bengkel'); // Ambil nilai bengkel dari form

        // Pastikan $progres dan $bengkel ada dan valid
        if (!$progres) {
            log_message('error', 'Progres tidak ditemukan dalam data POST.');
            return redirect()->back()->with('error', 'Progres tidak dipilih.');
        }

        if (!$bengkel) {
            log_message('error', 'Bengkel tidak ditemukan dalam data POST.');
            return redirect()->back()->with('error', 'Bengkel tidak dipilih.');
        }

        $data = [
            'id_po' => $newPoId,
            'id_terima_po' => $newIdTerimaPo,
            'no_kendaraan' => strtoupper($this->request->getPost('no-kendaraan')),
            'jenis_mobil' => strtoupper($this->request->getPost('jenis-mobil')),
            'warna' => strtoupper($this->request->getPost('warna')),
            'no_polis' => strtoupper($this->request->getPost('no-polis')),
            'no_rangka' => $this->request->getPost('no-rangka'),
            'tahun_kendaraan' => $this->request->getPost('tahun-kendaraan'),
            'panel' => $this->request->getPost('panel'),
            'no_contact' => $this->request->getPost('no-contact'),
            'customer_name' => strtoupper($this->request->getPost('customer-name')),
            'alamat' => strtoupper($this->request->getPost('alamat')),
            'kota' => strtoupper($this->request->getPost('kota')),
            'asuransi' => strtoupper($this->request->getPost('asuransi')),
            'tgl_klaim' => $this->request->getPost('tanggal_klaim'),
            'jam_klaim' => $this->request->getPost('jam_klaim'),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'status' => 'Pre-Order',
            'progres' => $progres,
            'bengkel' => $bengkel,
            'user_id' => $user_id
        ];

        // Debug data
        log_message('debug', 'Data yang dikirim ke database: ' . print_r($data, true));

        // Simpan data ke database
        // Cek dan masukkan ke tabel kendaraan, jenis_mobil, dan warna jika belum ada
        $no_kendaraan = $this->request->getPost('no-kendaraan');
        $customer_name = $this->request->getPost('customer-name');
        $no_contact = $this->request->getPost('no-contact');
        if (!$kendaraanModel->where('no_kendaraan', $no_kendaraan)->first()) {
            $kendaraanData = [
                'no_kendaraan' => $no_kendaraan,
                'customer_name' => $customer_name,
                'no_contact' => $no_contact
            ];
            $kendaraanModel->insert($kendaraanData);
        }

        $jenis_mobil = $this->request->getPost('jenis-mobil');
        if (!$jenisMobilModel->where('jenis_mobil', $jenis_mobil)->first()) {
            $jenisMobilModel->insert(['jenis_mobil' => $jenis_mobil]);
        }

        $warna = $this->request->getPost('warna');
        if (!$warnaModel->where('warna', $warna)->first()) {
            $warnaModel->insert(['warna' => $warna]);
        }

        // Simpan data PO
        if (!$poModel->createPo($data)) {
            $errors = $poModel->errors();
            log_message('error', 'Gagal menyimpan data PO: ' . print_r($errors, true));
            return redirect()->back()->with('error', 'Gagal menyimpan data PO.');
        }

        // Jika berhasil
        return redirect()->to(base_url('/order_posprev/' . $newIdTerimaPo))->with('success', 'Pre Order Berhasil Ditambahkan.');
    }


    public function updatePO($id_terima_po)
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $poModel = new M_Po();
        $kendaraanModel = new M_Kendaraan();
        $jenisMobilModel = new M_JenisMobil();
        $warnaModel = new M_Warna();
        $repairOrderModel = new M_RepairOrder();

        // Ambil data PO yang ingin di-update berdasarkan id_terima_po
        $existingPO = $poModel->where('id_terima_po', $id_terima_po)->first();
        if (!$existingPO) {
            return redirect()->to('klaim/preorder')->with('error', 'Data PO tidak ditemukan.');
        }

        // Ambil data dari form
        $status_order = $this->request->getPost('status_order');
        $no_kendaraan = $this->request->getPost('no_kendaraan');
        $bengkel = $this->request->getPost('bengkel');
        $progres = $this->request->getPost('progres');
        $harga_estimasi = $this->request->getPost('harga_estimasi');

        // Validasi input
        if (empty($no_kendaraan)) {
            log_message('error', 'no_kendaraan tidak diisi.');
            return redirect()->back()->with('error', 'No kendaraan harus diisi.');
        }

        if (!$status_order) {
            log_message('error', 'Status Order tidak ditemukan dalam data POST.');
            return redirect()->back()->with('error', 'Status Order tidak dipilih.');
        }

        // Hapus format angka dari harga_estimasi
        $harga_estimasi = str_replace(['.', ','], ['', '.'], $harga_estimasi);

        $data = [
            'no_kendaraan' => $no_kendaraan,
            'jenis_mobil' => strtoupper($this->request->getPost('jenis_mobil')),
            'warna' => strtoupper($this->request->getPost('warna')),
            'no_polis' => strtoupper($this->request->getPost('no_polis')),
            'no_rangka' => strtoupper($this->request->getPost('no_rangka')),
            'tahun_kendaraan' => $this->request->getPost('tahun_kendaraan'),
            'panel' => $this->request->getPost('panel'),
            'no_contact' => strtoupper($this->request->getPost('no_contact')),
            'customer_name' => strtoupper($this->request->getPost('customer_name')),
            'alamat' => strtoupper($this->request->getPost('alamat')),
            'kota' => strtoupper($this->request->getPost('kota')),
            'asuransi' => strtoupper($this->request->getPost('asuransi')),
            'tgl_klaim' => $this->request->getPost('tanggal_masuk'),
            'harga_estimasi' => $harga_estimasi,
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'status' => $status_order,
            'progres' => $progres,
            'bengkel' => $bengkel,
            'user_id' => $user_id
        ];

        // Debug data
        log_message('debug', 'Data yang dikirim ke database: ' . print_r($data, true));

        // Periksa dan masukkan ke tabel kendaraan jika belum ada
        if (!$kendaraanModel->where('no_kendaraan', $no_kendaraan)->first()) {
            $kendaraanData = [
                'no_kendaraan' => $no_kendaraan,
                'customer_name' => $this->request->getPost('customer_name'),
                'no_contact' => $this->request->getPost('no_contact')
            ];
            $kendaraanModel->insert($kendaraanData);
        }

        // Periksa dan masukkan ke tabel jenis_mobil jika belum ada
        $jenis_mobil = $this->request->getPost('jenis_mobil');
        if (!$jenisMobilModel->where('jenis_mobil', $jenis_mobil)->first()) {
            $jenisMobilModel->insert(['jenis_mobil' => $jenis_mobil]);
        }

        // Periksa dan masukkan ke tabel warna jika belum ada
        $warna = $this->request->getPost('warna');
        if (!$warnaModel->where('warna', $warna)->first()) {
            $warnaModel->insert(['warna' => $warna]);
        }

        // Update Pre Order
        $updateResult = $poModel->updateData($id_terima_po, $data);
        if (!$updateResult) {
            log_message('error', 'Gagal memperbarui Pre Order: ' . implode(', ', $poModel->errors()));
            return redirect()->back()->with('error', 'Gagal memperbarui Pre Order.');
        }

        // Pindahkan data ke tabel repair_order jika status diubah menjadi "Repair Order"
        if ($status_order === 'Repair Order') {
            // Ambil Pre Order yang sudah diperbarui
            $updatedPO = $poModel->where('id_terima_po', $id_terima_po)->first();

            // Data untuk tabel repair_order
            $repairOrderData = [
                'id_terima_po' => $id_terima_po,
                'tgl_klaim' => $updatedPO['tgl_klaim'],
                'tgl_acc' => $updatedPO['tgl_acc'],
                'tgl_masuk' => $updatedPO['tgl_klaim'],
                'no_kendaraan' => strtoupper($updatedPO['no_kendaraan']),
                'jenis_mobil' => strtoupper($updatedPO['jenis_mobil']),
                'warna' => strtoupper($updatedPO['warna']),
                'no_polis' => strtoupper($updatedPO['no_polis']),
                'no_rangka' => strtoupper($updatedPO['no_rangka']),
                'tahun_kendaraan' => $updatedPO['tahun_kendaraan'],
                'panel' => $updatedPO['panel'],
                'no_contact' => strtoupper($updatedPO['no_contact']),
                'customer_name' => strtoupper($updatedPO['customer_name']),
                'alamat' => strtoupper($updatedPO['alamat']),
                'kota' => strtoupper($updatedPO['kota']),
                'asuransi' => strtoupper($updatedPO['asuransi']),
                'keterangan' => strtoupper($updatedPO['keterangan']),
                'biaya_pengerjaan' => $updatedPO['biaya_pengerjaan'],
                'biaya_sparepart' => $updatedPO['biaya_sparepart'],
                'total_biaya' => $updatedPO['total_biaya'],
                'user_id' => $user_id,
                'harga_estimasi' => $updatedPO['harga_estimasi'],
                'harga_acc' => $updatedPO['harga_acc'],
                'bengkel' => strtoupper($bengkel)
            ];


            // Masukkan data ke repair_order
            $insertRepairOrder = $repairOrderModel->insert($repairOrderData);
            if (!$insertRepairOrder) {
                log_message('error', 'Gagal menyimpan data ke repair_order: ' . implode(', ', $repairOrderModel->errors()));
                return redirect()->back()->with('error', 'Gagal menyimpan data repair order.');
            }

            // Jika berhasil
            return redirect()->to('klaim/preorder')->with('success', 'Pre Order berhasil dipindahkan ke Repair Order.');
        }

        return redirect()->to('klaim/preorder')->with('success', 'Pre Order berhasil diperbarui.');
    }



    public function createPengerjaanPo()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan di session');
        }

        // Mengambil nilai id_terima_po dari form input
        $id_terima_po = $this->request->getPost('id_terima_po');
        if (!$id_terima_po) {
            return redirect()->back()->with('error', 'ID Terima PO tidak ditemukan.');
        }

        // Inisialisasi model M_Po dan M_PengerjaanPo
        $poModel = new M_Po();
        $pengerjaanPoModel = new M_PengerjaanPo();

        // Mengambil data PO berdasarkan id_terima_po
        $poData = $poModel->where('id_terima_po', $id_terima_po)->first();
        if (!$poData) {
            return redirect()->back()->with('error', 'Data PO tidak ditemukan.');
        }

        // Mengumpulkan data dari form
        $data = [
            'kode_pengerjaan' => $this->request->getPost('kodePengerjaan'),
            'nama_pengerjaan' => $this->request->getPost('pengerjaan'),
            'harga' => $this->request->getPost('harga'),
            'id_terima_po' => $id_terima_po
        ];

        // Debug data yang akan disimpan
        log_message('debug', 'Data yang akan disimpan ke tabel pengerjaan_po: ' . print_r($data, true));

        // Insert data ke dalam tabel pengerjaan_po
        try {
            $pengerjaanPoModel->insert($data);

            // Hitung total harga pengerjaan untuk id_terima_po ini
            $pengerjaanList = $pengerjaanPoModel->where('id_terima_po', $id_terima_po)->findAll();
            $totalHarga = array_reduce($pengerjaanList, function ($carry, $item) {
                return $carry + $item['harga'];
            }, 0);

            // Debug total harga
            log_message('debug', 'Total harga pengerjaan untuk id_terima_po ' . $id_terima_po . ': ' . $totalHarga);

            // Update total_harga di tabel pengerjaan_po
            $pengerjaanPoModel->where('id_terima_po', $id_terima_po)->set(['total_harga' => $totalHarga])->update();

            // Update biaya_pengerjaan di tabel po
            $poModel->where('id_terima_po', $id_terima_po)->set(['biaya_pengerjaan' => $totalHarga])->update();

            return redirect()->back()->with('success', 'Pengerjaan berhasil ditambahkan.');
        } catch (\Exception $e) {
            log_message('error', 'Error saat menyimpan data pengerjaan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    public function updatePengerjaanPo()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan di session');
        }

        // Mengambil nilai id_terima_po dan kode_pengerjaan dari form input
        $id_terima_po = $this->request->getPost('id_terima_po');
        $kode_pengerjaan = $this->request->getPost('kodePengerjaan');

        if (!$id_terima_po || !$kode_pengerjaan) {
            return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('error', 'ID Terima PO atau Kode Pengerjaan tidak ditemukan.');
        }

        // Inisialisasi model M_Po dan M_PengerjaanPo
        $poModel = new M_Po();
        $pengerjaanPoModel = new M_PengerjaanPo();

        // Mengambil data PO berdasarkan id_terima_po
        $poData = $poModel->where('id_terima_po', $id_terima_po)->first();
        if (!$poData) {
            return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('error', 'Data PO tidak ditemukan.');
        }

        // Mengumpulkan data yang akan diupdate dari form
        $data = [
            'nama_pengerjaan' => $this->request->getPost('pengerjaan'),
            'harga' => $this->request->getPost('harga'),
        ];

        // Debug data yang akan diupdate
        log_message('debug', 'Data yang akan diupdate di tabel pengerjaan_po: ' . print_r($data, true));

        // Update data di tabel pengerjaan_po
        try {
            $pengerjaanPoModel->where('id_terima_po', $id_terima_po)
                ->where('kode_pengerjaan', $kode_pengerjaan)
                ->set($data)
                ->update();

            // Hitung kembali total harga pengerjaan untuk id_terima_po ini
            $pengerjaanList = $pengerjaanPoModel->where('id_terima_po', $id_terima_po)->findAll();
            $totalHarga = array_reduce($pengerjaanList, function ($carry, $item) {
                return $carry + $item['harga'];
            }, 0);

            // Debug total harga
            log_message('debug', 'Total harga pengerjaan untuk id_terima_po ' . $id_terima_po . ': ' . $totalHarga);

            // Update total_harga di tabel pengerjaan_po
            $pengerjaanPoModel->where('id_terima_po', $id_terima_po)->set(['total_harga' => $totalHarga])->update();

            // Update biaya_pengerjaan di tabel po
            $poModel->where('id_terima_po', $id_terima_po)->set(['biaya_pengerjaan' => $totalHarga])->update();

            return redirect()->back()->with('success', 'Pengerjaan berhasil diperbarui.');
        } catch (\Exception $e) {
            log_message('error', 'Error saat mengupdate data pengerjaan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    public function getPengerjaanData($kode_pengerjaan)
    {
        $pengerjaanPoModel = new M_PengerjaanPo();
        $data = $pengerjaanPoModel->getPengerjaanByKode($kode_pengerjaan);

        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON(['error' => 'Data not found'], 404);
        }
    }


    public function deletePengerjaanPo($idPengerjaanPo = null)
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan di session');
        }

        if (!$idPengerjaanPo) {
            return redirect()->back()->with('error', 'ID Pengerjaan tidak ditemukan.');
        }

        // Inisialisasi model M_PengerjaanPo dan M_Po
        $pengerjaanPoModel = new M_PengerjaanPo();
        $poModel = new M_Po();

        // Mengambil data pengerjaan berdasarkan id_pengerjaan_po
        $pengerjaanData = $pengerjaanPoModel->where('id_pengerjaan_po', $idPengerjaanPo)->first();
        if (!$pengerjaanData) {
            return redirect()->back()->with('error', 'Data pengerjaan tidak ditemukan.');
        }

        $id_terima_po = $pengerjaanData['id_terima_po'];

        // Delete the pengerjaan record
        try {
            $pengerjaanPoModel->where('id_pengerjaan_po', $idPengerjaanPo)->delete();

            // Hitung total harga pengerjaan untuk id_terima_po ini
            $pengerjaanList = $pengerjaanPoModel->where('id_terima_po', $id_terima_po)->findAll();
            $totalHarga = array_reduce($pengerjaanList, function ($carry, $item) {
                return $carry + $item['harga'];
            }, 0);

            // Debug total harga
            log_message('debug', 'Total harga pengerjaan untuk id_terima_po ' . $id_terima_po . ': ' . $totalHarga);

            // Update total_harga di tabel pengerjaan_po
            $pengerjaanPoModel->where('id_terima_po', $id_terima_po)->set(['total_harga' => $totalHarga])->update();

            // Update biaya_pengerjaan di tabel po
            $poModel->where('id_terima_po', $id_terima_po)->set(['biaya_pengerjaan' => $totalHarga])->update();

            return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('success', 'Pengerjaan berhasil dihapus.');
        } catch (\Exception $e) {
            log_message('error', 'Error saat menghapus data pengerjaan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }



    public function createSparepartPo()
    {
        // Mendapatkan user_id dari sesi
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan di session');
        }

        $id_terima_po = $this->request->getPost('id_terima_po');
        $kodePengerjaan = $this->request->getPost('kodePengerjaan');

        if (!$id_terima_po) {
            return redirect()->back()->with('error', 'ID Terima PO tidak ditemukan.');
        }

        $sparepartPoModel = new M_SparepartPo();
        $poModel = new M_Po();

        $qty = $this->request->getPost('sparepartQty');
        $harga = $this->request->getPost('hargaSparepart');
        $jenisPart = $this->request->getPost('jenisPart');

        // Jika jenis part adalah SUPPLY, set harga menjadi 0
        if ($jenisPart === 'SUPPLY') {
            $harga = 0;
        }

        // Validasi qty dan harga
        if (!is_numeric($qty) || $qty <= 0) {
            return redirect()->back()->with('error', 'Qty harus berupa angka yang lebih besar dari 0.');
        }
        if (!is_numeric($harga) || $harga < 0) {
            return redirect()->back()->with('error', 'Harga harus berupa angka yang lebih besar dari atau sama dengan 0.');
        }

        // Hitung total harga
        $total_harga = $qty * $harga;

        // Mengumpulkan data dari form
        $data = [
            'id_terima_po'       => $id_terima_po,
            'kode_sparepart'     => $this->request->getPost('kodeSparepart'),
            'nama_sparepart'     => $this->request->getPost('sparepartNama'),
            'qty'                => $qty,
            'harga'              => $harga,
            'total_qty'          => $qty,
            'total_harga'        => $total_harga,
            'kode_pengerjaan'    => $kodePengerjaan,
            'jenis_part'         => $jenisPart,
            'keterangan'         => $this->request->getPost('keterangan')
        ];

        // Debug data yang akan disimpan
        log_message('debug', 'Data yang akan disimpan ke tabel sparepart_po: ' . print_r($data, true));

        // Insert data ke dalam tabel sparepart_po
        try {
            $sparepartPoModel->insert($data);

            // Hitung total biaya sparepart untuk id_terima_po ini
            $sparepartList = $sparepartPoModel->where('id_terima_po', $id_terima_po)->findAll();
            $totalBiayaSparepart = array_reduce($sparepartList, function ($carry, $item) {
                return $carry + $item['total_harga'];
            }, 0);

            // Debug total biaya sparepart
            log_message('debug', 'Total biaya sparepart untuk id_terima_po ' . $id_terima_po . ': ' . $totalBiayaSparepart);

            // Update biaya_sparepart di tabel po
            $poModel->where('id_terima_po', $id_terima_po)->set(['biaya_sparepart' => $totalBiayaSparepart])->update();

            return redirect()->back()->with('success', 'Data sparepart berhasil ditambahkan.');
        } catch (\Exception $e) {
            log_message('error', 'Error saat menyimpan data sparepart: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function updateSparepartPo($id_sparepart_po)
    {
        // Mendapatkan user_id dari sesi
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan di session');
        }

        // Mengambil nilai id_terima_po, kodePengerjaan, dan keterangan dari form input
        $id_terima_po = $this->request->getPost('id_terima_po');
        $kodePengerjaan = $this->request->getPost('kodePengerjaan');
        $keterangan = $this->request->getPost('keterangan'); // Mengambil data dari keterangan

        // Pastikan ID Terima PO yang diterima adalah valid
        if (!$id_terima_po) {
            return redirect()->back()->with('error', 'ID Terima PO tidak ditemukan.');
        }

        // Inisialisasi model M_SparepartPo dan M_Po
        $sparepartPoModel = new M_SparepartPo();
        $poModel = new M_Po();

        // Mengumpulkan data dari form
        $qty = $this->request->getPost('sparepartQty'); // Pastikan ini sesuai dengan nama input field
        $harga = $this->request->getPost('hargaSparepart');
        $jenisPart = $this->request->getPost('jenisPart');

        // Jika jenis part adalah SUPPLY, set harga menjadi 0
        if ($jenisPart === 'SUPPLY') {
            $harga = 0;
        }

        // Validasi qty dan harga
        if (!is_numeric($qty) || $qty <= 0) {
            return redirect()->back()->with('error', 'Qty harus berupa angka yang lebih besar dari 0.');
        }
        if (!is_numeric($harga) || $harga < 0) {
            return redirect()->back()->with('error', 'Harga harus berupa angka yang lebih besar dari atau sama dengan 0.');
        }

        // Hitung total harga
        $total_harga = $qty * $harga;

        // Mengumpulkan data dari form untuk pembaruan
        $data = [
            'kode_sparepart'     => $this->request->getPost('kodeSparepart'),
            'nama_sparepart'     => $this->request->getPost('sparepartNama'),
            'qty'                => $qty,
            'harga'              => $harga,
            'total_qty'          => $qty,
            'total_harga'        => $total_harga,
            'kode_pengerjaan'    => $kodePengerjaan,
            'jenis_part'         => $jenisPart,
            'keterangan'         => $keterangan  // Menyimpan keterangan
        ];

        // Debug data yang akan diperbarui
        log_message('debug', 'Data yang akan diperbarui di tabel sparepart_po: ' . print_r($data, true));

        // Update data di dalam tabel sparepart_po
        try {
            $sparepartPoModel->update($id_sparepart_po, $data);

            // Hitung total biaya sparepart untuk id_terima_po ini
            $sparepartList = $sparepartPoModel->where('id_terima_po', $id_terima_po)->findAll();
            $totalBiayaSparepart = array_reduce($sparepartList, function ($carry, $item) {
                return $carry + $item['total_harga'];
            }, 0);

            // Debug total biaya sparepart
            log_message('debug', 'Total biaya sparepart untuk id_terima_po ' . $id_terima_po . ': ' . $totalBiayaSparepart);

            // Update biaya_sparepart di tabel po
            $poModel->where('id_terima_po', $id_terima_po)->set(['biaya_sparepart' => $totalBiayaSparepart])->update();

            return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('success', 'Data sparepart berhasil diperbarui.');
        } catch (\Exception $e) {
            log_message('error', 'Error saat memperbarui data sparepart: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }




    public function getSparepartData($id_sparepart_po)
    {
        $sparepartPoModel = new M_SparepartPo();
        $data = $sparepartPoModel->find($id_sparepart_po);

        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON(['error' => 'Data not found'], 404);
        }
    }
    public function deleteSparepartPo($id)
    {
        // Mendapatkan user_id dari sesi
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan di session');
        }

        // Inisialisasi model M_SparepartPo dan M_Po
        $sparepartPoModel = new M_SparepartPo();
        $poModel = new M_Po();

        // Cari data sparepart berdasarkan ID
        $sparepart = $sparepartPoModel->find($id);
        if (!$sparepart) {
            return redirect()->back()->with('error', 'Data sparepart tidak ditemukan.');
        }

        // Ambil ID Terima PO dari data sparepart
        $id_terima_po = $sparepart['id_terima_po'];

        // Hapus data sparepart
        try {
            $sparepartPoModel->delete($id);

            // Hitung total biaya sparepart yang tersisa untuk id_terima_po ini
            $sparepartList = $sparepartPoModel->where('id_terima_po', $id_terima_po)->findAll();
            $totalBiayaSparepart = array_reduce($sparepartList, function ($carry, $item) {
                return $carry + $item['total_harga'];
            }, 0);

            // Debug total biaya sparepart
            log_message('debug', 'Total biaya sparepart setelah penghapusan untuk id_terima_po ' . $id_terima_po . ': ' . $totalBiayaSparepart);

            // Update biaya_sparepart di tabel po
            $poModel->where('id_terima_po', $id_terima_po)->set(['biaya_sparepart' => $totalBiayaSparepart])->update();

            return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('success', 'Data sparepart berhasil dihapus.');
        } catch (\Exception $e) {
            log_message('error', 'Error saat menghapus data sparepart: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function createGambarPo()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to(base_url('/order_posprev'))->with('error', 'User ID tidak ditemukan di session');
        }

        $id_terima_po = $this->request->getPost('id_terima_po');
        if (!$id_terima_po) {
            return redirect()->to(base_url('/order_posprev'))->with('error', 'ID Terima PO tidak ditemukan.');
        }

        // Mengambil file gambar yang diunggah
        $gambarFiles = $this->request->getFiles();
        $keteranganArray = $this->request->getPost('keterangan');
        $deskripsiArray = $this->request->getPost('deskripsi');

        if (empty($gambarFiles['gambar'])) {
            return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('error', 'Tidak ada file gambar yang diunggah.');
        }

        $gambarArray = $gambarFiles['gambar'];

        if (!is_array($gambarArray)) {
            $gambarArray = [$gambarArray];
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg'];
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/svg+xml'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        $gambarPoModel = new M_GambarPo();

        foreach ($gambarArray as $index => $gambarFile) {
            if (!$gambarFile->isValid()) {
                return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('error', 'File tidak valid.');
            }

            $fileExtension = $gambarFile->getClientExtension();
            $fileMimeType = $gambarFile->getClientMimeType();

            if (!in_array($fileExtension, $allowedExtensions) || !in_array($fileMimeType, $allowedMimeTypes)) {
                return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('error', 'Jenis file tidak diizinkan: ' . $gambarFile->getClientName());
            }

            if ($gambarFile->getSize() > $maxFileSize) {
                return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('error', 'Ukuran file terlalu besar: ' . $gambarFile->getClientName());
            }

            // Menyimpan file gambar
            $gambarName = $gambarFile->getRandomName();
            $gambarFile->move(FCPATH . 'uploads', $gambarName);

            // Ambil keterangan dan deskripsi untuk gambar ini
            $keterangan = isset($keteranganArray[$index]) ? $keteranganArray[$index] : '';
            $deskripsi = isset($deskripsiArray[$index]) ? $deskripsiArray[$index] : '';

            // Simpan data ke database
            $data = [
                'id_terima_po' => $id_terima_po,
                'gambar' => $gambarName,
                'keterangan' => $keterangan,
                'deskripsi' => $deskripsi,
            ];

            $gambarPoModel->insert($data);
        }

        return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('success', 'Gambar berhasil diunggah.');
    }



    public function deleteGambarPo($id)
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan di session');
        }

        $gambarPoModel = new M_GambarPo();

        // Cari data gambar berdasarkan ID
        $gambar = $gambarPoModel->find($id);
        if (!$gambar) {
            return redirect()->back()->with('error', 'Data gambar tidak ditemukan.');
        }

        // Ambil ID Terima PO dari data gambar
        $id_terima_po = $gambar['id_terima_po'];
        $gambarPath = FCPATH . 'uploads/' . $gambar['gambar'];

        // Hapus file gambar dari server
        if (file_exists($gambarPath)) {
            unlink($gambarPath);
        }

        // Hapus data gambar dari database
        try {
            $gambarPoModel->delete($id);

            return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('success', 'Gambar berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('error', 'Error: ' . $e->getMessage());
        }
    }
    // Controller

    public function downloadAllGambar($id_terima_po)
    {
        $gambarPoModel = new M_GambarPo();
        // Ambil data gambar berdasarkan id_terima_po
        $gambarData = $gambarPoModel->where('id_terima_po', $id_terima_po)->findAll();

        $zip = new \ZipArchive();
        $zipFileName = 'Gambar_' . $id_terima_po . '_' . date('YmdHis') . '.zip';

        if ($zip->open($zipFileName, \ZipArchive::CREATE) !== TRUE) {
            return $this->response->setStatusCode(500, 'Could not create zip file.');
        }

        foreach ($gambarData as $gambar) {
            $filePath = 'uploads/' . $gambar['gambar'];
            if (file_exists($filePath)) {
                $zip->addFile($filePath, $gambar['gambar']);
            }
        }

        $zip->close();

        return $this->response->download($zipFileName, null)->setFileName($zipFileName);
    }


    public function createAccAsuransi()
    {
        // Ambil user_id dari session
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan di session');
        }

        // Inisialisasi model
        $model = new M_AccAsuransi();
        $poModel = new M_Po();

        // Mengambil nilai id_terima_po dari form input
        $id_terima_po = $this->request->getPost('id_terima_po');
        $generatedId = $model->generateId();

        // Pastikan ID Terima PO yang diterima adalah valid
        if (!$id_terima_po) {
            return redirect()->back()->with('error', 'ID Terima PO tidak ditemukan.');
        }

        // Ambil data dari form dan konversi biaya
        $data = [
            'id_acc_asuransi' => $generatedId,
            'id_terima_po' => $id_terima_po,
            'tgl_acc' => $this->request->getPost('tgl_acc'),
            'no_kendaraan' => $this->request->getPost('no_kendaraan'),
            'jenis_mobil' => $this->request->getPost('jenis_mobil'),
            'warna' => $this->request->getPost('warna'),
            'customer_name' => $this->request->getPost('customer_name'),
            'no_contact' => $this->request->getPost('no_contact'),
            'tahun_kendaraan' => $this->request->getPost('tahun_mobil'),
            'asuransi' => $this->request->getPost('asuransi'),
            'tgl_masuk' => $this->request->getPost('tgl_masuk'),
            'tgl_estimasi' => $this->request->getPost('tgl_estimasi'),
            'biaya_jasa' => str_replace('.', '', $this->request->getPost('jasa')),
            'biaya_sparepart' => str_replace('.', '', $this->request->getPost('sparepart')),
            'biaya_total' => str_replace('.', '', $this->request->getPost('nilai_total')),
            'nilai_or' => str_replace('.', '', $this->request->getPost('nilai_or')),
            'qty_or' => $this->request->getPost('qty_or'),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'user_id' => $user_id
        ];


        // Proses upload file jika ada
        if ($fotoSpk = $this->request->getFile('file_lampiran')) {
            if ($fotoSpk->isValid() && !$fotoSpk->hasMoved()) {
                // Mengambil nama file yang unik
                $fileName = $fotoSpk->getRandomName();
                // Memindahkan file ke direktori uploads
                $uploadPath = FCPATH . 'uploads/acc-asuransi'; // Path ke direktori uploads
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true); // Membuat direktori jika tidak ada
                }
                $fotoSpk->move($uploadPath, $fileName); // Memindahkan file ke folder yang diinginkan
                // Menyimpan nama file ke dalam data
                $data['file_lampiran'] = $fileName;
            } else {
                return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('error', 'File upload tidak valid atau sudah dipindahkan.');
            }
        } else {
            return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('error', 'Tidak ada file yang diupload.');
        }

        // Simpan data ke database
        if ($model->saveAccAsuransi($data)) {
            // Ambil tgl_acc dan harga_acc dari form input
            $tgl_acc = $this->request->getPost('tgl_acc');
            $harga_acc = $data['biaya_total'];

            // Update status, tgl_acc, dan harga_acc di tabel PO
            $updateStatus = $poModel->updateData($id_terima_po, [
                'status' => 'Acc Asuransi',
                'progres' => 'Menunggu Sparepart',
                'tgl_acc' => $tgl_acc,
                'harga_acc' => $harga_acc
            ]);

            if ($updateStatus) {
                return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('success', 'Asuransi Berhasil Di Approve.');
            } else {
                log_message('error', 'Gagal mengupdate status di tabel PO dengan ID Terima PO: ' . $id_terima_po);
                return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('error', 'Gagal mengupdate status di tabel PO.');
            }
        } else {
            log_message('error', 'Gagal menyimpan data asuransi.');
            return redirect()->to(base_url('/order_posprev/' . $id_terima_po))->with('error', 'Gagal menyimpan data asuransi.');
        }
    }


    public function updateAccAsuransi()
    {
        // Ambil user_id dari session
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan di session');
        }

        // Inisialisasi model
        $model = new M_AccAsuransi();
        $poModel = new M_Po();

        // Mengambil nilai id_acc_asuransi dan id_terima_po dari input form
        $id_acc_asuransi = $this->request->getPost('no-acc');
        $id_terima_po = $this->request->getPost('id_terima_po');

        // Pastikan ID Terima PO yang diterima adalah valid
        if (!$id_terima_po || !$id_acc_asuransi) {
            return redirect()->back()->with('error', 'ID Terima PO atau ID Acc Asuransi tidak ditemukan.');
        }

        // Ambil data dari form dan konversi biaya
        $data = [
            'tgl_acc' => $this->request->getPost('tgl_acc'),
            'no_kendaraan' => $this->request->getPost('no_kendaraan'),
            'jenis_mobil' => $this->request->getPost('jenis_mobil'),
            'warna' => $this->request->getPost('warna'),
            'customer_name' => $this->request->getPost('customer_name'),
            'no_contact' => $this->request->getPost('no_contact'),
            'tahun_kendaraan' => $this->request->getPost('tahun_mobil'),
            'asuransi' => $this->request->getPost('asuransi'),
            'tgl_masuk' => $this->request->getPost('tgl_masuk'),
            'tgl_estimasi' => $this->request->getPost('tgl_estimasi'),
            'biaya_jasa' => str_replace('.', '', $this->request->getPost('biaya_jasa')),
            'biaya_sparepart' => str_replace('.', '', $this->request->getPost('biaya_sparepart')),
            'biaya_total' => str_replace('.', '', $this->request->getPost('biaya_total')),
            'nilai_or' => str_replace('.', '', $this->request->getPost('nilai_or')),
            'qty_or' => $this->request->getPost('qty_or'),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'user_id' => $user_id
        ];

        // Proses upload file jika ada
        if ($fotoSpk = $this->request->getFile('file_lampiran')) {
            if ($fotoSpk->isValid() && !$fotoSpk->hasMoved()) {
                // Ambil nama file lama dari database
                $existingRecord = $model->find($id_acc_asuransi);
                if ($existingRecord && $existingRecord['file_lampiran']) {
                    // Hapus file lama
                    $oldFilePath = FCPATH . 'uploads/acc-asuransi/' . $existingRecord['file_lampiran'];
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                // Mengambil nama file yang unik
                $fileName = $fotoSpk->getRandomName();
                // Memindahkan file ke direktori uploads
                $uploadPath = FCPATH . 'uploads/acc-asuransi';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                $fotoSpk->move($uploadPath, $fileName);
                // Menyimpan nama file ke dalam data
                $data['file_lampiran'] = $fileName;
            }
        }

        // Update data ke database
        if ($model->update($id_acc_asuransi, $data)) {
            // Ambil tgl_acc dan harga_acc dari form input
            $tgl_acc = $data['tgl_acc'];
            $harga_acc = $data['biaya_total'];

            // Update status, tgl_acc, dan harga_acc di tabel PO
            $updateStatus = $poModel->updateData($id_terima_po, [
                'status' => 'Acc Asuransi',
                'progres' => 'Menunggu Sparepart',
                'tgl_acc' => $tgl_acc,
                'harga_acc' => $harga_acc
            ]);

            if ($updateStatus) {
                return redirect()->to(base_url('/order_pos_asprev/' . $id_terima_po))->with('success', 'Asuransi berhasil diperbarui.');
            } else {
                log_message('error', 'Gagal mengupdate status di tabel PO dengan ID Terima PO: ' . $id_terima_po);
                return redirect()->to(base_url('/order_pos_asprev/' . $id_terima_po))->with('error', 'Gagal mengupdate status di tabel PO.');
            }
        } else {
            log_message('error', 'Gagal memperbarui data asuransi.');
            return redirect()->to(base_url('/order_pos_asprev/' . $id_terima_po))->with('error', 'Gagal memperbarui data asuransi.');
        }
    }

    public function orderlist_asuransi()
    {

        $accAsuransiModel = new M_AccAsuransi();

        // Menggunakan metode untuk mengambil semua data acc dengan username
        $accData = $accAsuransiModel->getAccAsuransiWithUser();

        $data = [
            'title' => 'Asuransi',
            'accData' => $accData,
        ];

        return view('klaim/orderlist_asuransi', $data);
    }


    public function prev_as($id_terima_po)
    {
        $model = new M_AccAsuransi();

        // Tambahkan pengecekan debugging
        $data = $model->where('id_terima_po', $id_terima_po)->first();

        if ($data === null) {
            // Tampilkan pesan debug
            echo "Data dengan ID Terima PO: $id_terima_po tidak ditemukan.";
            exit;
        }

        return view('klaim/order_post_asprev', [
            'title' => 'Asuransi',
            'data' => $data
        ]);
    }


    public function repair_order()
    {
        $model = new M_RepairOrder();
        $userModel = new UserModel();

        $repair = $model->findAll();

        foreach ($repair as &$order) {
            $user = $userModel->find($order['user_id']);
            $order['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Repair Order',
            'repairOrders' => $repair
        ];

        // Mengembalikan view dengan data
        return view('klaim/repair_order', $data);
    }


    public function orderlist_pending()
    {
        $pending = new M_RepairOrder();
        $userModel = new UserModel();

        $pendingData = $pending->groupStart()
            ->where('status_bayar', 'Belum Bayar')
            ->orGroupStart()
            ->where('progres_pengerjaan', 'Menunggu Sparepart Tambahan')
            ->orWhere('progres_pengerjaan', 'Menunggu Comment User')
            ->groupEnd()
            ->groupEnd()
            ->findAll();

        foreach ($pendingData as &$order) {
            $user = $userModel->find($order['user_id']);
            $order['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Pending Invoice',
            'pending' => $pendingData
        ];

        return view('klaim/orderlist_pending', $data);
    }



    public function kwitansi()
    {
        $kwitansiData = new M_Kwitansi();
        $userModel = new UserModel();

        $kwitansi = $kwitansiData->findAll();

        foreach ($kwitansi as &$kwitansiItem) {
            $user = $userModel->find($kwitansiItem['user_id']);
            $kwitansiItem['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Kwitansi',
            'kwitansi' => $kwitansi
        ];

        return view('klaim/kwitansi', $data);
    }


    // In your controller
    public function kwitansi_piutang()
    {

        $asuransiKwitansi = new M_Kwitansi();
        $orKwitansi =  new M_KwitansiOR();

        $utangAsuransi = $asuransiKwitansi->findAll();
        $utangOR = $orKwitansi->findAll();


        $piutangData = array_merge($utangAsuransi, $utangOR);


        $data = [
            'title' => 'Piutang List',
            'piutang' => $piutangData
        ];

        // Load the view and pass the data
        return view('klaim/kwitansi_piutang', $data);
    }


    public function kwitansi_pending_preview($nomor = null)
    {
        $model = new M_Piutang();


        if ($nomor) {
            $piutang = $model->where('nomor', $nomor)->first();
        } else {
            $piutang = $model->findAll();
        }

        $nomor = $piutang['nomor'] ?? null;

        $data = [
            'title' => 'Update Invoice',
            'piutang' => $piutang,
            'nomor' => $nomor
        ];

        return view('klaim/kwitansi_piutangprev', $data);
    }

    public function updatePiutang($nomor)
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        // Ambil model piutang
        $piutangModel = new M_Piutang();

        // Ambil data yang akan di-update dari request
        $data = [
            'tanggal'                 => $this->request->getPost('tgl'),
            'no_order'                => $this->request->getPost('no_order'),
            'no_kendaraan'            => $this->request->getPost('no_kendaraan'),
            'jenis_mobil'             => $this->request->getPost('jenis-mobil'),
            'warna'                   => $this->request->getPost('warna'),
            'customer_name'           => $this->request->getPost('customer-name'),
            'no_contact'              => $this->request->getPost('no-contact'),
            'tahun_mobil'             => $this->request->getPost('tahun-mobil'),
            'asuransi'                => $this->request->getPost('asuransi'),
            'jasa'                    => $this->request->getPost('jasa'),
            'sparepart'               => $this->request->getPost('sparepart'),
            'nilai_total'             => $this->request->getPost('nilai-total'),
            'nilai_bayar'             => $this->request->getPost('nilai-bayar'),
            'jenis_bayar'             => $this->request->getPost('jenis-bayar'),
            'tanggal_masuk'           => $this->request->getPost('tgl-masuk'),
            'tanggal_selesai'         => $this->request->getPost('tgl-estimasi'),
            'keterangan'              => $this->request->getPost('keterangan'),
            'tanggal_kirim_kwitansi'  => $this->request->getPost('tgl_kirim_kwitansi'),
            'user_id'                 => $user_id
        ];

        try {
            // Simpan/update ke M_Piutang
            $updateResult = $piutangModel->update($nomor, $data);

            if ($updateResult === false) {
                $errors = $piutangModel->errors();
                log_message('error', 'Error updating piutang: ' . json_encode($errors));
                session()->setFlashdata('error', 'Gagal mengupdate piutang! Error: ' . json_encode($errors));
                return redirect()->to('kwitansi_piutang'); // Redirect jika gagal
            } else {
                session()->setFlashdata('success', 'Data piutang berhasil diupdate!');
            }

            return redirect()->to('kwitansi_piutang');
        } catch (\Exception $e) {
            log_message('error', 'Exception saat mengupdate piutang: ' . $e->getMessage());
            session()->setFlashdata('error', 'Terjadi kesalahan saat mengupdate piutang. Silakan coba lagi.');
            return redirect()->to('kwitansi_piutang');
        }
    }

    public function invoice_or()
    {
        $model = new M_KwitansiOR();
        $userModel = new UserModel();

        $kwitansiOr = $model->findAll();

        foreach ($kwitansiOr as &$kwitansi) {
            $user = $userModel->find($kwitansi['user_id']);
            $kwitansi['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Cetak Kwitansi OR',
            'kwitansi_or' => $kwitansiOr,
        ];

        return view('klaim/invoice_or', $data);
    }


    // add di asuransi
    public function input_od_asuransi()
    {
        $data = [
            'title' => 'Asuransi',
        ];
        return view('klaim/order_pos_as', $data);
    }

    // add di repair order
    public function input_repair($id_terima_po)
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
            'title' => 'Repair Order',
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

        return view('klaim/order_repair', $data);
    }




    public function update_ro($id_terima_po)
    {
        $repairOrderModel = new M_RepairOrder();

        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $data = [
            'bengkel'          => $this->request->getPost('bengkel'),
            'id_terima_po'     => $this->request->getPost('id_terima_po'),
            'no_kendaraan'     => strtoupper($this->request->getPost('no_kendaraan')),
            'jenis_mobil'      => strtoupper($this->request->getPost('jenis-mobil')),
            'warna'            => strtoupper($this->request->getPost('warna')),
            'no_rangka'        => strtoupper($this->request->getPost('no-rangka')),
            'tahun_kendaraan'  => $this->request->getPost('tahun-kendaraan'),
            'customer_name'    => strtoupper($this->request->getPost('customer-name')),
            'no_contact'       => strtoupper($this->request->getPost('no-contact')),
            'alamat'           => strtoupper($this->request->getPost('alamat')),
            'kota'             => strtoupper($this->request->getPost('kota')),
            'asuransi'         => strtoupper($this->request->getPost('asuransi')),
            'no_polis'         => strtoupper($this->request->getPost('no-polis')),
            'tgl_klaim'        => $this->request->getPost('tanggal-masuk'),
            'tgl_keluar'       => $this->request->getPost('tanggal-estimasi'),
            'harga_estimasi'   => str_replace(['.', ','], ['', '.'], $this->request->getPost('harga-estimasi')),
            'keterangan'       => strtoupper($this->request->getPost('keterangan')),
            'progres_pengerjaan' => strtoupper(implode(',', (array) $this->request->getPost('progres_pengerjaan'))),
            'user_id' => $user_id
        ];


        // Cek apakah data dengan ID yang dimaksud ada
        $existingData = $repairOrderModel->findByTerimaPo($id_terima_po);
        log_message('debug', 'Data yang ditemukan: ' . print_r($existingData, true));

        if ($existingData) {
            // Lakukan update data
            if ($repairOrderModel->update($existingData['id_repair_order'], $data)) {
                return redirect()->to('/order_repair/' . esc($id_terima_po))->with('success', 'Repair Order berhasil diperbarui.');
            } else {
                return redirect()->back()->with('error', 'Gagal memperbarui Repair Order.');
            }
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }


    public function cetakKwitansi($id_terima_po)
    {
        $dataPO = new M_RepairOrder();

        // Cari data repair order berdasarkan id_terima_po
        $repairOrder = $dataPO->where('id_terima_po', $id_terima_po)->first();

        // Cek apakah data dengan id_terima_po tersebut ada
        if (!$repairOrder) {
            // Jika tidak ada data, kembalikan dengan pesan error
            return redirect()->back()->with('error', 'Data tidak ditemukan untuk id terima po: ' . $id_terima_po);
        }

        // Dapatkan id_repair_order dari hasil pencarian
        $id_repair_order = $repairOrder['id_repair_order'];

        // Persiapkan data untuk update
        $updateData = [
            'status_bayar' => 'Belum Bayar',
            'is_sent' => 1 // Set is_sent menjadi 1
        ];

        // Update data Repair Order berdasarkan id_repair_order
        if ($dataPO->update($id_repair_order, $updateData)) {
            // Jika berhasil update
            return redirect()->to('/repair_order')->with('success', 'Kwitansi telah berhasil dicetak dan status diperbarui.');
        } else {
            // Jika gagal update
            return redirect()->back()->with('error', 'Gagal memperbarui data Kwitansi.');
        }
    }


    // add di kwitansi
    public function add_invoice()
    {
        $model = new M_Kwitansi();
        $repair = new M_RepairOrder();
        $coa = new M_Coa();

        // Ambil semua data repair yang is_sent = 1
        $dataRepair = $repair->where('is_sent', 1)->findAll();

        // Filter hanya data COA yang diinginkan
        $datacoa = $coa->getSpecificCoa();

        // Loop data repair dan tambahkan data biaya berdasarkan jenis asuransi
        $dataRepairProcessed = [];
        foreach ($dataRepair as $item) {
            $id_terima_po = $item['id_terima_po'];
            $asuransi = $item['asuransi'];

            // Ambil data biaya berdasarkan jenis asuransi
            $biayaData = $repair->getDataByAsuransi($id_terima_po, $asuransi);
            log_message('debug', 'Data dari getDataByAsuransi: ' . json_encode($biayaData));


            $item['biaya_pengerjaan'] = $biayaData['biaya_pengerjaan'] ?? 0;
            $item['biaya_sparepart'] = $biayaData['biaya_sparepart'] ?? 0;
            $item['total_biaya'] = $biayaData['total_biaya'] ?? 0;
            $item['nilai_or'] = $biayaData['nilai_or'] ?? 0;
            $item['qty_or'] = $biayaData['qty_or'] ?? 0;

            $dataRepairProcessed[] = $item;
        }

        // Generate nomor kwitansi baru
        $nomorData = $model->generateNomor();

        $data = [
            'title' => 'Add Invoice',
            'nomor' => $nomorData,
            'dataRepair' => $dataRepairProcessed,
            'coa' => $datacoa
        ];

        return view('klaim/add_invo', $data);
    }



    public function add_invoice_or()
    {
        $model = new M_KwitansiOR();
        $repair = new M_RepairOrder();
        $or = new M_AccAsuransi();
        $coa = new M_Coa();

        // Ambil semua data repair
        $dataRepair = $repair->findAll();

        // Filter data repair dengan asuransi bukan 'Umum/Pribadi' dan is_sent = 1
        $dataRepairFiltered = array_filter($dataRepair, function ($repair) {
            return $repair['is_sent'] == 1 && $repair['asuransi'] != 'UMUM/PRIBADI';
        });

        // Ambil daftar id_terima_po dari dataRepairFiltered
        $idTerimaPoList = array_column($dataRepairFiltered, 'id_terima_po');

        // Ambil nilai_or dan qty_or berdasarkan id_terima_po dari M_AccAsuransi
        if (!empty($idTerimaPoList)) {
            $dataOR = $or->select('id_terima_po, nilai_or, qty_or')
                ->whereIn('id_terima_po', $idTerimaPoList)
                ->findAll();
        } else {
            $dataOR = [];
        }

        // Gabungkan data nilai_or dan qty_or ke dalam dataRepairFiltered
        $dataRepairMerged = array_map(function ($repair) use ($dataOR) {
            foreach ($dataOR as $orData) {
                if ($repair['id_terima_po'] == $orData['id_terima_po']) {
                    $repair['nilai_or'] = $orData['nilai_or'];
                    $repair['qty_or'] = $orData['qty_or'];
                    break;
                }
            }
            // Tambahkan nilai default jika tidak ada data di M_AccAsuransi
            if (!isset($repair['nilai_or'])) {
                $repair['nilai_or'] = 0;
                $repair['qty_or'] = 0;
            }
            return $repair;
        }, $dataRepairFiltered);

        $nomorData = $model->generateNomor();
        $datacoa = $coa->getSpecificCoa();

        $data = [
            'title' => 'Add Invoice',
            'nomor' => $nomorData,
            'dataRepair' => $dataRepairMerged,
            'coa' => $datacoa
        ];

        return view('klaim/add_invo_or', $data);
    }


    public function add_invoice_prev()
    {
        $model = new M_Kwitansi();
        $kwitansi = $model->findAll();

        $nomor = $kwitansi[0]['nomor'] ?? null;

        $data = [
            'title' => 'Update Invoice',
            'kwitansi' => $kwitansi,
            'nomor' => $nomor
        ];
        return view('klaim/add_invoprev', $data);
    }
    public function add_invoice_prev_or()
    {
        $model = new M_KwitansiOR();
        $kwitansi = $model->findAll();

        $nomor = $kwitansi[0]['nomor'] ?? null;

        $data = [
            'title' => 'Update Invoice',
            'kwitansi' => $kwitansi,
            'nomor' => $nomor
        ];
        return view('klaim/add_invoprev_or', $data);
    }


    public function createKwitansi()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $model = new M_Kwitansi();
        $repairModel = new M_RepairOrder();
        $nomorData = $model->generateNomor();

        $data = [
            'nomor' => $nomorData,
            'tanggal' => $this->request->getPost('tgl'),
            'jatuh_tempo' => $this->request->getPost('jatuh_tempo'),
            'no_order' => strtoupper($this->request->getPost('no_order')),
            'no_kendaraan' => strtoupper($this->request->getPost('no_kendaraan')),
            'jenis_mobil' => strtoupper($this->request->getPost('jenis-mobil')),
            'warna' => strtoupper($this->request->getPost('warna')),
            'customer_name' => strtoupper($this->request->getPost('customer-name')),
            'no_contact' => strtoupper($this->request->getPost('no-contact')),
            'tahun_mobil' => $this->request->getPost('tahun-mobil'),
            'asuransi' => strtoupper($this->request->getPost('asuransi')),
            'jasa' => str_replace([',', '.'], '', $this->request->getPost('jasa')), // Fixed missing parenthesis
            'sparepart' => str_replace([',', '.'], '', $this->request->getPost('sparepart')), // Fixed missing parenthesis
            'nilai_total' => str_replace([',', '.'], '', $this->request->getPost('nilai-total')), // Fixed missing parenthesis
            'nilai_bayar' => str_replace([',', '.'], '', $this->request->getPost('nilai-bayar')), // Fixed missing parenthesis
            'nilai_or' => str_replace([',', '.'], '', $this->request->getPost('nilai_or')), // Fixed missing parenthesis
            'qty_or' => $this->request->getPost('qty_or'),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'user_id' => $user_id
        ];


        try {
            // Insert kwitansi
            if ($model->insert($data) === false) {
                return redirect()->back()->with('error', 'Gagal menyimpan kwitansi: ' . implode(", ", $model->errors()));
            }

            $no_order = $this->request->getPost('no_order');
            $repairOrder = $repairModel->where('id_terima_po', $no_order)->first();

            if (!$repairOrder) {
                return redirect()->back()->with('error', 'Data tidak ditemukan untuk id terima po: ' . $no_order);
            }



            return redirect()->to('kwitansi')->with('success', 'Kwitansi berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
        }
    }

    // public function createKwitansi()
    // {
    //     // Get the user ID from the session
    //     $user_id = session()->get('user_id');
    //     if (!$user_id) {
    //         return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
    //     }

    //     // Load the M_Kwitansi model
    //     $model = new M_Kwitansi();

    //     // Generate the Kwitansi number
    //     $nomorData = $model->generateNomor();

    //     // Get data from the POST request and sanitize/clean the values
    //     $dataRO = [
    //         'nomor'         => $nomorData,
    //         'tanggal'       => $this->request->getPost('tgl'),
    //         'jatuh_tempo'   => $this->request->getPost('jatuh_tempo'),
    //         'no_order'      => strtoupper(trim($this->request->getPost('no_order'))),
    //         'no_kendaraan'  => strtoupper(trim($this->request->getPost('no_kendaraan'))),
    //         'jenis_mobil'   => strtoupper(trim($this->request->getPost('jenis-mobil'))),
    //         'warna'         => strtoupper(trim($this->request->getPost('warna'))),
    //         'customer_name' => strtoupper(trim($this->request->getPost('customer-name'))),
    //         'no_contact'    => strtoupper(trim($this->request->getPost('no-contact'))),
    //         'tahun_mobil'   => trim($this->request->getPost('tahun-mobil')),
    //         'asuransi'      => strtoupper(trim($this->request->getPost('asuransi'))),
    //         'jasa'          => floatval(str_replace(['.', ','], '', $this->request->getPost('jasa'))), // Remove dots and commas
    //         'sparepart'     => floatval(str_replace(['.', ','], '', $this->request->getPost('sparepart'))), // Remove dots and commas
    //         'nilai_total'   => floatval(str_replace(['.', ','], '', $this->request->getPost('nilai-total'))), // Remove dots and commas
    //         'nilai_bayar'   => floatval(str_replace(['.', ','], '', $this->request->getPost('nilai-bayar'))), // Remove dots and commas
    //         'nilai_or'      => floatval(str_replace(['.', ','], '', $this->request->getPost('nilai_or'))), // Remove dots and commas
    //         'qty_or'        => intval($this->request->getPost('qty_or')),
    //         'keterangan'    => strtoupper(trim($this->request->getPost('keterangan'))),
    //         'user_id'       => $user_id
    //     ];

    //     try {
    //         // Insert Kwitansi into the database
    //         if (!$model->insert($dataRO)) {
    //             // Return with error message if the insert fails
    //             return redirect()->back()->with('error', 'Gagal menyimpan kwitansi: ' . implode(", ", $model->errors()));
    //         }

    //         // Redirect with success message if the insert is successful
    //         return redirect()->to('kwitansi')->with('success', 'Kwitansi berhasil disimpan.');
    //     } catch (\Exception $e) {
    //         // Log the error for further analysis and return a user-friendly error message
    //         log_message('error', "Error while saving kwitansi: " . $e->getMessage());
    //         return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //     }
    // }






    public function updateKwitansi($nomor)
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        // Ambil model kwitansi dan repair order
        $model = new M_Kwitansi();
        $repairModel = new M_RepairOrder();
        $piutangModel = new M_Piutang(); // Model Piutang

        // Ambil data yang akan di-update dari request
        $data = [
            'tanggal' => $this->request->getPost('tgl'),
            'jatuh_tempo' => $this->request->getPost('jatuh_tempo'), // Tanggal tidak diubah
            'no_order' => strtoupper($this->request->getPost('no_order')),
            'no_kendaraan' => strtoupper($this->request->getPost('no_kendaraan')),
            'jenis_mobil' => strtoupper($this->request->getPost('jenis-mobil')),
            'warna' => strtoupper($this->request->getPost('warna')),
            'customer_name' => strtoupper($this->request->getPost('customer-name')),
            'no_contact' => strtoupper($this->request->getPost('no-contact')),
            'tahun_mobil' => $this->request->getPost('tahun-mobil'), // Tidak diubah karena numerik
            'asuransi' => strtoupper($this->request->getPost('asuransi')),
            'jasa' => strtoupper($this->request->getPost('jasa')),
            'sparepart' => strtoupper($this->request->getPost('sparepart')),
            'nilai_total' => $this->request->getPost('nilai-total'), // Tidak diubah karena numerik
            'nilai_bayar' => $this->request->getPost('nilai-bayar'), // Tidak diubah karena numerik
            'jenis_bayar' => strtoupper($this->request->getPost('jenis-bayar')),
            'tanggal_masuk' => $this->request->getPost('tgl-masuk'), // Tanggal tidak diubah
            'tanggal_selesai' => $this->request->getPost('tgl-estimasi'), // Tanggal tidak diubah
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'tanggal_kirim_kwitansi' => $this->request->getPost('tgl_kirim_kwitansi'), // Tanggal tidak diubah
            'user_id'                 => $user_id
        ];

        // Cek jenis bayar
        $jenis_bayar = $this->request->getPost('jenis-bayar');

        try {
            // Simpan ke M_Kwitansi terlebih dahulu
            $updateResult = $model->update($nomor, $data);

            if ($updateResult === false) {
                $errors = $model->errors();
                log_message('error', 'Error updating kwitansi: ' . json_encode($errors));
                session()->setFlashdata('error', 'Gagal mengupdate kwitansi! Error: ' . json_encode($errors));
                return redirect()->to('kwitansi'); // Redirect jika gagal
            } else {
                session()->setFlashdata('success', 'Kwitansi berhasil diupdate!');

                // Jika jenis_bayar adalah Piutang, simpan ke M_Piutang
                if ($jenis_bayar === "Piutang") {
                    $piutangModel->insert($data); // Simpan juga ke M_Piutang
                    session()->setFlashdata('success', 'Data piutang berhasil disimpan!');
                }

                // Ambil no_order untuk update status bayar
                $no_order = $this->request->getPost('no_order');

                // Cari data repair order berdasarkan no_order
                $repairOrder = $repairModel->where('id_terima_po', $no_order)->first();

                if (!$repairOrder) {
                    return redirect()->back()->with('error', 'Data tidak ditemukan untuk id terima po: ' . $no_order);
                }

                $id_repair_order = $repairOrder['id_repair_order'];

                // Persiapkan data untuk update status bayar
                $updateData = [
                    'status_bayar' => 'Kwitansi Asuransi' // Status baru
                ];

                // Update data Repair Order berdasarkan id_repair_order
                if ($repairModel->update($id_repair_order, $updateData)) {
                    session()->setFlashdata('success', 'Status bayar berhasil diperbarui ke Kwitansi Asuransi!');
                } else {
                    $repairErrors = $repairModel->errors();
                    log_message('error', 'Error updating status bayar: ' . json_encode($repairErrors));
                    session()->setFlashdata('error', 'Gagal memperbarui status bayar! Error: ' . json_encode($repairErrors));
                }
            }

            return redirect()->to('kwitansi');
        } catch (\Exception $e) {
            log_message('error', 'Exception saat mengupdate kwitansi: ' . $e->getMessage());
            session()->setFlashdata('error', 'Terjadi kesalahan saat mengupdate kwitansi. Silakan coba lagi.');
            return redirect()->to('kwitansi');
        }
    }
    public function deleteKwitansi($nomor)
    {
        // Mendapatkan ID pengguna dari sesi
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $model = new M_Kwitansi();

        try {
            // Mencari kwitansi berdasarkan ID
            $kwitansi = $model->find($nomor);

            if (!$kwitansi) {
                return redirect()->back()->with('error', 'Kwitansi tidak ditemukan.');
            }

            // Menghapus kwitansi
            if ($model->delete($nomor) === false) {
                return redirect()->back()->with('error', 'Gagal menghapus kwitansi: ' . implode(", ", $model->errors()));
            }

            // Menampilkan pesan sukses
            return redirect()->to('kwitansi')->with('success', 'Kwitansi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
        }
    }


    public function createKwitansiOR()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        // Ambil model kwitansi, repair order, dan piutang
        $model = new M_KwitansiOR();
        $repairModel = new M_RepairOrder();
        $modelJurnal = new M_ReportJurnal();
        $nomorData = $model->generateNomor();

        // Ambil data dari request
        $data = [
            'nomor' => $nomorData,
            'tanggal' => $this->request->getPost('tgl'),
            'no_order' => strtoupper($this->request->getPost('no_order')),
            'no_kendaraan' => strtoupper($this->request->getPost('no_kendaraan')),
            'jenis_mobil' => strtoupper($this->request->getPost('jenis-mobil')),
            'warna' => strtoupper($this->request->getPost('warna')),
            'customer_name' => strtoupper($this->request->getPost('customer-name')),
            'no_contact' => strtoupper($this->request->getPost('no-contact')),
            'tahun_mobil' => $this->request->getPost('tahun-mobil'),
            'asuransi' => strtoupper($this->request->getPost('asuransi')),
            'nilai_total' => $this->request->getPost('nilai-total'),
            'nilai_or' => $this->request->getPost('nilai-or'),
            'qty_or' => $this->request->getPost('qty-or'),
            'jenis_bayar' => strtoupper($this->request->getPost('jenis-bayar')),
            'tanggal_masuk' => $this->request->getPost('tgl-masuk'),
            'tanggal_selesai' => $this->request->getPost('tgl-estimasi'),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'tanggal_kirim_kwitansi' => $this->request->getPost('tgl_kirim_kwitansi'),
            'user_id' => $user_id
        ];

        try {
            // Insert kwitansi
            if ($model->insert($data) === false) {
                return redirect()->back()->with('error', 'Gagal menyimpan kwitansi or: ' . implode(", ", $model->errors()));
            }

            $no_order = $this->request->getPost('no_order');
            $repairOrder = $repairModel->where('id_terima_po', $no_order)->first();

            if (!$repairOrder) {
                return redirect()->back()->with('error', 'Data tidak ditemukan untuk id terima po: ' . $no_order);
            }

            $id_repair_order = $repairOrder['id_repair_order'];

            $updateData = [
                'status_bayar' => 'Kwitansi OR'
            ];

            if ($repairModel->update($id_repair_order, $updateData)) {
                session()->setFlashdata('success', 'Status bayar berhasil diperbarui!');
            } else {
                $repairErrors = $repairModel->errors();
                log_message('error', 'Error updating status bayar: ' . json_encode($repairErrors));
                session()->setFlashdata('error', 'Gagal memperbarui status bayar! Error: ' . json_encode($repairErrors));
            }

            $doc_no = 'JP.' . $nomorData;

            // Hitung nilai total dari nilai_or dan qty_or
            $nilai_or = (float)$this->request->getPost('nilai-or');
            $qty_or = (int)$this->request->getPost('qty-or');
            $nilai_total = $nilai_or * $qty_or;

            $jenis_bayar = strtoupper($this->request->getPost('jenis-bayar'));

            // Kondisi untuk jenis bayar REK BCA
            if ($jenis_bayar === 'REK BCA') {
                $dataBank = [
                    'date' => $data['tanggal'],
                    'doc_no' => $doc_no,
                    'account' => '11113',
                    'name' => 'REK BCA',
                    'description' => $qty_or . 'X OR ' . $data['jenis_mobil'] . ' ' . $data['no_kendaraan'] . ' ' . $data['customer_name'],
                    'debit' => $nilai_total,
                    'kredit' => 0,
                    'aksi' => 'Posted',
                    'user_id' => $user_id,
                ];

                // Simpan ke database k_kasbank
                $modelJurnal->insert($dataBank);

                $dataPendapatan = [
                    'date' => $data['tanggal'],
                    'doc_no' => $doc_no,
                    'account' => '41140',
                    'name' => 'PENDAPATAN OR',
                    'description' => $qty_or . 'X OR ' . $data['jenis_mobil'] . ' ' . $data['no_kendaraan'] . ' ' . $data['customer_name'],
                    'debit' => 0,
                    'kredit' => $nilai_total,
                    'user_id' => $user_id,
                ];

                // Simpan ke database k_kasbank
                $modelJurnal->insert($dataPendapatan);
            }

            // Kondisi untuk jenis bayar KAS BESAR
            if ($jenis_bayar === 'KAS BESAR') {
                $dataBank = [
                    'date' => $data['tanggal'],
                    'doc_no' => $doc_no,
                    'account' => '11102',
                    'name' => 'KAS BESAR',
                    'description' => $qty_or . 'X OR ' . $data['jenis_mobil'] . ' ' . $data['no_kendaraan'] . ' ' . $data['customer_name'],
                    'debit' => $nilai_total,
                    'kredit' => 0,
                    'aksi' => 'Posted',
                    'user_id' => $user_id,
                ];

                // Simpan ke database k_kasbank
                $modelJurnal->insert($dataBank);

                $dataPendapatan = [
                    'date' => $data['tanggal'],
                    'doc_no' => $doc_no,
                    'account' => '41140',
                    'name' => 'PENDAPATAN OR',
                    'description' => $qty_or . 'X OR ' . $data['jenis_mobil'] . ' ' . $data['no_kendaraan'] . ' ' . $data['customer_name'],
                    'debit' => 0,
                    'kredit' => $nilai_total,
                    'user_id' => $user_id,
                ];

                // Simpan ke database k_kasbank
                $modelJurnal->insert($dataPendapatan);
            }

            // Kondisi untuk jenis bayar PIUTANG USAHA
            if ($jenis_bayar === 'PIUTANG USAHA') {
                $repairModel->update($id_repair_order, ['status_bayar' => 'Belum Bayar OR']);
            }

            // Kondisi tambahan untuk BEBAN DIBAYAR DIMUKA
            if ($jenis_bayar === 'BEBAN DIBAYAR DIMUKA') {
                // Tambahkan logika tambahan jika diperlukan
            }

            return redirect()->to('invoice_or')->with('success', 'Kwitansi berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
        }
    }




    public function updateKwitansiOR($nomor)
    {
        // Inisialisasi model
        $model = new M_KwitansiOR();
        $repairModel = new M_RepairOrder();
        $piutangModel = new M_Piutang(); // Tambahkan model Piutang

        // Ambil data dari POST
        $data = [
            'id_repair_order' => $this->request->getPost('id_repair_order'),
            'nomor' => strtoupper($this->request->getPost('nomor')),
            'tanggal' => $this->request->getPost('tgl'),
            'no_order' => strtoupper($this->request->getPost('no_order')),
            'no_kendaraan' => strtoupper($this->request->getPost('no_kendaraan')),
            'jenis_mobil' => strtoupper($this->request->getPost('jenis-mobil')),
            'warna' => strtoupper($this->request->getPost('warna')),
            'customer_name' => strtoupper($this->request->getPost('customer-name')),
            'no_contact' => strtoupper($this->request->getPost('no-contact')),
            'tahun_mobil' => $this->request->getPost('tahun-mobil'), // Tidak diubah karena numerik
            'asuransi' => strtoupper($this->request->getPost('asuransi')),
            'jasa' => strtoupper($this->request->getPost('jasa')),
            'sparepart' => strtoupper($this->request->getPost('sparepart')),
            'nilai_total' => $this->request->getPost('nilai-total'), // Tidak diubah karena numerik
            'nilai_bayar' => $this->request->getPost('nilai-bayar'), // Tidak diubah karena numerik
            'jenis_bayar' => strtoupper($this->request->getPost('jenis-bayar')),
            'tanggal_masuk' => $this->request->getPost('tgl-masuk'), // Tanggal tidak diubah
            'tanggal_selesai' => $this->request->getPost('tgl-estimasi'), // Tanggal tidak diubah
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'tanggal_kirim_kwitansi' => $this->request->getPost('tgl_kirim_kwitansi') // Tanggal tidak diubah

        ];

        // Coba simpan kwitansi
        $updateResult = $model->update($nomor, $data);
        if ($updateResult === false) {
            // Tangani error saat menyimpan kwitansi
            $errors = $model->errors();
            log_message('error', 'Error updating kwitansi: ' . json_encode($errors));
            session()->setFlashdata('error', 'Gagal mengupdate kwitansi! Error: ' . json_encode($errors));
        } else {
            // Jika kwitansi berhasil diupdate, update status bayar
            session()->setFlashdata('success', 'Kwitansi berhasil diupdate!');

            // Ambil id_repair_order dari POST
            $id_repair_order = $this->request->getPost('id_repair_order');

            // Debug: Cek apakah id_repair_order ada
            log_message('info', 'ID Repair Order: ' . $id_repair_order);

            // Siapkan data untuk update status bayar
            $repairUpdateData = [
                'status_bayar' => 'Kwitansi OR' // Status baru
            ];

            // Debug: Cek data sebelum update
            log_message('info', 'Data untuk update status bayar: ' . json_encode($repairUpdateData));

            // Update status bayar di tabel Repair Order
            $repairUpdateResult = $repairModel->update($id_repair_order, $repairUpdateData);

            // Cek hasil update status bayar
            if ($repairUpdateResult === false) {
                // Jika ada error saat update status bayar
                $repairErrors = $repairModel->errors();
                log_message('error', 'Error updating status bayar: ' . json_encode($repairErrors));
                session()->setFlashdata('error', 'Gagal mengupdate status bayar! Error: ' . json_encode($repairErrors));
            } else {
                session()->setFlashdata('success', 'Status bayar berhasil diperbarui!');
            }
        }
        // Redirect ke halaman yang sesuai setelah operasi
        return redirect()->to('invoice_or');
    }

    public function deleteKwitansiOR($nomor)
    {
        // Mendapatkan ID pengguna dari sesi
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $model = new M_KwitansiOR();

        try {
            // Mencari kwitansi berdasarkan ID
            $kwitansi = $model->find($nomor);

            if (!$kwitansi) {
                return redirect()->back()->with('error', 'Kwitansi tidak ditemukan.');
            }

            // Menghapus kwitansi
            if ($model->delete($nomor) === false) {
                return redirect()->back()->with('error', 'Gagal menghapus kwitansi: ' . implode(", ", $model->errors()));
            }

            // Menampilkan pesan sukses
            return redirect()->to('invoice_or')->with('success', 'Kwitansi OR berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
        }
    }
    // order pos pending
    public function order_pos_pending($id_terima_po)
    {
        $pengerjaanModel = new M_PengerjaanPo();
        $sparepartModel = new M_SparepartPo();
        $gambarModel = new M_GambarPo();
        $dataPO = new M_RepairOrder();

        // Ambil data berdasarkan id_terima_po jika ada
        if ($id_terima_po) {
            $po = $dataPO->where('id_terima_po', $id_terima_po)->first();

            // Jika tidak ada data Repair Order, kembalikan dengan pesan error
            if (!$po) {
                return redirect()->back()->with('error', 'Data Repair Order tidak ditemukan untuk ID terima PO: ' . $id_terima_po);
            }

            // Ambil data pengerjaan, sparepart, dan gambar berdasarkan id_terima_po
            $pengerjaan = $pengerjaanModel->where('id_terima_po', $id_terima_po)->findAll();
            $sparepart = $sparepartModel->where('id_terima_po', $id_terima_po)->findAll();
            $gambar = $gambarModel->where('id_terima_po', $id_terima_po)->findAll();
        } else {
            $po = $dataPO->findAll();
            $pengerjaan = $pengerjaanModel->findAll();
            $sparepart = $sparepartModel->findAll();
            $gambar = $gambarModel->findAll();
        }

        // Menyiapkan data untuk dikirim ke tampilan
        $data = [
            'title' => 'Repair Order',
            'ro' => $po,
            'pengerjaan' => $pengerjaan,
            'spareparts' => $sparepart,
            'gambarData' => $gambar,
            'id_terima_po' => $id_terima_po,
            'is_sent' => $po['is_sent'] ?? 0 // Tambahkan is_sent untuk digunakan di tampilan
        ];
        return view('klaim/order_pospending', $data);
    }

    // kwitansi pending preview


    public function bayar_piutang()
    {
        $pembayaranModel = new M_Pembayaran();
        $userModel = new UserModel();

        $dataPembayaran = $pembayaranModel->getPembayaranWithInvoice();


        $data = [
            'title' => 'Payment',
            'pemb' => $dataPembayaran
        ];

        return view('klaim/bayar_piutang', $data);
    }


    // add pembayaran
    public function add_pembayaran()
    {
        // Load model
        $kwitansi = new M_Kwitansi();
        $generated = new M_Pembayaran();

        $dataKwitansi = $kwitansi->findAll();
        $generated = $generated->generatePembayaran();


        $data = [
            'title' => 'Add Pembayaran',
            'invoices' => $dataKwitansi,
            'id_pembayaran' => $generated
        ];

        // Return view dengan data
        return view('klaim/add_bayar', $data);
    }

    public function add_pembayaran_prev($id_pembayaran)
    {
        $dataBayar = new M_Pembayaran();
        $dataInvoice = new M_Invoice();
        $dataKwitansi = new M_Kwitansi();
        $dataKwitansiOR = new M_KwitansiOR();
        $dataPiutang = new M_Piutang();
        $dataPembayaranInvoice = new M_PembayaranInvoice();
        $coa = new M_Coa();


        // Ambil data pembayaran berdasarkan ID yang diberikan
        $bayar = $dataBayar->where('id_pembayaran', $id_pembayaran)->first();

        if (!$bayar) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Pembayaran tidak ditemukan untuk ID: $id_pembayaran");
        }

        // Ambil data invoice berdasarkan id_pembayaran
        $invoices = $dataInvoice->where('id_pembayaran', $id_pembayaran)->findAll();
        $paymentInvoices = $dataPembayaranInvoice->where('id_pembayaran', $id_pembayaran)->findAll();

        // Ambil data dari model lainnya
        $kwitansiData = $dataKwitansi->findAll();
        $kwitansiORData = $dataKwitansiOR->findAll();
        $piutangData = $dataPiutang->findAll();
        $datacoa = $coa->getSpecificCoa();

        // Ambil id_pembayaran dari data bayar
        $id_pembayaran_value = $bayar['id_pembayaran']; // Ambil id_pembayaran dari hasil $bayar

        // Gabungkan data dari model lainnya
        $dataMerger = array_merge($kwitansiData, $kwitansiORData, $piutangData);

        $data = [
            'title' => 'Add Pembayaran',
            'bayar' => $bayar,
            'invoices' => $invoices,
            'dataMerger' => $dataMerger,
            'paymentInvoices' => $paymentInvoices,
            'id_pembayaran' => $id_pembayaran_value,
            'coa' => $datacoa
        ];

        return view('klaim/add_bayarprev', $data);
    }


    public function createInvoice()
    {
        // Mendapatkan data dari input
        $no_invoice = $this->request->getPost('no_invoice');
        $tgl_invoice = $this->request->getPost('tgl_invoice');
        $asuransi = $this->request->getPost('asuransi');
        $jasa = $this->request->getPost('jasa');
        $sparepart = $this->request->getPost('sparepart');
        $nilai_or = $this->request->getPost('nilai_or');
        $keterangan = $this->request->getPost('keterangan_invoice');
        $total = $this->request->getPost('total');

        // Memanggil model
        $pembayaranModel = new M_Pembayaran();
        $invoiceModel = new M_Invoice();


        $id_pembayaran = $pembayaranModel->generatePembayaran();


        $dataPembayaran = [
            'id_pembayaran' => $id_pembayaran,
            'total_kredit' => $total,
            'tanggal' => $tgl_invoice
        ];


        $dataInvoice = [
            'no_invoice' => $no_invoice,
            'tgl_invoice' => $tgl_invoice,
            'asuransi' => $asuransi,
            'keterangan_invoice' => $keterangan,
            'jasa' => $jasa,
            'sparepart' => $sparepart,
            'nilai_or' => $nilai_or,
            'total' => $total,
            'keterangan' => $keterangan,
            'id_pembayaran' => $id_pembayaran,
        ];

        try {

            $pembayaranModel->insert($dataPembayaran);


            $invoiceModel->insert($dataInvoice);


            session()->setFlashdata('success', 'Invoice berhasil dibuat.');
        } catch (\Exception $e) {

            session()->setFlashdata('error', 'Gagal menyimpan invoice: ' . $e->getMessage());
        }

        return redirect()->to(base_url('add_bayarprev/' . $id_pembayaran));
    }

    public function addInvoice()
    {
        // Load model
        $invoiceModel = new M_Invoice();
        $pembayaranModel = new M_Pembayaran();

        // Dapatkan data input dari form
        $data = [
            'no_invoice' => $this->request->getPost('no_invoice'),
            'tgl_invoice' => $this->request->getPost('tgl_invoice'),
            'asuransi' => $this->request->getPost('asuransi'),
            'jasa' => $this->request->getPost('jasa'),
            'sparepart' => $this->request->getPost('sparepart'),
            'nilai_or' => $this->request->getPost('nilai_or'),
            'total' => $this->request->getPost('total'),
            'keterangan_invoice' => $this->request->getPost('keterangan_invoice'),
            'id_pembayaran' => $this->request->getPost('id_pembayaran'),
        ];

        // Debugging: Cek nilai id_pembayaran
        if (empty($data['id_pembayaran'])) {
            return redirect()->back()->withInput()->with('error', 'ID Pembayaran tidak ditemukan.');
        }

        // Cek apakah id_pembayaran ada di tabel pembayaran
        $existingPembayaran = $pembayaranModel->find($data['id_pembayaran']);
        if (!$existingPembayaran) {
            return redirect()->back()->withInput()->with('error', 'ID Pembayaran tidak ditemukan.');
        }

        // Tambahkan nilai total ke total_kredit di tabel pembayaran
        $totalKreditSebelumnya = $existingPembayaran['total_kredit'];  // Ambil total_kredit yang sudah ada
        $totalBaru = $totalKreditSebelumnya + $data['total'];  // Tambahkan nilai total baru dari invoice

        // Update total_kredit di tabel pembayaran
        $pembayaranModel->update($data['id_pembayaran'], [
            'total_kredit' => $totalBaru,
        ]);

        // Simpan data invoice
        if ($invoiceModel->insert($data)) {
            // Redirect ke add_bayarprev dengan id_pembayaran yang valid
            return redirect()->to('/add_bayarprev/' . $data['id_pembayaran'])->with('success', 'Invoice berhasil ditambahkan dan total kredit diperbarui!');
        } else {
            return redirect()->back()->withInput()->with('errors', $invoiceModel->errors());
        }
    }

    // public function addPembayaran()
    // {
    //     $user_id = session()->get('user_id');
    //     if (!$user_id) {
    //         return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
    //     }

    //     $pembayaranModel = new M_PembayaranInvoice();
    //     $pembayaran = new M_Pembayaran();
    //     $kwitansi = new M_Kwitansi();
    //     $invoiceModel = new M_Invoice();
    //     $modelJurnal = new M_ReportJurnal();
    //     $repair = new M_RepairOrder();


    //     $data = [
    //         'kode_bayar' => $this->request->getPost('kode_bayar'),
    //         'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
    //         'no_bukti' => $this->request->getPost('no_bukti'),
    //         'kode_bank' => $this->request->getPost('bank'),
    //         'debet' => str_replace('.', '', $this->request->getPost('debet')),
    //         'jatuh_tempo' => $this->request->getPost('tanggal'),
    //         'id_pembayaran' => $this->request->getPost('id_pembayaran'),
    //     ];


    //     if (empty($data['id_pembayaran'])) {
    //         return redirect()->back()->withInput()->with('error', 'ID Pembayaran tidak ditemukan.');
    //     }

    //     // Cek apakah id_pembayaran ada di tabel pembayaran
    //     $existingPembayaran = $pembayaran->find($data['id_pembayaran']);
    //     if (!$existingPembayaran) {
    //         return redirect()->back()->withInput()->with('error', 'ID Pembayaran tidak ditemukan.');
    //     }

    //     // Log data sebelum simpan
    //     log_message('debug', 'Data pembayaran: ' . print_r($data, true));

    //     // Simpan data pembayaran ke tabel M_PembayaranInvoice
    //     if ($pembayaranModel->insert($data) === false) {
    //         log_message('error', 'Error saat menyimpan pembayaran: ' . print_r($pembayaranModel->errors(), true));
    //         return redirect()->to('/add_bayarprev/' . $data['id_pembayaran'])->with('errors', $pembayaranModel->errors());
    //     }

    //     // Update total_debet di M_Pembayaran
    //     $totalDebetBaru = $existingPembayaran['total_debet'] + $data['debet'];
    //     $pembayaran->update($data['id_pembayaran'], ['total_debet' => $totalDebetBaru]);

    //     // Ambil no_invoice dari M_Invoice berdasarkan id_pembayaran
    //     $invoice = $invoiceModel->where('id_pembayaran', $data['id_pembayaran'])->first();
    //     if ($invoice) {
    //         $noInvoiceSTK = $invoice['no_invoice']; // Ambil no_invoice dari invoice

    //         // Cek apakah ada entry di M_Kwitansi untuk no_invoice yang didapat
    //         $existingKwitansi = $kwitansi->where('nomor', $noInvoiceSTK)->first();
    //         if ($existingKwitansi) {
    //             // Jika ada, tambahkan nilai debet ke nilai_tagihan di M_Kwitansi
    //             $newNilaiTagihan = $existingKwitansi['nilai_tagihan'] + $data['debet'];
    //             $kwitansi->update($existingKwitansi['nomor'], ['nilai_tagihan' => $newNilaiTagihan]);
    //         } else {
    //             // // Jika tidak ada entry, Anda bisa memilih untuk membuatnya atau melakukan tindakan lain
    //             // // Contoh membuat entry baru:
    //             // $kwitansi->insert([
    //             //     'nomor' => $noInvoiceSTK,
    //             //     'nilai_tagihan' => $data['debet'],
    //             //     // tambahkan field lain yang diperlukan
    //             // ]);
    //         }
    //     }
    //     // Ambil no_invoice dari M_Invoice berdasarkan id_pembayaran
    //     $invoice = $invoiceModel->where('id_pembayaran', $data['id_pembayaran'])->first();
    //     if ($invoice) {
    //         $noInvoiceSTK = $invoice['no_invoice']; // Ambil no_invoice dari invoice

    //         // Cek apakah ada entry di M_Kwitansi untuk no_invoice yang didapat
    //         $existingKwitansi = $kwitansi->where('nomor', $noInvoiceSTK)->first();
    //         if ($existingKwitansi) {
    //             // Data dari M_Kwitansi yang akan digunakan
    //             $customerName = $existingKwitansi['customer_name'];
    //             $jenisMobil = $existingKwitansi['jenis_mobil'];
    //             $noKendaraan = $existingKwitansi['no_kendaraan'];

    //             // Kirim ke jurnal
    //             $doc_no = 'PP.' . $this->request->getPost('id_pembayaran');
    //             $nilai_total = $this->request->getPost('debet');
    //             $jenis_bayar = $this->request->getPost('kode_bayar');
    //             $tanggal = $this->request->getPost('tanggal') ?: date('Y-m-d');

    //             // Kondisi untuk jenis bayar TRANSFER BCA
    //             if ($jenis_bayar === 'REK BCA') {
    //                 $dataBank = [
    //                     'date' => $tanggal,
    //                     'doc_no' => $doc_no,
    //                     'account' => '11113',
    //                     'name' => 'REK BCA',
    //                     'description' => 'PEMBAYARAN PIUTANG ' . $customerName . ' / ' . $jenisMobil . ' ' . $noKendaraan,
    //                     'debit' => $nilai_total,
    //                     'kredit' => 0,
    //                     'aksi' => 'Posted',
    //                     'user_id' => $user_id,
    //                 ];

    //                 // Simpan ke database k_kasbank
    //                 $modelJurnal->insert($dataBank);

    //                 $dataTotal = [
    //                     'date' => $tanggal,
    //                     'doc_no' => $doc_no,
    //                     'account' => '11200',
    //                     'name' => 'PIUTANG USAHA',
    //                     'description' => 'PEMBAYARAN PIUTANG ' . $customerName . ' / ' . $jenisMobil . ' ' . $noKendaraan,
    //                     'debit' => 0,
    //                     'kredit' => $nilai_total,
    //                     'user_id' => $user_id,
    //                 ];

    //                 // Simpan ke database k_kasbank
    //                 $modelJurnal->insert($dataTotal);
    //             }

    //             // Kondisi untuk jenis bayar CASH
    //             if ($jenis_bayar === 'KAS BESAR') {
    //                 $dataBank = [
    //                     'date' => $tanggal,
    //                     'doc_no' => $doc_no,
    //                     'account' => '11102',
    //                     'name' => 'KAS BESAR',
    //                     'description' => 'PEMBAYARAN PIUTANG ' . $customerName . ' / ' . $jenisMobil . ' ' . $noKendaraan,
    //                     'debit' => $nilai_total,
    //                     'kredit' => 0,
    //                     'aksi' => 'Posted',
    //                     'user_id' => $user_id,
    //                 ];

    //                 // Simpan ke database k_kasbank
    //                 $modelJurnal->insert($dataBank);

    //                 $dataBank = [
    //                     'date' => $tanggal,
    //                     'doc_no' => $doc_no,
    //                     'account' => '11200',
    //                     'name' => 'PIUTANG USAHA',
    //                     'description' => 'PEMBAYARAN PIUTANG ' . $customerName . ' / ' . $jenisMobil . ' ' . $noKendaraan,
    //                     'debit' => 0,
    //                     'kredit' => $nilai_total,
    //                     'user_id' => $user_id,
    //                 ];

    //                 // Simpan ke database k_kasbank
    //                 $modelJurnal->insert($dataBank);
    //             }
    //         }
    //     }
    //     if ($invoice) {
    //         $noInvoiceSTK = $invoice['no_invoice'];

    //         $existingKwitansi = $kwitansi->where('nomor', $noInvoiceSTK)->first();
    //         if ($existingKwitansi) {
    //             $noOrder = $existingKwitansi['no_order'];

    //             $repairOrder = $repair->where('id_terima_po', $noOrder)->first();
    //             if ($repairOrder) {
    //                 $repair->update($repairOrder['id_repair_order'], ['status_bayar' => 'Lunas']);
    //             }
    //         }
    //     }

    //     return redirect()->to('/add_bayarprev/' . $data['id_pembayaran'])->with('success', 'Pembayaran berhasil!');
    // }

    public function addPembayaran()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        // Mengambil data dari form
        $data = [
            'kode_bayar' => $this->request->getPost('kode_bayar'),
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
            'no_bukti' => $this->request->getPost('no_bukti'),
            'kode_bank' => $this->request->getPost('bank'),
            'debet' => str_replace('.', '', $this->request->getPost('debet')),
            'jatuh_tempo' => $this->request->getPost('tanggal'),
            'id_pembayaran' => $this->request->getPost('id_pembayaran'),
        ];

        // Cek apakah ID Pembayaran valid
        if (empty($data['id_pembayaran'])) {
            return redirect()->back()->withInput()->with('error', 'ID Pembayaran tidak ditemukan.');
        }

        // Model yang digunakan
        $pembayaranModel = new M_PembayaranInvoice();
        $pembayaran = new M_Pembayaran();
        $kwitansi = new M_Kwitansi();
        $invoiceModel = new M_Invoice();
        $modelJurnal = new M_ReportJurnal();
        $repair = new M_RepairOrder();

        // Cek apakah ID Pembayaran ada di tabel pembayaran
        $existingPembayaran = $pembayaran->find($data['id_pembayaran']);
        if (!$existingPembayaran) {
            return redirect()->back()->withInput()->with('error', 'ID Pembayaran tidak ditemukan.');
        }

        // Log data sebelum simpan
        log_message('debug', 'Data pembayaran: ' . print_r($data, true));

        // Simpan data pembayaran ke tabel M_PembayaranInvoice
        if ($pembayaranModel->insert($data) === false) {
            log_message('error', 'Error saat menyimpan pembayaran: ' . print_r($pembayaranModel->errors(), true));
            return redirect()->to('/add_bayarprev/' . $data['id_pembayaran'])->with('errors', $pembayaranModel->errors());
        }

        // Update total_debet di M_Pembayaran
        $totalDebetBaru = $existingPembayaran['total_debet'] + $data['debet'];
        $pembayaran->update($data['id_pembayaran'], ['total_debet' => $totalDebetBaru]);

        // Ambil data invoice berdasarkan ID Pembayaran
        $invoice = $invoiceModel->where('id_pembayaran', $data['id_pembayaran'])->first();
        if ($invoice) {
            $nilai_total = $invoice['total']; // Nilai total dari M_Invoice
        } else {
            return redirect()->back()->withInput()->with('error', 'Invoice tidak ditemukan.');
        }

        // Perhitungan baru
        $nilai_sparepart = 0.12 * $invoice['total']; // 12% dari nilai_total
        $nilai_setelah_sparepart = $invoice['total'] - $nilai_sparepart; // Kurangi nilai_total dengan nilai_sparepart
        $nilai_jasa = $nilai_setelah_sparepart * 0.20; // 20% dari sisa nilai setelah sparepart untuk jasa
        $nilai_sisa = $nilai_setelah_sparepart * 0.80; // 80% dari sisa nilai setelah sparepart
        $nilai_cat = $nilai_sisa * 0.60; // 60% dari 80% untuk cat
        $nilai_non_cat = $nilai_sisa * 0.40; // 40% dari 80% untuk non-cat



        // Ambil data kwitansi berdasarkan no_invoice
        $existingKwitansi = $kwitansi->where('nomor', $invoice['no_invoice'])->first();
        if ($existingKwitansi) {
            $noKendaraan = $existingKwitansi['no_kendaraan'];
            $jenisMobil = $existingKwitansi['jenis_mobil'];
            $customerName = $existingKwitansi['customer_name'];
        } else {
            return redirect()->back()->withInput()->with('error', 'Kwitansi tidak ditemukan.');
        }

        // Ambil nilai sparepart dari invoice

        // Data Jurnal untuk Pembayaran Asuransi dan Pembayaran OR
        $metodePembayaran = $data['metode_pembayaran'];
        $tanggal = $data['jatuh_tempo'] ?: date('Y-m-d');
        $doc_no = 'JP.' . $data['id_pembayaran'];
        $nilai_or = $data['debet'];
        $qty_or = isset($data['qty_or']) ? $data['qty_or'] : 1;

        // Kondisi untuk Pembayaran Asuransi
        if ($metodePembayaran === 'Pembayaran Asuransi' && $data['kode_bayar'] === 'REK BCA') {
            // Entry untuk REK BCA
            $dataBank = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => '11113',
                'name' => 'REK BCA',
                'description' => 'PENDAPATAN REPAIR ' . $noKendaraan . ' ' . $jenisMobil . ' ' . $customerName,
                'debit' => $nilai_total,
                'kredit' => 0,
                'aksi' => 'Posted',
                'user_id' => session()->get('user_id'),
            ];

            // Simpan ke database jurnal
            $modelJurnal->insert($dataBank);

            // Entry untuk Jasa (20% dari nilai total)
            $dataJasa = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => '41110',
                'name' => 'PENDAPATAN JASA PENGECATAN',
                'description' => 'JASA ' . $noKendaraan . ' ' . $jenisMobil . ' ' . $customerName,
                'debit' => 0,
                'kredit' => $nilai_jasa, // 20% dari nilai total
                'user_id' => session()->get('user_id'),
            ];

            $modelJurnal->insert($dataJasa);

            // Entry untuk Cat (60% dari 80% nilai total)
            $dataCat = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => '41140',
                'name' => 'PENDAPATAN BAHAN CAT',
                'description' => 'BAHAN CAT ' . $noKendaraan . ' ' . $jenisMobil . ' ' . $customerName,
                'debit' => 0,
                'kredit' => $nilai_cat, // 60% dari 80% nilai total
                'user_id' => session()->get('user_id'),
            ];

            $modelJurnal->insert($dataCat);

            // Entry untuk Non-Cat (40% dari 80% nilai total)
            $dataNonCat = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => '41130',
                'name' => 'PENDAPATAN BAHAN NON CAT',
                'description' => 'BAHAN NON CAT ' . $noKendaraan . ' ' . $jenisMobil . ' ' . $customerName,
                'debit' => 0,
                'kredit' => $nilai_non_cat, // 40% dari 80% nilai total
                'user_id' => session()->get('user_id'),
            ];

            $modelJurnal->insert($dataNonCat);

            // Entry untuk Sparepart
            $dataSparepart = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => '41120',
                'name' => 'PENDAPATAN PENJUALAN SPAREPART',
                'description' => 'PENJUALAN SPAREPART ' . $noKendaraan . ' ' . $jenisMobil . ' ' . $customerName,
                'debit' => 0,
                'kredit' => $nilai_sparepart, // Nilai total untuk sparepart
                'user_id' => session()->get('user_id'),
            ];

            $modelJurnal->insert($dataSparepart);
        }

        // Kondisi untuk Pembayaran Asuransi KAS BESAR
        if ($metodePembayaran === 'Pembayaran Asuransi' && $data['kode_bayar'] === 'KAS BESAR') {
            // Entry untuk REK BCA
            $dataBank = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => '11112',
                'name' => 'KAS BESAR',
                'description' => 'PENDAPATAN REPAIR ' . $noKendaraan . ' ' . $jenisMobil . ' ' . $customerName,
                'debit' => $nilai_total,
                'kredit' => 0,
                'aksi' => 'Posted',
                'user_id' => session()->get('user_id'),
            ];

            // Simpan ke database jurnal
            $modelJurnal->insert($dataBank);

            // Entry untuk Jasa (20% dari nilai total)
            $dataJasa = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => '41110',
                'name' => 'PENDAPATAN JASA PENGECATAN',
                'description' => 'JASA ' . $noKendaraan . ' ' . $jenisMobil . ' ' . $customerName,
                'debit' => 0,
                'kredit' => $nilai_jasa, // 20% dari nilai total
                'user_id' => session()->get('user_id'),
            ];

            $modelJurnal->insert($dataJasa);

            // Entry untuk Cat (60% dari 80% nilai total)
            $dataCat = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => '41140',
                'name' => 'PENDAPATAN BAHAN CAT',
                'description' => 'BAHAN CAT ' . $noKendaraan . ' ' . $jenisMobil . ' ' . $customerName,
                'debit' => 0,
                'kredit' => $nilai_cat, // 60% dari 80% nilai total
                'user_id' => session()->get('user_id'),
            ];

            $modelJurnal->insert($dataCat);

            // Entry untuk Non-Cat (40% dari 80% nilai total)
            $dataNonCat = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => '41130',
                'name' => 'PENDAPATAN BAHAN NON CAT',
                'description' => 'BAHAN NON CAT ' . $noKendaraan . ' ' . $jenisMobil . ' ' . $customerName,
                'debit' => 0,
                'kredit' => $nilai_non_cat, // 40% dari 80% nilai total
                'user_id' => session()->get('user_id'),
            ];

            $modelJurnal->insert($dataNonCat);

            // Entry untuk Sparepart
            $dataSparepart = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => '41120',
                'name' => 'PENDAPATAN PENJUALAN SPAREPART',
                'description' => 'PENJUALAN SPAREPART ' . $noKendaraan . ' ' . $jenisMobil . ' ' . $customerName,
                'debit' => 0,
                'kredit' => $nilai_sparepart, // Nilai total untuk sparepart
                'user_id' => session()->get('user_id'),
            ];

            $modelJurnal->insert($dataSparepart);
        }

        // Kondisi untuk Pembayaran OR
        if ($metodePembayaran === 'Pembayaran OR' && $data['kode_bayar'] === 'REK BCA') {
            // Entry untuk REK BCA
            $dataBank = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => '11113',
                'name' => 'REK BCA',
                'description' => $qty_or . 'X OR ' . $jenisMobil . ' ' . $noKendaraan . ' ' . $customerName,
                'debit' => $nilai_or,
                'kredit' => 0,
                'aksi' => 'Posted',
                'user_id' => session()->get('user_id'),
            ];

            // Simpan ke database jurnal
            $modelJurnal->insert($dataBank);

            // Entry untuk Pendapatan OR
            $dataPendapatan = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => '41150',
                'name' => 'PENERIMAAN OR',
                'description' => $qty_or . 'X OR ' . $jenisMobil . ' ' . $noKendaraan . ' ' . $customerName,
                'debit' => 0,
                'kredit' => $nilai_or,
                'user_id' => session()->get('user_id'),
            ];

            // Simpan ke database jurnal
            $modelJurnal->insert($dataPendapatan);
        }

        // Kondisi untuk jenis bayar KAS BESAR dan Pembayaran OR
        if ($metodePembayaran === 'Pembayaran OR' && $data['kode_bayar'] === 'KAS BESAR') {
            // Entry untuk KAS BESAR
            $dataBank = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => '11112', // KAS BESAR
                'name' => 'KAS BESAR',
                'description' => $qty_or . 'X OR ' . $jenisMobil . ' ' . $noKendaraan . ' ' . $customerName,
                'debit' => $nilai_total,
                'kredit' => 0,
                'aksi' => 'Posted',
                'user_id' => $user_id,
            ];

            // Simpan ke database k_kasbank
            $modelJurnal->insert($dataBank);

            // Entry untuk Pendapatan OR
            $dataPendapatan = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => '41150',  // Account untuk Pendapatan OR
                'name' => 'PENERIMAAN OR',
                'description' => $qty_or . 'X OR ' . $jenisMobil . ' ' . $noKendaraan . ' ' . $customerName,
                'debit' => 0,
                'kredit' => $nilai_total,
                'user_id' => $user_id,
            ];

            // Simpan ke database k_kasbank
            $modelJurnal->insert($dataPendapatan);
        }
        if ($invoice) {
            $noInvoiceSTK = $invoice['no_invoice'];

            $existingKwitansi = $kwitansi->where('nomor', $noInvoiceSTK)->first();
            if ($existingKwitansi) {
                $noOrder = $existingKwitansi['no_order'];

                $repairOrder = $repair->where('id_terima_po', $noOrder)->first();
                if ($repairOrder) {
                    // Update status_bayar di RepairOrder berdasarkan metode pembayaran
                    if ($data['metode_pembayaran'] === 'Pembayaran OR') {
                        $repair->update($repairOrder['id_repair_order'], ['status_bayar' => 'Sudah Bayar OR']);
                    } elseif ($data['metode_pembayaran'] === 'Pembayaran Asuransi') {
                        $repair->update($repairOrder['id_repair_order'], ['status_bayar' => 'Sudah Bayar']);
                    }
                }
            }

            // Tambahan: Update M_Kwitansi untuk Pembayaran Asuransi dan Pembayaran OR
            if ($data['metode_pembayaran'] === 'Pembayaran Asuransi') {
                $kwitansi->update($existingKwitansi['nomor'], ['pemb_asuransi' => 'Sudah Bayar']);
            }

            if ($data['metode_pembayaran'] === 'Pembayaran OR') {
                $kwitansi->update($existingKwitansi['nomor'], ['pemb_or' => 'Sudah Bayar']);
            }
        }



        return redirect()->to('/add_bayarprev/' . $data['id_pembayaran'])->with('success', 'Pembayaran berhasil!');
    }




    public function Repair_Selesai()
    {

        $data = [
            'title' => 'Repair Selesai',
        ];
        return view('klaim/repair_selesai', $data);
    }

    public function mobil_batal()
    {
        $poModel = new M_Po();
        $poData = $poModel->getPoWithUsername();
        $accData = $poModel->getPoWithAccAsuransi();

        foreach ($poData as &$po_item) {
            foreach ($accData as $acc_item) {
                if ($po_item['id_terima_po'] === $acc_item['id_terima_po']) {
                    $po_item['tgl_acc'] = $acc_item['tgl_acc'];
                    $po_item['harga_acc'] = $acc_item['harga_acc'];
                    break;
                }
            }
        }

        $preOrderId = $poModel->generateIdTerimaPo();
        $idPo = $poModel->generateIdPo();

        $data = [
            'title' => 'Mobil Batal Masuk',
            'preOrderId' => $preOrderId,
            'idPo' => $idPo,
            'po' => $poData,
        ];

        return view('klaim/mobil_batal', $data);
    }
    public function mobil_batal_asuransi()
    {
        $poModel = new M_Po();
        $poData = $poModel->getPoWithUsername();
        $accData = $poModel->getPoWithAccAsuransi();

        foreach ($poData as &$po_item) {
            foreach ($accData as $acc_item) {
                if ($po_item['id_terima_po'] === $acc_item['id_terima_po']) {
                    $po_item['tgl_acc'] = $acc_item['tgl_acc'];
                    $po_item['harga_acc'] = $acc_item['harga_acc'];
                    break;
                }
            }
        }

        $preOrderId = $poModel->generateIdTerimaPo();
        $idPo = $poModel->generateIdPo();

        $data = [
            'title' => 'Batal Klaim Asuransi',
            'preOrderId' => $preOrderId,
            'idPo' => $idPo,
            'po' => $poData,
        ];

        return view('klaim/mobil_batal_asuransi', $data);
    }
}
