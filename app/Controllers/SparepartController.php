<?php

namespace App\Controllers;

use App\Models\M_Barang_Sparepart;
use App\Models\M_Po;
use App\Models\M_RepairOrder;
use App\Models\M_Part_Po;
use App\Models\M_Pdetail_Pesan;
use App\Models\M_Part_Terima;
use App\Models\M_Pdetail_Terima;
use App\Models\M_ReportJurnal;
use App\Models\M_SparepartPo;
use App\Models\M_Supplier;
use App\Models\M_Part_Repair;
use App\Models\M_Pdetail_Repair;
use App\Models\M_Gd_Stok;
use App\Models\M_Gd_Repair;
use App\Models\M_Gd_Supply;
use App\Models\M_Gd_Waiting;
use App\Models\M_Gd_Salvage;
use App\Models\M_Kartu_Stok;
use App\Models\M_KasKecil;
use App\Models\UserModel;

class SparepartController extends BaseController
{
    public function permintaan_sparepart($id_terima_po = null)
    {
        $partbahanModel = new M_Part_Po();
        $Pomodel = new M_Po();
        $SparepartPoModel = new M_SparepartPo();
        $supplierModel = new M_Supplier();
        $repairOrderModel = new M_RepairOrder();

        $poData = $Pomodel->getFilteredDataSparepartNotSent();

        $repairOrderData = $repairOrderModel->findAll();

        $combinedData = array_merge($poData, $repairOrderData);

        $sparepart = [];
        $detailPO = [];
        $filteredCombinedData = [];

        if ($id_terima_po) {
            $sparepart = $SparepartPoModel->where('id_terima_po', $id_terima_po)
                ->where('jenis_part', 'NON-SUPPLY')
                ->where('is_sent', '0')
                ->findAll();

            if (!empty($sparepart)) {
                $detailPO[$id_terima_po] = $SparepartPoModel->getDetailByIdTerimaPo($id_terima_po);
            }
        } else {
            foreach ($combinedData as $data) {
                $sparepart = $SparepartPoModel->where('id_terima_po', $data['id_terima_po'])
                    ->where('jenis_part', 'NON-SUPPLY')
                    ->where('is_sent', '0')
                    ->findAll();

                if (!empty($sparepart)) {
                    $detailPO[$data['id_terima_po']] = $SparepartPoModel->getDetailByIdTerimaPo($data['id_terima_po']);
                    $filteredCombinedData[] = $data;
                }
            }
        }

        $data = [
            'title' => 'Permintaan Sparepart',
            'poData' => $filteredCombinedData,
            'detailPO' => $detailPO,
            'suppliers' => $supplierModel->findAll(),
            'id_pesan' => $partbahanModel->generateId(),
            'spareparts' => $sparepart,
            'SparepartPoModel' => $SparepartPoModel
        ];

        return view('sparepart/permintaan_part', $data);
    }







    public function create_part_po()
    {
        // Ambil user_id dari sesi
        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $modelPartPo = new M_Part_Po();
        $modelSparepart = new M_SparepartPo();
        $modelPdetailPesan = new M_Pdetail_Pesan();

        // Ambil dan konversi total qty dan jumlah
        $totalQtyArray = $this->request->getPost('qty');
        $totalJumlahArray = $this->request->getPost('jumlah');

        $totalQty = 0;
        $totalJumlah = 0;

        // Menghitung total qty dan total jumlah
        foreach ($totalQtyArray as $qty) {
            $totalQty += intval(str_replace('.', '', $qty));
        }

        foreach ($totalJumlahArray as $jumlah) {
            $totalJumlah += intval(str_replace('.', '', $jumlah));
        }

        $data = [
            'id_pesan'          => $this->request->getPost('id_pesan'),
            'tanggal'           => $this->request->getPost('tgl'),
            'kode_supplier'     => $this->request->getPost('kode_supplier'),
            'supplier'          => strtoupper($this->request->getPost('supplier')),
            'jatuh_tempo'       => $this->request->getPost('jatuh_tempo'),
            'keterangan'        => strtoupper($this->request->getPost('keterangan')),
            'wo'   => strtoupper($this->request->getPost('no_ro')),
            'customer'      => strtoupper($this->request->getPost('nama_pemilik')),
            'asuransi'          => strtoupper($this->request->getPost('asuransi')),
            'nopol'      => strtoupper($this->request->getPost('no_kendaraan')),
            'jenis_mobil'       => strtoupper($this->request->getPost('jenis_mobil')),
            'no_rangka'         => strtoupper($this->request->getPost('no_rangka')),
            'warna'             => strtoupper($this->request->getPost('warna')),
            'user_id'           => $user_id,
        ];

        // Insert data ke M_Part_Po
        if ($modelPartPo->insert($data) === false) {
            return redirect()->back()->withInput()->with('error', $modelPartPo->errors());
        }

        $selectedIds = $this->request->getPost('selected_ids');

        // Proses hanya sparepart yang dicentang
        if (!empty($selectedIds)) {
            foreach ($selectedIds as $id) {
                // Ambil sparepart yang dipilih berdasarkan ID
                $selectedSparepart = $modelSparepart->find($id);

                if ($selectedSparepart) {
                    // Cek apakah data detail pesan sudah ada
                    $existingDetail = $modelPdetailPesan->where('id_kode_barang', $selectedSparepart['id_sparepart_po'])
                        ->where('id_pesan', $data['id_pesan'])
                        ->first();

                    if (!$existingDetail) {
                        // Ambil qty dari input berdasarkan index
                        $index = array_search($id, $selectedIds);
                        $qtyInput = intval(str_replace('.', '', $totalQtyArray[$index])); // Ambil qty yang sesuai

                        // Hitung jumlah dari qty dan harga
                        $harga = intval(str_replace('.', '', $selectedSparepart['harga']));
                        $jumlah = $qtyInput * $harga;

                        // Simpan data di tabel M_Pdetail_Pesan
                        $dataDetailPesan = [
                            'id_pesan'       => $data['id_pesan'],
                            'satuan'         => 'PCS',
                            'id_kode_barang' => $selectedSparepart['kode_sparepart'],
                            'nama_barang'    => $selectedSparepart['nama_sparepart'],
                            'qty'            => $qtyInput,
                            'harga'          => $harga,
                            'jumlah'         => $jumlah,
                            'wo' => strtoupper($this->request->getPost('no_ro')),
                            'nopol'          => strtoupper($this->request->getPost('no_kendaraan')),
                            'no_rangka'          => strtoupper($this->request->getPost('no_rangka')),
                        ];
                        $modelPdetailPesan->insert($dataDetailPesan);
                    }

                    // Update is_sent menjadi 1 untuk sparepart yang dipilih
                    $modelSparepart->update($id, ['is_sent' => '1']);
                }
            }
        }

        return redirect()->back()->with('success', 'Data berhasil diproses.');
    }


    // Permintaan NON-SUPPLY - Detail Sparepart 
    public function updateJenisPartNonSupp()
    {
        // Mengambil array dari input hidden
        $id_sparepart_po = $this->request->getPost('id_sparepart_po');
        $kode_sparepart = $this->request->getPost('kode_sparepart');
        $nama_sparepart = $this->request->getPost('nama_sparepart');
        $qty = $this->request->getPost('qty');
        $harga = str_replace('.', '', $this->request->getPost('harga'));
        $total_harga = str_replace('.', '', $this->request->getPost('total_harga'));
        $jenis_part = $this->request->getPost('jenis_part');

        // Mendapatkan user_id dari sesi
        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan di session');
        }

        // Inisialisasi model M_SparepartPo
        $sparepartPoModel = new M_SparepartPo();

        // Validasi input
        foreach ($qty as $index => $value) {
            if (!is_numeric($value) || $value <= 0) {
                return redirect()->back()->with('error', 'Qty harus berupa angka yang lebih besar dari 0.');
            }
        }

        foreach ($harga as $index => $value) {
            if (!is_numeric($value) || $value < 0) {
                return redirect()->back()->with('error', 'Harga harus berupa angka yang lebih besar dari atau sama dengan 0.');
            }
        }

        foreach ($id_sparepart_po as $index => $id) {
            // Mengumpulkan data untuk diperbarui
            $data = [
                'kode_sparepart' => $kode_sparepart[$index],
                'nama_sparepart' => $nama_sparepart[$index],
                'qty' => $qty[$index],
                'harga' => $harga[$index],
                'total_harga' => $total_harga[$index],
                'jenis_part' => $jenis_part[$index],
            ];

            // Debug data yang akan diperbarui
            log_message('debug', 'Data yang akan diperbarui di tabel sparepart_po: ' . print_r($data, true));

            // Update data di database
            try {
                $sparepartPoModel->update($id, $data);
            } catch (\Exception $e) {
                log_message('error', 'Error saat memperbarui sparepart: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error saat memperbarui sparepart: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Data sparepart berhasil diperbarui.');
    }

    public function pemesanan_sparepart()
    {
        $partbahanModel = new M_Part_Po();
        $partDetailModel = new M_Pdetail_Pesan();
        $partTerimaModel = new M_Pdetail_Terima();
        $userModel = new UserModel();

        $sparepart = $partbahanModel->orderBy('id_pesan', 'DESC')->findAll();
        $partmerge = [];

        foreach ($sparepart as $item) {
            if (strpos($item['id_pesan'], 'POS') === 0) {
                $detail = $partDetailModel->where('id_pesan', $item['id_pesan'])->findAll();
                $terimaDetail = $partTerimaModel->where('no_po', $item['id_pesan'])->findAll();

                $totalJumlah = 0;
                foreach ($detail as $d) {
                    $totalJumlah += $d['jumlah'];
                }

                $allSent = true;
                if (count($terimaDetail) === 0) {
                    $allSent = false;
                } else {
                    $terimaCount = 0;
                    foreach ($terimaDetail as $terima) {
                        if ($terima['is_sent'] != 1) {
                            $allSent = false;
                            break;
                        }
                        $terimaCount++;
                    }
                    if ($terimaCount !== count($detail)) {
                        $allSent = false;
                    }
                }

                $item['total_jumlah'] = $totalJumlah;
                $item['all_sent'] = $allSent;

                // Menambahkan username berdasarkan user_id
                $user = $userModel->find($item['user_id']);
                $item['username'] = $user ? $user['username'] : 'Unknown';

                $partmerge[] = $item;
            }
        }

        $data = [
            'title' => 'Pemesanan Sparepart PO',
            'sparepart' => $partmerge,
        ];

        return view('sparepart/pesan_part', $data);
    }



    public function add_part()
    {
        $partbahanModel = new M_Part_Po();
        $poM = new M_Po();
        $supM = new M_Supplier();
        $partM = new M_Barang_Sparepart();

        $po = $poM->findAll();
        $sup = $supM->findAll();
        $part = $partM->findAll();


        $data = [
            'title' => 'Pemesanan Sparepart PO',
            'generatedId' => $partbahanModel->generateId(),
            'supplier' => $sup,
            'sparepart' => $part,
            'po' => $po
        ];
        return view('sparepart/beli_part', $data);
    }

    public function add_partpreview($id_pesan)
    {
        $partbahanModel = new M_Part_Po();
        $dataBahan = $partbahanModel->find($id_pesan);

        if ($dataBahan) {
            // Ambil detail barang dari tabel pdetail_pesan
            $detailpartModel = new M_Pdetail_Pesan();
            $detailBarang = $detailpartModel->where('id_pesan', $id_pesan)->findAll();

            // Hitung total qty dan total jumlah
            $totalQty = 0;
            $totalJumlah = 0;

            foreach ($detailBarang as $detail) {
                $totalQty += $detail['qty'];
                $totalJumlah += $detail['jumlah'];
            }

            $data = [
                'title' => 'Pemesanan Sparepart PO',
                'sparepart' => $dataBahan,
                'detail_barang' => $detailBarang,
                'total_qty' => $totalQty,
                'total_jumlah' => $totalJumlah,
            ];
            return view('sparepart/beli_partprev', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function delete_part($id_pesan)
    {
        $db = \Config\Database::connect();
        $db->transStart(); // Memulai transaksi

        // Menghapus data terkait di tabel detail_barang
        $detailpartModel = new M_Pdetail_Pesan();
        $detailpartModel->where('id_pesan', $id_pesan)->delete();

        // Menghapus data di tabel pesan
        $partbahanModel = new M_Part_Po();
        $partbahanModel->where('id_pesan', $id_pesan)->delete();

        $db->transComplete(); // Menyelesaikan transaksi

        if ($db->transStatus() === FALSE) {
            return redirect()->to('pesan_part')->with('error', 'Data gagal dihapus');
        } else {
            return redirect()->to('pesan_part')->with('berhasil', 'Data berhasil dihapus');
        }
    }

    public function penerimaan_sparepart()
    {
        $sparepartModel = new M_Part_Terima();
        $userModel = new UserModel();

        $sparepartsData = $sparepartModel
            ->where('gudang !=', 'GUDANG SUPPLY ASURANSI')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        foreach ($sparepartsData as &$item) {
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Penerimaan Sparepart',
            'sparepart' => $sparepartsData,
        ];

        return view('sparepart/terima_part', $data);
    }




    public function add_terimapart($id_pesan = null)
    {
        $partPoModel = new M_Part_Po();
        $terimaPartModel = new M_Part_Terima();

        // Ambil data part_po berdasarkan id_pesan
        $partPoData = $partPoModel->getByIdPesan($id_pesan);

        $supplierData = $terimaPartModel->getAllSupplier();
        $barangData = $terimaPartModel->getAllBarang();
        $partPoData = $terimaPartModel->getAllPoBahan();


        $data = [
            'title' => 'Penerimaan Sparepart',
            'generatedIdTerima' => $terimaPartModel->generateIdTerima(),
            'supplier' => $supplierData,
            'barang' => $barangData,
            'part_po' => $partPoData,
        ];

        return view('sparepart/order_pos_terimapart', $data);
    }
    public function getSpareparts()
    {
        $id_pesan = $this->request->getGet('id_pesan');

        if (!$id_pesan) {
            return $this->response->setStatusCode(400, 'ID Pesan tidak ditemukan');
        }

        $pdetailPesanModel = new M_Pdetail_Pesan();
        $data = $pdetailPesanModel->getSparepartsByPesan($id_pesan);

        return $this->response->setJSON($data);
    }


    public function create_terima()
    {
        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $kartuStokModel = new M_kartu_stok();
        $terimaPartModel = new M_Part_Terima();
        $detailTerimaModel = new M_Pdetail_Terima();
        $partPoModel = new M_Part_Po();
        $detailPesanModel = new M_Pdetail_Pesan();
        $modelJurnal = new M_ReportJurnal();
        $modelKasKecil = new M_KasKecil;
        $barangSparepartModel = new M_Barang_Sparepart();
        $GenerateIdT = $terimaPartModel->generateIdTerima();

        // Mengambil data dari request
        $qty = $this->request->getPost('qty');
        $harga = $this->request->getPost('harga');
        $disc = $this->request->getPost('disc');
        $ppn_option = $this->request->getPost('ppn');
        $gudang = $this->request->getPost('gudang');

        // Menghitung total qty, total jumlah, nilai ppn, dan netto secara manual
        $total_qty = 0;
        $total_jumlah = 0;

        foreach ($qty as $index => $quantity) {
            $hargaItem = intval(str_replace('.', '', $harga[$index]));
            $discItem = intval(str_replace('.', '', $disc[$index]));
            $jumlah = ($hargaItem - $discItem) * $quantity;
            $total_qty += $quantity;
            $total_jumlah += $jumlah;
        }

        // Hitung nilai PPN (11%) jika PPN dipilih
        $nilai_ppn = ($ppn_option == 'PPN') ? ($total_jumlah * 0.11) : 0;
        $netto = $total_jumlah + $nilai_ppn;

        // Menyiapkan data untuk disimpan di tabel part_terima
        $dataBahan = [
            'id_penerimaan' => $this->request->getPost('id_penerimaan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'kode_supplier' => $this->request->getPost('kode_supplier'),
            'supplier' => strtoupper($this->request->getPost('supplier')),
            'jatuh_tempo' => $this->request->getPost('jatuh_tempo'),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'gudang' => strtoupper($gudang),
            'no_preor' => strtoupper($this->request->getPost('no_preor')),
            'kota' => strtoupper($this->request->getPost('kota')),
            'alamat' => strtoupper($this->request->getPost('alamat')),
            'no_repair_order' => strtoupper($this->request->getPost('no_repair_order')),
            'asuransi' => strtoupper($this->request->getPost('asuransi')),
            'jenis_mobil' => strtoupper($this->request->getPost('jenis_mobil')),
            'warna' => strtoupper($this->request->getPost('warna')),
            'nama_pemilik' => strtoupper($this->request->getPost('nama_pemilik')),
            'nopol' => strtoupper($this->request->getPost('nopol')),
            'pembayaran' => $this->request->getPost('pembayaran'),
            'ppn' => ($ppn_option == 'PPN') ? 11 : 0,
            'term' => $this->request->getPost('term'),
            'total_qty' => $total_qty,
            'total_jumlah' => $total_jumlah,
            'nilai_ppn' => $nilai_ppn,
            'netto' => $netto,
            'user_id' => $user_id
        ];

        // Simpan data ke tabel part_terima
        $terimaPartModel->insert($dataBahan);

        // Mengambil data dari request
        $kode_barang = $this->request->getPost('kode_barang');
        $nama_barang = $this->request->getPost('nama_barang');
        $satuan = $this->request->getPost('satuan');
        $no_po = $this->request->getPost('no_po');
        $checkbox = $this->request->getPost('is_sent_checkbox'); // ambil data checkbox

        // Menentukan model gudang sesuai pilihan gudang yang ada di tabel 'gd_'
        $gudangModel = $this->getGudangModel($gudang);

        if ($kode_barang) {
            foreach ($kode_barang as $index => $kode) {
                // Menghitung harga dan diskon
                $hargaItem = intval(str_replace('.', '', $harga[$index]));
                $discItem = intval(str_replace('.', '', $disc[$index])); // Diskon dalam persen

                // Menghitung jumlah setelah diskon (diskon dihitung berdasarkan persen)
                $jumlah = ($hargaItem * (1 - ($discItem / 100))) * $qty[$index];

                // Cek jika item dicentang
                $isSent = (isset($checkbox) && in_array($index, array_keys($checkbox))) ? 1 : 0;

                // Jika tidak dicentang, lewati proses penyimpanan
                if ($isSent === 0) {
                    continue; // lanjutkan ke iterasi berikutnya jika tidak dicentang
                }

                // Siapkan data untuk tabel gudang
                $gudangData = [
                    'id_kode_barang' => $kode,
                    'nama_barang' => $nama_barang[$index],
                    'harga' => $harga[$index],
                    'debit' => $qty[$index],
                    'stok' => $qty[$index],
                    'wo' => $this->request->getPost('no_repair_order'),
                    'nopol' => $this->request->getPost('nopol'),
                    'gudang' => $this->request->getPost('gudang'),
                    'id_penerimaan' => $this->request->getPost('id_penerimaan'),
                ];

                // Siapkan data untuk kartu stok
                $kartuStokData = [
                    'nomor' => $this->request->getPost('id_penerimaan'),
                    'id_kode_barang' => $kode,
                    'nama_barang' => $nama_barang[$index],
                    'nopol' => $this->request->getPost('nopol'),
                    'tanggal' => $this->request->getPost('tanggal'),
                    'transaksi' => 'PEMBELIAN DARI ' . strtoupper($this->request->getPost('supplier')),
                    'debit' => $qty[$index],
                    'saldo' => $qty[$index],
                    'gudang' => strtoupper($this->request->getPost('gudang')),
                ];

                // Simpan data ke tabel kartu_stok
                $kartuStokModel->insert($kartuStokData);

                // Siapkan data untuk detail terima
                $detailData = [
                    'id_kode_barang' => $kode,
                    'nama_barang' => $nama_barang[$index],
                    'qty' => $qty[$index],
                    'satuan' => $satuan[$index],
                    'harga' => $harga[$index],
                    'disc' => $disc[$index],
                    'jumlah' => $jumlah,
                    'no_po' => $no_po[$index],
                    'id_penerimaan' => $this->request->getPost('id_penerimaan'),
                    'no_repair_order' => $this->request->getPost('no_repair_order'),
                    'asuransi' => strtoupper($this->request->getPost('asuransi')),
                    'jenis_mobil' => strtoupper($this->request->getPost('jenis_mobil')),
                    'nopol' => $this->request->getPost('nopol'),
                    'supplier' => strtoupper($this->request->getPost('supplier')),
                    'tgl_terima' => $this->request->getPost('tanggal'),
                    'is_sent' => $isSent,
                ];

                // Simpan data ke tabel detail_terima
                if (!$detailTerimaModel->insert($detailData)) {
                    $errors = $detailTerimaModel->errors();
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Gagal menyimpan detail terima: ' . implode(', ', $errors),
                        'detailData' => $detailData
                    ]);
                }

                $nopol = $this->request->getPost('nopol'); // Pastikan $nopol diambil dari input
                // Update is_sent di M_Pdetail_Pesan
                if ($isSent === 1) {
                    $detailPesanModel->updateIsSent($kode, $nopol, 1);
                }

                // Simpan atau update data gudang untuk setiap item
                if ($gudangModel) {
                    $this->saveOrUpdateGudang($gudangModel, $gudangData);
                } else {
                    return redirect()->back()->with('error', 'Model gudang tidak ditemukan.');
                }
            }

            foreach ($kode_barang as $index => $kode) {
                $barangSparepartList = $barangSparepartModel->where('kode_part', $kode)->findAll();

                foreach ($barangSparepartList as $barangSparepart) {
                    $barangSparepartModel->update($barangSparepart['id_part'], [
                        'stok' => $barangSparepart['stok'] + $qty[$index],
                    ]);
                }
            }
        }

        $id_pesan = $this->request->getPost('no_preor');
        $no_faktur = $this->request->getPost('id_penerimaan');

        // Update no_faktur jika ada id_pesan
        if ($id_pesan) {
            $partPoModel->updateNoFaktur($id_pesan, $no_faktur);
        }

        // Memproses pengiriman data jurnal berdasarkan jenis pembayaran
        $pembayaran = $this->request->getPost('pembayaran');
        $doc_no = 'JB.' . $this->request->getPost('id_penerimaan');
        $descriptionItems = [];
        foreach ($nama_barang as $index => $nama) {
            $descriptionItems[] = $nama . ' ' . $qty[$index] . ' ' . $satuan[$index];
        }
        $description = 'BELI BARANG - ' . implode(', ', $descriptionItems);

        // Memproses kondisi berdasarkan opsi pembayaran
        switch (strtoupper($pembayaran)) {
            case 'TRANSFER':
                // Kirim data ke jurnal
                $dataBarang = [
                    'date' => $this->request->getPost('tanggal'),
                    'doc_no' => $doc_no,
                    'account' => '13350',
                    'name' => 'PERSEDIAAN BARANG',
                    'description' => $description,
                    'debit' => $total_jumlah,
                    'kredit' => 0,
                    'aksi' => 'Posted',
                    'user_id' => $user_id,
                ];
                $modelJurnal->insert($dataBarang);

                // Kirim Jurnal untuk PPN jika berlaku
                if ($nilai_ppn > 0) {
                    $dataPPN = [
                        'date' => $this->request->getPost('tanggal'),
                        'doc_no' => $doc_no,
                        'account' => '11460',
                        'name' => 'PPN MASUKAN',
                        'description' => 'PPN BELI BARANG - ' . implode(', ', $descriptionItems),
                        'debit' => $nilai_ppn,
                        'kredit' => 0,
                        'aksi' => 'Posted',
                        'user_id' => $user_id,
                    ];
                    $modelJurnal->insert($dataPPN);
                }

                // Simpan data akun kredit ke akun Bank
                $dataBank = [
                    'date' => $this->request->getPost('tanggal'),
                    'doc_no' => $doc_no,
                    'account' => '11113',
                    'name' => 'REK BCA',
                    'description' => 'PEMBAYARAN BARANG - ' . implode(', ', $descriptionItems),
                    'debit' => 0,
                    'kredit' => $netto,
                    'user_id' => $user_id,
                ];
                $modelJurnal->insert($dataBank);
                break;

            case 'CASH':
                // Kirim data ke jurnal
                $dataBarang = [
                    'date' => $this->request->getPost('tanggal'),
                    'doc_no' => $doc_no,
                    'account' => '13350',
                    'name' => 'PERSEDIAAN BARANG',
                    'description' => $description,
                    'debit' => $total_jumlah,
                    'kredit' => 0,
                    'aksi' => 'Posted',
                    'user_id' => $user_id,
                ];
                $modelJurnal->insert($dataBarang);

                // Kirim Jurnal untuk PPN jika berlaku
                if ($nilai_ppn > 0) {
                    $dataPPN = [
                        'date' => $this->request->getPost('tanggal'),
                        'doc_no' => $doc_no,
                        'account' => '11460',
                        'name' => 'PPN MASUKAN',
                        'description' => 'PPN BELI BARANG - ' . implode(', ', $descriptionItems),
                        'debit' => $nilai_ppn,
                        'kredit' => 0,
                        'aksi' => 'Posted',
                        'user_id' => $user_id,
                    ];
                    $modelJurnal->insert($dataPPN);
                }

                // Simpan data ke M_KasKecil dan jurnal dengan akun Kas Kecil
                $dataKasKecil = [
                    'tanggal' => $this->request->getPost('tanggal'),
                    'doc_no' => $doc_no,
                    'kode_account' => '11101',
                    'nama_account' => 'KAS KECIL',
                    'keterangan' => 'PEMBAYARAN BARANG - ' . implode(', ', $descriptionItems),
                    'debit' => 0,
                    'kredit' => $netto,
                    'tgl_input' => $this->request->getPost('tanggal'),
                    'user_id' => $user_id,
                ];
                $modelJurnal->insert($dataKasKecil);
                $modelKasKecil = new M_KasKecil();
                $modelKasKecil->insert($dataKasKecil);
                break;

            case 'KREDIT':
                // Tidak perlu mengirim data ke jurnal atau kas kecil
                break;

            default:
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Opsi pembayaran tidak valid.'
                ]);
        }

        return redirect()->to(base_url('/order_pos_terimapartprev/' . $GenerateIdT))->with('success', 'Data berhasil disimpan.');
    }



    private function getGudangModel($gudang)
    {
        switch ($gudang) {
            case 'GUDANG STOK SPAREPART':
                return new M_Gd_Stok();
            case 'GUDANG REPAIR':
                return new M_Gd_Repair();
            case 'GUDANG SUPPLY ASURANSI':
                return new M_Gd_Supply();
            case 'GUDANG WAITING':
                return new M_Gd_Waiting();
            case 'GUDANG SALVAGE':
                return new M_Gd_Salvage();
            default:
                return null;
        }
    }



    // Fungsi untuk menyimpan atau mengupdate data di gudang yang sesuai
    private function saveOrUpdateGudang($model, $data)
    {
        // Tambahkan pengecekan berdasarkan id_kode_barang, nama_barang, dan nopol
        $existingData = $model->where('id_kode_barang', $data['id_kode_barang'])
            ->where('nama_barang', $data['nama_barang'])
            ->where('wo', $data['wo'])
            ->first();

        if ($existingData) {
            // Jika data dengan id_kode_barang, nama_barang, dan wo sama, update stok dan debit
            $data['debit'] += $existingData['debit'];
            $data['stok'] += $existingData['stok'];
            $model->update($existingData['id'], $data);
        } else {
            // Periksa lagi jika id_kode_barang dan nama_barang sama, tapi wo berbeda
            $existingSameItem = $model->where('id_kode_barang', $data['id_kode_barang'])
                ->where('nama_barang', $data['nama_barang'])
                ->first();

            if ($existingSameItem && $existingSameItem['wo'] !== $data['wo']) {
                // Jika ada item dengan id_kode_barang dan nama_barang yang sama, tetapi wo berbeda, buat data baru
                $model->insert($data);
            } else {
                // Jika id_kode_barang dan nama_barang berbeda, atau wo sama tetapi barang berbeda, buat data baru
                $model->insert($data);
            }
        }
    }


    public function add_terimapart_preview($id_penerimaan)
    {

        $terimaPartModel = new M_Part_Terima();
        $dataTerima = $terimaPartModel->find($id_penerimaan);
        // ambil
        $supplierData = $terimaPartModel->getAllSupplier();
        $barangData = $terimaPartModel->getAllBarang();

        if ($dataTerima) {
            // Ambil detail barang dari tabel detail_terima
            $detailTerimaModel = new M_Pdetail_Terima();
            $detailTerima = $detailTerimaModel->where('id_penerimaan', $id_penerimaan)->findAll();

            // Inisialisasi total qty dan total jumlah
            $totalQty = 0;
            $totalJumlah = 0;

            if ($detailTerima) {
                foreach ($detailTerima as $detail) {
                    $totalQty += $detail['qty'];
                    $totalJumlah += $detail['jumlah'];
                }
            } else {
                // Jika data tidak ditemukan, berikan peringatan atau set default
                $totalQty = 0;
                $totalJumlah = 0;
            }
            $data = [
                'title' => 'Penerimaan Sparepart',
                'sparepart' => $dataTerima,
                'detail_terima' => $detailTerima,
                'total_qty' => $totalQty,
                'total_jumlah' => $totalJumlah,
                'supplier' => $supplierData,
                'barang' => $barangData,
            ];
            return view('sparepart/order_pos_terimapartprev', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }


    public function pasangSparepartv2($id)
    {
        $partM = new M_Pdetail_Terima();
        $barangSparepartModel = new M_Barang_Sparepart();
        $gdStokModel = new M_Gd_Stok();

        // Ambil data id_kode_barang dan qty langsung dari database
        $dataParts = $partM->select('id_kode_barang, qty')->where('id', $id)->findAll();

        if (empty($dataParts)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data part tidak ditemukan untuk ID: ' . $id
            ]);
        }

        $data = [
            'is_pasang' => '1',
            'tgl_pasang' => date('Y-m-d') // Format tanggal hari ini
        ];

        // Update status pemasangan di M_Pdetail_Terima
        if ($partM->update($id, $data)) {
            foreach ($dataParts as $part) {
                $kode = $part['id_kode_barang'];
                $qty = $part['qty'];

                // Ambil data barang dari M_Gd_Stok berdasarkan id_kode_barang dan wo
                $gdStokData = $gdStokModel->where('id_kode_barang', $kode)->findAll();

                if (empty($gdStokData)) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => "Data stok tidak ditemukan untuk id_kode_barang: $kode"
                    ]);
                }

                foreach ($gdStokData as $stokBarang) {
                    // Validasi stok mencukupi
                    if ($stokBarang['stok'] < $qty) {
                        return $this->response->setJSON([
                            'success' => false,
                            'message' => "Stok tidak mencukupi untuk id_kode_barang: $kode"
                        ]);
                    }

                    // Perbarui stok dan masukkan ke credit
                    $stokBaru = $stokBarang['stok'] - $qty;
                    $gdStokModel->update($stokBarang['id'], [
                        'stok' => $stokBaru,
                        'credit' => $stokBarang['credit'] + $qty
                    ]);
                }
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Sparepart berhasil terpasang dan stok diperbarui.'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memperbarui status pemasangan. Silakan coba lagi.'
            ]);
        }
    }



    public function updateTerima()
    {
        $terimaPartModel = new M_Part_Terima();

        // Mengambil data dari request
        $id_penerimaan = $this->request->getPost('id_penerimaan');
        $dataUpdate = [
            'tanggal' => $this->request->getPost('tanggal'),
            'supplier' => strtoupper($this->request->getPost('supplier')),
            'jatuh_tempo' => $this->request->getPost('jatuh_tempo'),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'gudang' => $this->request->getPost('gudang'),
            'no_preor' => strtoupper($this->request->getPost('no_preor')),
            'kota' => strtoupper($this->request->getPost('kota')),
            'alamat' => strtoupper($this->request->getPost('alamat')),
            'nopol' => strtoupper($this->request->getPost('nopol')),
            'pembayaran' => $this->request->getPost('pembayaran'),
            'ppn' => ($this->request->getPost('ppn') == 'PPN') ? 11 : 0,
            'term' => $this->request->getPost('term')
        ];

        // Melakukan update pada tabel terima_bahan
        $terimaPartModel->update($id_penerimaan, $dataUpdate);

        return redirect()->to(base_url('/order_pos_terimapartprev/' . $id_penerimaan))->with('message', 'Data berhasil diperbarui.');
    }

    // public function createDetailTambah()
    // {
    //     $detailTerimaModel = new M_Pdetail_Terima();

    //     // Mendapatkan id_penerimaan dari form
    //     $id_penerimaan = $this->request->getPost('id_penerimaan');
    //     if (!$id_penerimaan) {
    //         return redirect()->back()->with('error', 'ID Terima PO tidak ditemukan.');
    //     }

    //     // Data yang akan disimpan
    //     $harga = $this->request->getPost('harga');
    //     $disc = $this->request->getPost('disc') ?: 0; // Default diskon 0 jika tidak ada
    //     $qty = $this->request->getPost('qty');

    //     $jumlah = $qty * ($harga - $disc); // Perhitungan jumlah

    //     $data = [
    //         'id_kode_barang'  => $this->request->getPost('id_kode_barang'),
    //         'nama_barang'  => $this->request->getPost('nama_barang'),
    //         'qty'          => $qty,
    //         'satuan'       => $this->request->getPost('satuan'),
    //         'harga'        => $harga,
    //         'disc'         => $disc,
    //         'jumlah'       => $jumlah,
    //         'id_penerimaan' => $id_penerimaan // Simpan ID Terima PO
    //     ];

    //     // Insert data ke dalam database
    //     $detailTerimaModel->insert($data);

    //     // Redirect dengan pesan sukses
    //     return redirect()->to('/order_pos_terimapartprev/' . $id_penerimaan)->with('message', 'Barang berhasil ditambahkan');
    // }

    public function delete_terima($id)
    {
        $db = \Config\Database::connect();
        $db->transStart(); // Memulai transaksi

        // Menghapus data terkait di tabel detail_barang
        $detailTerimaModel = new M_Pdetail_Terima();
        $detailTerimaModel->where('id_penerimaan', $id)->delete();

        // Menghapus data di tabel id_penerimaan
        $terimaPartModel = new M_Part_Terima();
        $terimaPartModel->where('id_penerimaan', $id)->delete();

        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            return redirect()->to('terima_part')->with('error', 'Data gagal dihapus');
        } else {
            return redirect()->to('terima_part')->with('berhasil', 'Data berhasil dihapus');
        }
    }

    public function delete_detailterima($id)
    {
        $detailTerimaModel = new M_Pdetail_Terima();

        // Ambil id_penerimaan berdasarkan id
        $id_penerimaan = $detailTerimaModel->getIdPenerimaanByKodeBarang($id);

        // Menghapus data berdasarkan id
        $result = $detailTerimaModel->deleteByKodeBarang($id);

        if ($result) {
            return redirect()->to(base_url('/order_pos_terimapartprev/' . $id_penerimaan))->with('message', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('message', 'Data gagal dihapus.');
        }
    }

    // public function permintaan_sparepart_supply($id_terima_po = null)
    // {
    //     // Inisialisasi model yang diperlukan
    //     $partbahanModel = new M_Part_Terima();
    //     $Pomodel = new M_Po();
    //     $SparepartPoModel = new M_SparepartPo();
    //     $supplierModel = new M_Supplier();

    //     // Ambil data PO yang belum terkirim sparepart
    //     $poData = $Pomodel->getFilteredDataSparepartNotSentSupply();

    //     // Ambil sparepart dan detail berdasarkan id_terima_po
    //     $sparepart = [];
    //     $detailPO = [];

    //     if ($id_terima_po) {
    //         // Jika id_terima_po diberikan, ambil data sesuai dengan id tersebut
    //         $sparepart = $SparepartPoModel->where('id_terima_po', $id_terima_po)
    //             ->where('jenis_part', 'SUPPLY')
    //             ->where('is_sent', '0') // Hanya ambil sparepart yang belum dikirim
    //             ->findAll();

    //         $detailPO[$id_terima_po] = $SparepartPoModel->getDetail($id_terima_po);
    //     } else {
    //         // Jika tidak ada id_terima_po, ambil data untuk semua PO
    //         foreach ($poData as $po) {
    //             $detailPO[$po['id_terima_po']] = $SparepartPoModel->getDetail($po['id_terima_po']);
    //         }
    //     }

    //     // Menyiapkan data untuk dikirim ke view
    //     $data = [
    //         'title' => 'Permintaan Supply',
    //         'poData' => $poData,
    //         'detailPO' => $detailPO,
    //         'suppliers' => $supplierModel->findAll(),
    //         'id_penerimaan' => $partbahanModel->generateIdSupply(),
    //         'spareparts' => $sparepart, // Menggunakan data sparepart yang terfilter
    //         'SparepartPoModel' => $SparepartPoModel
    //     ];

    //     return view('sparepart/minta_part_supp', $data);
    // }
    public function permintaan_sparepart_supply($id_terima_po = null)
    {
        // Inisialisasi model yang diperlukan
        $partbahanModel = new M_Part_Terima();
        $Pomodel = new M_Po();
        $SparepartPoModel = new M_SparepartPo();
        $supplierModel = new M_Supplier();
        $repairOrderModel = new M_RepairOrder(); // Inisialisasi M_RepairOrder

        // Ambil data PO yang belum terkirim sparepart
        $poData = $Pomodel->getFilteredDataSparepartNotSentSupply();

        // Ambil data Repair Order yang belum terkirim sparepart
        $repairOrderData = $repairOrderModel->findAll();

        // Gabungkan data PO dan Repair Order
        $combinedData = array_merge($poData, $repairOrderData);

        // Ambil sparepart dan detail berdasarkan id_terima_po
        $sparepart = [];
        $detailData = []; // Gabungan detail untuk PO dan Repair Order
        $filteredCombinedData = []; // Array untuk menyimpan hanya data yang memiliki sparepart

        if ($id_terima_po) {
            $sparepart = $SparepartPoModel->where('id_terima_po', $id_terima_po)
                ->where('jenis_part', 'SUPPLY')
                ->where('is_sent', '0') // Hanya ambil sparepart yang belum dikirim
                ->findAll();

            if (!empty($sparepart)) {
                $detailData[$id_terima_po] = $SparepartPoModel->getDetail($id_terima_po);
            }
        } else {
            // Jika tidak ada id_terima_po, ambil data untuk semua PO dan Repair Order
            foreach ($combinedData as $data) {
                $sparepart = $SparepartPoModel->where('id_terima_po', $data['id_terima_po'])
                    ->where('jenis_part', 'SUPPLY')
                    ->where('is_sent', '0')
                    ->findAll();

                if (!empty($sparepart)) {
                    $detailData[$data['id_terima_po']] = $SparepartPoModel->getDetail($data['id_terima_po']);

                    $filteredCombinedData[] = $data;
                }
            }
        }

        // Menyiapkan data untuk dikirim ke view
        $data = [
            'title' => 'Permintaan Supply',
            'poData' => $filteredCombinedData, // Gabungan data PO dan Repair Order
            'detailPO' => $detailData, // Gabungan detail PO dan Repair Order
            'suppliers' => $supplierModel->findAll(),
            'id_penerimaan' => $partbahanModel->generateIdSupply(),
            'spareparts' => $sparepart, // Menggunakan data sparepart yang terfilter
            'SparepartPoModel' => $SparepartPoModel
        ];


        return view('sparepart/minta_part_supp', $data);
    }


    public function create_partadd()
    {
        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $kartuStokModel = new M_kartu_stok();
        $modelPartPo = new M_Part_Terima();
        $modelSparepart = new M_SparepartPo();
        $modelPdetailPesan = new M_Pdetail_Terima();
        $id_penerimaan = $modelPartPo->generateIdSupply();

        $data = [
            'id_penerimaan'     => $id_penerimaan,
            'tanggal'           => $this->request->getPost('tgl'),
            'kode_supplier'     => $this->request->getPost('kode_supplier'),
            'supplier'          => strtoupper($this->request->getPost('supplier')),
            'gudang'            => strtoupper($this->request->getPost('gudang')),
            'keterangan'        => strtoupper($this->request->getPost('keterangan')),
            'no_repair_order'   => strtoupper($this->request->getPost('no_ro')),
            'nama_pemilik'      => strtoupper($this->request->getPost('nama_pemilik')),
            'asuransi'          => strtoupper($this->request->getPost('asuransi')),
            'nopol'             => strtoupper($this->request->getPost('no_kendaraan')),
            'no_rangka'         => strtoupper($this->request->getPost('no_rangka')),
            'jenis_mobil'       => strtoupper($this->request->getPost('jenis_mobil')),
            'warna'             => strtoupper($this->request->getPost('warna')),
            'user_id'           => $user_id,
        ];

        // Insert data ke M_Part_Po
        if ($modelPartPo->insert($data) === false) {
            return redirect()->back()->withInput()->with('error', $modelPartPo->errors());
        }

        $selectedIds = $this->request->getPost('selected_ids');

        // Proses hanya sparepart yang dicentang
        if (!empty($selectedIds)) {
            foreach ($selectedIds as $id) {
                // Ambil sparepart yang dipilih berdasarkan ID
                $selectedSparepart = $modelSparepart->find($id);

                if ($selectedSparepart) {
                    // Cek apakah data detail pesan sudah ada
                    $existingDetail = $modelPdetailPesan->where('id_kode_barang', $selectedSparepart['id_sparepart_po'])
                        ->where('id_penerimaan', $data['id_penerimaan'])
                        ->first();

                    if (!$existingDetail) {
                        // Simpan data di tabel M_Pdetail_Pesan
                        $dataDetailPesan = [
                            'id_penerimaan'  => $data['id_penerimaan'],
                            'qty'            => $selectedSparepart['qty'],
                            'satuan'         => 'PCS',
                            'id_kode_barang' => $selectedSparepart['kode_sparepart'],
                            'nama_barang'    => $selectedSparepart['nama_sparepart'],
                        ];
                        $modelPdetailPesan->insert($dataDetailPesan);
                    }

                    // Update is_sent menjadi 1 untuk sparepart yang dipilih
                    $modelSparepart->update($id, ['is_sent' => '1']);

                    // Siapkan data untuk kartu stok
                    // $kartuStokData = [
                    //     'nomor' => $id_penerimaan,
                    //     'id_kode_barang' => $selectedSparepart['kode_sparepart'],
                    //     'nama_barang' => $selectedSparepart['nama_sparepart'],
                    //     'nopol' => $this->request->getPost('nopol'),
                    //     'tanggal' => $this->request->getPost('tgl'),
                    //     'transaksi' => 'SUPPLY DARI ' . strtoupper($this->request->getPost('asuransi')),
                    //     'debit' => $this->request->getPost('qty'),
                    //     'saldo' => $this->request->getPost('qty'),
                    //     'gudang' => strtoupper($this->request->getPost('gudang')),
                    // ];

                    // // Simpan data ke tabel kartu_stok
                    // $kartuStokModel->insert($kartuStokData);

                    // Mengirim data ke gudang
                    $gudangModel = $this->getGudangModel($data['gudang']);
                    $gudangData = [
                        'id_kode_barang' => $selectedSparepart['kode_sparepart'],
                        'nama_barang'    => $selectedSparepart['nama_sparepart'],
                        'harga'          => $selectedSparepart['harga'],
                        'debit'          => $this->request->getPost('qty'), // Pastikan qty dikirim melalui form
                        'stok'           => $this->request->getPost('qty'),
                        'nopol'          => $this->request->getPost('no_kendaraan'),
                        'gudang'         => $data['gudang'],
                        'id_penerimaan'  => $id_penerimaan,
                    ];

                    if ($gudangModel) {
                        $this->saveOrUpdateGudang($gudangModel, $gudangData);
                    } else {
                        return redirect()->back()->with('error', 'Model gudang tidak ditemukan.');
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Data berhasil diproses.');
    }



    public function supply_asuransi()
    {
        $modelPart = new M_Part_Terima();
        $userModel = new UserModel();

        $supply = $modelPart->getSupplyAsuransiWithSP();

        foreach ($supply as &$item) {
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Supply List',
            'supply' => $supply,
        ];

        return view('sparepart/supp_asuransi', $data);
    }


    public function add_supp_asuransi()
    {


        $data = [
            'title' => ' Supply List',

        ];
        return view('sparepart/supp_asuransi_add', $data);
    }

    public function prev_supp_asuransi($id_penerimaan)
    {
        $terimaPartModel = new M_Part_Terima();
        $dataTerima = $terimaPartModel->find($id_penerimaan);


        if ($dataTerima) {
            $detailTerimaModel = new M_Pdetail_Terima();
            $detailTerima = $detailTerimaModel->where('id_penerimaan', $id_penerimaan)->findAll();

            // Hitung total qty dan total jumlah
            $totalQty = 0;
            $totalJumlah = 0;

            foreach ($detailTerima as $detail) {
                $totalQty += $detail['qty'];
                $totalJumlah += $detail['jumlah'];
            }
            $data = [
                'title' => ' Supply List',
                'sparepart' => $dataTerima,
                'detail_terima' => $detailTerima,
            ];
            return view('sparepart/supp_asuransi_prev', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }


    // ---------------------------------------------------------------------------------------------------------------------



    //REPAIR MATERIAL SPAREPART -----------------------------------------------------------------------------------------------------------------------

    public function repair_material_sparepart()
    {
        $partRepairModel = new M_Part_Repair();
        $userModel = new UserModel();

        $repair = $partRepairModel->orderBy('id_material', 'DESC')->findAll();

        foreach ($repair as &$item) {
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'repair' => $repair,
            'title' => 'RM Sparepart',
        ];

        return view('sparepart/repair_material_part', $data);
    }

    public function getSparepartTerima()
    {
        $id_penerimaan = $this->request->getGet('id_penerimaan');

        if (!$id_penerimaan) {
            return $this->response->setStatusCode(400, 'ID Pesan tidak ditemukan');
        }

        $pdetailTerimaModel = new M_Pdetail_Terima();
        $data = $pdetailTerimaModel->getSparepartsByTerima($id_penerimaan);

        return $this->response->setJSON($data);
    }


    public function add_repair_material()
    {
        $partRepairModel = new M_Part_Repair();
        $barangData = $partRepairModel->getAllBarangSparepart();
        $poData = $partRepairModel->getAllPO();
        $penerimaan = $partRepairModel->getpenerimaanJoinedDataWithIsSent();

        $data = [
            'title' => 'RM Sparepart',
            'generateIdrepair' => $partRepairModel->generateId(),
            'barang' => $barangData,
            'po' => $poData,
            'penerimaan' => $penerimaan,

        ];
        return view('sparepart/repair_material_add', $data);
    }



    public function createRepairPart()
    {
        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $partRepairModel = new M_Part_Repair();
        $detailRepairModel = new M_Pdetail_Repair();
        $gdStokModel = new M_Gd_Stok();
        $kartuStokModel = new M_Kartu_Stok();

        // Generate unique ID for 'id_material'
        $generateId = $partRepairModel->generateId();

        // Menghitung total qty dan total hpp
        $qty_B = $this->request->getPost('qty_B');
        $sat_B = $this->request->getPost('sat_B');
        $hpp = $this->request->getPost('hpp');
        $total_qty_B = array_sum($qty_B);
        $total_hpp = array_sum($hpp);

        // Data untuk tabel bahan_repair
        $data = [
            'id_material' => $this->request->getPost('id_material'),
            'tanggal' => $this->request->getPost('tanggal'),
            'gudang_masuk' => strtoupper($this->request->getPost('gudang_masuk')),
            'gudang_keluar' => strtoupper($this->request->getPost('gudang_keluar')),
            'no_repair' => strtoupper($this->request->getPost('no_ro')),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'nopol' => strtoupper($this->request->getPost('nopol')),
            'asuransi' => strtoupper($this->request->getPost('asuransi')),
            'jenis_mobil' => strtoupper($this->request->getPost('jenis_mobil')),
            'warna' => strtoupper($this->request->getPost('warna')),
            'tahun' => $this->request->getPost('tahun'),
            'nama_pemilik' => strtoupper($this->request->getPost('nama_pemilik')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'total_qty_B' => $total_qty_B,
            'total_hpp' => $total_hpp,
            'user_id' => $user_id
        ];

        // Cek stok di gudang keluar
        $gudangKeluar = $this->request->getPost('gudang_keluar');
        $id_kode_barang = $this->request->getPost('id_kode_barang');
        $nama_barang = $this->request->getPost('nama_barang');
        $nopol = $this->request->getPost('nopol');

        foreach ($id_kode_barang as $index => $kode) {
            $stokAda = $this->cekStokGudang($gudangKeluar, $kode, $nama_barang[$index], $nopol);
            if ($stokAda < $qty_B[$index]) {
                return redirect()->back()->with('error', 'Stok di gudang untuk barang ' . $nama_barang[$index] . ' dengan nopol ' . $nopol . ' tidak mencukupi.');
            }
        }

        // Lanjutkan penyimpanan data bahan_repair
        $partRepairModel->insert($data);

        // Proses penyimpanan detail dan update stok seperti semula
        foreach ($id_kode_barang as $index => $kode) {
            $detail = [
                'id_material' => $generateId,
                'id_kode_barang' => $kode,
                'nama_barang' => strtoupper($nama_barang[$index]),
                'sat_B' => strtoupper($sat_B[$index]),
                'qty_B' => $qty_B[$index],
                'hpp' => $hpp[$index],
                'no_repair_order' => strtoupper($this->request->getPost('no_ro')),
                'nopol' => strtoupper($this->request->getPost('nopol')),
                'asuransi' => strtoupper($this->request->getPost('asuransi')),
                'jenis_mobil' => strtoupper($this->request->getPost('jenis_mobil')),
            ];
            $detailRepairModel->insert($detail);

            // Update stok di gudang keluar sesuai pilihan
            $this->updateGudangStok($gudangKeluar, $kode, $qty_B[$index]);

            // Kirim data ke kartu stok
            $this->kirimKeKartuStok($kode, strtoupper($nama_barang[$index]), $nopol, date('Y-m-d'), $qty_B[$index], $data['asuransi'], 'MUTASI OUT');
        }

        return redirect()->to(base_url('/repair_material_prev/' . $generateId))->with('message', 'Data berhasil disimpan.');
    }

    // Fungsi untuk cek stok di gudang yang sesuai
    private function cekStokGudang($gudangKeluar, $id_kode_barang, $nama_barang, $nopol)
    {
        switch ($gudangKeluar) {
            case 'GUDANG STOK SPAREPART':
                $model = new M_Gd_Stok();
                break;
            case 'GUDANG REPAIR':
                $model = new M_Gd_Repair();
                break;
            case 'GUDANG SUPPLY ASURANSI':
                $model = new M_Gd_Supply();
                break;
            case 'GUDANG WAITING':
                $model = new M_Gd_Waiting();
                break;
            case 'GUDANG SALVAGE':
                $model = new M_Gd_Salvage();
                break;
            default:
                return 0;
        }

        $barang = $model->where('id_kode_barang', $id_kode_barang)
            ->where('nama_barang', $nama_barang)
            ->where('nopol', $nopol)
            ->first();

        return $barang ? $barang['stok'] : 0;
    }

    // Fungsi untuk mengurangi stok di gudang keluar
    private function updateGudangStok($gudangKeluar, $id_kode_barang, $qty_B)
    {
        switch ($gudangKeluar) {
            case 'GUDANG STOK SPAREPART':
                $model = new M_Gd_Stok();
                break;
            case 'GUDANG REPAIR':
                $model = new M_Gd_Repair();
                break;
            case 'GUDANG SUPPLY ASURANSI':
                $model = new M_Gd_Supply();
                break;
            case 'GUDANG WAITING':
                $model = new M_Gd_Waiting();
                break;
            case 'GUDANG SALVAGE':
                $model = new M_Gd_Salvage();
                break;
            default:
                return;
        }

        $barang = $model->where('id_kode_barang', $id_kode_barang)->first();
        if ($barang) {
            // Update stok dan credit
            $model->update($barang['id'], [
                'stok' => $barang['stok'] - $qty_B,
                'credit' => $barang['credit'] + $qty_B, // Tambahkan nilai credit
            ]);
        }
    }

    // Fungsi untuk mengirim data ke kartu stok
    private function kirimKeKartuStok($id_kode_barang, $nama_barang, $nopol, $tanggal, $qty_B, $asuransi, $transaksi)
    {
        $kartuStokModel = new M_Kartu_Stok();

        $data = [
            'id_kode_barang' => $id_kode_barang,
            'nama_barang' => $nama_barang,
            'nopol' => $nopol,
            'tanggal' => $tanggal,
            'transaksi' => $transaksi . " - " . $asuransi,
            'credit' => $qty_B,
            'saldo' => 0, // Anda bisa sesuaikan sesuai kebutuhan saldo
        ];

        $kartuStokModel->insert($data);
    }


    public function prev_repair_preview($id_material)
    {
        $partRepairModel = new M_Part_Repair();
        $detailRepairModel = new M_Pdetail_Repair();

        // Get the repair data from bahan_repair table
        $repairData = $partRepairModel->find($id_material);

        if ($repairData) {
            // Get the detail data from detail_repair table
            $detailData = $detailRepairModel->where('id_material', $id_material)->findAll();

            // Calculate total quantities and HPP
            $totalQtyB = 0;
            $totalHpp = 0;

            foreach ($detailData as $detail) {
                $totalQtyB += $detail['qty_B'];
                $totalHpp += $detail['hpp'];
            }

            $data = [
                'title' => 'RM Sparepart',
                'repair' => $repairData,
                'detail_repair' => $detailData,
                'total_qty_B' => $totalQtyB,
                'total_hpp' => $totalHpp,
            ];

            return view('sparepart/repair_material_prev', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }



    public function updateRepairPart()
    {
        $partRepairModel = new M_Part_Repair();
        $id_material = $this->request->getPost('id_material');
        $dataUpdate = [
            'tanggal' => $this->request->getPost('tanggal'),
            'gudang_masuk' => strtoupper($this->request->getPost('gudang_masuk')),
            'gudang_keluar' => strtoupper($this->request->getPost('gudang_keluar')),
            'no_repair' => strtoupper($this->request->getPost('no_ro')),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'nopol' => strtoupper($this->request->getPost('nopol')),
            'jenis_mobil' => strtoupper($this->request->getPost('jenis_mobil')),
            'warna' => strtoupper($this->request->getPost('warna')),
            'tahun' => $this->request->getPost('tahun'),
            'nama_pemilik' => strtoupper($this->request->getPost('nama_pemilik')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),

        ];
        $partRepairModel->update($id_material, $dataUpdate);

        return redirect()->to(base_url('/repair_material_prev/' . $id_material))->with('message', 'Data berhasil diperbarui.');
    }

    public function delete_repair_part($id_material)
    {
        $db = \Config\Database::connect();
        $db->transStart(); // Memulai transaksi

        // Menghapus data terkait di tabel detail_repair
        $detailRepairModel = new M_Pdetail_Repair();
        $detailRepairModel->where('id_material', $id_material)->delete();

        // Menghapus data di tabel bahan_repair
        $bahanRepairModel = new M_Part_Repair();
        $bahanRepairModel->where('id_material', $id_material)->delete();

        $db->transComplete(); // Menyelesaikan transaksi

        if ($db->transStatus() === FALSE) {
            return redirect()->to('repair_material_part')->with('error', 'Data gagal dihapus.');
        } else {
            return redirect()->to('repair_material_part')->with('berhasil', 'Data berhasil dihapus.');
        }
    }


    // ---------------------------------------------------------------------------------------------------------------------



    // ---------------------------------------------------------------------------------------------------------------------
    public function mutasi_gudang_sparepart()
    {
        $gdStokModel = new M_Gd_Stok();
        $gdRepairModel = new M_Gd_Repair();
        $gdSupplyModel = new M_Gd_Supply();
        $gdWaitingModel = new M_Gd_Waiting();
        $gdSalvageModel = new M_Gd_Salvage();


        $data = [
            'title' => 'Mutasi Sparepart',
            'stok' => $gdStokModel->orderBy('id')->findAll(),
            'repair' => $gdRepairModel->orderBy('id')->findAll(),
            'supply' => $gdSupplyModel->orderBy('id')->findAll(),
            'waiting' => $gdWaitingModel->orderBy('id')->findAll(),
            'salvage' => $gdSalvageModel->orderBy('id')->findAll(),
        ];
        return view('sparepart/mutasi_gudang_part', $data);
    }




    public function mutasigudangStokKeGudang()
    {
        $id_kode_barang = $this->request->getPost('id_kode_barang');
        $nama_barang = $this->request->getPost('nama_barang');
        $qty = (int)$this->request->getPost('qty');
        $gudang_keluar = $this->request->getPost('gudang_keluar');
        $nopol = $this->request->getPost('nopol');
        $harga = $this->request->getPost('harga');
        $stok = $this->request->getPost('stok');
        $gudang = $this->request->getPost('gudang');

        $gdStokModel = new M_Gd_Stok();
        $stokData = $gdStokModel->where('id_kode_barang', $id_kode_barang)->first();

        if ($stokData) {
            if ($stokData['stok'] >= $qty) {
                // Kurangi stok di gudang keluar
                $gdStokModel->update($stokData['id'], [
                    'stok' => $stokData['stok'] - $qty,
                    'credit' => $stokData['credit'] + $qty
                ]);

                // Mutasi ke gudang tujuan
                $this->mutasiKeGudangTujuan($gudang_keluar, $id_kode_barang, $nama_barang, $qty, $nopol, $harga);

                // Kirim laporan ke kartu stok
                $this->laporkanMutasiKeKartuStok($id_kode_barang, $nama_barang, $qty, $gudang, $gudang_keluar, $nopol, $stokData['stok']);
            } else {
                return redirect()->back()->with('error', 'Qty melebihi stok tersedia.');
            }
        } else {
            return redirect()->back()->with('error', 'Barang tidak ditemukan di gudang stok.');
        }

        return redirect()->to('mutasi_gudang_part');
    }



    private function mutasiKeGudangTujuan($gudang, $id_kode_barang, $nama_barang, $qty, $nopol, $harga)
    {
        switch ($gudang) {
            case 'GUDANG STOK SPAREPART':
                $model = new M_Gd_Stok();
                break;
            case 'GUDANG SUPPLY ASURANSI':
                $model = new M_Gd_Supply();
                break;
            case 'GUDANG WAITING':
                $model = new M_Gd_Waiting();
                break;
            case 'GUDANG SALVAGE':
                $model = new M_Gd_Salvage();
                break;
            default:
                return;
        }

        // Cek apakah barang sudah ada di gudang tujuan dengan nopol yang sama
        $data = $model->where('id_kode_barang', $id_kode_barang)
            ->where('nopol', $nopol) // Tambahkan syarat nopol
            ->first();

        if ($data) {
            // Jika ada, update debit, stok, dan harga (jika harga baru tersedia)
            $updateData = [
                'debit' => $data['debit'] + $qty,
                'stok' => $data['stok'] + $qty,
                'gudang' => $gudang
            ];

            if ($harga) {
                $updateData['harga'] = $harga; // Update harga jika ada
            }

            $model->update($data['id'], $updateData);
        } else {
            // Jika tidak ada, tambahkan data baru
            $model->insert([
                'id_kode_barang' => $id_kode_barang,
                'nama_barang' => $nama_barang,
                'debit' => $qty,
                'stok' => $qty,
                'credit' => 0,
                'nopol' => $nopol, // Tambahkan nopol
                'harga' => $harga ?? 0, // Tambahkan harga jika ada, atau 0 jika tidak
                'gudang' => $gudang, // Tambahkan
            ]);
        }
    }

    private function laporkanMutasiKeKartuStok($id_kode_barang, $nama_barang, $qty, $gudang, $gudang_keluar, $nopol, $stokSebelum)
    {
        $log = date('ymdhis');
        $kartuStokModel = new M_Kartu_Stok();

        // Catatan Mutasi OUT (pengurangan stok di gudang keluar)
        $kartuStokModel->insert([
            'tanggal' => date('Y-m-d'),
            'nomor' => 'MUTASI_OUT.' . $log,
            'transaksi' => 'MUTASI KE ' . $gudang_keluar,
            'debit' => 0,
            'credit' => $qty,
            'saldo' => $stokSebelum - $qty,
            'id_kode_barang' => $id_kode_barang,
            'nama_barang' => $nama_barang,
            'nopol' => $nopol,
            'gudang' => $gudang,
        ]);

        // Mutasi ke gudang tujuan sudah terjadi, kita catat sebagai Mutasi IN
        $kartuStokModel->insert([
            'tanggal' => date('Y-m-d'),
            'nomor' => 'MUTASI_IN.' . $log,
            'transaksi' => 'MUTASI Dari ' . $gudang, // Deskripsi bisa diubah jika perlu
            'debit' => $qty,
            'credit' => 0,
            'saldo' => $stokSebelum, // Ini hanya untuk laporan
            'id_kode_barang' => $id_kode_barang,
            'nama_barang' => $nama_barang,
            'nopol' => $nopol,
            'gudang' => $gudang_keluar,
        ]);
    }



    public function mutasigudangSupplyKeGudang()
    {
        $id_kode_barang = $this->request->getPost('id_kode_barang');
        $nama_barang = $this->request->getPost('nama_barang');
        $qty = (int)$this->request->getPost('qty');
        $gudang_keluar = $this->request->getPost('gudang_keluar');
        $nopol = $this->request->getPost('nopol'); // Tambahkan nopol
        $harga = $this->request->getPost('harga'); // Tambahkan harga jika ada

        // Model untuk masing-masing tabel
        $gdSupplyModel = new M_Gd_Supply();

        // Cek apakah barang ada di gudang supply
        $supplyData = $gdSupplyModel->where('id_kode_barang', $id_kode_barang)->first();

        if ($supplyData) {
            // Update debit dan stok gudang supply
            if ($supplyData['stok'] >= $qty) {
                // Mengurangi stok di gudang supply
                $gdSupplyModel->update($supplyData['id'], [
                    'stok' => $supplyData['stok'] - $qty,
                    'credit' => $supplyData['credit'] + $qty // Update credit sesuai pengurangan stok
                ]);

                // Menambahkan ke gudang tujuan
                $this->SupplymutasiKeGudangTujuan($gudang_keluar, $id_kode_barang, $nama_barang, $qty, $nopol, $harga);
            } else {
                // Jika qty lebih dari stok
                return redirect()->back()->with('error', 'Qty melebihi stok tersedia.');
            }
        } else {
            // Jika barang tidak ada di gudang supply
            return redirect()->back()->with('error', 'Barang tidak ditemukan di gudang supply.');
        }

        return redirect()->to('mutasi_gudang_part'); // Ganti dengan path yang sesuai
    }

    private function SupplymutasiKeGudangTujuan($gudang, $id_kode_barang, $nama_barang, $qty, $nopol, $harga)
    {
        switch ($gudang) {
            case 'GUDANG STOK SPAREPART':
                $model = new M_Gd_Stok();
                break;
            case 'GUDANG SUPPLY ASURANSI':
                $model = new M_Gd_Supply();
                break;
            case 'GUDANG WAITING':
                $model = new M_Gd_Waiting();
                break;
            case 'GUDANG SALVAGE':
                $model = new M_Gd_Salvage();
                break;
            default:
                return;
        }

        // Cek apakah barang sudah ada di gudang tujuan dengan nopol yang sama
        $data = $model->where('id_kode_barang', $id_kode_barang)
            ->where('nopol', $nopol) // Tambahkan syarat nopol
            ->first();

        if ($data) {
            // Jika ada, update debit, stok, dan harga (jika harga baru tersedia)
            $updateData = [
                'debit' => $data['debit'] + $qty,
                'stok' => $data['stok'] + $qty,
                'gudang' => $gudang
            ];

            if ($harga) {
                $updateData['harga'] = $harga; // Update harga jika ada
            }

            $model->update($data['id'], $updateData);
        } else {
            // Jika tidak ada, tambahkan data baru
            $model->insert([
                'id_kode_barang' => $id_kode_barang,
                'nama_barang' => $nama_barang,
                'debit' => $qty,
                'stok' => $qty,
                'credit' => 0,
                'nopol' => $nopol, // Tambahkan nopol
                'harga' => $harga ?? 0, // Tambahkan harga jika ada, atau 0 jika tidak
                'gudang' => $gudang, // Tambahkan
            ]);
        }
    }




    public function mutasigudangWaitingKeGudang()
    {
        $id_kode_barang = $this->request->getPost('id_kode_barang');
        $nama_barang = $this->request->getPost('nama_barang');
        $qty = (int)$this->request->getPost('qty');
        $gudang_keluar = $this->request->getPost('gudang_keluar');
        $nopol = $this->request->getPost('nopol'); // Tambahkan nopol
        $harga = $this->request->getPost('harga'); // Tambahkan harga jika ada

        // Model untuk masing-masing tabel
        $gdWaitingModel = new M_Gd_Waiting();


        // Cek apakah barang ada di gudang waiting
        $waitingData = $gdWaitingModel->where('id_kode_barang', $id_kode_barang)
            ->where('nopol', $nopol) // Tambahkan syarat nopol
            ->first();

        if ($waitingData) {
            // Update debit dan stok gudang waiting
            if ($waitingData['stok'] >= $qty) {
                // Mengurangi stok di gudang waiting
                $gdWaitingModel->update($waitingData['id'], [
                    'stok' => $waitingData['stok'] - $qty,
                    'credit' => $waitingData['credit'] + $qty // Update credit sesuai pengurangan stok
                ]);

                // Menambahkan ke gudang tujuan
                $this->WaitingmutasiKeGudangTujuan($gudang_keluar, $id_kode_barang, $nama_barang, $qty, $nopol, $harga);
            } else {
                // Jika qty lebih dari stok
                return redirect()->back()->with('error', 'Qty melebihi stok tersedia.');
            }
        } else {
            return redirect()->back()->with('error', 'Barang tidak ditemukan di gudang waiting.');
        }

        return redirect()->to('mutasi_gudang_part'); // Ganti dengan path yang sesuai
    }

    private function WaitingmutasiKeGudangTujuan($gudang, $id_kode_barang, $nama_barang, $qty, $nopol, $harga)
    {
        switch ($gudang) {
            case 'GUDANG STOK SPAREPART':
                $model = new M_Gd_Stok();
                break;
            case 'GUDANG SUPPLY ASURANSI':
                $model = new M_Gd_Supply();
                break;
            case 'GUDANG WAITING':
                $model = new M_Gd_Waiting();
                break;
            case 'GUDANG SALVAGE':
                $model = new M_Gd_Salvage();
                break;
            default:
                return;
        }

        // Cek apakah barang sudah ada di gudang tujuan dengan nopol yang sama
        $data = $model->where('id_kode_barang', $id_kode_barang)
            ->where('nopol', $nopol) // Tambahkan syarat nopol
            ->first();

        if ($data) {
            // Jika ada, update debit, stok, dan harga (jika harga baru tersedia)
            $updateData = [
                'debit' => $data['debit'] + $qty,
                'stok' => $data['stok'] + $qty,
                'gudang' => $gudang
            ];

            if ($harga) {
                $updateData['harga'] = $harga; // Update harga jika ada
            }

            $model->update($data['id'], $updateData);
        } else {
            // Jika tidak ada, tambahkan data baru
            $model->insert([
                'id_kode_barang' => $id_kode_barang,
                'nama_barang' => $nama_barang,
                'debit' => $qty,
                'stok' => $qty,
                'credit' => 0,
                'nopol' => $nopol, // Tambahkan nopol
                'harga' => $harga ?? 0, // Tambahkan harga jika ada, atau 0 jika tidak
                'gudang' => $gudang, // Tambahkan
            ]);
        }
    }



    public function mutasigudangSalvageKeGudang()
    {
        $id_kode_barang = $this->request->getPost('id_kode_barang');
        $nama_barang = $this->request->getPost('nama_barang');
        $qty = (int)$this->request->getPost('qty');
        $gudang_keluar = $this->request->getPost('gudang_keluar');
        $nopol = $this->request->getPost('nopol'); // Tambahkan nopol
        $harga = $this->request->getPost('harga'); // Tambahkan harga jika ada

        // Model untuk masing-masing tabel
        $gdSalvageModel = new M_Gd_Salvage();

        // Cek apakah barang ada di gudang salvage
        $salvageData = $gdSalvageModel->where('id_kode_barang', $id_kode_barang)
            ->where('nopol', $nopol) // Tambahkan syarat nopol
            ->first();

        if ($salvageData) {
            // Update debit dan stok gudang salvage
            if ($salvageData['stok'] >= $qty) {
                // Mengurangi stok di gudang salvage
                $gdSalvageModel->update($salvageData['id'], [
                    'stok' => $salvageData['stok'] - $qty,
                    'credit' => $salvageData['credit'] + $qty // Update credit sesuai pengurangan stok
                ]);

                // Menambahkan ke gudang tujuan
                $this->SalvagemutasiKeGudangTujuan($gudang_keluar, $id_kode_barang, $nama_barang, $qty, $nopol, $harga);
            } else {
                // Jika qty lebih dari stok
                return redirect()->back()->with('error', 'Qty melebihi stok tersedia.');
            }
        } else {
            return redirect()->back()->with('error', 'Barang tidak ditemukan di gudang salvage.');
        }

        return redirect()->to('mutasi_gudang_part'); // Ganti dengan path yang sesuai
    }

    private function SalvagemutasiKeGudangTujuan($gudang, $id_kode_barang, $nama_barang, $qty, $nopol, $harga)
    {
        switch ($gudang) {
            case 'GUDANG STOK SPAREPART':
                $model = new M_Gd_Stok();
                break;
            case 'GUDANG SUPPLY ASURANSI':
                $model = new M_Gd_Supply();
                break;
            case 'GUDANG WAITING':
                $model = new M_Gd_Waiting();
                break;
            case 'GUDANG SALVAGE':
                $model = new M_Gd_Salvage();
                break;
            default:
                return;
        }

        // Cek apakah barang sudah ada di gudang tujuan dengan nopol yang sama
        $data = $model->where('id_kode_barang', $id_kode_barang)
            ->where('nopol', $nopol) // Tambahkan syarat nopol
            ->first();

        if ($data) {
            // Jika ada, update debit, stok, dan harga (jika harga baru tersedia)
            $updateData = [
                'debit' => $data['debit'] + $qty,
                'stok' => $data['stok'] + $qty,
                'gudang' => $gudang
            ];

            if ($harga) {
                $updateData['harga'] = $harga; // Update harga jika ada
            }

            $model->update($data['id'], $updateData);
        } else {
            // Jika tidak ada, tambahkan data baru
            $model->insert([
                'id_kode_barang' => $id_kode_barang,
                'nama_barang' => $nama_barang,
                'debit' => $qty,
                'stok' => $qty,
                'credit' => 0,
                'nopol' => $nopol, // Tambahkan nopol
                'harga' => $harga ?? 0, // Tambahkan harga jika ada, atau 0 jika tidak
                'gudang' => $gudang, // Tambahkan
            ]);
        }
    }





    // ---------------------------------------------------------------------------------------------------------------------


    // ---------------------------------------------------------------------------------------------------------------------
    public function part_dalam_pesanan()
    {

        $partPoModel = new M_Part_Po();
        $PoDetail = $partPoModel->getPartPoWithDetails();

        $data = [
            'title' => 'Sparepart PO',
            'part' => $PoDetail,
        ];
        return view('sparepart/waiting_part', $data);
    }

    // ---------------------------------------------------------------------------------------------------------------------



    // ---------------------------------------------------------------------------------------------------------------------
    // Controller
    public function part_diterima()
    {
        $partTerimaModel = new M_Part_Terima();
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');

        if ($start && $end) {
            $partTerima = $partTerimaModel->getFilteredPartTerima($start, $end);
        } else {
            $partTerima = $partTerimaModel->getPartTerimaWithDetails();
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON($partTerima);
        }

        $data = [
            'title' => 'Sparepart Masuk',
            'part' => $partTerima,
        ];

        return view('sparepart/sparepart_masuk', $data);
    }


    // ---------------------------------------------------------------------------------------------------------------------



    // ---------------------------------------------------------------------------------------------------------------------
    public function sparepart_salvage()
    {
        // Memanggil model M_Po
        $gambarPoModel = new M_Po();

        // Mengambil data dengan join tanpa filter
        $dataPogambar = $gambarPoModel->getDataWithJoin();

        // Menyiapkan data untuk view
        $data = [
            'title' => 'Salvage',
            'dataPogambar' => $dataPogambar,
        ];

        // Mengembalikan view dengan data yang diambil
        return view('sparepart/part_salvage', $data);
    }

    // ---------------------------------------------------------------------------------------------------------------------



    // ---------------------------------------------------------------------------------------------------------------------
    public function sparepart_sisa()
    {
        $partModel = new M_Pdetail_Terima();
        $partsBelumPasang = $partModel->getPartBelumpasang();

        $data = [
            'title' => 'Sparepart Sisa',
            'partsBelumPasang' => $partsBelumPasang,
        ];
        return view('sparepart/part_sisa', $data);
    }

    // ---------------------------------------------------------------------------------------------------------------------

    public function sparepart_terpasang()
    {
        $partModel = new M_Pdetail_Terima();
        $getPartPasang = $partModel->getPartPasang();

        $data = [
            'title' => 'Sparepart Terpasang',
            'getPartPasang' => $getPartPasang,
        ];
        return view('sparepart/part_pasang', $data);
    }

    // ---------------------------------------------------------------------------------------------------------------------
    public function stok_sparepart()
    {
        $kartuStokModel = new M_Kartu_Stok();

        // Mengambil parameter dari form
        $search = $this->request->getGet('search');
        $date = $this->request->getGet('date');
        $sortBy = $this->request->getGet('sortby') ?? 'tanggal';  // Default sorting by 'tanggal'
        $order = $this->request->getGet('order') ?? 'asc';        // Default order 'asc'

        // Query dasar
        $query = $kartuStokModel;

        // Filter pencarian jika ada
        if ($search) {
            $query = $query->like('nama_barang', $search)
                ->orLike('id_kode_barang', $search);
        }

        // Filter tanggal jika ada
        if ($date) {
            $query = $query->where('DATE(tanggal)', $date);
        }

        // Ambil data dengan sorting
        $stok = $query->orderBy($sortBy, $order)->findAll();

        // Kirim data ke view
        $data = [
            'title' => 'Kartu Stok',
            'stok' => $stok,
            'sortby' => $sortBy,
            'order' => $order,
            'search' => $search,
            'date' => $date,
        ];

        return view('sparepart/stok_part', $data);
    }



    // ---------------------------------------------------------------------------------------------------------------------













}
