<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function login_page()
    {
        return view('auth/view_login');
    }

    public function login()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && $password === $user['password']) {
            // Set session, redirect to dashboard
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'isLoggedIn' => true
            ]);

            return redirect()->to('dashboard/index');
        } else {
            // Kembalikan ke halaman login dengan pesan error
            return redirect()->back()->with('error', 'Invalid login credentials');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
    public function profile()
    {
        $session = session();
        $userId = $session->get('user_id');
        $userData = $this->userModel->getUserData($userId);

        $data = [
            'title' => 'Profile',
            'user' => $userData
        ];

        return view('auth/profile', $data);
    }

    public function updateProfile()
    {
        $session = session();
        $userId = $session->get('user_id');

        $data = [
            'nama_user' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'kontak' => $this->request->getPost('telp')
        ];

        // Handle photo upload
        $foto = $this->request->getFile('fotoProfil');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Check if the file is a valid image format
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (in_array($foto->getMimeType(), $allowedTypes)) {
                $fotoName = $foto->getRandomName();
                $foto->move(ROOTPATH . 'public/uploads', $fotoName);
                $data['foto'] = $fotoName;
            } else {
                return redirect()->back()->with('error', 'Invalid image format. Please upload a jpg, jpeg, png, or gif file.');
            }
        }

        $this->userModel->updateProfile($userId, $data);

        return redirect()->to('/profile');
    }
}
