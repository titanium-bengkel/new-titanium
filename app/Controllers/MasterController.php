<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\M_BarangK;
use App\Models\M_Barang;
use App\Models\M_Group;
use App\Models\M_Pengerjaan;
use App\Models\M_Jasa;
use App\Models\M_Alokasi;
use App\Models\M_Gudang;
use App\Models\M_Salesman;
use App\Models\M_Asuransi;
use App\Models\M_Coa;
use App\Models\M_Supplier;
use App\Models\M_Barang_Bahan;
use App\Models\M_Barang_Sparepart;
use App\Models\M_Gd_Bahan;
use App\Models\M_Kartu_Stok;
use CodeIgniter\Controller;

class MasterController extends BaseController
{

    protected $userModel;
    protected $m_BarangK;
    protected $m_Barang;
    protected $m_Group;
    protected $m_Pengerjaan;
    protected $m_Jasa;
    protected $m_Alokasi;
    protected $m_Gudang;
    protected $m_Salesman;
    protected $m_Asuransi;
    protected $m_Coa;
    protected $m_Supplier;
    protected $m_Barang_Bahan;
    protected $m_Gd_Bahan;
    protected $m_Kartu_Stok;


    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->m_BarangK = new M_BarangK();
        $this->m_Barang = new M_Barang();
        $this->m_Group = new M_Group();
        $this->m_Pengerjaan = new M_Pengerjaan();
        $this->m_Jasa = new M_Jasa();
        $this->m_Alokasi = new M_Alokasi();
        $this->m_Gudang = new M_Gudang();
        $this->m_Salesman = new M_Salesman();
        $this->m_Asuransi = new M_Asuransi();
        $this->m_Coa = new M_Coa();
        $this->m_Supplier = new M_Supplier();
        $this->m_Barang_Bahan = new M_Barang_Bahan();
        $this->m_Gd_Bahan = new M_Gd_Bahan();
        $this->m_Kartu_Stok = new M_Kartu_Stok();
    }

    public function barangkategori()
    {
        $user_id = session()->get('user_id');
        $kategori = $this->m_BarangK->getBarangKategoriWithUsername();

        $username = '';
        if ($user_id) {
            $user = $this->userModel->find($user_id);
            if ($user) {
                $username = $user['username'];
            }
        }

        $data = [
            'title' => 'Barang Kategori',
            'kategori' => $kategori,
            'username' => $username
        ];

        return view('master/barangkategori', $data);
    }

    public function createBarang()
    {
        // Mendapatkan user_id dari session
        $user_id = session()->get('user_id');

        // Validasi jika user_id tidak ditemukan di sesi
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID not found in session');
        }

        // Mendapatkan data dari form
        $data = [
            'userid' => strtoupper($user_id),
            'kode' => strtoupper($this->request->getPost('kode')),
            'nama' => strtoupper($this->request->getPost('nama')),
            'stok' => strtoupper($this->request->getPost('stok')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'status' => null // Atur status sesuai kebutuhan Anda
        ];

        // Memanggil model untuk menyimpan data baru
        if (!$this->m_BarangK->insertBarangKategori($data));

        // Tampilkan SweetAlert dengan tipe toast setelah proses update berhasil
        $alert = [
            'title' => 'Sukses!',
            'text' => 'Data berhasil Ditambahkan .',
            'icon' => 'success',
            'toast' => true,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 3000
        ];

        return redirect()->to('master/barangkategori')->with('alert', $alert);
    }
    // Metode untuk menyimpan perubahan barang yang sudah diedit
    public function updateBarang($id)
    {
        // Ambil data dari form
        $data = [
            'kode' => strtoupper($this->request->getPost('kode')),
            'nama' => strtoupper($this->request->getPost('nama')),
            'stok' => strtoupper($this->request->getPost('stok')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
        ];

        // Update data di database
        $this->m_BarangK->updateBarangKategori($id, $data);

        // Tampilkan SweetAlert dengan tipe toast setelah proses update berhasil
        $alert = [
            'title' => 'Sukses!',
            'text' => 'Data berhasil diperbarui.',
            'icon' => 'success',
            'toast' => true,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 3000
        ];

        return redirect()->to('master/barangkategori')->with('alert', $alert);
    }

    // Method to delete a Barang
    public function deleteBarang($id)
    {
        $this->m_Barang->deleteBarangKategori($id);

        // Tampilkan SweetAlert dengan tipe toast setelah proses delete berhasil
        $alert = [
            'title' => 'Sukses!',
            'text' => 'Data berhasil dihapus.',
            'icon' => 'success',
            'toast' => true,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 3000
        ];

        return redirect()->to('master/barangkategori')->with('alert', $alert);
    }
    //  Barang Group

    public function baranggroup()
    {
        // Mendapatkan user_id dari session
        $userid = session()->get('user_id');

        // Memeriksa apakah user_id tersedia dalam session
        if (!$userid) {
            return redirect()->to('/')->with('error', 'User ID not found in session');
        }

        // Mengambil data kategori dari model
        $categories = $this->m_Group->getKategori();

        // Mengambil data grup dari model
        $groups = $this->m_Group->getBarangGroupTableJoin();

        // Mengirim data ke view dengan variabel title, categories, dan groups
        return view('master/baranggroup', [
            'title' => 'Barang Group',
            'categories' => $categories,
            'groups' => $groups
        ]);
    }

    public function createBarangGroup()
    {
        // Mendapatkan user_id dari session
        $userid = session()->get('user_id');

        // Memeriksa apakah user_id tersedia dalam session
        if (!$userid) {
            return redirect()->to('/')->with('error', 'User ID not found in session');
        }


        // Memasukkan data baru menggunakan model
        $data = [
            'kodegroup' => $this->request->getPost('kodegroup'),
            'namagroup' => strtoupper($this->request->getPost('namagroup')),
            'user_id' => $userid,
            'kodekategori' => $this->request->getPost('kodekategori'),
            'kodeperkiraan' => $this->request->getPost('kodeperkiraan'),
            'keterangan' => strtoupper($this->request->getPost('keterangan'))
        ];

        if (!$this->m_Group->insertBarangGroup($data)) {
            return redirect()->back()->withInput()->with('error', 'Gagal Menambahkan Barang Group');
        }

        // Redirect kembali ke halaman master/baranggroup dengan pesan sukses
        return redirect()->to('master/baranggroup')->with('success', 'Barang Group Berhasil Ditambahkan');
    }
    public function updateBarangGroup($id)
    {
        // Mendapatkan user_id dari session
        $userid = session()->get('user_id');

        // Memeriksa apakah user_id tersedia dalam session
        if (!$userid) {
            return redirect()->to('/')->with('error', 'User ID not found in session');
        }


        // Memperbarui data menggunakan model
        $data = [
            'kodegroup' => strtoupper($this->request->getPost('edit_kodegroup')),
            'namagroup' => strtoupper($this->request->getPost('edit_namagroup')),
            'user_id' => strtoupper($userid),
            'kodekategori' => strtoupper($this->request->getPost('edit_kodekategori')),
            'kodeperkiraan' => strtoupper($this->request->getPost('edit_kodeperkiraan')),
            'keterangan' => strtoupper($this->request->getPost('edit_keterangan'))
        ];

        // ID data yang akan diupdate
        $id = $this->request->getPost('edit_id');

        // Memanggil model untuk melakukan update
        if (!$this->m_Group->updateBarangGroup($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Gagal Memperbarui Barang Group');
        }

        // Redirect kembali ke halaman master/baranggroup dengan pesan sukses
        return redirect()->to('master/baranggroup')->with('success', 'Barang Group Berhasil Diperbarui');
    }

    // public function deleteBarangGroup($id)
    // {
    //     $this->m_Group->deleteBarangGroup($id);
    //     return redirect()->to('/master/baranggroup')->with('success', 'Data deleted successfully');
    // }
    public function barang()
    {
        $user_id = session()->get('user_id');
        $barang = $this->m_Barang->getAllBarangWithDetails();
        $kategori = $this->m_Group->getKategori();
        $groups = $this->m_Group->getGroups();

        $username = '';
        if ($user_id) {
            $user = $this->userModel->find($user_id);
            if ($user) {
                $username = $user['username'];
            }
        }

        $data = [
            'title' => 'Barang',
            'barang' => $barang,
            'kategori' => $kategori,
            'groups' => $groups,
            'username' => $username
        ];

        return view('master/barang', $data);
    }

    public function createBar()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID not found in session');
        }

        $data = [
            'kode' => $this->request->getPost('kode'),
            'nama' => $this->request->getPost('nama'),
            'kode_group' => $this->request->getPost('kode_group'),
            'sat_B' => $this->request->getPost('sat_B'),
            'isi_B' => $this->request->getPost('isi_B'),
            'sat_T' => $this->request->getPost('sat_T'),
            'isi_T' => $this->request->getPost('isi_T'),
            'sat_K' => $this->request->getPost('sat_K'),
            'stok_minimal' => $this->request->getPost('stok_minimal'),
            'stok_maksimal' => $this->request->getPost('stok_maksimal'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'kode_kategori' => $this->request->getPost('kode_kategori'),
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'stok' => $this->request->getPost('stok'),
            'tahun' => $this->request->getPost('tahun'),
            'periode' => $this->request->getPost('periode'),
            'upd' => $this->request->getPost('upd'),
            'hargabeli_B' => $this->request->getPost('hargabeli_B'),
            'hargabeli_T' => $this->request->getPost('hargabeli_T'),
            'hargajual_B' => $this->request->getPost('hargajual_B'),
            'hargajual_T' => $this->request->getPost('hargajual_T'),
            'aktif' => $this->request->getPost('aktif'),
            'user_id' => $user_id
        ];

        if (!$this->m_Barang->insertBarang($data)) {
            return redirect()->to('master/barang')->with('error', 'Gagal Menambahkan Data Barang');
        }

        return redirect()->to('master/barang')->with('success', 'Data Barang Berhasil Ditambahkan');
    }

    public function updateBar($id)
    {
        $data = [
            'kode' => $this->request->getPost('kode'),
            'nama' => $this->request->getPost('nama'),
            'kode_group' => $this->request->getPost('kode_group'),
            'sat_B' => $this->request->getPost('sat_B'),
            'isi_B' => $this->request->getPost('isi_B'),
            'sat_T' => $this->request->getPost('sat_T'),
            'isi_T' => $this->request->getPost('isi_T'),
            'sat_K' => $this->request->getPost('sat_K'),
            'stok_minimal' => $this->request->getPost('stok_minimal'),
            'stok_maksimal' => $this->request->getPost('stok_maksimal'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'kode_kategori' => $this->request->getPost('kode_kategori'),
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'stok' => $this->request->getPost('stok'),
            'tahun' => $this->request->getPost('tahun'),
            'periode' => $this->request->getPost('periode'),
            'upd' => $this->request->getPost('upd'),
            'hargabeli_B' => $this->request->getPost('hargabeli_B'),
            'hargabeli_T' => $this->request->getPost('hargabeli_T'),
            'hargajual_B' => $this->request->getPost('hargajual_B'),
            'hargajual_T' => $this->request->getPost('hargajual_T'),
            'aktif' => $this->request->getPost('aktif')
        ];

        $this->m_Barang->updateBarang($id, $data);

        $alert = [
            'title' => 'Sukses!',
            'text' => 'Data berhasil diperbarui.',
            'icon' => 'success',
            'toast' => true,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 3000
        ];

        return redirect()->to('master/barang')->with('alert', $alert);
    }


    public function pengerjaan()
    {
        $user_id = session()->get('user_id');
        $kategori = $this->m_Pengerjaan->getPengerjaanWithUsername();

        $username = '';
        if ($user_id) {
            $user = $this->userModel->find($user_id);
            if ($user) {
                $username = $user['username'];
            }
        }

        $data = [
            'title' => 'Pengerjaan',
            'kategori' => $kategori,
            'username' => $username
        ];

        return view('master/pengerjaan', $data);
    }

    public function createPengerjaan()
    {
        // Mendapatkan user_id dari session
        $user_id = session()->get('user_id');

        // Validasi jika user_id tidak ditemukan di sesi
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID not found in session');
        }

        // Mendapatkan data dari form
        $data = [
            'user_id' => strtoupper($user_id),
            'kode_pengerjaan' => strtoupper($this->request->getPost('kode_pengerjaan')),
            'nama_pengerjaan' => strtoupper($this->request->getPost('nama_pengerjaan')),
            'keterangan_pengerjaan' => strtoupper($this->request->getPost('keterangan_pengerjaan'))
        ];


        // Memanggil model untuk menyimpan data baru
        if (!$this->m_Pengerjaan->insertPengerjaan($data)) {
            return redirect()->to('master/pengerjaan')->with('error', 'Gagal Menambahkan Pengerjaan');
        }

        return redirect()->to('master/pengerjaan')->with('success', 'Pengerjaan Berhasil Ditambahkan');
    }

    // Method untuk menyimpan perubahan barang yang sudah diedit
    public function updatePengerjaan($id)
    {
        $data = [
            'kode_pengerjaan' => strtoupper($this->request->getPost('kode_pengerjaan')),
            'nama_pengerjaan' => strtoupper($this->request->getPost('nama_pengerjaan')),
            'keterangan_pengerjaan' => strtoupper($this->request->getPost('keterangan_pengerjaan')),
            'user_id' => session()->get('user_id')  // Menggunakan session untuk mendapatkan user_id
        ];

        $this->m_Pengerjaan->updatePengerjaan($id, $data);

        return redirect()->back()->with('success', 'Pengerjaan updated successfully');
    }

    // Alokasi
    public function alokasibarang()
    {
        $user_id = session()->get('user_id');
        $kategori = $this->m_Alokasi->getAlokasiWithUsername();

        $username = '';
        if ($user_id) {
            $user = $this->userModel->find($user_id);
            if ($user) {
                $username = $user['username'];
            }
        }

        $data = [
            'title' => 'Alokasi Barang',
            'kategori' => $kategori,
            'username' => $username
        ];

        return view('master/alokasibarang', $data);
    }

    public function createAlokasi()
    {
        $user_id = session()->get('user_id');

        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID not found in session');
        }

        $data = [
            'user_id' => strtoupper($user_id),
            'kode_alokasi' => strtoupper($this->request->getPost('kode_alokasi')),
            'kode_perkiraan' => strtoupper($this->request->getPost('kode_perkiraan')),
            'nama_alokasi' => strtoupper($this->request->getPost('nama_alokasi')),
            'keterangan_alokasi' => strtoupper($this->request->getPost('keterangan_alokasi'))
        ];


        if (!$this->m_Alokasi->insertAlokasi($data)) {
            return redirect()->to('master/alokasibarang')->with('error', 'Gagal Menambahkan Alokasi Barang');
        }

        return redirect()->to('master/alokasibarang')->with('success', 'Alokasi Barang Berhasil Ditambahkan');
    }

    // Method untuk menyimpan perubahan barang yang sudah diedit
    public function updateAlokasi($id)
    {
        $data = [
            'kode_alokasi' => strtoupper($this->request->getPost('kode_alokasi')),
            'kode_perkiraan' => strtoupper($this->request->getPost('kode_perkiraan')),
            'nama_alokasi' => strtoupper($this->request->getPost('nama_alokasi')),
            'keterangan_alokasi' => strtoupper($this->request->getPost('keterangan_alokasi')),
            'user_id' => session()->get('user_id')  // Menggunakan session untuk mendapatkan user_id
        ];

        $this->m_Alokasi->updateAlokasi($id, $data);

        return redirect()->back()->with('success', 'Alokasi Barang updated successfully');
    }
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function jasa()
    {
        $jasa = $this->m_Jasa->findAll();
        $coa = $this->m_Coa->findAll();

        $data = [
            'title' => 'Jasa',
            'jasa' => $jasa,
            'coa' => $coa,
        ];

        return view('master/jasa', $data);
    }

    public function createJasa()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID not found in session');
        }

        $data = [
            'kode' => strtoupper($this->request->getPost('kode')),
            'nama_jasa' => strtoupper($this->request->getPost('nama_jasa')),
            'kode_biaya' => strtoupper($this->request->getPost('kode_biaya')),
            'ket_biaya' => strtoupper($this->request->getPost('ket_biaya')),
            'ket_alokasi' => strtoupper($this->request->getPost('ket_alokasi')),
            'kode_alokasi' => strtoupper($this->request->getPost('kode_alokasi')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'user_id' => strtoupper($user_id)
        ];


        if (!$this->m_Jasa->insertJasa($data)) {
            return redirect()->to('master/jasa')->with('error', 'Gagal Menambahkan Data Jasa');
        }

        return redirect()->to('master/jasa')->with('success', 'Data Jasa Berhasil Ditambahkan');
    }

    public function updateJasa($id)
    {
        $data = [
            'kode' => strtoupper($this->request->getPost('kode')),
            'nama_jasa' => strtoupper($this->request->getPost('nama_jasa')),
            'kode_biaya' => strtoupper($this->request->getPost('kode_biaya')),
            'kode_alokasi' => strtoupper($this->request->getPost('kode_alokasi')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
        ];

        $this->m_Jasa->updateJasa($id, $data);

        $alert = [
            'title' => 'Sukses!',
            'text' => 'Data berhasil diperbarui.',
            'icon' => 'success',
            'toast' => true,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 3000
        ];

        return redirect()->to('master/jasa')->with('alert', $alert);
    }


    public function asuransi()
    {
        $user_id = session()->get('user_id');
        $asuransi = $this->m_Asuransi->findAll();

        $username = '';
        if ($user_id) {
            $user = $this->userModel->find($user_id);
            if ($user) {
                $username = $user['username'];
            }
        }

        $data = [
            'title' => 'Asuransi',
            'asuransi' => $asuransi,
            'username' => $username
        ];

        return view('master/asuransi', $data);
    }

    public function createAsuransi()
    {
        $user_id = session()->get('user_id');

        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID not found in session');
        }

        $data = [
            'user_id' => strtoupper($user_id),
            'kode' => strtoupper($this->request->getPost('kode')),
            'nama_asuransi' => strtoupper($this->request->getPost('nama_asuransi')),
            'status_member' => strtoupper($this->request->getPost('status_member')),
            'kode_alokasi' => strtoupper($this->request->getPost('kode_alokasi')),
            'kode_group' => strtoupper($this->request->getPost('kode_group')),
            'alamat' => strtoupper($this->request->getPost('alamat')),
            'kodepos' => strtoupper($this->request->getPost('kodepos')),
            'kota' => strtoupper($this->request->getPost('kota')),
            'telp' => strtoupper($this->request->getPost('telp')),
            'fax' => strtoupper($this->request->getPost('fax')),
            'no_hp_whatsapp' => strtoupper($this->request->getPost('no_hp_whatsapp')),
            'email' => strtoupper($this->request->getPost('email')),
            'contact_person' => strtoupper($this->request->getPost('contact_person')),
            'discount' => strtoupper($this->request->getPost('discount')),
            'npwp' => strtoupper($this->request->getPost('npwp')),
            'plafond' => strtoupper($this->request->getPost('plafond')),
            'max_bill' => strtoupper($this->request->getPost('max_bill')),
            'customer_pos' => strtoupper($this->request->getPost('customer_pos')),
            'kode_gudang' => strtoupper($this->request->getPost('kode_gudang')),
            'status' => strtoupper($this->request->getPost('status')),
            'keterangan' => strtoupper($this->request->getPost('keterangan'))
        ];


        if (!$this->m_Asuransi->insertAsuransi($data)) {
            return redirect()->to('master/asuransi')->with('error', 'Gagal Menambahkan Data Asuransi');
        }

        return redirect()->to('master/asuransi')->with('success', 'Data Asuransi Berhasil Ditambahkan');
    }

    public function updateAsuransi($id)
    {
        $data = [
            'kode' => strtoupper($this->request->getPost('kode')),
            'nama_asuransi' => strtoupper($this->request->getPost('nama_asuransi')),
            'status_member' => strtoupper($this->request->getPost('status_member')),
            'kode_alokasi' => strtoupper($this->request->getPost('kode_alokasi')),
            'kode_group' => strtoupper($this->request->getPost('kode_group')),
            'alamat' => strtoupper($this->request->getPost('alamat')),
            'kodepos' => strtoupper($this->request->getPost('kodepos')),
            'kota' => strtoupper($this->request->getPost('kota')),
            'telp' => strtoupper($this->request->getPost('telp')),
            'fax' => strtoupper($this->request->getPost('fax')),
            'no_hp_whatsapp' => strtoupper($this->request->getPost('no_hp_whatsapp')),
            'email' => strtoupper($this->request->getPost('email')),
            'contact_person' => strtoupper($this->request->getPost('contact_person')),
            'discount' => strtoupper($this->request->getPost('discount')),
            'npwp' => strtoupper($this->request->getPost('npwp')),
            'plafond' => strtoupper($this->request->getPost('plafond')),
            'max_bill' => strtoupper($this->request->getPost('max_bill')),
            'customer_pos' => strtoupper($this->request->getPost('customer_pos')),
            'kode_gudang' => strtoupper($this->request->getPost('kode_gudang')),
            'status' => strtoupper($this->request->getPost('status')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'user_id' => strtoupper(session()->get('user_id'))
        ];

        $this->m_Asuransi->updateAsuransi($id, $data);

        return redirect()->back()->with('success', 'Data Asuransi berhasil diperbarui');
    }
    // ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function gudang()
    {
        $user_id = session()->get('user_id');
        $kategori = $this->m_Gudang->getGudangWithUsername();

        $username = '';
        if ($user_id) {
            $user = $this->userModel->find($user_id);
            if ($user) {
                $username = $user['username'];
            }
        }

        $data = [
            'title' => 'Gudang',
            'kategori' => $kategori,
            'username' => $username
        ];

        return view('master/gudang', $data);
    }

    public function createGudang()
    {
        $user_id = session()->get('user_id');

        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID not found in session');
        }

        $data = [
            'user_id' => strtoupper($user_id),
            'telp' => strtoupper($this->request->getPost('telp')),
            'fax' => strtoupper($this->request->getPost('fax')),
            'kota' => strtoupper($this->request->getPost('kota')),
            'alamat' => strtoupper($this->request->getPost('alamat')),
            'kode' => strtoupper($this->request->getPost('kode')),
            'gudangpos' => strtoupper($this->request->getPost('gudangpos')),
            'nama' => strtoupper($this->request->getPost('nama')),
            'contactperson' => strtoupper($this->request->getPost('contactperson')),
            'keterangan' => strtoupper($this->request->getPost('keterangan'))
        ];


        if (!$this->m_Gudang->insertGudang($data)) {
            return redirect()->to('master/gudang')->with('error', 'Gagal Menambahkan Data Gudang');
        }

        return redirect()->to('master/gudang')->with('success', 'Data Gudang Berhasil Ditambahkan');
    }

    // Method untuk menyimpan perubahan barang yang sudah diedit
    public function updateGudang($id)
    {
        $data = [
            'telp' => strtoupper($this->request->getPost('telp')),
            'fax' => strtoupper($this->request->getPost('fax')),
            'kota' => strtoupper($this->request->getPost('kota')),
            'alamat' => strtoupper($this->request->getPost('alamat')),
            'kode' => strtoupper($this->request->getPost('kode')),
            'gudangpos' => strtoupper($this->request->getPost('gudangpos')),
            'nama' => strtoupper($this->request->getPost('nama')),
            'contactperson' => strtoupper($this->request->getPost('contactperson')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'user_id' => session()->get('user_id')  // Menggunakan session untuk mendapatkan user_id
        ];

        $this->m_Gudang->updateGudang($id, $data);

        return redirect()->back()->with('success', 'Data Gudang updated successfully');
    }

    public function salesman()
    {
        $user_id = session()->get('user_id');
        $salesmen = $this->m_Salesman->getSalesmanWithUsername();

        $username = '';
        if ($user_id) {
            $user = $this->userModel->find($user_id);
            if ($user) {
                $username = $user['username'];
            }
        }

        $data = [
            'title' => 'Salesman',
            'salesmen' => $salesmen,
            'username' => $username
        ];

        return view('master/salesman', $data);
    }

    public function createSalesman()
    {
        $user_id = session()->get('user_id');

        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID not found in session');
        }

        $data = [
            'user_id' => $user_id,
            'kode' => $this->request->getPost('kode'),
            'nama' => $this->request->getPost('nama'),
            'keterangan' => $this->request->getPost('keterangan'),
            'alamat' => $this->request->getPost('alamat'),
            'kota' => $this->request->getPost('kota'),
            'telp' => $this->request->getPost('telp'),
            'target' => $this->request->getPost('target')
        ];

        if (!$this->m_Salesman->insertSalesman($data)) {
            return redirect()->to('master/salesman')->with('error', 'Gagal Menambahkan Data Salesman');
        }

        return redirect()->to('master/salesman')->with('success', 'Data Salesman Berhasil Ditambahkan');
    }

    public function updateSalesman($id)
    {
        $data = [
            'kode' => $this->request->getPost('kode'),
            'nama' => $this->request->getPost('nama'),
            'keterangan' => $this->request->getPost('keterangan'),
            'alamat' => $this->request->getPost('alamat'),
            'kota' => $this->request->getPost('kota'),
            'telp' => $this->request->getPost('telp'),
            'target' => $this->request->getPost('target'),
            'user_id' => session()->get('user_id')
        ];

        $this->m_Salesman->updateSalesman($id, $data);

        return redirect()->back()->with('success', 'Data Salesman Berhasil Diperbarui');
    }


    public function coa()
    {
        $user_id = session()->get('user_id');
        $coa = $this->m_Coa->findAll();


        $username = '';
        if ($user_id) {
            $user = $this->userModel->find($user_id);
            if ($user) {
                $username = $user['username'];
            }
        }

        $data = [
            'title' => 'Chart Of Account',
            'coa' => $coa,
            'username' => $username
        ];

        return view('master/coa', $data);
    }

    // Method untuk menyimpan data baru Chart Of Account
    public function createCoa()
    {
        $user_id = session()->get('user_id');

        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan di sesi');
        }

        $data = [
            'kode' => strtoupper($this->request->getPost('kode')),
            'nama_account' => strtoupper($this->request->getPost('nama_account')),
            'level' => strtoupper($this->request->getPost('level')),
            'kelompok' => strtoupper($this->request->getPost('kelompok')),
            'posisi' => strtoupper($this->request->getPost('posisi')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'user_id' => strtoupper($user_id),
            'transaksi' => strtoupper($this->request->getPost('transaksi'))
        ];

        if (!$this->m_Coa->insertCoa($data)) {
            return redirect()->to('master/coa')->with('error', 'Gagal Menambahkan Data Chart Of Account');
        }

        return redirect()->to('master/coa')->with('success', 'Data Chart Of Account Berhasil Ditambahkan');
    }
    // Method untuk memperbarui data Chart Of Account
    public function updateCoa($id)
    {
        // $user_id = session()->get('user_id');

        // if (!$user_id) {
        //     return redirect()->to('/')->with('error', 'User ID tidak ditemukan di sesi');
        // }

        $data = [
            'kode' => strtoupper($this->request->getPost('kode')),
            'nama_account' => strtoupper($this->request->getPost('nama_account')),
            'level' => strtoupper($this->request->getPost('level')),
            'kelompok' => strtoupper($this->request->getPost('kelompok')),
            'posisi' => strtoupper($this->request->getPost('posisi')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            // 'user_id' => strtoupper($user_id),
            'transaksi' => strtoupper($this->request->getPost('transaksi')),
            // 'user_id' => $user_id,

        ];

        if (!$this->m_Coa->updateCoa($id, $data)) {
            return redirect()->to('master/coa')->with('error', 'Gagal Memperbarui Data Chart Of Account');
        }

        return redirect()->to('master/coa')->with('success', 'Data Chart Of Account Berhasil Diperbarui');
    }

    // Method untuk menghapus data Chart Of Account
    public function delete($id)
    {
        $this->m_Coa->deleteCoa($id);
        return redirect()->to('master/coa');
    }

    public function supplier()
    {
        $user_id = session()->get('user_id');
        $suppliers = $this->m_Supplier->getSupplierWithUser();

        $username = '';
        if ($user_id) {
            $user = $this->userModel->find($user_id);
            if ($user) {
                $username = $user['username'];
            }
        }

        $data = [
            'title' => 'Supplier',
            'suppliers' => $suppliers,
            'username' => $username
        ];

        return view('master/supplier', $data);
    }

    public function createSupplier()
    {
        $user_id = session()->get('user_id');

        if (!$user_id) {
            return redirect()->to('/')->with('error', 'User ID tidak ditemukan di sesi');
        }

        $data = [
            'user_id' => strtoupper($user_id),
            'kode' => strtoupper($this->request->getPost('kode')),
            'nama' => strtoupper($this->request->getPost('nama')),
            'alamat' => strtoupper($this->request->getPost('alamat')),
            'email' => strtoupper($this->request->getPost('email')),
            'contactperson' => strtoupper($this->request->getPost('contactperson')),
            'telp' => strtoupper($this->request->getPost('telp')),
            'kota' => strtoupper($this->request->getPost('kota')),
            'fax' => strtoupper($this->request->getPost('fax')),
            'hp' => strtoupper($this->request->getPost('hp')),
            'rekening' => strtoupper($this->request->getPost('rekening')),
            'term' => strtoupper($this->request->getPost('term')),
            'npwp' => strtoupper($this->request->getPost('npwp')),
            'status' => strtoupper($this->request->getPost('status')),
            'inisial' => strtoupper($this->request->getPost('inisial')),
            'keterangan' => strtoupper($this->request->getPost('keterangan'))
        ];


        if (!$this->m_Supplier->insertSupplier($data)) {
            return redirect()->to('master/supplier')->with('error', 'Gagal Menambahkan Data Supplier');
        }

        return redirect()->to('master/supplier')->with('success', 'Data Supplier Berhasil Ditambahkan');
    }


    public function updateSupplier($id)
    {
        $data = [
            'kode' => strtoupper($this->request->getPost('kode')),
            'nama' => strtoupper($this->request->getPost('nama')),
            'alamat' => strtoupper($this->request->getPost('alamat')),
            'email' => strtoupper($this->request->getPost('email')),
            'contactperson' => strtoupper($this->request->getPost('contactperson')),
            'telp' => strtoupper($this->request->getPost('telp')),
            'kota' => strtoupper($this->request->getPost('kota')),
            'fax' => strtoupper($this->request->getPost('fax')),
            'hp' => strtoupper($this->request->getPost('hp')),
            'rekening' => strtoupper($this->request->getPost('rekening')),
            'term' => strtoupper($this->request->getPost('term')),
            'npwp' => strtoupper($this->request->getPost('npwp')),
            'status' => strtoupper($this->request->getPost('status')),
            'inisial' => strtoupper($this->request->getPost('inisial')),
            'keterangan' => strtoupper($this->request->getPost('keterangan')),
            'user_id' => session()->get('user_id')
        ];

        $this->m_Supplier->updateSupplier($id, $data);

        return redirect()->back()->with('success', 'Data Supplier Berhasil Diperbarui');
    }


    public function masterbahan()
    {
        $m_Barang_Bahan = new M_Barang_Bahan();
        $kategori = $this->m_Group->getKategori();
        $groups = $this->m_Group->getGroups();
        $data = [
            'title' => 'Bahan',
            'bahan' => $m_Barang_Bahan->findAll(),
            'kategori' => $kategori,
            'groups' => $groups
        ];
        return view('master/masterbahan', $data);
    }

    public function createBahan()
    {
        // Load the models
        $m_Barang_Bahan = new M_Barang_Bahan();
        $m_Gd_Bahan = new M_Gd_Bahan();
        $m_Kartu_Stok = new M_Kartu_Stok();

        $generateid = $m_Kartu_Stok->generateId();
        $kode_group = strtoupper($this->request->getPost('kode_group'));
        $group_parts = explode(' - ', $kode_group);

        $kode_group_id = isset($group_parts[0]) ? $group_parts[0] : '';
        $nama_group = isset($group_parts[1]) ? $group_parts[1] : '';


        $data = [
            'kode_bahan'    => strtoupper($this->request->getPost('kode_bahan')),
            'nama_bahan'    => strtoupper($this->request->getPost('nama_bahan')),
            'kode_kategori' => strtoupper($this->request->getPost('kode_kategori')),
            'kode_group'    => $kode_group_id, // Hanya menyimpan kode_group_id
            'nama_group'    => $nama_group,
            'satuan'        => strtoupper($this->request->getPost('satuan')),
            'stok'          => $this->request->getPost('stok'),
            'harga_beli'    => $this->request->getPost('harga_beli'),
            'harga_jual'    => $this->request->getPost('harga_jual'),
            'stok_minimal'  => $this->request->getPost('stok_minimal'),
            'tanggal'       => $this->request->getPost('tanggal'),
        ];

        // Simpan data ke dalam tabel barang_bahan
        $m_Barang_Bahan->insert($data);

        // Ambil stok yang dimasukkan dari form
        $stok = $this->request->getPost('stok');

        // Menyiapkan data untuk tabel gd_bahan
        $gd_bahan_data = [
            'kode_bahan'    => $data['kode_bahan'],
            'nama_bahan'    => $data['nama_bahan'],
            'stok_awal'     => $stok,  // Menggunakan stok awal dari form
            'stok'          => $stok,
            'gudang'        => 'GUDANG BAHAN',  // Format Gudang
        ];

        // Simpan data ke dalam tabel kartustok
        $m_Gd_Bahan->insert($gd_bahan_data);

        $kartu_data = [
            'nomor'         => $generateid,
            'transaksi'     => 'STOK AWAL',
            'id_kode_barang'    => $data['kode_bahan'],
            'nama_barang'    => $data['nama_bahan'],
            'debit'         => $stok,  // Menggunakan stok awal dari form
            'saldo'         => $stok,
            'gudang'        => 'GUDANG BAHAN',  // Format Gudang
        ];

        // Simpan data ke dalam tabel gd_bahan
        $m_Kartu_Stok->insert($kartu_data);

        // Redirect ke halaman yang diinginkan setelah penyimpanan
        return redirect()->to('master/masterbahan')->with('message', 'Data berhasil ditambahkan');
    }


    public function updateBahan($id_bahan)
    {
        // Load the model
        $m_Barang_Bahan = new M_Barang_Bahan();

        // // Validasi data jika diperlukan
        // if (!$this->validate([
        //     'kode_bahan'    => 'required',
        //     'nama_bahan'    => 'required',
        //     'harga_beli'    => 'required',
        // ])) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }

        $kode_group = strtoupper($this->request->getPost('kode_group'));
        $group_parts = explode(' - ', $kode_group);

        $kode_group_id = isset($group_parts[0]) ? $group_parts[0] : '';
        $nama_group = isset($group_parts[1]) ? $group_parts[1] : '';

        // Mengambil data dari form
        $data = [
            'kode_bahan'    => strtoupper($this->request->getPost('kode_bahan')),
            'nama_bahan'    => strtoupper($this->request->getPost('nama_bahan')),
            'kode_kategori' => strtoupper($this->request->getPost('kode_kategori')),
            'kode_group'    => $kode_group_id, // Hanya menyimpan kode_group_id
            'nama_group'    => $nama_group,
            'satuan'         => strtoupper($this->request->getPost('satuan')),
            'stok'         => $this->request->getPost('stok'),
            'harga_beli'    => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jualawal'),
            'stok_minimal'  => $this->request->getPost('stok_minimal'),
            'tanggal'       => $this->request->getPost('tanggal'),
        ];

        // Update data di tabel barang_bahan berdasarkan ID
        $m_Barang_Bahan->update($id_bahan, $data);

        // Redirect ke halaman yang diinginkan setelah update
        return redirect()->to('master/masterbahan')->with('message', 'Data berhasil diupdate');
    }

    public function deleteBahan($id_bahan)
    {
        // Load the model
        $m_Barang_Bahan = new M_Barang_Bahan();

        // Cek apakah ID bahan yang ingin dihapus ada dalam database
        $bahan = $m_Barang_Bahan->find($id_bahan);
        if (!$bahan) {
            return redirect()->back()->with('error', 'Data bahan tidak ditemukan.');
        }

        // Hapus data bahan berdasarkan ID
        if ($m_Barang_Bahan->delete($id_bahan)) {
            return redirect()->to('master/masterbahan')->with('message', 'Data bahan berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }




    public function mastersparepart()
    {
        $sparepartModel = new M_Barang_Sparepart();
        $kategori = $this->m_Group->getKategori();
        $groups = $this->m_Group->getGroups();
        $totalPart = $sparepartModel->getTotalStok();
        $data = [
            'title' => 'Sparepart',
            'sparepart' => $sparepartModel->orderBy('id_part', 'DESC')->findAll(),
            'kategori' => $kategori,
            'groups' => $groups,
            'totalPart' => $totalPart,


        ];
        return view('master/view_sparepart', $data);
    }


    public function createsparepart()
    {
        // Inisialisasi model
        $sparepartModel = new M_Barang_Sparepart();

        // Ambil input dari form
        $data = [
            'kode_part'      => strtoupper($this->request->getPost('kode_part')),
            'nama_part'      => strtoupper($this->request->getPost('nama_part')),
            'satuan'         => strtoupper($this->request->getPost('satuan')),
            'harga_beliawal' => $this->request->getPost('harga_beliawal'),
            'harga_jualawal'     => $this->request->getPost('harga_jualawal'),
            'stok'           => $this->request->getPost('stok_minimal'),
            'tanggal'        => $this->request->getPost('tanggal'),
        ];

        // Simpan data ke database
        if ($sparepartModel->insert($data)) {
            // Jika berhasil, redirect ke halaman yang diinginkan
            return redirect()->to('master/mastersparepart')->with('success', 'Data sparepart berhasil ditambahkan.');
        } else {
            // Jika gagal, tampilkan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function updatesparepart($id_part)
    {
        // Inisialisasi model
        $sparepartModel = new M_Barang_Sparepart();

        // Ambil input dari form
        $data = [
            'kode_part'      => strtoupper($this->request->getPost('kode_part')),
            'nama_part'      => strtoupper($this->request->getPost('nama_part')),
            'satuan'         => strtoupper($this->request->getPost('satuan')),
            'harga_beliawal' => $this->request->getPost('harga_beliawal'),
            'harga_jualawal' => $this->request->getPost('harga_jualawal'),
            'stok'           => $this->request->getPost('stok_minimal'),
            'tanggal'        => $this->request->getPost('tanggal'),
        ];

        // Update data sparepart berdasarkan ID
        if ($sparepartModel->update($id_part, $data)) {
            // Jika berhasil, redirect ke halaman yang diinginkan
            return redirect()->to('master/mastersparepart')->with('success', 'Data sparepart berhasil diperbarui.');
        } else {
            // Jika gagal, tampilkan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }


    public function deletesparepart($id_part)
    {
        $sparepartModel = new M_Barang_Sparepart();

        if ($sparepartModel->delete($id_part)) {

            return redirect()->to('master/mastersparepart')->with('success', 'Data sparepart berhasil dihapus.');
        } else {

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
