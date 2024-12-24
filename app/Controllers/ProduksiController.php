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
        $ro = $this->repairOrderModel->findAll();
        $data = [
            'title' => 'Head Produksi',
            'ro' => $ro
        ];
        return view('produksi/headproduksi', $data);
    }

    public function kelolaproduksi()
    {
        $ro = $this->repairOrderModel->findAll();
        $data = [
            'title' => 'Kelola Produksi',
            'ro' => $ro
        ];
        return view('produksi/kelolaproduksi', $data);
    }

}