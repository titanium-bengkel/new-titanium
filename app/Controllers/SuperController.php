<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\LevelModel;
use CodeIgniter\Controller;
use App\Models\M_Role;

class SuperController extends Controller
{
    protected $userModel;
    protected $levelModel;
    protected $roleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->levelModel = new LevelModel();
        $this->roleModel = new M_Role();
    }

    // Method untuk mengelola pengguna
    public function kelola_user()
    {
        $users = $this->userModel->findAll();
        $roles = $this->roleModel->findAll(); 
        foreach ($users as &$user) {
            $role = array_filter($roles, function ($r) use ($user) {
                return $r['id'] == $user['id_role'];
            });
            $user['role_label'] = $role ? reset($role)['label'] : 'Tidak Ada Role';
        }
        $data = [
            'title' => 'Kelola User',
            'users' => $users,
            'roles' => $roles
        ];
        return view('superadmin/kel_user', $data);
    }


    public function createUser()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'nama_user' => $this->request->getPost('nama_user'),
            'alamat' => $this->request->getPost('alamat'),
            'kontak' => $this->request->getPost('kontak'),
            'email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status'),
            'level' => $this->request->getPost('level'),
            'id_role' => $this->request->getPost('id_role'),
        ];
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // dd($data);
        $this->userModel->insert($data);
        return redirect()->to('/supercontroller/kelola_user')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function updateUser()
    {
        $id = $this->request->getPost('edit_user_id');
        $data = [
            'username'  => $this->request->getPost('username'),
            'nama_user' => $this->request->getPost('nama_user'),
            'alamat'    => $this->request->getPost('alamat'),
            'kontak'    => $this->request->getPost('kontak'),
            'email'     => $this->request->getPost('email'),
            'status'    => $this->request->getPost('status'),
            'level'     => $this->request->getPost('level'),
            'id_role'   => $this->request->getPost('id_role'),
        ];
        // dd([
        //     'id' => $id,
        //     'data' => $data
        // ]);
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        $hasilUpdate = $this->userModel->where(['id'=> $id ])->set($data)->update();
        // dd($hasilUpdate);
        if ($hasilUpdate) {
            return redirect()->to('/supercontroller/kelola_user')->with('success', 'Pengguna berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui pengguna.');
        }
    }

    public function deleteUser($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/supercontroller/kelola_user')->with('success', 'Pengguna berhasil dihapus.');
    }



    // Method untuk mengelola level
    public function menu_akses()
    {
        $levels = $this->levelModel->findAll();

        $data = [
            'title' => 'Kelola Level',
            'levels' => $levels
        ];

        return view('menu_akses', $data);
    }


    public function createLevel()
    {
        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'updatedate' => date('Y-m-d H:i:s'),
            'updateby' => $this->request->getPost('updateby'),
            'status' => $this->request->getPost('status'),
        ];

        $this->levelModel->insert($data);

        return redirect()->to('/supercontroller/menu_akses');
    }

    public function updateLevel()
    {
        $id = $this->request->getPost('edit_level_id');
        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'updatedate' => date('Y-m-d H:i:s'),
            'updateby' => $this->request->getPost('updateby'),
            'status' => $this->request->getPost('status'),
        ];

        $this->levelModel->update($id, $data);

        return redirect()->to('/supercontroller/menu_akses');
    }

    // public function deleteLevel($id)
    // {
    //     $this->levelModel->delete($id);
    //     return redirect()->to('/supercontroller/menu_akses');
    // }



    // Method untuk mengelola menu akses
    public function kelola_menu()
    {
        $data = [
            'title' => 'Kelola Menu',
        ];
        return view('superadmin/menu_akses', $data);
    }


    public function pengaturan_role(){
        $role = $this->roleModel->findAll();
        $data = [];
        
        foreach($role as $ind_r => $r){
            $arraykosong = [];
            $feature = json_decode($r["fitur"], true);
            foreach($feature as $ind_rf => $rf){
                array_push($arraykosong, $rf["nama"]);
                
                if (isset($rf["children"])) {
                    foreach ($rf["children"] as $ind_rfc => $rfc) {
                        array_push($arraykosong, $rfc["nama"]);
                        
                        if (isset($rfc["children"])) {
                            foreach ($rfc["children"] as $ind_rfcc => $rfcc) {
                                array_push($arraykosong, $rfcc["nama"]);
                            }
                        }
                    }
                }
            }
            
            $role[$ind_r]['fiturnya'] = $arraykosong;
        }
        
        $data = [
            'title' => 'Pengaturan Role',
            'label' => $role,
        ];
    
        return view('superadmin/pengaturan_role', $data);
    }

    public function update_permissions($roleId)
    {
        $dashboard = $this->request->getVar('dashboard');
        $superadmin = $this->request->getVar('superadmin');
        $kelolauser = $this->request->getVar('kelolauser');
        $kelolamenu = $this->request->getVar('kelolamenu');
        $registeradminonly = $this->request->getVar('registeradminonly');

        // produk
        $produkp = $this->request->getVar('produkp');
        $memberprodukp = $this->request->getVar('memberprodukp');
        $headprodukp = $this->request->getVar('headprodukp');

        // klaim
        $klaim = $this->request->getVar('klaim');
        $estperbaikan = $this->request->getVar('estperbaikan');
        $orderlist_asuransi = $this->request->getVar('orderlist_asuransi');
        $repair_order = $this->request->getVar('repair_order');
        $orderlist_pending = $this->request->getVar('orderlist_pending');
        $kwitansi = $this->request->getVar('kwitansi');
        $bayar_piutang = $this->request->getVar('bayar_piutang');
        $kwitansi_piutang = $this->request->getVar('kwitansi_piutang');
        $mobilmasuk = $this->request->getVar('mobilmasuk');
        $batalmasuk = $this->request->getVar('batalmasuk');
        $batalsuransi = $this->request->getVar('batalsuransi');
        $mobilselesai = $this->request->getVar('mobilselesai');

        // BAHAN
        $bahan = $this->request->getVar('bahan');
        $po_bahan = $this->request->getVar('po_bahan');
        $terima_bahan = $this->request->getVar('terima_bahan');
        $repair_material = $this->request->getVar('repair_material');
        $laporan_mutasi = $this->request->getVar('laporan_mutasi');

        // SPAREPART
        $sparepart = $this->request->getVar('sparepart');
        $permintaan_part = $this->request->getVar('permintaan_part');
        $pesan_part = $this->request->getVar('pesan_part');
        $terima_part = $this->request->getVar('terima_part');
        $minta_part_supp = $this->request->getVar('minta_part_supp');
        $supp_asuransi = $this->request->getVar('supp_asuransi');
        $repair_material_part = $this->request->getVar('repair_material_part');
        $mutasi_gudang_part = $this->request->getVar('mutasi_gudang_part');
        $waiting_part = $this->request->getVar('waiting_part');
        $sparepart_masuk = $this->request->getVar('sparepart_masuk');
        $part_salvage = $this->request->getVar('part_salvage');
        $part_pasang = $this->request->getVar('part_pasang');
        $part_sisa = $this->request->getVar('part_sisa');
        $stok_part = $this->request->getVar('stok_part');

        // KEUANGAN
        $keuangan = $this->request->getVar('keuangan');
        $hutang = $this->request->getVar('hutang');
        $bayar_hutang = $this->request->getVar('bayar_hutang');
        $pembelian = $this->request->getVar('pembelian');
        $kas_bank = $this->request->getVar('kas_bank');
        $kas_kecil = $this->request->getVar('kas_kecil');
        $keluar_kasbesar = $this->request->getVar('keluar_kasbesar');
        $kas_masuk = $this->request->getVar('kas_masuk');
        $kas_keluar = $this->request->getVar('kas_keluar');
        $ro_list = $this->request->getVar('ro_list');
        $material_jasa = $this->request->getVar('material_jasa');

        // REPORT
        $report = $this->request->getVar('report');
        $report_jurnal = $this->request->getVar('report_jurnal');
        $buku_besar = $this->request->getVar('buku_besar');
        $laba_rugi = $this->request->getVar('laba_rugi');
        $neraca = $this->request->getVar('neraca');

        // MONITORING
        $monitoring = $this->request->getVar('monitoring');
        $monitoring_history = $this->request->getVar('monitoring_history');
        $monitoring_jadwal_keluar = $this->request->getVar('monitoring_jadwal_keluar');
        $monitoring_tracking_unit = $this->request->getVar('monitoring_tracking_unit');

        // WEBSITE
        $website = $this->request->getVar('website');
        $video_home = $this->request->getVar('video_home');
        $tentang_kami = $this->request->getVar('tentang_kami');
        $layanan = $this->request->getVar('layanan');
        $gallery = $this->request->getVar('gallery');
        $testimoni_konsumen = $this->request->getVar('testimoni_konsumen');
        
        // ROLE
        $mpengaturan_role = $this->request->getVar('mpengaturan_role');

        // MASTER
        $master = $this->request->getVar('master');
        $asuransi = $this->request->getVar('asuransi');
        $cabang = $this->request->getVar('cabang');
        $coa = $this->request->getVar('coa');
        $car = $this->request->getVar('car');
        $customer = $this->request->getVar('customer');
        $pengerjaan = $this->request->getVar('pengerjaan');
        $masterbahan = $this->request->getVar('masterbahan');
        $mekanik = $this->request->getVar('mekanik');
        $msparepart = $this->request->getVar('msparepart');
        $supplier = $this->request->getVar('supplier');
        $foreman = $this->request->getVar('foreman');
        $mclass = $this->request->getVar('class');
        $merk = $this->request->getVar('merk');
        $model = $this->request->getVar('model');
        $job = $this->request->getVar('job');
        $subblet = $this->request->getVar('subblet');
        $bahanm = $this->request->getVar('bahanm');
        $katergoribarang = $this->request->getVar('kategoribarang');
        $grupbarang = $this->request->getVar('grupbarang');
        $gudang = $this->request->getVar('gudang');
        $jasarm = $this->request->getVar('jasarm');

        

        $features = [];
        if($dashboard) {
            array_push($features, [
                "nama" => "Dashboard",
                "icon" => "bi bi-grid-fill",
                "url" => "/dashboard/index",
            ]);    
        }

        // SUPER ADMIN
        if($superadmin) {
            array_push($features, [
                "nama" => "Super Admin",
                "icon" => "bi bi-stack",
                "children" => []
            ]);
            $index_cur = count($features) -1 ;
            if($kelolauser) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Kelola User',
                    "url" => "/kel_user"
                ]);
            }
            if($kelolamenu) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Kelola Menu',
                    "url" => "/menu_akses"
                ]);
            }
            // if($registeradminonly) {
            //     array_push($features[$index_cur]['children'], [
            //         "nama" => 'Tambah User',
            //         "url" => "/register"
            //     ]);
            // }
        }
        // END SUPER ADMIN

        // PRODUK
        if($produkp) {
            array_push($features, [
                "nama" => "Produksi",
                "icon" => "bi bi-stack",
                "children" => []
            ]);
            $index_cur = count($features) -1 ;
            if($headprodukp) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Head Produksi',
                    "url" => "/produksi/headproduksi"
                ]);
            }
            if($memberprodukp) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Kelola Produksi',
                    "url" => "/produksi/kelolaproduksi"
                ]);
            }
        }
        // END SPRODUK
        
        // KLAIM
        if ($klaim) {
            array_push($features, [
                "nama" => "Klaim",
                "icon" => "bi bi-stack",
                "children" => []
            ]);
            $index_cur = count($features) - 1;
            if ($estperbaikan) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Estimasi Perbaikan',
                    "url" => "/klaim/preorder"
                ]);
            }
            if ($orderlist_asuransi) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Approval Asuransi',
                    "url" => "/orderlist_asuransi"
                ]);
            }
            if ($repair_order) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Work Order',
                    "url" => "/repair_order"
                ]);
            }
            if ($orderlist_pending) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Pending Invoice',
                    "url" => "/orderlist_pending"
                ]);
            }
            if ($kwitansi) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Kwitansi',
                    "url" => "/kwitansi"
                ]);
            }
            if ($bayar_piutang) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Payment',
                    "url" => "/bayar_piutang"
                ]);
            }
            if ($kwitansi_piutang) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Pending Payment',
                    "url" => "/kwitansi_piutang"
                ]);
            }
            if ($mobilmasuk) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Mobil Status',
                    "children" => []
                ]);
                $index_cur_sub = count($features[$index_cur]["children"]) - 1;
                if ($batalmasuk) {
                    array_push($features[$index_cur]['children'][$index_cur_sub]['children'], [
                        "nama" => 'Batal Masuk',
                        "url" => "/klaim/mobil_batal"
                    ]);
                }
                if ($batalsuransi) {
                    array_push($features[$index_cur]['children'][$index_cur_sub]['children'], [
                        "nama" => 'Batal Asuransi',
                        "url" => "/klaim/mobil_batal_asuransi"
                    ]);
                }
                if ($mobilselesai) {
                    array_push($features[$index_cur]['children'][$index_cur_sub]['children'], [
                        "nama" => 'Selesai',
                        "url" => "/klaim/mobil_selesai"
                    ]);
                }
            }
        }
        // END KLAIM

        

        // BAHAN
        if ($bahan) {
            array_push($features, [
                "nama" => "Bahan",
                "icon" => "bi bi-box",
                "children" => []
            ]);
            $index_cur = count($features) - 1;
            if ($po_bahan) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Pemesanan Bahan (PO)',
                    "url" => "/po_bahan"
                ]);
            }
            if ($terima_bahan) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Penerimaan Barang',
                    "url" => "/terima_bahan"
                ]);
            }
            if ($repair_material) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Repair Material',
                    "url" => "/repair_material"
                ]);
            }
            if ($laporan_mutasi) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Laporan Mutasi Gudang Bahan',
                    "url" => "/laporan_mutasi"
                ]);
            }
        }
        // END BAHAN

        // SPAREPART
        if ($sparepart) {
            array_push($features, [
                "nama" => "Sparepart",
                "icon" => "bi bi-wrench",
                "children" => []
            ]);
            $index_cur = count($features) - 1;
            if ($permintaan_part) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Permintaan Sparepart',
                    "url" => "/permintaan_part"
                ]);
            }
            if ($pesan_part) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Pemesanan Sparepart (PO)',
                    "url" => "/pesan_part"
                ]);
            }
            if ($terima_part) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Penerimaan Sparepart',
                    "url" => "/terima_part"
                ]);
            }
            if ($minta_part_supp) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Permintaan Sparepart Supply',
                    "url" => "/minta_part_supp"
                ]);
            }
            if ($supp_asuransi) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Supply Asuransi',
                    "url" => "/supp_asuransi"
                ]);
            }
            if ($repair_material_part) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Repair Material Sparepart',
                    "url" => "/repair_material_part"
                ]);
            }
            if ($mutasi_gudang_part) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Laporan Mutasi Gudang Sparepart',
                    "url" => "/mutasi_gudang_part"
                ]);
            }
            if ($waiting_part) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Sparepart Dalam Pemesanan',
                    "url" => "/waiting_part"
                ]);
            }
            if ($sparepart_masuk) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Sparepart Sudah Diterima',
                    "url" => "/sparepart_masuk"
                ]);
            }
            if ($part_salvage) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Sparepart Salvage',
                    "url" => "/part_salvage"
                ]);
            }
            if ($part_pasang) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Sparepart Terpasang',
                    "url" => "/part_pasang"
                ]);
            }
            if ($part_sisa) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Sparepart Sisa',
                    "url" => "/part_sisa"
                ]);
            }
            if ($stok_part) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Kartu Stok Sparepart',
                    "url" => "/stok_part"
                ]);
            }
        }
        // END SPAREPART

        // MASTER
        if($master) {
            array_push($features, [
                "nama" => "Master",
                "icon" => "bi bi-journal-check",
                "children" => []
            ]);
            $index_cur = count($features) - 1;
            if($katergoribarang) {
                array_push($features[$index_cur]['children'], [
                    "nama" => "Kategori Barang",
                    "url" => "/master/barangkategori"
                ]);
            }
            if($grupbarang) {
                array_push($features[$index_cur]['children'], [
                    "nama" => "Grup Barang",
                    "url" => "/master/baranggroup"
                ]);
            }
            if($msparepart) {
                array_push($features[$index_cur]['children'], [
                    "nama" => "Sparepart",
                    "url" => "/master/mastersparepart"
                ]);
            }
            // if($coa) {
            //     array_push($features[$index_cur]['children'], [
            //         "nama" => "Sparepart",
            //         "url" => "/master/mastersparepart"
            //     ]);
            // }
            if($bahanm) {
                array_push($features[$index_cur]['children'], [
                    "nama" => "Bahan",
                    "url" => "/master/masterbahan"
                ]);
            }
            // if($car) {
            //     array_push($features[$index_cur]['children'], [
            //         "nama" => "Car",
            //         "children" => []
            //     ]);
            //     $index_cur_sub = count($features[$index_cur]["children"]) - 1;
            //     if($mclass) {
            //         array_push($features[$index_cur]['children'][$index_cur_sub]['children'], [
            //             "nama" => "Class",
            //             "url" => "/master/car/class"
            //         ]);
            //     }
            //     if($merk) {
            //         array_push($features[$index_cur]['children'][$index_cur_sub]['children'], [
            //             "nama" => "Merk",
            //             "url" => "/master/car/merk"
            //         ]);
            //     }
            //     if($model) {
            //         array_push($features[$index_cur]['children'][$index_cur_sub]['children'], [
            //             "nama" => "Model",
            //             "url" => "/master/car/model"
            //         ]);
            //     }
            // }
            // if($customer) {
            //     array_push($features[$index_cur]['children'], [
            //         "nama" => "Customer",
            //         "url" => "/master/customer"
            //     ]);
            // }
            if($pengerjaan) {
                array_push($features[$index_cur]['children'], [
                    "nama" => "Pengerjaan",
                    "url" => "/master/pengerjaan"
                ]);
            }
            if($jasarm) {
                array_push($features[$index_cur]['children'], [
                    "nama" => "Jasa RM",
                    "url" => "/master/jasa"
                ]);
            }
            if($asuransi) {
                array_push($features[$index_cur]['children'], [
                    "nama" => "Asuransi",
                    "url" => "/master/asuransi"
                ]);
            }
            // if($pengerjaan) {
            //     array_push($features[$index_cur]['children'], [
            //         "nama" => "Pengerjaan",
            //         "children" => []
            //     ]);
            //     $index_cur_sub = count($features[$index_cur]["children"]) - 1;
            //     if($job) {
            //         array_push($features[$index_cur]['children'][$index_cur_sub]['children'], [
            //             "nama" => "Job",
            //             "url" => "/master/pengerjaan/job"
            //         ]);
            //     }
            //     if($subblet) {
            //         array_push($features[$index_cur]['children'][$index_cur_sub]['children'], [
            //             "nama" => "Subblet",
            //             "url" => "/master/pengerjaan/subblet"
            //         ]);
            //     }
            // }
            if($gudang) {
                array_push($features[$index_cur]['children'], [
                    "nama" => "Gudang",
                    "url" => "/master/gudang"
                ]);
            }
            if($coa) {
                array_push($features[$index_cur]['children'], [
                    "nama" => "Chart of Account",
                    "url" => "/master/coa"
                ]);
            }
            // if($masterbahan) {
            //     array_push($features[$index_cur]['children'], [
            //         "nama" => "Material",
            //         "url" => "/master/material"
            //     ]);
            // }
            // if($mekanik) {
            //     array_push($features[$index_cur]['children'], [
            //         "nama" => "Mekanik",
            //         "url" => "/master/mekanik"
            //     ]);
            // }
            
            if($supplier) {
                array_push($features[$index_cur]['children'], [
                    "nama" => "Supplier",
                    "url" => "/master/supplier"
                ]);
            }
            // if($foreman) {
            //     array_push($features[$index_cur]['children'], [
            //         "nama" => "Foreman",
            //         "url" => "/master/foreman"
            //     ]);
            // }
        }
        // END MASTER

        //KEUANGAN
        if($keuangan) {
            array_push($features, [
                "nama" => "Keuangan",
                "icon" => "bi bi-hexagon-fill",
                "url" => "#",
                "children" => []
            ]);
            $index_cur = count($features) - 1;
    
            if($hutang) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Hutang Per Supplier',
                    "url" => "/hutang"
                ]);
            }
            if($bayar_hutang) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Pembayaran Hutang',
                    "url" => "/bayar_hutang"
                ]);
            }
            if($pembelian) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Pembelian',
                    "url" => "/pembelian"
                ]);
            }
            if($kas_bank) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Kas & Bank',
                    "url" => "/kas_bank"
                ]);
            }
            if($kas_kecil) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Kas Kecil',
                    "url" => "/kas_kecil"
                ]);
            }
            if($keluar_kasbesar) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Pengeluaran Kas Besar',
                    "url" => "/keluar_kasbesar"
                ]);
            }
            if($kas_masuk) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Kas Masuk',
                    "url" => "/kas_masuk"
                ]);
            }
            if($kas_keluar) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Kas Keluar',
                    "url" => "/kas_keluar"
                ]);
            }
            if($ro_list) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Repair Order List',
                    "url" => "/ro_list"
                ]);
            }
            if($material_jasa) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Repair Material Jasa',
                    "url" => "/material_jasa"
                ]);
            }
        }
        // END KEUANGAN

        // REPORT
        if($report) {
            array_push($features, [
                "nama" => "Report",
                "icon" => "bi bi-file-earmark-text",
                "url" => "#",
                "children" => []
            ]);
            $index_cur = count($features) - 1;

            if($report_jurnal) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Report Jurnal',
                    "url" => "/report_jurnal"
                ]);
            }
            if($buku_besar) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'General Ledger (Buku Besar)',
                    "url" => "/buku_besar"
                ]);
            }
            if($laba_rugi) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Income Statment (Laba Rugi)',
                    "url" => "/laba_rugi"
                ]);
            }
            if($neraca) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Balance Sheet (Neraca)',
                    "url" => "/neraca"
                ]);
            }
        }
        // END REPORT

        

        // MONITORING
        if($monitoring) {
            array_push($features, [
                "nama" => "Monitoring",
                "icon" => "bi bi-eye-fill",
                "url" => "#",
                "children" => []
            ]);
            $index_cur = count($features) - 1;

            if($monitoring_history) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Histori Edit',
                    "url" => "/monitoring/history"
                ]);
            }
            if($monitoring_jadwal_keluar) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Jadwal Mobil Keluar',
                    "url" => "/monitoring/jadwal_keluar"
                ]);
            }
            if($monitoring_tracking_unit) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Tracking Unit',
                    "url" => "/monitoring/tracking_unit"
                ]);
            }
        }
        // END MONITORING

        // WEBSITE
        if($website) {
            array_push($features, [
                "nama" => "Website",
                "icon" => "bi bi-globe",
                "url" => "#", 
                "children" => []
            ]);
            $index_cur = count($features) - 1;

            if($video_home) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Video Home',
                    "url" => "/website/video_home"
                ]);
            }
            if($tentang_kami) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Tentang Kami (About Us)',
                    "url" => "/website/tentang_kami"
                ]);
            }
            if($layanan) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Layanan (Service)',
                    "url" => "/website/layanan"
                ]);
            }
            if($gallery) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Gallery',
                    "url" => "/website/gallery"
                ]);
            }
            if($testimoni_konsumen) {
                array_push($features[$index_cur]['children'], [
                    "nama" => 'Testimoni Konsumen',
                    "url" => "/website/testimoni_konsumen"
                ]);
            }
        }
        // END WEBSITE

        

        // PENGATURAN ROLE
        if($mpengaturan_role) {
            array_push($features, [
                "nama" => "Role",
                "icon" => "bi bi-person-lock", 
                "url" => "/pengaturan_role",
            ]);
        }
        // END PENGATURAN ROLE
        
        $this->roleModel->update($roleId, ['fitur' => json_encode($features)]);
        return redirect()->to('/pengaturan_role')->with('message', 'Perubahan Telah di Simpan. Silahkan Logout dan Login kembali');
    }
}