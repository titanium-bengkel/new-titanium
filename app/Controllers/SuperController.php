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
}