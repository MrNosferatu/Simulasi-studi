<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminLoginModel;

class AdminLogin extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        $data['title'] = 'Login'; 
        return view('admin/login', $data);
    }
    public function authentication()
    {
        $model = new AdminLoginModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session = session();
            $session->set('user_id', $user['id']);
            $session->set('logged_in', true);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->withInput()->with('error', 'Invalid login credentials');
        }
    }
    public function signup()
    {
        $data['title'] = 'Signup'; 
        return view('admin/signup', $data);
    }
    public function register()
    {
        $AdminLoginModel = new AdminLoginModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]|max_length[128]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $user = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $AdminLoginModel->insert($user);
        return redirect()->to('/login')->with('success', 'Your account has been created. Please log in.');
    }
}