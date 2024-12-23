<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\M_Role;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $userModel;
    protected $roleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new M_Role();
    }
    public function login_page()
    {
        return view('auth/view_login');
    }

    public function login()
    {
        $userModel = new UserModel();
        $roleModel = new M_Role();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();
        
        if ($user && password_verify($password, $user['password'])) {
            if (empty($user['foto'])) {
                $userModel->update($user['id'], ['foto' => 'default.jpg']);
                $user['foto'] = 'default.jpg';
            }        
            $role = $this->roleModel->where('id', $user['id_role'])->first();
            session()->set([
                'user_id'     => $user['id'],
                'username'    => $user['username'],
                'role'        => $user['role'], 
                'role_label'  => $role['label'],
                'foto' => $user['foto'] ?: 'default.jpg',
                'fitur_role'  => json_decode($role['fitur'], true), 
                'isLoggedIn'  => true
            ]);
            return redirect()->to('/index')->with('success', 'Login berhasil!');
        } else {
            return redirect()->back()->with('error', 'Username atau password salah!');
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
        $data = [];
        $user = $this->userModel->find($userId);

        if ($this->request->getPost('nama') && $this->request->getPost('nama') != $user['nama_user']) {
            $data['nama_user'] = $this->request->getPost('nama');
        }
        if ($this->request->getPost('alamat') && $this->request->getPost('alamat') != $user['alamat']) {
            $data['alamat'] = $this->request->getPost('alamat');
        }
        if ($this->request->getPost('email') && $this->request->getPost('email') != $user['email']) {
            $data['email'] = $this->request->getPost('email');
        }
        if ($this->request->getPost('telp') && $this->request->getPost('telp') != $user['kontak']) {
            $data['kontak'] = $this->request->getPost('telp');
        }
        $foto = $this->request->getFile('fotoProfil');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $uploadPath = ROOTPATH . 'public/uploads/profile/';
            if ($foto->move($uploadPath, $newName)) {
                if ($user['foto'] && $user['foto'] != 'default.jpg') {
                    $oldFotoPath = $uploadPath . $user['foto'];
                    if (is_file($oldFotoPath)) {
                        unlink($oldFotoPath); 
                    }
                }
                $data['foto'] = $newName;
                $session->set('foto', $newName);
            } else {
                log_message('error', 'Gagal memindahkan file foto.');
                return redirect()->back()->with('error', 'Gagal mengupload foto profil.');
            }
        }
        $validationRules = [
            'nama' => 'permit_empty|string|max_length[100]', 
            'alamat' => 'permit_empty|string|max_length[255]', 
            'telp' => 'permit_empty|string|max_length[15]',
            'email' => 'permit_empty|valid_email',
        ];
        if (isset($data['email']) && $data['email'] != $user['email']) {
            $validationRules['email'] .= '|is_unique[users.email]'; 
        }
        if (!$this->validate($validationRules)) {
            log_message('error', 'Validasi gagal: ' . json_encode($this->validator->getErrors()));
            return redirect()->back()->with('error', 'Validasi gagal: ' . implode(', ', $this->validator->getErrors()));
        }
        if (!empty($data)) {
            if ($this->userModel->update($userId, $data)) {
                log_message('info', 'Profil berhasil diperbarui.');
                $session->setFlashdata('success', 'Profil berhasil diperbarui.');
                return redirect()->to('/profile');
            } else {
                log_message('error', 'Gagal memperbarui profil: ' . json_encode($this->userModel->errors()));
                return redirect()->back()->with('error', 'Gagal memperbarui profil.');
            }
        }
        return redirect()->to('/profile')->with('info', 'Tidak ada perubahan yang dilakukan.');
    }

    public function register()
    {
        return view('auth/register');
    }
    public function registerSubmit()
    {
        $db = \Config\Database::connect();
        $db->query('SET SESSION query_cache_type = OFF');
        $validation = \Config\Services::validation();
        $rules = [
            'username' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[auth_user.username]',
                'errors' => [
                    'is_unique' => 'Username sudah digunakan. Silakan pilih username lain.',
                    'required'  => 'Username wajib diisi.',
                    'min_length' => 'Username minimal 3 karakter.',
                    'max_length' => 'Username maksimal 50 karakter.'
                ],
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[auth_user.email]',
                'errors' => [
                    'is_unique'    => 'Email sudah terdaftar. Silakan gunakan email lain.',
                    'valid_email'  => 'Harap masukkan email yang valid.',
                    'required'     => 'Email wajib diisi.'
                ],
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Password wajib diisi.',
                    'min_length' => 'Password minimal 6 karakter.'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/register')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'email'     => trim(strtolower($this->request->getPost('email'))),
            'nama_user' => $this->request->getPost('nama_user'),
            'alamat'    => $this->request->getPost('alamat'),
            'kontak'    => $this->request->getPost('kontak'),
            'status'    => 'aktif',
            'role'      => 'admin',
            'role_label'=> 4, 
            'foto'      => 'default.jpg',
        ];

        if ($this->userModel->insert($data)) {
            return redirect()->to('/')->with('success', 'Akun berhasil dibuat! Silakan login.');
        } else {
            return redirect()->to('/register')->with('error', 'Gagal menyimpan data, coba lagi.');
        }
    }

    public function forgotPassword()
    {
        $data = [
            'title' => 'TITANIUM'
        ];
        return view('auth/forgot_password',$data);
    }
    public function forgotPasswordSubmit()
    {
        $email = $this->request->getPost('email');
        $user = $this->userModel->where('email', $email)->first();

        if ($user) {
            $token = bin2hex(random_bytes(50));
            $resetModel = new \App\Models\PasswordResetModel();
            $resetModel->insert([
                'email' => $email,
                'token' => $token,
            ]);
            $resetLink = base_url('resetPassword?token=' . $token);
            $this->sendResetPasswordEmail($email, $resetLink);

            return redirect()->to('/forgot-password')->with('success', 'Link reset password telah dikirim ke email Anda.');
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }
    }
    private function sendResetPasswordEmail($email, $resetLink)
    {
        $emailService = \Config\Services::email();
        $emailService->setFrom('adityaanugrah494@gmail.com', 'TITANIUM NI BOSS ');
        $emailService->setTo($email);
        $emailService->setSubject('Reset Password');
        $emailService->setMessage("
            <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: auto; border: 1px solid #ddd; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);'>
                <div style='background-color: #007bff; color: #fff; padding: 20px; text-align: center;'>
                    <h2 style='margin: 0; font-size: 24px;'>Reset Password</h2>
                </div>
                <div style='padding: 20px;'>
                    <p>Halo, </p>
                    <p>Anda telah meminta untuk mereset password akun Anda. Jika ini benar, klik link berikut untuk melanjutkan proses reset password:</p>
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='$resetLink' style='background-color: #007bff; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;'>Reset Password</a>
                    </p>
                    <p>Atau, Anda dapat menyalin dan menempelkan link berikut di browser Anda:</p>
                    <p style='word-wrap: break-word; background-color: #f9f9f9; padding: 10px; border: 1px solid #ddd; border-radius: 5px;'>$resetLink</p>
                    <p>Jika Anda tidak merasa meminta reset password, abaikan email ini. Akun Anda tetap aman.</p>
                    <p>Salam,</p>
                    <p><strong>Tim TITANIUM</strong></p>
                </div>
                <div style='background-color: #f1f1f1; text-align: center; padding: 10px; font-size: 12px; color: #666;'>
                    <p>Copyright © " . date('Y') . " TITANIUM. All rights reserved.</p>
                </div>
            </div>
        "); 
        if (!$emailService->send()) {
            log_message('error', $emailService->printDebugger(['headers', 'subject', 'body']));
            return false;
        }
        return true;
    }

    public function resetPassword()
    {
        $token = $this->request->getGet('token');
        $resetModel = new \App\Models\PasswordResetModel();
        $resetData = $resetModel->where('token', $token)->first();

        if ($resetData) {
            return view('auth/reset_password', ['token' => $token]);
        } else {
            return redirect()->to('/forgot-password')->with('error', 'Token tidak valid.');
        }
    } 


    public function resetPasswordSubmit()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        $resetModel = new \App\Models\PasswordResetModel();
        $resetData = $resetModel->where('token', $token)->first();

        if ($resetData) {
            // Update password di tabel auth_user
            $this->userModel->where('email', $resetData['email'])->set([
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ])->update();

            // Hapus token setelah password berhasil di-reset
            $resetModel->where('email', $resetData['email'])->delete();

            return redirect()->to('/')->with('success', 'Password berhasil diubah. Silakan login.');
        } else {
            return redirect()->to('/forgot-password')->with('error', 'Token tidak valid.');
        }
    }
}