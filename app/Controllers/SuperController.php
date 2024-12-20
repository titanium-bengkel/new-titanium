<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\LevelModel;
use CodeIgniter\Controller;

class SuperController extends Controller
{
    protected $userModel;
    protected $levelModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->levelModel = new LevelModel();
    }

    // Method untuk mengelola pengguna
    public function kelola_user()
    {
        $users = $this->userModel->findAll();
        $levels = $this->levelModel->findAll();

        $data = [
            'title' => 'Kelola User',
            'users' => $users,
            'levels' => $levels
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
        ];

        $this->userModel->insert($data);

        return redirect()->to('kel_user');
    }

    public function updateUser()
    {
        $id = $this->request->getPost('edit_user_id');
        $data = [
            'username' => $this->request->getPost('username'),
            'nama_user' => $this->request->getPost('nama_user'),
            'alamat' => $this->request->getPost('alamat'),
            'kontak' => $this->request->getPost('kontak'),
            'email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status'),
            'level' => $this->request->getPost('level'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/supercontroller/kelola_user');
    }

    public function deleteUser($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/supercontroller/kelola_user');
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
}
