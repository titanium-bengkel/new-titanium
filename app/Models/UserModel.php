<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'auth_user';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'username', 'password', 'nama_user', 'alamat', 'kontak', 'email', 'status', 'level', 'foto','id_role'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';


    // protected $validationRules = [
    //     'username' => 'required|min_length[3]|max_length[50]|is_unique[auth_user.username,id,{id}]',
    //     'email'    => 'required|valid_email|is_unique[auth_user.email,id,{id}]',
    //     'password' => 'permit_empty|min_length[6]',
    // ];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function getUserIdByUsername($username)
    {
        $user = $this->where('username', $username)->first();
        return $user ? $user['id'] : false;
    }


    public function getUserData($id)
    {
        return $this->find($id);
    }

    public function updateProfile($id, $data)
    {
        return $this->update($id, $data);
    }
}