<?php

namespace App\Controllers;

use App\Models\M_Detail_Terima;
use App\Models\M_K_Pembelian;
use App\Models\M_K_DPembelian;
use App\Models\M_RepairOrder;
use App\Models\M_Supplier;
use App\Models\M_Terima_Bahan;
use App\Models\M_HutangSupplier;
use App\Models\M_Rm_Jasa;
use App\Models\M_Jasa;
use App\Models\M_Rm_Detail_Jasa;
use App\Models\M_K_Pembayaran;
use App\Models\M_K_Pembayaran_Detail;
use App\Models\M_Coa;
use App\Models\M_KasKecil;
use App\Models\M_KasKeluar;
use App\Models\M_ReportJurnal;
use App\Models\UserModel;
use App\Models\M_AuditLog;
use App\Models\M_AccAsuransi;

class KeuanganController extends BaseController
{

    public function hutang_supp()
    {
        $partM = new M_Terima_Bahan();

        $hutang = $partM->getHutangWithAll();

        $data = [
            'title' => 'Rekap Hutang',
            'supplier' => $hutang
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
        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $pembelianModel = new M_K_Pembelian();
        $detailPembelianModel = new M_K_DPembelian();
        $auditLogModel = new M_AuditLog();

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

        // Simpan data ke tabel pembelian
        $pembelianModel->insert($dataBeli);
        $pembelianId = $pembelianModel->getInsertID(); // Mendapatkan ID terakhir yang dimasukkan

        // Tambahkan log CREATE untuk data pembelian
        $auditLogModel->logCreate('Pembelian', $user_id, 'Menambahkan data pembelian baru dengan No Faktur: ' . $dataBeli['no_faktur']);

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

                // Tambahkan log CREATE untuk setiap data detail pembelian
                $auditLogModel->logCreate(
                    'detail_pembelian',
                    $user_id,
                    'Menambahkan data detail pembelian untuk No Faktur: ' . $no_faktur[$index] . ' dengan Kode Barang: ' . $kode
                );
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
        $auditLogModel = new M_AuditLog();

        // Mengambil data dari request
        $id_pembelian = $this->request->getPost('id_pembelian');
        $user_id = session()->get('username');

        // Ambil data lama sebelum diupdate
        $oldData = $pembelianModel->find($id_pembelian);

        if (!$oldData) {
            return redirect()->back()->with('error', 'Data pembelian tidak ditemukan.');
        }

        // Data yang akan diupdate
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

        // Log perubahan data
        foreach ($dataUpdate as $key => $newValue) {
            $oldValue = $oldData[$key] ?? null;

            // Hanya catat jika ada perubahan
            if ($oldValue != $newValue) {
                $auditLogModel->logEdit(
                    'Pembelian',
                    $id_pembelian,
                    $key,
                    $oldValue,
                    $newValue,
                    $user_id,
                    'Mengubah data pembelian untuk ID: ' . $id_pembelian
                );
            }
        }

        return redirect()->to(base_url('/pembelian_prev/' . $id_pembelian))->with('message', 'Data berhasil diperbarui.');
    }


    public function createDetailTambah()
    {
        $detailPembelianModel = new M_K_DPembelian();
        $auditLogModel = new M_AuditLog();

        // Mendapatkan ID pembelian dari form
        $id_pembelian = $this->request->getPost('id_pembelian');
        if (!$id_pembelian) {
            return redirect()->back()->with('error', 'ID Pembelian tidak ditemukan.');
        }

        // Data yang akan disimpan
        $harga = $this->request->getPost('harga');
        $disc = $this->request->getPost('disc') ?: 0; // Default diskon 0 jika tidak ada
        $qty = $this->request->getPost('qty');

        $jumlah = $qty * ($harga - $disc); // Perhitungan jumlah

        $data = [
            'id_kode_barang'  => $this->request->getPost('id_kode_barang'),
            'nama_barang'     => $this->request->getPost('nama_barang'),
            'qty'             => $qty,
            'satuan'          => $this->request->getPost('satuan'),
            'harga'           => $harga,
            'disc'            => $disc,
            'jumlah'          => $jumlah,
            'id_pembelian'    => $id_pembelian // Simpan ID Pembelian
        ];

        // Insert data ke dalam database
        $detailPembelianModel->insert($data);

        // Mendapatkan ID detail pembelian terakhir
        $id_detail_pembelian = $detailPembelianModel->getInsertID();

        // Tambahkan log CREATE untuk detail pembelian
        $user_id = session()->get('username');
        $auditLogModel->logCreate(
            'detail_pembelian',
            $user_id,
            'Menambahkan detail pembelian baru dengan ID Pembelian: ' . $id_pembelian . ' dan Nama Barang: ' . $data['nama_barang']
        );

        // Redirect dengan pesan sukses
        return redirect()->to('/pembelian_prev/' . $id_pembelian)->with('message', 'Barang berhasil ditambahkan.');
    }

    public function delete_pembelian($id)
    {
        $db = \Config\Database::connect();
        $db->transStart(); // Memulai transaksi

        $detailPembelianModel = new M_K_DPembelian();
        $pembelianModel = new M_K_Pembelian();
        $auditLogModel = new M_AuditLog();
        $user_id = session()->get('username'); // Mendapatkan user ID dari sesi

        // Mengambil data lama sebelum dihapus untuk log
        $detailPembelianData = $detailPembelianModel->where('no_faktur', $id)->findAll();
        $pembelianData = $pembelianModel->where('no_faktur', $id)->first();

        // Menghapus data terkait di tabel detail_pembelian
        $detailPembelianModel->where('no_faktur', $id)->delete();

        // Log penghapusan data di tabel detail_pembelian
        if (!empty($detailPembelianData)) {
            foreach ($detailPembelianData as $detail) {
                $auditLogModel->logDelete(
                    'detail_pembelian',
                    $detail['id'], // ID record dari detail_pembelian
                    $user_id,
                    $detail, // Data detail yang dihapus
                    'Menghapus detail pembelian dengan No Faktur: ' . $id
                );
            }
        }

        // Menghapus data di tabel pembelian
        $pembelianModel->where('no_faktur', $id)->delete();

        // Log penghapusan data di tabel pembelian
        if (!empty($pembelianData)) {
            $auditLogModel->logDelete(
                'pembelian',
                $pembelianData['id'], // ID record dari pembelian
                $user_id,
                $pembelianData, // Data pembelian yang dihapus
                'Menghapus data pembelian dengan No Faktur: ' . $id
            );
        }

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
        $jurnalM = new M_ReportJurnal();
        $modelCoa = new M_Coa();
        $userModel = new UserModel();

        // Ambil data filter dari GET request
        $searchKeyword = $this->request->getGet('search_keyword');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $showAll = $this->request->getGet('show_all');

        // Default tanggal untuk bulan saat ini
        $defaultStartDate = date('Y-m-01'); // Awal bulan
        $defaultEndDate = date('Y-m-t');   // Akhir bulan

        // Query dasar
        $query = $jurnalM->like('doc_no', 'OCB', 'after')->orderBy('doc_no', 'DESC');

        // Terapkan filter pencarian jika ada
        if (!empty($searchKeyword)) {
            $query->groupStart() // Mulai kondisi OR
                ->like('doc_no', $searchKeyword) // Filter berdasarkan doc_no
                ->orLike('description', $searchKeyword) // Filter berdasarkan deskripsi
                ->groupEnd(); // Akhiri kondisi OR
        }

        // Terapkan filter tanggal jika "Tampilkan Semua" tidak diaktifkan
        if (empty($showAll)) {
            $query->where('date >=', $startDate ?: $defaultStartDate);
            $query->where('date <=', $endDate ?: $defaultEndDate);
        }

        // Eksekusi query
        $datakasbank = $query->findAll();

        // Ambil data COA dan user
        $coa = $modelCoa->findAll();
        $id_doc = $jurnalM->generateOCB();

        foreach ($datakasbank as &$item) {
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';
        }

        // Siapkan data untuk dikirim ke view
        $data = [
            'title' => 'Kas & Bank',
            'coa' => $coa,
            'generate' => $id_doc,
            'datakasbank' => $datakasbank,
            'searchKeyword' => $searchKeyword ?? '',
            'startDate' => $startDate ?? $defaultStartDate,
            'endDate' => $endDate ?? $defaultEndDate,
            'showAll' => $showAll,
        ];

        return view('keuangan/kas_bank', $data);
    }


    public function createKasBank()
    {
        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }
        $modelJurnal = new M_ReportJurnal();
        $modelKasKecil = new M_KasKecil();
        $auditLogModel = new M_AuditLog();
        $doc_no = $modelJurnal->generateOCB();

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
        }

        // Cek apakah akun debit adalah "KAS KECIL"  
        if (strtoupper($nama_akun_debet[$index]) === 'KAS KECIL') { // Pastikan kita memeriksa kode akun debit  
            // Simpan ke model M_KasKecil  
            $dataKasKecil = [
                'tanggal' => $tanggal,
                'doc_no' => $doc_no,
                'kode_account' => $kode_akun_debet[$index], // Simpan kode akun debit  
                'nama_account' => $nama_akun_debet[$index], // Simpan nama akun debit  
                'keterangan' => implode(" ", $keterangan), // Gabungkan keterangan jika diperlukan  
                'debit' => intval($nilai[$index]), // Simpan nilai debit  
                'kredit' => 0, // Untuk KAS KECIL, kredit harus 0  
                'user_id' => $user_id,
                'tgl_input' => date('Y-m-d H:i:s'),
            ];

            // Simpan ke database k_kas_kecil  
            $modelKasKecil->insert($dataKasKecil);
            $auditLogModel->logCreate(
                'Jurnal',
                $user_id,
                'Menambahkan nilai debit di kas kecil dengan Doc No: ' . $doc_no . ' dan Nama Akun: ' . $akun
            );
        }

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
            $auditLogModel->logCreate(
                'Jurnal',
                $user_id,
                'Menambahkan nilai debit di kas bank dengan Doc No: ' . $doc_no . ' dan Nama Akun: ' . $akun
            );
        }

        // Simpan data untuk akun kredit (hanya satu entri) ke model M_ReportJurnal  
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
        $auditLogModel->logCreate(
            'Jurnal',
            $user_id,
            'Menambahkan nilai kredit di kas bank dengan Doc No: ' . $doc_no . ' dan Nama Akun: ' . $akun
        );

        // Redirect atau tampilkan pesan sukses  
        return redirect()->to(base_url('kas_bank'))->with('success', 'Data berhasil disimpan!');
    }

    public function updateKasBank($id_report)
    {
        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $modelJurnal = new M_ReportJurnal();
        $auditLogModel = new M_AuditLog();

        // Ambil data lama dari database berdasarkan id_report
        $dataLama = $modelJurnal->find($id_report);
        if (!$dataLama) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $doc_no = $this->request->getPost('doc_no');

        // Ambil data baru dari form
        $dataBaru = [
            // 'date' => $this->request->getPost('tgl'),
            'doc_no' => $doc_no,
            'account' => $this->request->getPost('account'),
            'name' => strtoupper($this->request->getPost('name')),
            'description' => strtoupper($this->request->getPost('description')),
            'debit' => intval($this->request->getPost('debit')),
            'kredit' => intval($this->request->getPost('credit')),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Simpan perubahan ke database
        $modelJurnal->update($id_report, $dataBaru);

        // Log perubahan untuk setiap kolom
        foreach ($dataBaru as $key => $newValue) {
            $oldValue = $dataLama[$key] ?? null;

            // Bandingkan nilai lama dan baru
            if ($oldValue != $newValue) {
                $auditLogModel->logEdit(
                    'Report Jurnal',
                    $id_report,
                    $key,
                    strval($oldValue ?? ''),   // Konversi nilai lama menjadi string
                    strval($newValue ?? ''),   // Konversi nilai baru menjadi string
                    $user_id,
                    "$user_id Mengedit kolom $key pada No. Dokumen $doc_no."
                );
            }
        }

        // Redirect dengan pesan sukses
        return redirect()->to(base_url('kas_bank'))->with('success', 'Data berhasil diperbarui!');
    }

    public function deleteKasBank($id_report)
    {
        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $modelJurnal = new M_ReportJurnal();
        $auditLogModel = new M_AuditLog();

        $doc_no = $this->request->getPost('doc_no');

        // Ambil data lama untuk log
        $dataLama = $modelJurnal->find($id_report);
        if (!$dataLama) {
            return redirect()->to(base_url('kas_bank'))->with('error', 'Data tidak ditemukan.');
        }

        // Hapus data dari database
        $modelJurnal->delete($id_report);

        // Simpan log penghapusan
        $auditLogModel->logDelete(
            'report_jurnal',
            $id_report,
            $user_id,
            $dataLama,
            "$user_id menghapus data dengan No. Dokumen $doc_no."
        );

        return redirect()->to(base_url('kas_bank'))->with('success', 'Data berhasil dihapus!');
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

        // Mengambil input filter
        $searchKeyword = $this->request->getGet('search_keyword');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $showAll = $this->request->getGet('show_all');

        // Default query builder
        $query = $model->orderBy('tanggal', 'DESC');

        // Jika "Tampilkan Semua" tidak dipilih, tambahkan filter
        if (!$showAll) {
            if (!empty($searchKeyword)) {
                $query->like('keterangan', $searchKeyword)
                    ->orLike('no_document', $searchKeyword); // Asumsi ada kolom 'no_document'
            }
            if (!empty($startDate)) {
                $query->where('tanggal >=', $startDate);
            }
            if (!empty($endDate)) {
                $query->where('tanggal <=', $endDate);
            }
        }

        // Eksekusi query
        $kaskecil = $query->findAll();

        $totalDebit = 0;
        $totalKredit = 0;

        foreach ($kaskecil as &$item) {
            // Menambahkan nama user berdasarkan user_id
            $user = $userModel->find($item['user_id']);
            $item['username'] = $user ? $user['username'] : 'Unknown';

            // Menambahkan nilai debit dan kredit untuk menghitung total
            $totalDebit += $item['debit'];
            $totalKredit += $item['kredit'];
        }

        // Menghitung sisa debit
        $sisaDebit = $totalDebit - $totalKredit;

        // Data yang dikirim ke view
        $data = [
            'title' => 'Kas Kecil',
            'kaskecil' => $kaskecil,
            'totalDebit' => $totalDebit,
            'totalKredit' => $totalKredit,
            'sisaDebit' => $sisaDebit,
            'searchKeyword' => $searchKeyword,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        return view('keuangan/kas_kecil', $data);
    }



    public function getKasKecilData()
    {
        $kasM = new M_KasKecil();

        // Ambil data dari model
        $dataKas = $kasM->findAll();

        // Hitung total jumlah
        $totalJumlah = 0;
        foreach ($dataKas as $data) {
            $totalJumlah += $data['kredit'];
        }

        // Kirim data sebagai JSON
        return $this->response->setJSON([
            'dataKasKecil' => $dataKas,
            'totalJumlah' => $totalJumlah
        ]);
    }


    public function createKasKecil()
    {
        $model = new M_KasKecil();
        $modelJurnal = new M_ReportJurnal();
        $modelKasKeluar = new M_KasKeluar();
        $auditLogModel = new M_AuditLog(); // Tambahkan model audit log

        $user_id = session()->get('username');
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
            $parts = explode(' - ', $kode); // Pisahkan berdasarkan ' - '

            $dataBatch[] = [
                'tanggal'      => strtoupper($tanggal),
                'doc_no'       => strtoupper($docNo),
                'kode_account' => isset($parts[0]) ? strtoupper($parts[0]) : '',
                'nama_account' => isset($parts[1]) ? strtoupper($parts[1]) : '',
                'keterangan'   => strtoupper($keterangan[$key]),
                'debit'        => 0,
                'kredit'       => str_replace('.', '', $nilai[$key]), // Menghapus titik pada nilai
                'user_id'      => $user_id,
                'tgl_input'    => date('Y-m-d H:i:s'),
            ];

            $totalNilai += str_replace('.', '', $nilai[$key]); // Menghapus titik pada nilai
        }

        // Simpan data ke database dengan batch insert
        if ($model->insertBatch($dataBatch)) {
            // Tambahkan log CREATE untuk setiap baris data
            foreach ($dataBatch as $data) {
                $auditLogModel->logCreate(
                    'Kas Kecil',
                    $user_id,
                    'Menambahkan data kas kecil dengan Doc No: ' . $docNo . ' dan Nama Akun: ' . $data['nama_account']
                );
            }

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
                'user_id'     => $user_id
            ];

            // Simpan ke database M_ReportJurnal (Debit)
            $modelJurnal->insert($dataReportDebit);

            // Tambahkan log CREATE untuk jurnal debit
            $auditLogModel->logCreate(
                'Report Jurnal',
                $user_id,
                'Menambahkan jurnal debit dengan Doc No: ' . $docNo . ' dan Nama Akun: ' . $dataReportDebit['name']
            );
        }

        // Simpan data untuk model M_ReportJurnal (Kredit sebagai total nilai)
        $dataReportKredit = [
            'date'        => strtoupper($tanggal),
            'doc_no'      => strtoupper($docNo),
            'account'     => '11111',
            'name'        => 'KAS KECIL',
            'description' => 'PENGELUARAN KAS KECIL ' . strtoupper($tanggal),
            'debit'       => 0,
            'kredit'      => str_replace('.', '', $totalNilai), // Menghapus titik pada total nilai
            'user_id'     => $user_id
        ];

        // Simpan ke database M_ReportJurnal (Kredit Total)
        $modelJurnal->insert($dataReportKredit);

        // Tambahkan log CREATE untuk jurnal kredit
        $auditLogModel->logCreate(
            'Report Jurnal',
            $user_id,
            'Menambahkan jurnal kredit untuk pengeluaran kas kecil dengan Doc No: ' . $docNo
        );

        // Simpan Pengeluaran ke M_KasKeluar
        $dataKeluar = [
            'tanggal'      => strtoupper($tanggal),
            'no_doc'       => strtoupper($docNo),
            'kode_account' => '11111',
            'nama_account' => 'KAS KECIL',
            'keterangan'   => 'PENGELUARAN KAS KECIL ' . strtoupper($tanggal),
            'kredit'       => str_replace('.', '', $totalNilai), // Menghapus titik pada total nilai
            'user_id'      => session()->get('user_id'),
        ];

        // Simpan ke database M_KasKeluar
        $modelKasKeluar->insert($dataKeluar);

        // Tambahkan log CREATE untuk pengeluaran kas kecil
        $auditLogModel->logCreate(
            'k_kas_keluar',
            $user_id,
            'Menambahkan pengeluaran kas kecil dengan Doc No: ' . $docNo
        );

        // Redirect ke halaman lain setelah simpan data
        return redirect()->to('/kas_kecil');
    }

    public function updateKasKecil($idKc)
    {
        $model = new M_KasKecil();
        $modelJurnal = new M_ReportJurnal();
        $auditLogModel = new M_AuditLog();

        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $tanggal = strtoupper($this->request->getPost('tanggal'));
        $kodeAccount = $this->request->getPost('kode_account');
        $namaAccount = $this->request->getPost('nama_account');
        $keterangan = $this->request->getPost('keterangan');
        $kredit = $this->request->getPost('kredit');

        // Ambil data lama berdasarkan id_kc untuk log audit dan mendapatkan doc_no
        $dataLamaKasKecil = $model->find($idKc);
        if (!$dataLamaKasKecil) {
            return redirect()->to('/kas_kecil')->with('error', 'Data tidak ditemukan.');
        }

        $docNo = $dataLamaKasKecil['doc_no']; // Ambil doc_no dari data lama untuk digunakan di ReportJurnal

        // Update data di M_KasKecil
        $dataKasKecil = [
            'tanggal'      => strtoupper($tanggal),
            'kode_account' => strtoupper($kodeAccount),
            'nama_account' => strtoupper($namaAccount),
            'keterangan'   => strtoupper($keterangan),
            'kredit'       => str_replace('.', '', $kredit), // Hilangkan titik jika ada
            'user_id'      => $user_id,
            'tgl_input'    => date('Y-m-d H:i:s'),
        ];

        $model->update($idKc, $dataKasKecil);

        // Tambahkan log UPDATE untuk kas kecil
        $auditLogModel->logEdit(
            'M_KasKecil',
            $idKc,
            'id_kc',
            json_encode($dataLamaKasKecil),
            json_encode($dataKasKecil),
            $user_id,
            'Memperbarui data kas kecil dengan ID KC: ' . $idKc
        );

        // Ambil semua data lama di M_ReportJurnal berdasarkan doc_no
        $dataLamaReportJurnal = $modelJurnal->where('doc_no', $docNo)->findAll();

        // Update data di M_ReportJurnal (Debit)
        $dataReportDebit = [
            'date'        => strtoupper($tanggal),
            'account'     => strtoupper($kodeAccount),
            'name'        => strtoupper($namaAccount),
            'description' => strtoupper($keterangan),
            'debit'       => str_replace('.', '', $kredit),
            'kredit'      => 0,
            'aksi'        => 'Updated',
            'user_id'     => $user_id,
        ];

        $modelJurnal->where('doc_no', $docNo)->where('account', $kodeAccount)->set($dataReportDebit)->update();

        // Tambahkan log UPDATE untuk jurnal debit
        $auditLogModel->logEdit(
            'M_ReportJurnal',
            $docNo,
            'account',
            json_encode($dataLamaReportJurnal),
            json_encode($dataReportDebit),
            $user_id,
            'Memperbarui jurnal debit dengan Doc No: ' . $docNo
        );

        // Update data di M_ReportJurnal (Kredit untuk total nilai)
        $dataReportKredit = [
            'date'        => strtoupper($tanggal),
            'account'     => '11111',
            'name'        => 'KAS KECIL',
            'description' => 'PENGELUARAN KAS KECIL ' . strtoupper($tanggal),
            'debit'       => 0,
            'kredit'      => str_replace('.', '', $kredit), // Gunakan nilai kredit yang baru
            'user_id'     => $user_id,
        ];

        $modelJurnal->where('doc_no', $docNo)->where('account', '11111')->set($dataReportKredit)->update();

        // Tambahkan log UPDATE untuk jurnal kredit
        $auditLogModel->logEdit(
            'M_ReportJurnal',
            $docNo,
            'account',
            json_encode($dataLamaReportJurnal),
            json_encode($dataReportKredit),
            $user_id,
            'Memperbarui jurnal kredit untuk pengeluaran kas kecil dengan Doc No: ' . $docNo
        );

        // Redirect ke halaman kas kecil
        return redirect()->to('/kas_kecil')->with('success', 'Data berhasil diperbarui.');
    }





    public function keluarkasbesar()
    {
        $model = new M_ReportJurnal();

        // Mengambil input filter dari request
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $showAll = $this->request->getGet('show_all');

        // Query data dengan filter
        $builder = $model->orderBy('date', 'DESC');

        $kodeAwal = '01.01';
        $bulan = str_pad(date('m'), 2, '0', STR_PAD_LEFT);
        $pattern = "$kodeAwal.$bulan.KB%";

        $builder->like('doc_no', $pattern, 'after');

        $builder->where('debit !=', 0);

        if (!$showAll) {

            if ($startDate && $endDate) {
                $builder->where('date >=', $startDate)
                    ->where('date <=', $endDate);
            } elseif ($startDate) {
                $builder->where('date >=', $startDate);
            } elseif ($endDate) {
                $builder->where('date <=', $endDate);
            }
        }

        $data_kasbesar = $builder->findAll();
        $data = [
            'title' => 'Pengeluaran Kas Besar',
            'data_kasbesar' => $data_kasbesar,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];

        return view('keuangan/keluar_kasbesar', $data);
    }



    public function getKasBesarData()
    {
        $kasBesarModel = new M_ReportJurnal();

        $currentMonth = str_pad(date('m'), 2, '0', STR_PAD_LEFT);
        $pattern = "01.01.$currentMonth.KB%";

        $dataKasBesar = $kasBesarModel
            ->select('date, debit, doc_no')
            ->like('doc_no', $pattern, 'after')
            ->findAll();


        // Hitung total jumlah
        $totalJumlah = 0;
        foreach ($dataKasBesar as $data) {
            $totalJumlah += $data['debit'];
        }

        // Kirim data sebagai JSON
        return $this->response->setJSON([
            'dataKasBesar' => $dataKasBesar,
            'totalJumlah' => $totalJumlah
        ]);
    }



    public function createPKasbesar()
    {
        $modelJurnal = new M_ReportJurnal();
        $auditLogModel = new M_AuditLog();

        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $tanggal = strtoupper($this->request->getPost('tanggal'));
        $docNo = strtoupper($this->request->getPost('doc_no'));
        $kodeAccount = $this->request->getPost('kode_account');
        $keterangan = $this->request->getPost('keterangan');
        $nilai = $this->request->getPost('nilai');

        $totalNilai = 0; // Inisialisasi total nilai kredit

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
                'user_id'     => $user_id
            ];

            // Simpan ke database M_ReportJurnal (Debit)
            $modelJurnal->insert($dataReportDebit);

            // Tambahkan log CREATE untuk jurnal debit
            $auditLogModel->logCreate(
                'Report Jurnal',
                $user_id,
                'Menambahkan jurnal debit dengan Doc No: ' . $docNo . ' dan Nama Akun: ' . $dataReportDebit['name']
            );

            // Tambahkan nilai debit ke totalNilai
            $totalNilai += str_replace('.', '', $nilai[$key]); // Penjumlahan total nilai
        }

        // Simpan data untuk model M_ReportJurnal (Kredit sebagai total nilai)
        $dataReportKredit = [
            'date'        => strtoupper($tanggal),
            'doc_no'      => strtoupper($docNo),
            'account'     => '11112', // Kode account untuk kas besar
            'name'        => 'KAS BESAR',
            'description' => 'PENGELUARAN KAS BESAR ' . strtoupper($tanggal),
            'debit'       => 0,
            'kredit'      => $totalNilai, // Menggunakan totalNilai yang dihitung
            'user_id'     => $user_id
        ];

        // Simpan ke database M_ReportJurnal (Kredit Total)
        $modelJurnal->insert($dataReportKredit);

        // Tambahkan log CREATE untuk jurnal kredit
        $auditLogModel->logCreate(
            'Report Jurnal',
            $user_id,
            'Menambahkan jurnal kredit untuk pengeluaran kas besar dengan Doc No: ' . $docNo
        );

        // Redirect ke halaman lain setelah simpan data
        return redirect()->to('/keluar_kasbesar')->with('success', 'Data berhasil disimpan.');
    }
    public function updatePKasbesar($idReport)
    {
        $modelJurnal = new M_ReportJurnal();
        $auditLogModel = new M_AuditLog();

        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan dalam sesi');
        }

        $kodeAccount = $this->request->getPost('account');
        $namaAccount = $this->request->getPost('name');
        $keterangan = $this->request->getPost('keterangan');
        $nilai = $this->request->getPost('nilai');

        if (!is_array($kodeAccount) || !is_array($keterangan) || !is_array($nilai)) {
            return redirect()->to('/keluar_kasbesar')->with('error', 'Data input tidak valid.');
        }

        $totalNilai = 0;

        $dataLamaReportJurnal = $modelJurnal->where('id_report', $idReport)->findAll();
        if (!$dataLamaReportJurnal) {
            return redirect()->to('/keluar_kasbesar')->with('error', 'Data tidak ditemukan.');
        }

        foreach ($kodeAccount as $key => $kode) {
            $dataReportDebit = [
                'account'     => $kode,
                'name'        => $namaAccount[$key] ?? '',
                'description' => strtoupper($keterangan[$key] ?? ''),
                'debit'       => str_replace('.', '', $nilai[$key] ?? '0'),
                'kredit'      => 0,
                'aksi'        => 'Posted',
                'user_id'     => $user_id
            ];

            $dataLamaDebit = $modelJurnal->where('id_report', $idReport)
                ->where('account', $dataReportDebit['account'])
                ->first();

            if ($dataLamaDebit) {
                $modelJurnal->where('id_report', $dataLamaDebit['id_report'])->set($dataReportDebit)->update();

                foreach ($dataReportDebit as $column => $newValue) {
                    $oldValue = is_array($dataLamaDebit[$column]) ? json_encode($dataLamaDebit[$column]) : (string) $dataLamaDebit[$column];
                    $newValue = is_array($newValue) ? json_encode($newValue) : (string) $newValue;

                    if ($oldValue != $newValue) {
                        $auditLogModel->logEdit(
                            'Report Jurnal',
                            $dataLamaDebit['id_report'],
                            $column,
                            $oldValue,
                            $newValue,
                            $user_id,
                            "Memperbarui jurnal debit dengan ID Report: $idReport, kolom: $column"
                        );
                    }
                }
            }

            $totalNilai += str_replace('.', '', $nilai[$key] ?? '0');
        }

        return redirect()->to('/keluar_kasbesar')->with('success', 'Data berhasil diperbarui.');
    }






    public function jurnal_kasmasuk()
    {
        $modelKas = new M_ReportJurnal();

        // Ambil parameter dari GET request
        $searchKeyword = $this->request->getGet('search_keyword');
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-d');
        $filterAccount = $this->request->getGet('filter_account');
        $showAll = $this->request->getGet('show_all');

        // Query dasar
        $modelKas->whereIn('name', ['REK BCA', 'KAS BESAR']);

        // Tambahkan filter jika tidak memilih "Tampilkan Semua"
        if (!$showAll) {
            if (!empty($searchKeyword)) {
                $modelKas->like('description', $searchKeyword)
                    ->orLike('doc_no', $searchKeyword);
            }

            if (!empty($startDate) && !empty($endDate)) {
                $modelKas->where('date >=', $startDate)
                    ->where('date <=', $endDate);
            }

            if (!empty($filterAccount)) {
                $modelKas->where('name', $filterAccount);
            }
        }

        $kas = $modelKas->orderBy('id_report', 'DESC')->findAll();

        $data = [
            'title' => 'Kas Masuk Real',
            'kasMasuk' => $kas,
            'searchKeyword' => $searchKeyword,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'filterAccount' => $filterAccount
        ];

        return view('keuangan/kas_masuk', $data);
    }




    public function jurnal_kaskeluar()
    {
        $modelKas = new M_ReportJurnal();

        // Tangkap filter dari request (GET method)
        $filterName = $this->request->getVar('filter_name');
        $startDate = $this->request->getVar('start_date');
        $endDate = $this->request->getVar('end_date');
        $searchKeyword = $this->request->getVar('search_keyword');

        // Query dasar untuk mengambil data
        $builder = $modelKas->where('kredit >', 0);

        // Filter berdasarkan Nama Kas
        if (!empty($filterName)) {
            $builder->where('name', $filterName);
        } else {
            $builder->whereIn('name', ['KAS BESAR', 'KAS KECIL', 'REK BCA']);
        }

        // Filter berdasarkan rentang tanggal
        if (!empty($startDate)) {
            $builder->where('date >=', $startDate);
        }
        if (!empty($endDate)) {
            $builder->where('date <=', $endDate);
        }

        // Filter berdasarkan kata kunci pencarian (search)
        if (!empty($searchKeyword)) {
            $builder->groupStart()
                ->like('description', $searchKeyword) // Cari di kolom keterangan
                ->orLike('doc_no', $searchKeyword)    // Cari di kolom nomor dokumen
                ->groupEnd();
        }

        // Ambil data dari database
        $kas = $builder->orderBy('date', 'DESC')->findAll();

        // Kelompokkan transaksi berdasarkan tanggal
        $groupedData = [];
        foreach ($kas as $transaction) {
            $tanggal = $transaction['date'];
            if (!isset($groupedData[$tanggal])) {
                $groupedData[$tanggal] = [
                    'transactions' => [],
                    'total' => 0,
                ];
            }
            $groupedData[$tanggal]['transactions'][] = $transaction;
            $groupedData[$tanggal]['total'] += $transaction['kredit'];
        }

        $data = [
            'title' => 'Kas Keluar Real',
            'groupedData' => $groupedData,
            'filterName' => $filterName,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'searchKeyword' => $searchKeyword, // Kirim kata kunci ke view untuk menampilkan ulang
        ];

        return view('keuangan/kas_keluar', $data);
    }

    public function repairoder_list()
    {
        $modelro = new M_RepairOrder();

        // Ambil filter dari GET request
        $filterName = $this->request->getGet('filter_name');
        $searchKeyword = $this->request->getGet('search_keyword');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $showAll = $this->request->getGet('show_all');

        // Panggil data dari model dengan filter
        $rodata = $modelro->getRepairOrder($filterName, $searchKeyword, $startDate, $endDate, $showAll);

        // Kirim data ke view
        $data = [
            'title' => 'Repair Order List',
            'rodata' => $rodata,
            'filterName' => $filterName,
            'searchKeyword' => $searchKeyword,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'showAll' => $showAll,
        ];

        return view('keuangan/ro_list', $data);
    }



    public function repairorder_listprev($id_terima_po)
    {
        $modelro = new M_RepairOrder();

        $dataro = $modelro->findByTerimaPo($id_terima_po);
        $rodata = $modelro->getRepairOrderDetails($id_terima_po);


        if (!$rodata) {
            return redirect()->back()->with('error', 'Repair Order tidak ditemukan.');
        }


        $data = [
            'title' => 'Repair Order List',
            'rodata' => $rodata,
            'dataro' => $dataro
        ];

        // Mengembalikan data ke view
        return view('keuangan/ro_listprev', $data);
    }





    public function repair_materialjasa()
    {
        $modelJasa = new M_Rm_Jasa();

        $dataJasa = $modelJasa->orderBy('id_jasa', 'DESC')->findAll();

        $data = [
            'title' => 'RM Jasa',
            'jasa' => $dataJasa,
        ];

        return view('keuangan/material_jasa', $data);
    }


    public function repair_materialjasaadd()
    {
        $modelJasa = new M_Rm_Jasa();
        $roM = new M_RepairOrder();

        $roData = $roM->findAll();


        $data = [
            'title' => 'RM Jasa',
            'generateId' => $modelJasa->generateId(),
            'ro' => $roData,
        ];
        return view('keuangan/material_jasaadd', $data);
    }

    public function createRepairJasa()
    {
        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID not found in session');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $rjasaM = new M_Rm_Jasa();
        $auditM = new M_AuditLog();
        $generateId = $rjasaM->generateId();

        $id_jasa = $this->request->getPost('id_jasa');
        $data = [
            'id_jasa' => $id_jasa,
            'tanggal' => $this->request->getPost('tanggal'),
            'no_ro' => strtoupper($this->request->getPost('no_ro')),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'nopol' => strtoupper($this->request->getPost('nopol')),
            'no_rangka' => strtoupper($this->request->getPost('no_rangka')),
            'jenis_mobil' => strtoupper($this->request->getPost('jenis_mobil')),
            'warna' => strtoupper($this->request->getPost('warna')),
            'tahun' => $this->request->getPost('tahun'),
            'nama_pemilik' => strtoupper($this->request->getPost('nama_pemilik')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'user_id' => $user_id
        ];

        $rjasaM->insert($data);

        $description = "$user_id Menambahkan Repair Material Jasa dengan id $id_jasa";

        $auditM->logCreate('Repair Material Jasa', $user_id, $description);

        // Selesaikan transaksi
        $db->transComplete();

        // Cek status transaksi
        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menyimpan data');
        }

        return redirect()->to(base_url('/material_jasaprev/' . $generateId))->with('success', 'Repair Jasa berhasil disimpan.');
    }

    public function updateJasa()
    {
        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID not found in session');
        }

        $modelJasa = new M_Rm_Jasa();
        $auditM = new M_AuditLog();

        $id_jasa = $this->request->getPost('id_jasa');

        $oldData = $modelJasa->find($id_jasa);

        if (!$oldData) {
            return redirect()->back()->with('error', 'Repair Jasa tidak ditemukan');
        }

        log_message('debug', 'Data Lama: ' . print_r($oldData, true));

        $data = [
            'id_jasa' => $id_jasa,
            'tanggal' => $this->request->getPost('tanggal'),
            'no_ro' => strtoupper($this->request->getPost('no_ro')),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'nopol' => strtoupper($this->request->getPost('nopol')),
            'no_rangka' => strtoupper($this->request->getPost('no_rangka')),
            'jenis_mobil' => strtoupper($this->request->getPost('jenis_mobil')),
            'warna' => strtoupper($this->request->getPost('warna')),
            'tahun' => $this->request->getPost('tahun'),
            'nama_pemilik' => strtoupper($this->request->getPost('nama_pemilik')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
        ];

        log_message('debug', 'Data Baru: ' . print_r($data, true));

        $modelJasa->update($id_jasa, $data);

        $description = "$user_id Mengedit Repair Material Jasa dengan id $id_jasa";

        foreach ($data as $column => $newValue) {
            $oldValue = isset($oldData[$column]) ? $oldData[$column] : null;

            log_message('debug', "Perubahan pada $column: Old Value - $oldValue, New Value - $newValue");

            if (trim(strtolower($oldValue)) != trim(strtolower($newValue))) {
                $auditM->logEdit('Repair Material Jasa', $id_jasa, $column, $oldValue, $newValue, $user_id, $description);
            }
        }

        $auditM->insert([
            'action' => 'EDIT',
            'table_name' => 'Repair Material Jasa',
            'record_id' => $id_jasa,
            'username' => $user_id,
            'description' => $description,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('material_jasaprev/' . $id_jasa))->with('success', 'Repair Jasa berhasil diperbarui.');
    }

    public function deleteRepairJasa($id_jasa)
    {
        $user_id = session()->get('username');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID not found in session');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $rjasaM = new M_Rm_Jasa();
        $auditM = new M_AuditLog();

        $oldData = $rjasaM->find($id_jasa);

        if (!$oldData) {
            return redirect()->back()->with('error', 'Repair Jasa tidak ditemukan');
        }

        $rjasaM->delete($id_jasa);

        $description = "$user_id Menghapus Repair Material Jasa dengan id $id_jasa";

        $auditM->logDelete('Repair Material Jasa', $id_jasa, $user_id, $oldData, $description);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }

        return redirect()->to(base_url('/material_jasa'))->with('success', 'Repair Jasa berhasil dihapus.');
    }





    public function repair_materialjasaprev($id_jasa)
    {
        $modelJasa = new M_Rm_Jasa();
        $masterJasaModel = new M_Jasa();
        $modelDetailJasa = new M_Rm_Detail_Jasa();

        $dataJasa = $modelJasa->find($id_jasa);
        $masterjasa = $masterJasaModel->findAll();
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
        $modelAuditLog = new M_AuditLog();
        $modelJurnal = new M_ReportJurnal();
        $modelCoa = new M_Coa();
        $modelMasterJasa = new M_Jasa();

        $username = session()->get('username');
        $data = [
            'id_jasa' => $this->request->getPost('id_jasa'),
            'no_order' => $this->request->getPost('no_order'),
            'kode_jasa' => strtoupper($this->request->getPost('kode_jasa')),
            'nama_jasa' => strtoupper($this->request->getPost('nama_jasa')),
            'harga' => str_replace([',', '.'], '', $this->request->getPost('harga')),
            'jenis_bayar' => strtoupper($this->request->getPost('jenis_bayar')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
        ];

        if ($modelDetailJasa->find($data['id_jasa'])) {
            $oldData = $modelDetailJasa->find($data['id_jasa']);
            $modelDetailJasa->update($data['id_jasa'], $data);

            foreach ($data as $column => $newValue) {
                if (isset($oldData[$column]) && $oldData[$column] !== $newValue) {
                    $modelAuditLog->logEdit(
                        'rm_detail_jasa',
                        $data['id_jasa'],
                        $column,
                        $oldData[$column],
                        $newValue,
                        $username
                    );
                }
            }
        } else {
            $modelDetailJasa->insert($data);

            $modelAuditLog->logCreate(
                'rm_detail_jasa',
                $username,
                "User {$username} Menambahkan Jasa dengan ID {$data['id_jasa']}"
            );
        }

        $total = $modelDetailJasa->selectSum('harga')
            ->where('id_jasa', $data['id_jasa'])
            ->first();

        $modelJasa->update($data['id_jasa'], ['total' => $total['harga']]);

        $modelAuditLog->logEdit(
            'rm_jasa',
            $data['id_jasa'],
            'total',
            '',
            $total['harga'],
            $username,
            "User {$username} Mengubah Total Jasa pada ID {$data['id_jasa']}"
        );

        // Pencatatan ke jurnal
        $coaData = $modelCoa->where('kode', $data['jenis_bayar'])->first();
        $masterJasaData = $modelMasterJasa->where('kode', $data['kode_jasa'])->first();

        if ($coaData && $masterJasaData) {
            $docNo = "HPP.{$data['id_jasa']}";
            $description = "{$data['nama_jasa']} {$data['keterangan']}";

            // Entri jurnal untuk DEBET
            $jurnalDebit = [
                'date' => date('Y-m-d'),
                'doc_no' => $docNo,
                'account' => $coaData['kode'],
                'name' => $coaData['nama_account'],
                'description' => $description,
                'debit' => $total['harga'],
                'kredit' => 0,
                'aksi' => 'Posted',
                'user_id' => $username,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $modelJurnal->insert($jurnalDebit);

            // Entri jurnal untuk KREDIT
            if (!empty($masterJasaData['kode_alokasi'])) {
                $coaAlokasi = $modelCoa->where('kode', $masterJasaData['kode_alokasi'])->first();
                if ($coaAlokasi) {
                    $jurnalKredit = [
                        'date' => date('Y-m-d'),
                        'doc_no' => $docNo,
                        'account' => $coaAlokasi['kode'],
                        'name' => $coaAlokasi['nama_account'],
                        'description' => $description,
                        'debit' => 0,
                        'kredit' => $total['harga'],
                        'aksi' => '',
                        'user_id' => $username,
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                    $modelJurnal->insert($jurnalKredit);
                } else {
                    return redirect()->back()->with('error', 'Kode Alokasi tidak ditemukan di COA.');
                }
            } else {
                return redirect()->back()->with('error', 'Kode Alokasi kosong pada Master Jasa.');
            }
        } else {
            return redirect()->back()->with('error', 'Jenis Bayar atau Kode Jasa tidak ditemukan di COA atau Master Jasa.');
        }

        return redirect()->to(base_url('material_jasaprev/' . $data['id_jasa']))->with('success', 'Jasa berhasil ditambahkan.');
    }






    public function add_bayar_hutang()
    {
        $hutang = new M_K_Pembelian;
        $hutangM = new M_Terima_Bahan();

        $hutangsupp = $hutangM->getHutangWithAll();


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

        $user_id = session()->get('username');
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
        $user_id = session()->get('username');
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
            'tgl_pembayaran'   => $this->request->getPost('tgl_pembayaran'),
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
