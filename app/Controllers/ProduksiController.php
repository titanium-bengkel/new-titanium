<?php

namespace App\Controllers;

use App\Models\ProduksiModel;
use CodeIgniter\Controller;


class ProduksiController extends Controller
{
    protected $produksiModel;

    public function __construct()
    {
        // $this->produksiModel = new ProduksiModel();
    }

    public function headproduksi()
    {
        $data = [
            'title' => 'Head Produksi'
        ];
        return view('produksi/headproduksi', $data);
    }

    public function kelolaproduksi()
    {
        $data = [
            'title' => 'Kelola Produksi',
        ];
        return view('produksi/kelolaproduksi', $data);
    }
}