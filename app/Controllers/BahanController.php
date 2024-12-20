<?php

namespace App\Controllers;


use App\Models\M_Barang_Bahan;
use App\Models\M_Part_Terima;
use App\Models\UserModel;
use App\Models\M_Po_Bahan;
use App\Models\M_Detail_Barang;
use App\Models\M_ReportJurnal;
use App\Models\M_Terima_Bahan;
use App\Models\M_Detail_Terima;
use App\Models\M_Bahan_Repair;
use App\Models\M_Detail_Repair;
use App\Models\M_Gd_Bahan;
use App\Models\M_Kartu_Stok;
use App\Models\M_KasKecil;
use App\Models\M_Coa;


class BahanController extends BaseController
{

    public function pemesanan_bahan()
    {
        $bahanModel = new M_Po_Bahan();
        $userModel = new UserModel();

        $bahan = $bahanModel->orderBy('id_po_bahan', 'DESC')->findAll();

        foreach ($bahan as &$item) {
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Pemesanan Bahan',
            'bahan' => $bahan
        ];

        return view('bahan/po_bahan', $data);
    }


    public function add_bahan()
    {
        $bahanModel = new M_Po_Bahan();
        $bahanData = new M_Barang_Bahan();

        $supplierData = $bahanModel->getAllSupplier();
        $bahanData = $bahanData->findAll(100);
        $poData = $bahanModel->getAllPO();

        $data = [
            'title' => 'Pemesanan Bahan',
            'generatedId' => $bahanModel->generateId(),
            'supplier' => $supplierData,
            'bahan' => $bahanData,
            'po' => $poData,
        ];
        return view('bahan/order_bahan', $data);
    }

    // create barang
    public function create_bahan()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $poBahanModel = new M_Po_Bahan();
        $detailBarangModel = new M_Detail_Barang();
        $GenerateId = $poBahanModel->generateId();

        // Mengambil dan memproses input qty dan harga dengan str_replace untuk menghilangkan format angka yang salah
        $qty = array_map(function ($qty) {
            return (float) str_replace(',', '', $qty); // Remove commas for thousands
        }, $this->request->getPost('qty'));

        $harga = array_map(function ($harga) {
            return (float) str_replace([',', '.'], '', $harga); // Remove commas and periods
        }, $this->request->getPost('harga'));

        // Menghitung jumlah, total qty, dan total jumlah
        $jumlah = array_map(function ($qty, $harga) {
            return $qty * $harga;
        }, $qty, $harga);

        $total_qty_b = array_sum($qty);
        $total_jumlah = array_sum($jumlah);

        // Convert inputs to uppercase where applicable
        $data = [
            'id_po_bahan' => strtoupper($this->request->getPost('id_po_bahan')),
            'tanggal' => $this->request->getPost('tanggal'),
            'kode_supplier' => strtoupper($this->request->getPost('kode_supplier')),
            'supplier' => strtoupper($this->request->getPost('supplier')),
            'jatuh_tempo' => $this->request->getPost('jatuh_tempo'),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'total_qty_b' => $total_qty_b,
            'total_jumlah' => $total_jumlah,
            'user_id' => $user_id
        ];

        // Simpan data PO Bahan
        $poBahanModel->insert($data);

        // Mengambil input tambahan qty_t, sat_t, qty_k, dan sat_k
        $id_kode_barang = $this->request->getPost('id_id_kode_barang');
        $nama_barang = $this->request->getPost('nama_barang');
        $satuan = $this->request->getPost('satuan');
        $qty = $this->request->getPost('qty');
        $ceklis = $this->request->getPost('ceklis');

        if ($id_kode_barang) {
            foreach ($id_kode_barang as $index => $kode) {
                $barangData = [
                    'id_kode_barang' => strtoupper($kode),
                    'nama_barang' => strtoupper($nama_barang[$index]),
                    'qty' => $qty[$index],
                    'satuan' => strtoupper($satuan[$index]),
                    'harga' => $harga[$index],
                    'jumlah' => $jumlah[$index],
                    'id_po_bahan' => strtoupper($data['id_po_bahan']),
                    'ceklis' => isset($ceklis[$index]) ? 1 : 0
                ];

                // Simpan data barang
                $detailBarangModel->insert($barangData);
            }
        }

        return redirect()->to(base_url('/order_bahanprev/' . $GenerateId))->with('message', 'Success.');
    }





    public function delete_bahan($id)
    {
        $db = \Config\Database::connect();
        $db->transStart(); // Memulai transaksi

        // Menghapus data terkait di tabel detail_barang
        $detailBarangModel = new M_Detail_Barang();
        $detailBarangModel->where('id_po_bahan', $id)->delete();

        // Menghapus data di tabel po_bahan
        $poBahanModel = new M_Po_Bahan();
        $poBahanModel->where('id_po_bahan', $id)->delete();

        $db->transComplete(); // Menyelesaikan transaksi

        if ($db->transStatus() === FALSE) {
            return redirect()->to('po_bahan')->with('error', 'Data gagal dihapus');
        } else {
            return redirect()->to('po_bahan')->with('berhasil', 'Data berhasil dihapus');
        }
    }
    public function prev_bahan($id_po_bahan)
    {
        $bahanModel = new M_Po_Bahan();
        $dataBahan = $bahanModel->find($id_po_bahan);

        if ($dataBahan) {
            // Ambil detail barang dari tabel detail po_bahan
            $detailModel = new M_Detail_Barang();
            $detailBarang = $detailModel->where('id_po_bahan', $id_po_bahan)->findAll();

            // Hitung total qty_b dan total jumlah
            $totalQty_b = 0;
            $totalJumlah = 0;

            foreach ($detailBarang as $detail) {
                $totalQty_b += $detail['qty']; // Hanya menghitung qty_b
                $totalJumlah += $detail['jumlah']; // Menghitung total jumlah
            }

            $data = [
                'title' => 'Pemesanan Bahan',
                'bahan' => $dataBahan,
                'detail_barang' => $detailBarang,
                'total_qty_b' => $totalQty_b, // Total qty_b
                'total_jumlah' => $totalJumlah, // Total jumlah
            ];
            return view('bahan/order_bahanprev', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }



    // TERIMA BARANG------------------------------------------------------------------------------------------
    public function penerimaan_bahan()
    {
        $TerimaBahanModel = new M_Terima_Bahan();
        $userModel = new UserModel();

        $bahan = $TerimaBahanModel->orderBy('id_penerimaan', 'DESC')->findAll();

        foreach ($bahan as &$item) {
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Penerimaan Bahan',
            'bahan' => $bahan
        ];

        return view('bahan/terima_bahan', $data);
    }


    public function bahan_terima_add($id_po_bahan = null)
    {
        $TerimaBahanModel = new M_Terima_Bahan();
        $poBahan = new M_Po_Bahan();
        $coa = new M_Coa();

        $dataPoBahanWithDetail = $poBahan->getByIdBahan($id_po_bahan);

        // Ambil data supplier dan PO bahan
        $supplierData = $TerimaBahanModel->getAllSupplier();
        $bahanData = $TerimaBahanModel->getAllBahan();
        $dataPoBahanWithDetail = $poBahan->getPoBahanWithSupplier();
        $coamodel = $coa->getCoaBahan();

        // Siapkan data untuk dikirim ke view
        $data = [
            'title' => 'Penerimaan Bahan',
            'generatedIdTerima' => $TerimaBahanModel->generateIdTerima(),
            'supplier' => $supplierData,
            'bahan' => $bahanData,
            'po_bahan' => $dataPoBahanWithDetail,
            'coa' => $coamodel
        ];


        return view('bahan/order_terima_bahan', $data);
    }

    public function getDetailBarang($id_po_bahan)
    {
        $detailBarangModel = new M_Detail_Barang();

        $detailBarang = $detailBarangModel->getDetailByIdPoBahan($id_po_bahan);
        return $this->response->setJSON($detailBarang);
    }

    // create terima

    public function create_terima()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'User ID tidak ditemukan dalam sesi'
            ]);
        }

        $terimaBahanModel = new M_Terima_Bahan();
        // $generated = new M_Terima_Bahan();
        $detailTerimaModel = new M_Detail_Terima();
        $gdBahanModel = new M_Gd_Bahan();
        $poBahanModel = new M_Po_Bahan();
        $kartuStokModel = new M_Kartu_Stok();
        $modelJurnal = new M_ReportJurnal();
        $modelKasKecil = new M_KasKecil();
        $GenerateIdT = $terimaBahanModel->generateIdTerima();

        // Mengambil data dari request
        $dataBahan = [
            'id_penerimaan' => $GenerateIdT,
            'tanggal' => $this->request->getPost('tgl'),
            'kode_supplier' => strtoupper($this->request->getPost('kode_supplier')),
            'supplier' => strtoupper($this->request->getPost('supplier')),
            'jatuh_tempo' => $this->request->getPost('jatuh_tempo'),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'gudang' => strtoupper($this->request->getPost('gudang')),
            'nomor' => strtoupper($this->request->getPost('nomor')),
            'kota' => strtoupper($this->request->getPost('kota')),
            'alamat' => strtoupper($this->request->getPost('alamat')),
            'pembayaran' => strtoupper($this->request->getPost('pembayaran')),
            'ppn' => 11,
            'term' => $this->request->getPost('term'),
            'total_qty' => 0,
            'total_jumlah' => 0,
            'nilai_ppn' => 0,
            'netto' => 0,
            'user_id' => $user_id
        ];

        // Pengambilan data detail dari request
        $kode_barang = $this->request->getPost('id_kode_barang');
        $nama_barang = $this->request->getPost('nama_barang');
        $id_po_bahan = $this->request->getPost('id_po_bahan');
        $qty_k = $this->request->getPost('qty_k');
        $sat_k = $this->request->getPost('sat_k');
        $qty_t = $this->request->getPost('qty_t');
        $sat_t = $this->request->getPost('sat_t');
        $qty_b = $this->request->getPost('qty_b');
        $sat_b = $this->request->getPost('sat_b');
        $harga = $this->request->getPost('harga');
        $disc = $this->request->getPost('disc');
        $ceklis = $this->request->getPost('ceklis');

        if (!empty($kode_barang)) {
            foreach ($kode_barang as $index => $kode) {
                $qty_b_clean = str_replace(',', '', $qty_b[$index]);
                $qty_clean = str_replace(',', '', $qty_k[$index]);
                $harga_clean = str_replace(',', '', $harga[$index]);
                $disc_clean = str_replace(',', '', $disc[$index]);

                // Perhitungan jumlah dan diskon
                $jumlah_sebelum_diskon = $qty_b_clean * $harga_clean;
                $jumlah = $jumlah_sebelum_diskon - ($jumlah_sebelum_diskon * ($disc_clean / 100));

                $dataBahan['total_qty'] += $qty_clean;
                $dataBahan['total_jumlah'] += $jumlah;

                // Update data stok atau masukkan data baru ke tabel gd_bahan
                $existingBahan = $gdBahanModel->where(['kode_bahan' => $kode, 'nama_bahan' => $nama_barang[$index]])->first();

                if ($existingBahan) {
                    $newStok = $existingBahan['stok'] + $qty_clean;
                    $newDebet = $existingBahan['debet'] + $qty_clean;
                    $gdBahanModel->update($existingBahan['id'], [
                        'stok' => $newStok,
                        'debet' => $newDebet
                    ]);
                } else {
                    $newBahanData = [
                        'kode_bahan' => $kode,
                        'nama_bahan' => $nama_barang[$index],
                        'stok' => $qty_clean,
                        'harga' => $harga_clean,
                        'debet' => $qty_clean
                    ];
                    $gdBahanModel->insert($newBahanData);
                }

                // Simpan data ke tabel M_Kartu_Stok
                $dataKartuStok = [
                    'nomor' => $GenerateIdT,
                    'id_kode_barang' => $kode,
                    'nama_barang' => $nama_barang[$index],
                    'tanggal' => $this->request->getPost('tgl'),
                    'transaksi' => 'PEMBELIAN DARI ' . strtoupper($this->request->getPost('supplier')),
                    'debit' => $qty_clean,
                    'saldo' => $qty_clean,
                    'gudang' => strtoupper($this->request->getPost('gudang'))
                ];
                $kartuStokModel->insert($dataKartuStok);

                // Siapkan data detail penerimaan
                $detailTerima = [
                    'id_kode_barang' => $kode,
                    'nama_barang' => $nama_barang[$index],
                    'qty_k' => $qty_clean,
                    'sat_k' => $sat_k[$index],
                    'qty_t' => $qty_t[$index],
                    'sat_t' => $sat_t[$index],
                    'qty_b' => $qty_b_clean,
                    'sat_b' => $sat_b[$index],
                    'harga' => $harga_clean,
                    'disc' => $disc_clean,
                    'jumlah' => $jumlah,
                    'no_po' => $this->request->getPost('id_po_bahan')[$index],
                    'po_id' => $this->request->getPost('po_id')[$index],
                    'id_penerimaan' => $GenerateIdT,
                    'ceklis' => isset($ceklis[$index]) ? 1 : 0
                ];

                $detailTerimaModel->insert($detailTerima);
            }
        }

        // Perhitungan nilai ppn dan netto
        $dataBahan['nilai_ppn'] = $dataBahan['total_jumlah'] * 0.11;
        $dataBahan['netto'] = $dataBahan['total_jumlah'] + $dataBahan['nilai_ppn'];

        $terimaBahanModel->insert($dataBahan);

        // Jika semua item dicentang, update status PO
        $tgl_faktur = $this->request->getPost('tgl');
        $semuaDicentang = !in_array(false, $ceklis, true);
        if ($semuaDicentang) {
            $poBahanModel->update($id_po_bahan, [
                'status' => 'Oke',
                'no_faktur' => $GenerateIdT,
                'tgl_faktur' => $tgl_faktur
            ]);
        }

        // Memproses pengiriman data jurnal berdasarkan jenis pembayaran
        $pembayaran = strtoupper($this->request->getPost('pembayaran'));
        $doc_no = 'JB.' . $GenerateIdT;
        $descriptionItems = [];
        foreach ($nama_barang as $nama) {
            $descriptionItems[] = $nama;
        }
        $description = 'BELI BARANG - ' . implode(', ', $descriptionItems);

        switch ($pembayaran) {
            case 'REK BCA':
                $dataBarang = [
                    'date' => $this->request->getPost('tgl'),
                    'doc_no' => $doc_no,
                    'account' => '13350',
                    'name' => 'PERSEDIAAN BARANG',
                    'description' => $description,
                    'debit' => $dataBahan['total_jumlah'],
                    'kredit' => 0,
                    'aksi' => 'Posted',
                    'user_id' => $user_id,
                ];
                $modelJurnal->insert($dataBarang);

                if ($dataBahan['nilai_ppn'] > 0) {
                    $dataPPN = [
                        'date' => $this->request->getPost('tgl'),
                        'doc_no' => $doc_no,
                        'account' => '21300',
                        'name' => 'PPN MASUKAN',
                        'description' => 'PPN BELI BARANG - ' . implode(', ', $descriptionItems),
                        'debit' => $dataBahan['nilai_ppn'],
                        'kredit' => 0,
                        'aksi' => 'Posted',
                        'user_id' => $user_id,
                    ];
                    $modelJurnal->insert($dataPPN);
                }

                $dataBank = [
                    'date' => $this->request->getPost('tgl'),
                    'doc_no' => $doc_no,
                    'account' => '11113',
                    'name' => 'REK BCA',
                    'description' => $description,
                    'debit' => 0,
                    'kredit' => $dataBahan['netto'],
                    'aksi' => 'Posted',
                    'user_id' => $user_id,
                ];
                $modelJurnal->insert($dataBank);
                break;

            case 'KAS KECIL':
                // Tidak ada jurnal yang dikirim untuk KREDIT
                break;

            case 'KAS BESAR':
                // Kirim data ke jurnal
                $dataBarang = [
                    'date' => $this->request->getPost('tgl'),
                    'doc_no' => $doc_no,
                    'account' => '13350',
                    'name' => 'PERSEDIAAN BARANG',
                    'description' => $description,
                    'debit' => $dataBahan['total_jumlah'],
                    'kredit' => 0,
                    'aksi' => 'Posted',
                    'user_id' => $user_id,
                ];
                $modelJurnal->insert($dataBarang);

                // Kirim Jurnal untuk PPN jika berlaku
                if ($dataBahan['nilai_ppn'] > 0) {
                    $dataPPN = [
                        'date' => $this->request->getPost('tgl'),
                        'doc_no' => $doc_no,
                        'account' => '11460',
                        'name' => 'PPN MASUKAN',
                        'description' => 'PPN BELI BARANG - ' . implode(', ', $descriptionItems),
                        'debit' => $dataBahan['nilai_ppn'],
                        'kredit' => 0,
                        'aksi' => 'Posted',
                        'user_id' => $user_id,
                    ];
                    $modelJurnal->insert($dataPPN);

                    $dataBank = [
                        'date' => $this->request->getPost('tgl'),
                        'doc_no' => $doc_no,
                        'account' => '11112',
                        'name' => 'KAS BESAR',
                        'description' => $description,
                        'debit' => 0,
                        'kredit' => $dataBahan['netto'],
                        'aksi' => 'Posted',
                        'user_id' => $user_id,
                    ];
                    $modelJurnal->insert($dataBank);
                }

                // Simpan data ke M_KasKecil dan jurnal dengan akun Kas Kecil
                $dataKasKecil = [
                    'tanggal' => $this->request->getPost('tgl'),
                    'doc_no' => $doc_no,
                    'kode_account' => '11101',
                    'nama_account' => 'KAS KECIL',
                    'keterangan' => 'PEMBAYARAN BARANG - ' . implode(', ', $descriptionItems),
                    'debit' => 0,
                    'kredit' => $dataBahan['netto'],
                    'tgl_input' => $this->request->getPost('tgl'),
                    'user_id' => $user_id,
                ];
                $modelJurnal->insert($dataKasKecil);
                $modelKasKecil->insert($dataKasKecil);
                break;

            default:
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Opsi pembayaran tidak valid.'
                ]);
        }

        return redirect()->to(base_url('/order_terima_bahanprev/' . $GenerateIdT))->with('message', 'Data berhasil disimpan.');
    }





    public function delete_terima($id)
    {
        $db = \Config\Database::connect();
        $db->transStart(); // Memulai transaksi

        // Menghapus data terkait di tabel detail_barang
        $detailTerimaModel = new M_Detail_Terima();
        $detailTerimaModel->where('id_penerimaan', $id)->delete();

        // Menghapus data di tabel id_penerimaan
        $terimaBahanModel = new M_Terima_Bahan();
        $terimaBahanModel->where('id_penerimaan', $id)->delete();

        $db->transComplete(); // Menyelesaikan transaksi

        if ($db->transStatus() === FALSE) {
            return redirect()->to('terima_bahan')->with('error', 'Data gagal dihapus');
        } else {
            return redirect()->to('terima_bahan')->with('berhasil', 'Data berhasil dihapus');
        }
    }


    public function hapus_detailterima($id)
    {
        $detailTerimaModel = new M_Detail_Terima();

        // Ambil id_penerimaan berdasarkan id
        $id_penerimaan = $detailTerimaModel->getIdPenerimaanByKodeBarang($id);

        // Menghapus data berdasarkan id
        $result = $detailTerimaModel->deleteByKodeBarang($id);

        if ($result) {
            return redirect()->to(base_url('/order_terima_bahanprev/' . $id_penerimaan))->with('message', 'Data berhasil disimpan.');
        }
    }


    public function bahan_terima_prev($id_penerimaan)
    {
        $TerimaBahanModel = new M_Terima_Bahan();
        $detailTerimaModel = new M_Detail_Terima();

        $dataTerima = $TerimaBahanModel->find($id_penerimaan);
        // ambil
        $supplierData = $TerimaBahanModel->getAllSupplier();
        $bahanData = $TerimaBahanModel->getAllBahan();

        $detailTerima = $detailTerimaModel->where('id_penerimaan', $id_penerimaan)->findAll();

        if ($dataTerima) {
            if (empty($detailTerima)) {
                // Logika debug: Jika tidak ada detail terima
                log_message('error', 'Tidak ada detail terima ditemukan untuk id_penerimaan: ' . $id_penerimaan);
            }

            $total_qty = 0;
            $total_jumlah = 0;

            // Kemudian kirimkan ke view
            $data = [
                'title' => 'Penerimaan Bahan',
                'terima' => $dataTerima,
                'detail_terima' => $detailTerima,
                'supplier' => $supplierData,
                'bahan' => $bahanData,
                'total_qty' => $total_qty,
                'total_jumlah' => $total_jumlah,
            ];

            return view('bahan/order_terima_bahanprev', $data);
        } else {
            // Logika debug: Jika tidak ada data penerimaan
            log_message('error', 'Tidak ada data penerimaan ditemukan untuk id: ' . $id_penerimaan);
        }
    }

    public function updateTerima()
    {
        $terimaBahanModel = new M_Terima_Bahan();

        // Mengambil data dari request
        $id_penerimaan = $this->request->getPost('no-terima');
        $dataUpdate = [
            'tanggal' => $this->request->getPost('tgl'),
            'supplier' => strtoupper($this->request->getPost('supplier')),
            'jatuh_tempo' => $this->request->getPost('jatuh_tempo'),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'gudang' => strtoupper($this->request->getPost('gudang')),
            'no_kendaraan' => strtoupper($this->request->getPost('no-kendaraan')),
            'kota' => strtoupper($this->request->getPost('kota')),
            'alamat' => strtoupper($this->request->getPost('alamat')),
            'pembayaran' => strtoupper($this->request->getPost('pembayaran')),
            'ppn' => ($this->request->getPost('ppn') == 'PPN') ? 11 : 0,
            'term' => strtoupper($this->request->getPost('term')),

        ];

        // Melakukan update pada tabel terima_bahan
        $terimaBahanModel->update($id_penerimaan, $dataUpdate);

        return redirect()->to(base_url('/order_terima_bahanprev/' . $id_penerimaan))->with('message', 'Data berhasil diperbarui.');
    }

    public function createDetailTambah()
    {
        $detailTerimaModel = new M_Detail_Terima();

        // Mendapatkan id_penerimaan dari form
        $id_penerimaan = $this->request->getPost('id_penerimaan');
        if (!$id_penerimaan) {
            return redirect()->back()->with('error', 'ID Terima PO tidak ditemukan.');
        }

        // Data yang akan disimpan
        $harga = $this->request->getPost('harga');
        $disc = $this->request->getPost('disc') ?: 0; // Default diskon 0 jika tidak ada
        $qty = $this->request->getPost('qty');

        $jumlah = $qty * ($harga - $disc); // Perhitungan jumlah

        $data = [
            'id_kode_barang'  => $this->request->getPost('id_kode_barang'),
            'nama_barang'  => $this->request->getPost('nama_barang'),
            'qty'          => $qty,
            'satuan'       => $this->request->getPost('satuan'),
            'harga'        => $harga,
            'disc'         => $disc,
            'jumlah'       => $jumlah,
            'id_penerimaan' => $id_penerimaan // Simpan ID Terima PO
        ];

        // Insert data ke dalam database
        $detailTerimaModel->insert($data);

        // Redirect dengan pesan sukses
        return redirect()->to('/order_terima_bahanprev/' . $id_penerimaan)->with('message', 'Barang berhasil ditambahkan');
    }


    // REPAIR MATERIAL BAHAN------------------------------------------------------------------------------------------------------------------------



    public function repair_materialbahan()
    {
        $bahanRepairModel = new M_Bahan_Repair();
        $userModel = new UserModel();

        $repair = $bahanRepairModel->orderBy('id_material', 'DESC')->findAll();

        foreach ($repair as &$item) {
            // Periksa apakah kunci 'user_id' ada sebelum mencoba mengaksesnya
            if (isset($item['user_id'])) {
                $user = $userModel->find($item['user_id']);
                $item['username'] = $user ? $user['username'] : 'Unknown';
            } else {
                $item['username'] = 'Unknown'; // Set nilai default jika 'user_id' tidak ada
            }
        }

        $data = [
            'title' => 'Repair Material Bahan',
            'repair' => $repair
        ];

        return view('bahan/repair_material', $data);
    }



    public function bahan_repair_add()
    {
        $bahanData = new M_Barang_bahan;
        $bahanRepairModel = new M_Bahan_Repair();
        $poData = $bahanRepairModel->getAllPO();
        $bahanData = $bahanData->findAll();

        $data = [
            'title' => 'Repair Material Bahan',
            'generateIdrepair' => $bahanRepairModel->generateId(),
            'bahan' => $bahanData,
            'po' => $poData,
        ];
        return view('bahan/order_repair_bahan', $data);
    }

    public function createRepairBahan()
    {
        $bahanRepairModel = new M_Bahan_Repair();
        $detailRepairModel = new M_Detail_Repair();
        $gdBahanModel = new M_Gd_Bahan(); // Model untuk tabel bahan_data
        $kartuStokModel = new M_Kartu_Stok();

        // Generate unique ID for 'id_material'
        $generateId = $bahanRepairModel->generateId();

        // Menghitung total qty dan total hpp
        $qty_B = $this->request->getPost('qty_B');
        $qty_T = $this->request->getPost('qty_T');
        $qty_K = $this->request->getPost('qty_K');
        $hpp = $this->request->getPost('hpp');

        // Menghitung total qty dan hpp
        $total_qty_B = array_sum($qty_B);
        $total_qty_T = array_sum($qty_T);
        $total_qty_K = array_sum($qty_K);
        $total_hpp = array_sum($hpp);

        // Data untuk tabel bahan_repair
        $data = [
            'id_material' => $this->request->getPost('id_material'),
            'tanggal' => $this->request->getPost('tanggal'),
            'gudang' => strtoupper($this->request->getPost('gudang')),
            'no_repair' => strtoupper($this->request->getPost('no_ro')),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'no_kendaraan' => strtoupper($this->request->getPost('no_kendaraan')),
            'asuransi' => strtoupper($this->request->getPost('asuransi')),
            'jenis_mobil' => strtoupper($this->request->getPost('jenis_mobil')),
            'warna' => strtoupper($this->request->getPost('warna')),
            'tahun' => $this->request->getPost('tahun'),
            'nama_pemilik' => strtoupper($this->request->getPost('nama_pemilik')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'total_qty_B' => $total_qty_B,
            'total_qty_T' => $total_qty_T,
            'total_qty_K' => $total_qty_K,
            'total_hpp' => $total_hpp,
        ];

        // Simpan data Bahan Repair
        $bahanRepairModel->insert($data);

        // Simpan detail repair ke tabel detail_repair
        $id_kode_barang = $this->request->getPost('id_kode_barang');
        $nama_barang = $this->request->getPost('nama_barang');
        $sat_B = $this->request->getPost('sat_B');
        $sat_T = $this->request->getPost('sat_T');
        $sat_K = $this->request->getPost('sat_K');

        if ($id_kode_barang) {
            foreach ($id_kode_barang as $index => $kode) {
                // Mengurangi stok bahan dari tabel bahan_data
                $existingBahan = $gdBahanModel->where([
                    'kode_bahan' => $kode,
                    'nama_bahan' => $nama_barang[$index]
                ])->first();

                if ($existingBahan) {
                    // Mengurangi stok jika qty_B tidak kosong atau > 0
                    $newStok = $existingBahan['stok'] - $qty_K[$index];
                    $newCredit = $existingBahan['credit'] + $qty_K[$index]; // Menambahkan qty_B ke kolom credit

                    // Update stok dan credit pada tabel bahan_data
                    $gdBahanModel->update($existingBahan['id'], [
                        'stok' => $newStok,
                        'credit' => $newCredit
                    ]);
                } else {
                    // Jika barang tidak ditemukan, lakukan penanganan error atau log
                    // Bisa mengembalikan pesan kesalahan atau melanjutkan ke item berikutnya
                    return redirect()->back()->with('error', 'Barang dengan kode ' . $kode . ' dan nama ' . $nama_barang[$index] . ' tidak ditemukan di stok.');
                }

                // Menyiapkan data detail repair untuk tabel detail_repair
                $detailData = [
                    'id_kode_barang' => $kode,
                    'nama_barang' => $nama_barang[$index],
                    'qty_B' => $qty_B[$index],
                    'sat_B' => $sat_B[$index],
                    'qty_T' => $qty_T[$index],
                    'sat_T' => $sat_T[$index],
                    'qty_K' => $qty_K[$index],
                    'sat_K' => $sat_K[$index],
                    'hpp' => $hpp[$index],
                    'id_material' => $data['id_material']
                ];

                // Simpan data detail repair
                $detailRepairModel->insert($detailData);

                $kartuStokData = [
                    'nomor' => $generateId,
                    'id_kode_barang' => $kode,
                    'nama_barang' => $nama_barang[$index],
                    'tanggal' => $this->request->getPost('tanggal'),
                    'transaksi' => strtoupper($this->request->getPost('jenis_mobil')) . '-' . strtoupper($this->request->getPost('no_kendaraan')) . '-' . strtoupper($this->request->getPost('nama_pemilik')) . '-' . strtoupper($this->request->getPost('asuransi')),
                    'credit' => $qty_K[$index],
                    'saldo' => $qty_K[$index],
                    'gudang' => strtoupper($this->request->getPost('gudang'))
                ];

                // Simpan data ke M_Kartu_Stok
                $kartuStokModel->insert($kartuStokData);
            }
        }


        return redirect()->to(base_url('/order_repair_bahanprev/' . $generateId))->with('message', 'Data berhasil disimpan.');
    }



    public function bahan_repair_prev($id_material)
    {
        $repairBahanModel = new M_Bahan_Repair();
        $detailRepairModel = new M_Detail_Repair();

        // Get the repair data from bahan_repair table
        $repairData = $repairBahanModel->find($id_material);

        if ($repairData) {
            // Get the detail data from detail_repair table
            $detailData = $detailRepairModel->where('id_material', $id_material)->findAll();

            // Calculate total quantities and HPP
            $totalQtyB = 0;
            $totalQtyT = 0;
            $totalQtyK = 0;
            $totalHpp = 0;

            foreach ($detailData as $detail) {
                $totalQtyB += $detail['qty_B'];
                $totalQtyT += $detail['qty_T'];
                $totalQtyK += $detail['qty_K'];
                $totalHpp += $detail['hpp'];
            }

            $data = [
                'title' => 'Repair Material Bahan',
                'repair' => $repairData,
                'detail_repair' => $detailData,
                'total_qty_B' => $totalQtyB,
                'total_qty_T' => $totalQtyT,
                'total_qty_K' => $totalQtyK,
                'total_hpp' => $totalHpp,
            ];

            return view('bahan/order_repair_bahanprev', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function updateRepairBahan()
    {
        $bahanRepairModel = new M_Bahan_Repair();
        $id_material = $this->request->getPost('id_material');
        $dataUpdate = [
            'tanggal' => $this->request->getPost('tanggal'),
            'gudang' => strtoupper($this->request->getPost('gudang')),
            'no_repair' => strtoupper($this->request->getPost('no_repair')),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'no_kendaraan' => strtoupper($this->request->getPost('no_kendaraan')),
            'jenis_mobil' => strtoupper($this->request->getPost('jenis_mobil')),
            'warna' => strtoupper($this->request->getPost('warna')),
            'tahun' => $this->request->getPost('tahun'),
            'nama_pemilik' => strtoupper($this->request->getPost('nama_pemilik')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),

        ];
        $bahanRepairModel->update($id_material, $dataUpdate);

        return redirect()->to(base_url('/order_repair_bahanprev/' . $id_material))->with('message', 'Data berhasil diperbarui.');
    }

    public function delete_repair($id_material)
    {
        $db = \Config\Database::connect();
        $db->transStart(); // Memulai transaksi

        // Menghapus data terkait di tabel detail_repair
        $detailRepairModel = new M_Detail_Repair();
        $detailRepairModel->where('id_material', $id_material)->delete();

        // Menghapus data di tabel bahan_repair
        $bahanRepairModel = new M_Bahan_Repair();
        $bahanRepairModel->where('id_material', $id_material)->delete();

        $db->transComplete(); // Menyelesaikan transaksi

        if ($db->transStatus() === FALSE) {
            return redirect()->to('repair_material')->with('error', 'Data gagal dihapus.');
        } else {
            return redirect()->to('repair_material')->with('berhasil', 'Data berhasil dihapus.');
        }
    }




    public function laporan_mutasigudang()
    {
        $gdBahanModel = new M_Gd_Bahan();

        $data = [
            'title' => 'Laporan Mutasi Bahan',
            'bahan' => $gdBahanModel->orderBy('id')->findAll(),
        ];
        return view('bahan/laporan_mutasi', $data);
    }
}
