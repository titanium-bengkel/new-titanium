<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class UserController extends Controller
{
    public function viewuser()
    {
        $data = [
            'title' => 'Welcome',
        ];
        // Load the user view with any data you need to pass
        return view('/user/user_view', $data);
    }
}