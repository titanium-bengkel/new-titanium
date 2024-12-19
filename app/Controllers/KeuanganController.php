<?php

namespace App\Controllers;

use App\Models\M_Bahan_Repair;
use App\Models\M_Detail_Terima;
use App\Models\M_K_Pembelian;
use App\Models\M_K_DPembelian;
use App\Models\M_Kwitansi;
use App\Models\M_Part_Repair;
use App\Models\M_Pdetail_Terima;
use App\Models\M_RepairOrder;
use App\Models\M_Supplier;
use App\Models\M_Terima_Bahan;
use App\Models\M_HutangSupplier;
use App\Models\M_Kdetail_Pembelian;
use App\Models\M_Rm_Jasa;
use App\Models\M_Jasa;
use App\Models\M_Rm_Detail_Jasa;
use App\Models\M_K_Pembayaran;
use App\Models\M_K_Pembayaran_Detail;
use App\Models\M_KasBank;
use App\Models\M_KasBank_Form;
use App\Models\M_Coa;
use App\Models\M_KasMasuk;
use App\Models\M_P_KasBesar;
use App\Models\M_KasKecil;
use App\Models\M_KasKeluar;
use App\Models\M_ReportJurnal;
use App\Models\UserModel;



class KeuanganController extends BaseController
{

    public function hutang_supp()
    {
        $model = new M_HutangSupplier();
        $supplier = $model->findAll();

        $data = [
            'title' => 'Rekap Hutang',
            'supplier' => $supplier
        ];
        return view('keuangan/hutang', $data);
    }


    //------------------------------------------------------------------------------------------------------------------- 
    public function pembayaran_hutang()
    {
        $pembayaran = new M_K_Pembayaran();
        $userModel = new UserModel();

        $bayar = $pembayaran->findAll();

        foreach ($bayar as &$item) {
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Bayar Hutang',
            'hutang' => $bayar
        ];

        return view('keuangan/bayar_hutang', $data);
    }


    public function laporan_pembelian()
    {
        $pembelianModel = new M_K_Pembelian();
        $userModel = new UserModel();

        $keuangan = $pembelianModel->orderBy('no_faktur', 'DESC')->findAll();

        foreach ($keuangan as &$item) {
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Pembelian',
            'keuangan' => $keuangan,
        ];

        return view('keuangan/pembelian', $data);
    }


    public function add_pembelian()
    {
        $serviceModel = new M_K_Pembelian();
        $supplierModel = new M_Supplier();
        $mergedData = $serviceModel->getMergedData();

        // Ambil data dari kedua model

        $suppliers = $supplierModel->findAll();

        $data = [
            'title' => 'Pembelian',
            'suppliers' => $suppliers,
            'getData' => $mergedData
        ];

        return view('keuangan/pembelian_add', $data);
    }
    public function getDetail($no_po)
    {
        // Buat instance dari kedua model
        $detailBarangModel = new M_Detail_Terima();

        $detailBarang = $detailBarangModel->getAllDetails($no_po);
        return $this->response->setJSON($detailBarang);
    }



    public function createPembelian()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $pembelianModel = new M_K_Pembelian();
        $detailPembelianModel = new M_K_DPembelian();

        // Mengambil data dari request
        $qty = $this->request->getPost('qty');
        $harga = $this->request->getPost('harga');
        $disc = $this->request->getPost('disc');
        $ppn_option = $this->request->getPost('ppn');

        // Menghitung total qty dan total jumlah menggunakan model
        $totals = $detailPembelianModel->calculateTotals($qty, $harga, $disc, $ppn_option);

        // Menyiapkan data untuk disimpan di tabel terima_bahan
        $dataBeli = [
            'no_faktur' => $this->request->getPost('no_faktur'),
            'tanggal' => $this->request->getPost('tgl'),
            'kode_supplier' => $this->request->getPost('kode_supplier'),
            'supplier' => $this->request->getPost('supplier'),
            'jatuh_tempo' => $this->request->getPost('jatuh_tempo'),
            'keterangan' => $this->request->getPost('keterangan'),
            'gudang' => $this->request->getPost('gudang'),
            'no_preor' => $this->request->getPost('nomor'),
            'kota' => $this->request->getPost('kota'),
            'alamat' => $this->request->getPost('alamat'),
            'pembayaran' => $this->request->getPost('pembayaran'),
            'ppn' => ($ppn_option == 'PPN') ? 11 : 0,
            'term' => $this->request->getPost('term'),
            'total_qty' => $totals['total_qty'],
            'total_jumlah' => $totals['total_jumlah'],
            'nilai_ppn' => $totals['nilai_ppn'],
            'netto' => $totals['netto'],
            'user_id' => $user_id
        ];

        $pembelianModel->insert($dataBeli);

        // Menyiapkan data untuk disimpan di tabel detail_terima
        $kode_barang = $this->request->getPost('kode_barang');
        $nama_barang = $this->request->getPost('nama_barang');
        $satuan = $this->request->getPost('satuan');
        $no_po = $this->request->getPost('no_po');
        $no_faktur = $this->request->getPost('no_faktur');

        if ($kode_barang) {
            foreach ($kode_barang as $index => $kode) {
                $detailData = [
                    'id_kode_barang' => $kode,
                    'nama_barang' => $nama_barang[$index],
                    'qty' => $qty[$index],
                    'satuan' => $satuan[$index],
                    'harga' => $harga[$index],
                    'disc' => $disc[$index],
                    'jumlah' => $totals['jumlah'][$index],
                    'no_po' => $no_po[$index],
                    'no_faktur' => $no_faktur[$index]
                ];

                // Simpan data ke tabel detail_terima
                $detailPembelianModel->insert($detailData);
            }
        }
        return redirect()->to(base_url('/pembelian_prev/' . $no_faktur))->with('success', 'Data berhasil disimpan.');
    }

    public function prev_pembelian($no_faktur)
    {
        $pembelianModel = new M_K_Pembelian();

        $dataTerima = $pembelianModel->find($no_faktur);
        // ambil
        $supplierData = $pembelianModel->getAllSupplier();
        $barangData = $pembelianModel->getAllBarang();

        if ($dataTerima) {
            // Ambil detail barang dari tabel detail_terima
            $detailPembelianModel = new M_K_DPembelian();
            $detailTerima = $detailPembelianModel->where('no_faktur', $no_faktur)->findAll();

            // Hitung total qty dan total jumlah
            $totalQty = 0;
            $totalJumlah = 0;

            foreach ($detailTerima as $detail) {
                $totalQty += $detail['qty'];
                $totalJumlah += $detail['jumlah'];
            }
            $data = [
                'title' => 'Pembelian',
                'sparepart' => $dataTerima,
                'detail_terima' => $detailTerima,
                'total_qty' => $totalQty,
                'total_jumlah' => $totalJumlah,
                'supplier' => $supplierData,
                'barang' => $barangData,
            ];
            return view('keuangan/pembelian_prev', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function updatePembelian()
    {
        $pembelianModel = new M_K_Pembelian();

        // Mengambil data dari request
        $id_pembelian = $this->request->getPost('id_pembelian');
        $dataUpdate = [
            'tanggal' => $this->request->getPost('tanggal'),
            'supplier' => $this->request->getPost('supplier'),
            'jatuh_tempo' => $this->request->getPost('jatuh_tempo'),
            'keterangan' => $this->request->getPost('keterangan'),
            'gudang' => $this->request->getPost('gudang'),
            'no_preor' => $this->request->getPost('no_preor'),
            'kota' => $this->request->getPost('kota'),
            'alamat' => $this->request->getPost('alamat'),
            'nopol' => $this->request->getPost('nopol'),
            'pembayaran' => $this->request->getPost('pembayaran'),
            'ppn' => ($this->request->getPost('ppn') == 'PPN') ? 11 : 0,
            'term' => $this->request->getPost('term')
        ];

        // Melakukan update pada tabel terima_bahan
        $pembelianModel->update($id_pembelian, $dataUpdate);

        return redirect()->to(base_url('/pembelian_prev/' . $id_pembelian))->with('message', 'Data berhasil diperbarui.');
    }

    public function createDetailTambah()
    {
        $detailPembelianModel = new M_K_DPembelian();

        // Mendapatkan id_penerimaan dari form
        $id_pembelian = $this->request->getPost('id_pembelian');
        if (!$id_pembelian) {
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
            'id_pembelian' => $id_pembelian // Simpan ID Terima PO
        ];

        // Insert data ke dalam database
        $detailPembelianModel->insert($data);

        // Redirect dengan pesan sukses
        return redirect()->to('/pembelian_prev/' . $id_pembelian)->with('message', 'Barang berhasil ditambahkan');
    }

    public function delete_pembelian($id)
    {
        $db = \Config\Database::connect();
        $db->transStart(); // Memulai transaksi

        // Menghapus data terkait di tabel detail_barang
        $detailPembelianModel = new M_K_DPembelian();
        $detailPembelianModel->where('no_faktur', $id)->delete();

        // Menghapus data di tabel no_faktur
        $pembelianModel = new M_K_Pembelian();
        $pembelianModel->where('no_faktur', $id)->delete();

        $db->transComplete(); // Menyelesaikan transaksi

        if ($db->transStatus() === FALSE) {
            return redirect()->to('pembelian')->with('error', 'Data gagal dihapus');
        } else {
            return redirect()->to('pembelian')->with('success', 'Data berhasil dihapus');
        }
    }

    public function delete_detailpembelian($id)
    {
        $detailPembelianModel = new M_K_DPembelian();

        // Ambil id_penerimaan berdasarkan id
        $id_pembelian = $detailPembelianModel->getIdPenerimaanByKodeBarang($id);

        // Menghapus data berdasarkan id
        $result = $detailPembelianModel->deleteByKodeBarang($id);

        if ($result) {
            return redirect()->to(base_url('/pembelian_prev/' . $id_pembelian))->with('message', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('message', 'Data gagal dihapus.');
        }
    }
    // ------------------------------------------------------------------------------------------------------------




    public function jurnal_kasbank()
    {
        $modelKas = new M_KasBank();
        $modelform = new M_KasBank_Form();
        $modelCoa = new M_Coa();
        $userModel = new UserModel();

        $coa = $modelCoa->findAll();
        $id_doc = $modelform->generateDoc();
        $datakasbank = $modelKas->findAll();

        foreach ($datakasbank as &$item) {
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Kas&Bank',
            'coa' => $coa,
            'generate' => $id_doc,
            'datakasbank' => $datakasbank,
        ];

        return view('keuangan/kas_bank', $data);
    }



    public function createKasBank()
    {

        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $modelKas = new M_KasBank();
        $modelform = new M_KasBank_Form();
        $modelJurnal = new M_ReportJurnal();
        $doc_no = $modelform->generateDoc();

        // Ambil data dari form
        $tanggal = $this->request->getPost('tgl');

        // Pastikan akun_debet berupa array
        $akun_debet = $this->request->getPost('akun_debet');
        if (!is_array($akun_debet)) {
            return redirect()->back()->with('error', 'Akun debet harus berupa array.');
        }

        // Bersihkan data akun_debet untuk menyimpan hanya nama akun
        $nama_akun_debet = array_map(function ($item) {
            return strtoupper(trim(explode('-', $item)[1])); // Ambil hanya nama akun setelah tanda '-'
        }, $akun_debet);

        // Ambil kode akun debet
        $kode_akun_debet = array_map(function ($item) {
            return strtoupper(trim(explode('-', $item)[0])); // Ambil kode akun sebelum tanda '-'
        }, $akun_debet);

        // Bersihkan data nilai
        $nilai = $this->request->getPost('nilai');
        if (!is_array($nilai)) {
            return redirect()->back()->with('error', 'Nilai harus berupa array.');
        }

        // Bersihkan data keterangan
        $keterangan = $this->request->getPost('keterangan');
        if (!is_array($keterangan)) {
            return redirect()->back()->with('error', 'Keterangan harus berupa array.');
        }

        // Proses setiap keterangan menjadi uppercase
        $keterangan = array_map('strtoupper', $keterangan);

        // Bersihkan data akun_credit untuk menyimpan hanya nama akun
        $akun_credit = strtoupper(trim(explode('-', $this->request->getPost('akun_credit'))[1])); // Ambil hanya nama akun
        $kode_akun_credit = strtoupper(trim(explode('-', $this->request->getPost('akun_credit'))[0])); // Ambil kode akun

        // Bersihkan total_debit
        $total_debit = intval($this->request->getPost('total_debit'));

        // Simpan data untuk akun debet ke model M_KasBank_Form
        foreach ($nama_akun_debet as $index => $akun) {
            $dataForm = [
                'doc_no' => $doc_no,
                'tanggal' => $tanggal,
                'account_debit' => $akun,
                'keterangan' => $keterangan[$index],
                'debit' => intval($nilai[$index]),
                'kredit' => 0,  // Untuk debit, kredit harus 0
                'user_id' => $user_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            // Simpan ke database k_kasbank_form
            $modelform->insert($dataForm);
        }

        // Simpan data untuk akun kredit (hanya satu entri) ke model M_KasBank_Form
        $dataFormKredit = [
            'doc_no' => $doc_no,
            'tanggal' => $tanggal,
            'account_credit' => $akun_credit,  // Simpan hanya nama akun kredit
            'keterangan' => implode(" ", $keterangan),  // Gabungkan keterangan jika diperlukan
            'debit' => 0,  // Untuk kredit, debit harus 0
            'kredit' => $total_debit,  // Simpan total kredit
            'user_id' => session()->get('user_id'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Simpan ke database k_kasbank_form
        $modelform->insert($dataFormKredit);

        // Simpan data untuk model M_KasBank
        foreach ($nama_akun_debet as $index => $akun) {
            $dataKasBankDebit = [
                'tanggal' => $tanggal,
                'doc_no' => $doc_no,
                'kode_account' => $kode_akun_debet[$index], // Simpan kode akun debet
                'nama_account' => $akun, // Simpan hanya nama akun debet
                'deskripsi' => $keterangan[$index],  // Ambil keterangan berdasarkan index
                'debit' => intval($nilai[$index]),  // Simpan nilai sebagai integer
                'kredit' => 0,  // Untuk debit, kredit harus 0
                'user_id' => $user_id,
                'tgl_input' => date('Y-m-d H:i:s'),
            ];

            // Simpan ke database k_kasbank
            $modelKas->insert($dataKasBankDebit);
        }

        // Simpan data untuk akun kredit (hanya satu entri) ke model M_KasBank
        $dataKasBankKredit = [
            'tanggal' => $tanggal,
            'doc_no' => $doc_no,
            'kode_account' => $kode_akun_credit,  // Simpan kode akun kredit
            'nama_account' => $akun_credit,  // Simpan hanya nama akun kredit
            'deskripsi' => implode(" ", $keterangan),  // Gabungkan keterangan jika diperlukan
            'debit' => 0,  // Untuk kredit, debit harus 0
            'kredit' => $total_debit,  // Simpan total kredit
            'user_id' => $user_id,
            'tgl_input' => date('Y-m-d H:i:s'),
        ];

        // Simpan ke database k_kasbank
        $modelKas->insert($dataKasBankKredit);

        // Simpan data untuk model M_ReportJurnal
        foreach ($nama_akun_debet as $index => $akun) {
            $dataReport = [
                'date' => $tanggal,
                'doc_no' => $doc_no,
                'account' => $kode_akun_debet[$index], // Simpan kode akun debet
                'name' => $akun, // Simpan hanya nama akun debet
                'description' => $keterangan[$index],  // Ambil keterangan berdasarkan index
                'debit' => intval($nilai[$index]),  // Simpan nilai sebagai integer
                'kredit' => 0,  // Untuk debit, kredit harus 0
                'aksi' => 'Posted',
                'user_id' => $user_id,
            ];

            // Simpan ke database k_kasbank
            $modelJurnal->insert($dataReport);
        }

        // Simpan data untuk akun kredit (hanya satu entri) ke model M_KasBank
        $dataJurnal = [
            'date' => $tanggal,
            'doc_no' => $doc_no,
            'account' => $kode_akun_credit,  // Simpan kode akun kredit
            'name' => $akun_credit,  // Simpan hanya nama akun kredit
            'description' => implode(" ", $keterangan),  // Gabungkan keterangan jika diperlukan
            'debit' => 0,  // Untuk kredit, debit harus 0
            'kredit' => $total_debit,  // Simpan total kredit
            'user_id' => $user_id,
        ];

        // Simpan ke database k_kasbank
        $modelJurnal->insert($dataJurnal);



        // Redirect atau tampilkan pesan sukses
        return redirect()->to(base_url('kas_bank'))->with('success', 'Data berhasil disimpan!');
    }


    public function getCoa()
    {
        $modelCoa = new M_Coa();
        $coa = $modelCoa->findAll();

        return $this->response->setJSON($coa);
    }

    public function kaskecil()
    {
        $model = new M_KasKecil();
        $userModel = new UserModel();

        $kaskecil = $model->orderBy('id_kc', 'DESC')->findAll();

        foreach ($kaskecil as &$item) {
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Kas Kecil',
            'kaskecil' => $kaskecil
        ];

        return view('keuangan/kas_kecil', $data);
    }

    public function createKasKecil()
    {
        $model = new M_KasKecil();
        $modelJurnal = new M_ReportJurnal();
        $modelKasKeluar = new M_KasKeluar();
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $tanggal = strtoupper($this->request->getPost('tanggal'));
        $docNo = strtoupper($this->request->getPost('doc_no'));
        $kodeAccount = $this->request->getPost('kode_account');
        $keterangan = $this->request->getPost('keterangan');
        $nilai = $this->request->getPost('nilai');

        $dataBatch = [];
        $totalNilai = 0;

        // Simpan setiap baris data yang diinput
        foreach ($kodeAccount as $key => $kode) {
            // Memisahkan kode dan nama akun
            $parts = explode(' - ', $kode); // Pisahkan berdasarkan ' - '

            $dataBatch[] = [
                'tanggal'      => strtoupper($tanggal),
                'doc_no'       => strtoupper($docNo),
                'kode_account' => isset($parts[0]) ? strtoupper($parts[0]) : '',
                'nama_account' => isset($parts[1]) ? strtoupper($parts[1]) : '',
                'keterangan'   => strtoupper($keterangan[$key]),
                'debit' => 0,
                'kredit'        => str_replace('.', '', $nilai[$key]), // Menghapus titik pada nilai
                'user_id'      => $user_id,
                'tgl_input'    => date('Y-m-d H:i:s'),
            ];

            // Menambahkan nilai ke total nilai
            $totalNilai += str_replace('.', '', $nilai[$key]); // Menghapus titik pada nilai
        }

        // Simpan data ke database dengan batch insert
        if ($model->insertBatch($dataBatch)) {
            session()->setFlashdata('success', 'Data berhasil disimpan.');
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan data.');
        }

        // Simpan data untuk model M_ReportJurnal (Debit)
        foreach ($kodeAccount as $key => $kode) {
            $parts = explode(' - ', $kode); // Pisahkan kode account dan nama account

            $dataReportDebit = [
                'date'        => strtoupper($tanggal),
                'doc_no'      => strtoupper($docNo),
                'account'     => isset($parts[0]) ? strtoupper($parts[0]) : '',
                'name'        => isset($parts[1]) ? strtoupper($parts[1]) : '',
                'description' => strtoupper($keterangan[$key]),
                'debit'       => str_replace('.', '', $nilai[$key]), // Menghapus titik pada nilai
                'kredit'      => 0,
                'aksi'        => 'Posted',
                'user_id'     => session()->get('user_id'),
            ];

            // Simpan ke database M_ReportJurnal (Debit)
            $modelJurnal->insert($dataReportDebit);
        }

        // Simpan data untuk model M_ReportJurnal (Kredit sebagai total nilai)
        $dataReportKredit = [
            'date'        => strtoupper($tanggal),
            'doc_no'      => strtoupper($docNo),
            'account'     => '10001',
            'name'        => 'KAS KECIL',
            'description' => 'PENGELUARAN KAS KECIL ' . strtoupper($tanggal),
            'debit'       => 0,
            'kredit'      => str_replace('.', '', $totalNilai), // Menghapus titik pada total nilai
            'user_id'     => session()->get('user_id'),
        ];

        // Simpan ke database M_ReportJurnal (Kredit Total)
        $modelJurnal->insert($dataReportKredit);

        // Simpan Pengeluaran ke M_KasKeluar
        $dataKeluar = [
            'tanggal'      => strtoupper($tanggal),
            'no_doc'       => strtoupper($docNo),
            'kode_account' => '10001',
            'nama_account' => 'KAS KECIL',
            'keterangan'   => 'PENGELUARAN KAS KECIL ' . strtoupper($tanggal),
            'kredit'       => str_replace('.', '', $totalNilai), // Menghapus titik pada total nilai
            'user_id'      => session()->get('user_id'),
        ];

        // Simpan ke database M_ReportJurnal (Kredit Total)
        $modelKasKeluar->insert($dataKeluar);


        // Redirect ke halaman lain setelah simpan data
        return redirect()->to('/kas_kecil');
    }


    public function keluarkasbesar()
    {
        $model = new M_P_KasBesar();
        $userModel = new UserModel();

        $data_kasbesar = $model->orderBy('id_kb', 'DESC')->findAll();

        foreach ($data_kasbesar as &$item) {
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Kas Keluar',
            'data_kasbesar' => $data_kasbesar
        ];

        return view('keuangan/keluar_kasbesar', $data);
    }

    public function getKasBesarData()
    {
        $kasBesarModel = new M_P_KasBesar();

        // Ambil data dari model
        $dataKasBesar = $kasBesarModel->select('tanggal, nilai')->findAll();

        // Hitung total jumlah
        $totalJumlah = 0;
        foreach ($dataKasBesar as $data) {
            $totalJumlah += $data['nilai'];
        }

        // Kirim data sebagai JSON
        return $this->response->setJSON([
            'dataKasBesar' => $dataKasBesar,
            'totalJumlah' => $totalJumlah
        ]);
    }
    public function getKasKecilData()
    {
        $kasBesarModel = new M_KasKecil();

        // Ambil data dari model
        $dataKasBesar = $kasBesarModel->select('tanggal, kredit')->findAll();

        // Hitung total jumlah
        $totalJumlah = 0;
        foreach ($dataKasBesar as $data) {
            $totalJumlah += $data['kredit'];
        }

        // Kirim data sebagai JSON
        return $this->response->setJSON([
            'dataKasKecil' => $dataKasBesar,
            'totalJumlah' => $totalJumlah
        ]);
    }


    public function createPKasbesar()
    {
        $model = new M_P_KasBesar();
        $modelJurnal = new M_ReportJurnal();

        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $tanggal = strtoupper($this->request->getPost('tanggal'));
        $docNo = strtoupper($this->request->getPost('doc_no'));
        $kodeAccount = $this->request->getPost('kode_account');
        $keterangan = $this->request->getPost('keterangan');
        $nilai = $this->request->getPost('nilai');

        $dataBatch = []; // Menyimpan data untuk batch insert
        $totalNilai = 0; // Variabel untuk menghitung total nilai

        // Simpan setiap baris data yang diinput
        foreach ($kodeAccount as $key => $kode) {
            // Memisahkan kode dan nama akun
            $parts = explode(' - ', $kode); // Pisahkan berdasarkan ' - '

            $dataBatch[] = [
                'tanggal'      => strtoupper($tanggal),
                'doc_no'       => strtoupper($docNo),
                'kode_account' => isset($parts[0]) ? strtoupper($parts[0]) : '',
                'nama_account' => isset($parts[1]) ? strtoupper($parts[1]) : '',
                'keterangan'   => strtoupper($keterangan[$key]),
                'nilai'        => str_replace('.', '', $nilai[$key]), // Menghapus titik pada nilai
                'user_id'      => $user_id,
                'tgl_input'    => date('Y-m-d H:i:s'),
            ];

            // Menambahkan nilai ke total nilai
            $totalNilai += str_replace('.', '', $nilai[$key]); // Menghapus titik pada nilai
        }

        // Simpan data ke database dengan batch insert
        if ($model->insertBatch($dataBatch)) {
            session()->setFlashdata('success', 'Data berhasil disimpan.');
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan data.');
        }

        // Simpan data untuk model M_ReportJurnal (Debit)
        foreach ($kodeAccount as $key => $kode) {
            $parts = explode(' - ', $kode); // Pisahkan kode account dan nama account

            $dataReportDebit = [
                'date'        => strtoupper($tanggal),
                'doc_no'      => strtoupper($docNo),
                'account'     => isset($parts[0]) ? strtoupper($parts[0]) : '',
                'name'        => isset($parts[1]) ? strtoupper($parts[1]) : '',
                'description' => strtoupper($keterangan[$key]),
                'debit'       => str_replace('.', '', $nilai[$key]), // Menghapus titik pada nilai
                'kredit'      => 0,
                'aksi'        => 'Posted',
                'user_id'     => session()->get('user_id'),
            ];

            // Simpan ke database M_ReportJurnal (Debit)
            $modelJurnal->insert($dataReportDebit);
        }

        // Simpan data untuk model M_ReportJurnal (Kredit sebagai total nilai)
        $dataReportKredit = [
            'date'        => strtoupper($tanggal),
            'doc_no'      => strtoupper($docNo),
            'account'     => '10002',
            'name'        => 'KAS BESAR',
            'description' => 'PENGELUARAN KAS BESAR ' . strtoupper($tanggal),
            'debit'       => 0,
            'kredit'      => str_replace('.', '', $totalNilai), // Menghapus titik pada total nilai
            'user_id'     => session()->get('user_id'),
        ];

        // Simpan ke database M_ReportJurnal (Kredit Total)
        $modelJurnal->insert($dataReportKredit);

        // Redirect ke halaman lain setelah simpan data
        return redirect()->to('/keluar_kasbesar');
    }




    public function jurnal_kasmasuk()
    {
        $modelKas = new M_ReportJurnal();
        $userModel = new UserModel();

        $kas = $modelKas->whereIn('name', ['REK BCA', 'KAS BESAR'])->orderBy('id_report', 'DESC')->findAll();

        foreach ($kas as &$item) {
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Kas Masuk Real',
            'kasMasuk' => $kas
        ];

        return view('keuangan/kas_masuk', $data);
    }



    public function jurnal_kaskeluar()
    {
        $modelKas = new M_ReportJurnal();
        $userModel = new UserModel();

        $kas = $modelKas->orderBy('id_report', 'DESC')->findAll();

        foreach ($kas as &$item) {
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'Kas Keluar Real',
            'kasKeluar' => $kas
        ];

        return view('keuangan/kas_keluar', $data);
    }


    public function repairoder_list()
    {
        $modelro = new M_RepairOrder();

        $rodata = $modelro->getRepairOrder();

        $data = [
            'title' => 'RO List',
            'rodata' => $rodata
        ];

        return view('keuangan/ro_list', $data);
    }



    public function repairorder_listprev($id_terima_po)
    {
        $modelro = new M_RepairOrder();
        $modeljasa = new M_Rm_Detail_Jasa();

        // Ambil data Repair Order berdasarkan id_terima_po
        $rodata = $modelro->getRepairOrderDetails($id_terima_po);

        if (!empty($rodata) && array_key_exists('id_jasa', $rodata)) {
            $id_jasa = $rodata['id_jasa'];
        } else {
            $id_jasa = null;
        }


        // Lakukan query jasa hanya jika id_jasa tidak null
        if ($id_jasa) {
            $roJasa = $modeljasa->where('id_jasa', $id_jasa)->findAll();
        } else {
            $roJasa = []; // Jika tidak ada id_jasa, kosongkan hasil
        }

        $data = [
            'title' => 'RO List',
            'rodata' => $rodata,
            'roJasa' => $roJasa
        ];

        return view('keuangan/ro_listprev', $data);
    }


    public function repair_materialjasa()
    {
        $modelJasa = new M_Rm_Jasa();
        $userModel = new UserModel();

        $dataJasa = $modelJasa->orderBy('id_jasa', 'DESC')->findAll();

        foreach ($dataJasa as &$item) {
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';
        }

        $data = [
            'title' => 'RM Jasa',
            'jasa' => $dataJasa,
        ];

        return view('keuangan/material_jasa', $data);
    }


    public function repair_materialjasaadd()
    {
        $modelJasa = new M_Rm_Jasa();
        $poData = $modelJasa->getAllPO();

        $data = [
            'title' => 'RM Jasa',
            'generateId' => $modelJasa->generateId(),
            'po' => $poData,
        ];
        return view('keuangan/material_jasaadd', $data);
    }

    public function createRepairJasa()
    {
        $modelJasa = new M_Rm_Jasa();
        $generateId = $modelJasa->generateId();

        // Mengambil data dari input form
        $data = [
            'id_jasa' => $this->request->getPost('id_jasa'),
            'tanggal' => $this->request->getPost('tanggal'),
            'no_ro' => strtoupper($this->request->getPost('no_ro')),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'nopol' => strtoupper($this->request->getPost('nopol')),
            'jenis_mobil' => strtoupper($this->request->getPost('jenis_mobil')),
            'warna' => strtoupper($this->request->getPost('warna')),
            'tahun' => $this->request->getPost('tahun'),
            'nama_pemilik' => strtoupper($this->request->getPost('nama_pemilik')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
        ];

        // Menyimpan data ke database
        $modelJasa->insert($data);

        // Mengarahkan pengguna ke halaman lain
        return redirect()->to(base_url('/material_jasaprev/' . $generateId))->with('message', 'Data berhasil disimpan.');
    }

    public function updateJasa()
    {
        $modelJasa = new M_Rm_Jasa();

        // Mengambil data dari input form
        $data = [
            'id_jasa' => $this->request->getPost('id_jasa'),
            'tanggal' => $this->request->getPost('tanggal'),
            'no_ro' => strtoupper($this->request->getPost('no_ro')), // Mengubah ke huruf besar
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'nopol' => strtoupper($this->request->getPost('nopol')), // Mengubah ke huruf besar
            'jenis_mobil' => strtoupper($this->request->getPost('jenis_mobil')), // Mengubah ke huruf besar
            'warna' => strtoupper($this->request->getPost('warna')), // Mengubah ke huruf besar
            'tahun' => $this->request->getPost('tahun'),
            'nama_pemilik' => strtoupper($this->request->getPost('nama_pemilik')), // Mengubah ke huruf besar
            'keterangan' => strtoupper($this->request->getPost('keterangan')), // Mengubah ke huruf besar
        ];

        // Memperbarui data di M_Rm_Jasa
        $modelJasa->update($data['id_jasa'], $data);

        // Mengarahkan ke halaman preview dengan id_jasa
        return redirect()->to(base_url('material_jasaprev/' . $data['id_jasa']))->with('message', 'Data berhasil diperbarui.');
    }



    public function repair_materialjasaprev($id_jasa)
    {
        $modelJasa = new M_Rm_Jasa();
        $masterJasaModel = new M_Jasa();
        $modelDetailJasa = new M_Rm_Detail_Jasa();

        // Mengambil data berdasarkan id_jasa
        $dataJasa = $modelJasa->find($id_jasa); // Menggunakan find untuk mendapatkan satu data
        $masterjasa = $masterJasaModel->findAll(); //
        $dataDetailJasa = $modelDetailJasa->where('id_jasa', $id_jasa)->findAll(); //
        $data = [
            'title' => 'RM Jasa',
            'jasa' => $dataJasa,
            'masterjasa' => $masterjasa,
            'detailjasa' => $dataDetailJasa,

        ];

        return view('keuangan/material_jasaprev', $data);
    }

    public function updateOrCreateJasa()
    {
        $modelDetailJasa = new M_Rm_Detail_Jasa();
        $modelJasa = new M_Rm_Jasa();

        // Mengambil data dari input form
        $data = [
            'id_jasa' => $this->request->getPost('id_jasa'),
            'kode_jasa' => strtoupper($this->request->getPost('kode_jasa')), // Mengubah ke huruf besar
            'nama_jasa' => strtoupper($this->request->getPost('nama_jasa')), // Mengubah ke huruf besar
            'harga' => $this->request->getPost('harga'),
            'jenis_bayar' => strtoupper($this->request->getPost('jenis_bayar')), // Mengubah ke huruf besar
        ];

        // Cek apakah id_jasa sudah ada
        if ($modelDetailJasa->find($data['id_jasa'])) {
            // Update jika id_jasa sudah ada
            $modelDetailJasa->update($data['id_jasa'], $data);
        } else {
            // Insert jika id_jasa belum ada
            $modelDetailJasa->insert($data);
        }

        // Menghitung total harga untuk id_jasa
        $total = $modelDetailJasa->selectSum('harga')
            ->where('id_jasa', $data['id_jasa'])
            ->first();

        // Memperbarui total di M_Rm_Jasa
        $modelJasa->update($data['id_jasa'], ['total' => $total['harga']]);

        return redirect()->to(base_url('material_jasaprev/' . $data['id_jasa']))->with('message', 'Data berhasil disimpan.');
    }


    public function add_bayar_hutang()
    {
        $hutang = new M_K_Pembelian;

        $hutangsupp = $hutang->findAll();


        $data = [
            'title' => 'Bayar Hutang',
            'faktur' => $hutangsupp
        ];
        return view('keuangan/bayar_hutang_add', $data);
    }

    public function createFaktur()
    {
        $pembayaranModel = new M_K_Pembayaran();
        $hutangModel = new M_HutangSupplier();

        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi.');
        }

        $generated = $pembayaranModel->generateId();

        $dataHutang = [
            'id_pembayaran' => $generated,
            'no_faktur' => $this->request->getPost('noFaktur'),
            'tanggal' => $this->request->getPost('tanggal'),
            'kode_supplier' => $this->request->getPost('kodeSupplier'),
            'supplier' => $this->request->getPost('supplier'),
            'kode_bayar' => $this->request->getPost('kodeBayar'),
            'jatuh_tempo' => $this->request->getPost('jatuhTempo'),
            'jumlah' => (int) str_replace('.', '', $this->request->getPost('jumlah')),
            'discount_nilai' => (int) str_replace('.', '', $this->request->getPost('discountNilai')),
            'subtotal' => (int) str_replace('.', '', $this->request->getPost('subtotal')),
            'ppn_persen' => $this->request->getPost('ppnPersen'),
            'ppn_value' => (int) str_replace('.', '', $this->request->getPost('ppnValue')),
            'netto' => (int) str_replace('.', '', $this->request->getPost('netto')),
            'kredit' => (int) str_replace('.', '', $this->request->getPost('netto')),
            'user_id' => $user_id
        ];

        $result = $pembayaranModel->insert($dataHutang);

        if ($result === false) {
            $errors = $pembayaranModel->errors();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . implode(", ", $errors));
        }
        // Menyiapkan data untuk laporan hutang supplier
        $dataHutang = [
            'no_faktur' => $this->request->getPost('noFaktur'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jatuh_tempo' => $this->request->getPost('jatuhTempo'),
            'nilai_total' => (int) str_replace('.', '', $this->request->getPost('netto')), // Menggunakan nilai netto sebagai nilai_total
            'pembayaran' => 0,
            'kode_supplier' => $this->request->getPost('kodeSupplier'),
            'supplier' => $this->request->getPost('supplier'),
        ];

        // Simpan data ke tabel laporan hutang supplier
        $hutangModel->insert($dataHutang);

        return redirect()->to('/bayar_hutang_prev/' . $generated)->with('success', 'Data berhasil disimpan.');
    }


    public function addPembayaran()
    {
        // Load models
        $pembayaranModel = new M_K_Pembayaran_Detail();
        $debitModel = new M_K_Pembayaran();
        $debitHutang = new M_HutangSupplier();

        // Mendapatkan user_id dari session
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi.');
        }

        // Mengambil data input
        $id_pembayaran = $this->request->getPost('id_pembayaran');
        $nominal = $this->request->getPost('nominal');
        $no_faktur = $this->request->getPost('no_faktur');

        // Mempersiapkan data untuk tabel k_pembayaran_detail
        $dataBayar = [
            'id_pembayaran' => $id_pembayaran,
            'kode_bayar'    => $this->request->getPost('kode_bayar'),
            'jatuh_tempo'   => $this->request->getPost('jatuh_tempo'),
            'nominal'       => $nominal,
            'no_bukti'      => $this->request->getPost('no_bukti'),
            'user_id'       => $user_id,
            'no_faktur'     => $no_faktur
        ];

        // Insert ke tabel k_pembayaran_detail
        if (!$pembayaranModel->insert($dataBayar)) {
            return redirect()->to('/bayar_hutang_prev/' . $id_pembayaran)->with('error', 'Gagal menyimpan data pembayaran.');
        }

        // Cek apakah id_pembayaran sudah ada di tabel k_pembayaran
        $existingPayment = $debitModel->where('id_pembayaran', $id_pembayaran)->first();

        // Cek apakah no_faktur sudah ada di tabel M_HutangSupplier
        $existingHutang = $debitHutang->where('no_faktur', $no_faktur)->first();

        // Update M_K_Pembayaran jika id_pembayaran sudah ada
        if ($existingPayment) {
            // Tambah nominal ke nilai debit yang ada
            $newDebit = $existingPayment['debit'] + $nominal;

            // Update data debit dengan nilai baru yang dijumlahkan
            $dataDebit = [
                'debit' => $newDebit,
                'user_id' => $user_id
            ];

            // Update M_K_Pembayaran
            $debitModel->update($existingPayment['id_pembayaran'], $dataDebit);
        }

        // Update M_HutangSupplier jika no_faktur sudah ada
        if ($existingHutang) {
            // Tambah nominal ke nilai pembayaran yang ada
            $newPayment = $existingHutang['pembayaran'] + $nominal;

            // Update data pembayaran dengan nilai baru yang dijumlahkan
            $dataHutang = [
                'pembayaran' => $newPayment,
                'user_id' => $user_id
            ];

            // Update M_HutangSupplier menggunakan no_faktur (pastikan no_faktur benar)
            $debitHutang->update($existingHutang['id_laporan'], $dataHutang);
        }

        return redirect()->to('/bayar_hutang_prev/' . $id_pembayaran)->with('success', 'Data berhasil disimpan.');
    }


    public function prev_bayar_hutang($id_pembayaran)
    {
        $pembayaranModel = new M_K_Pembayaran();
        $dataBayar = new M_K_Pembayaran_Detail();

        $bayar = $dataBayar->where('id_pembayaran', $id_pembayaran)->findAll();
        $hutang = $pembayaranModel->find($id_pembayaran);
        $data = [
            'title' => 'Bayar Hutang',
            'pembayaran' => $hutang,
            'bayar' => $bayar
        ];
        return view('keuangan/bayar_hutang_prev', $data);
    }
}
