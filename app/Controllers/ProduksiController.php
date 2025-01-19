<?php

namespace App\Controllers;

use App\Models\M_RepairOrder;
use CodeIgniter\Controller;



class ProduksiController extends Controller
{
    protected $repairOrderModel;

    public function __construct()
    {
        $this->repairOrderModel = new M_RepairOrder();
    }

    public function headproduksi()
    {
        $statuses = ['Ketok', 'Epoxy', 'Dempul', 'Cat', 'Beres Pengerjaan'];
        $repairOrders = $this->repairOrderModel->whereIn('progres_pengerjaan', $statuses)->findAll();
        $data = [
            'title' => 'Head Produksi',
            'repairOrders' => $repairOrders,
        ];
        return view('produksi/headproduksi', $data);
    }


    // Method untuk mengupdate progress dari Head Produksi
    public function updateProgressHead()
    {
        $id = $this->request->getPost('id_repair_order');
        $newProgress = $this->request->getPost('progres_pengerjaan');

        // Data progress yang valid sesuai ENUM
        $validProgress = [
            'Ketok',
            'Dempul',
            'Epoxy',
            'Cat',
            'Poles',
            'Beres Pengerjaan',
            'Menunggu Comment User',
            'Kurang Dokumen',
            'Sparepart',
            'Data Completed'
        ];

        if (!in_array($newProgress, $validProgress)) {
            return redirect()->to('/produksi/headproduksi')->with('error', 'Nilai progres pengerjaan tidak valid.');
        }

        // Ambil data repair order dari database
        $repairOrder = $this->repairOrderModel->find($id);

        if (!$repairOrder) {
            return redirect()->to('/produksi/headproduksi')->with('error', 'Data tidak ditemukan.');
        }

        // Update progress tanpa batasan maju/mundur
        $updated = $this->repairOrderModel->update($id, ['progres_pengerjaan' => $newProgress]);

        if ($updated) {
            return redirect()->to('/produksi/headproduksi')->with('success', 'Progress berhasil diupdate.');
        } else {
            return redirect()->to('/produksi/headproduksi')->with('error', 'Gagal mengupdate progress.');
        }
    }

    public function kelolaproduksi()
    {
        $statuses = ['Ketok', 'Epoxy', 'Dempul', 'Cat', 'Beres Pengerjaan'];

        $repairOrders = $this->repairOrderModel->whereIn('progres_pengerjaan', $statuses)->findAll();
        $data = [
            'title' => 'Kelola Produksi',
            'repairOrders' => $repairOrders,
        ];
        return view('produksi/kelolaproduksi', $data);
    }

    public function updateProgressKelola()
    {
        $id = $this->request->getPost('id_repair_order');
        $newProgress = $this->request->getPost('progres_pengerjaan');
        $validProgress = [
            'Ketok',
            'Dempul',
            'Epoxy',
            'Cat',
            'Poles',
            'Beres Pengerjaan',
            'Menunggu Comment User',
            'Kurang Dokumen',
            'Sparepart',
            'Data Completed'
        ];

        if (!in_array($newProgress, $validProgress)) {
            return redirect()->to('/produksi/kelolaproduksi')->with('error', 'Nilai progres pengerjaan tidak valid.');
        }
        $repairOrder = $this->repairOrderModel->find($id);

        if (!$repairOrder) {
            return redirect()->to('/produksi/kelolaproduksi')->with('error', 'Data tidak ditemukan.');
        }

        $currentIndex = array_search($repairOrder['progres_pengerjaan'], $validProgress);
        $newIndex = array_search($newProgress, $validProgress);
        if ($newIndex < $currentIndex) {
            return redirect()->to('/produksi/kelolaproduksi')->with('error', 'Tidak dapat kembali ke proses sebelumnya. Kecuali Role Head Produksi.');
        }
        $this->repairOrderModel->update($id, ['progres_pengerjaan' => $newProgress]);

        return redirect()->to('/produksi/kelolaproduksi')->with('success', 'Progress berhasil diupdate.');
    }

    public function getRepairOrderDetail($id)
    {
        // Ambil detail repair order berdasarkan ID
        $repairOrder = $this->repairOrderModel->find($id);

        if ($repairOrder) {
            return $this->response->setJSON($repairOrder);
        } else {
            return $this->response->setJSON(['error' => 'Data tidak ditemukan']);
        }
    }
}
