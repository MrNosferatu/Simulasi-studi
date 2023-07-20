<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminLoginModel;

class dashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->get('logged_in')) {
            return redirect()->to('/dashboard/konsentrasi');
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
            return redirect()->to('/dashboard/konsentrasi');
        } else {
            return redirect()->back()->withInput()->with('error', 'Invalid login credentials');
        }
    }
    public function signup()
    {
        $session = session();
        if ($session->get('logged_in')) {
            return redirect()->to('/dashboard/konsentrasi');
        }
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
    function matakuliah()
    {
        $session = session();
        if ($session->get('logged_in')) {
            // $konsentrasiModel = new \App\Models\konsentrasiModel();
            // $data['konsentrasi'] = $konsentrasiModel->findAll();
            // $matakuliahModel = new \App\Models\matakuliahModel();
            // $data['matakuliah'] = $matakuliahModel->findAll();

            $matakuliahModel = new \App\Models\matakuliahModel();
            $data['matakuliah'] = $matakuliahModel->select('matakuliah.*, konsentrasi.nama as nama_konsentrasi')
                ->join('matakuliah_konsentrasi', 'matakuliah_konsentrasi.kode_matakuliah = matakuliah.kode_matakuliah', 'left')
                ->join('konsentrasi', 'konsentrasi.kode_konsentrasi = matakuliah_konsentrasi.kode_konsentrasi', 'left')
                // ->groupBy('matakuliah.kode_matakuliah')
                ->findAll();

            $konsentrasiModel = new \App\Models\konsentrasiModel();
            $data['konsentrasi'] = $konsentrasiModel->findAll();

            $data['title'] = 'Matakuliah';
            return view('admin/perkuliahan/matakuliah', $data);
            return $this->response->setJSON($data);

        } else {
            return redirect()->to('/login');
        }
    }
    function konsentrasi()
    {
        $session = session();
        if ($session->get('logged_in')) {
            $matakuliahModel = new \App\Models\konsentrasiModel();
            $data['konsentrasi'] = $matakuliahModel->findAll();
            $data['title'] = 'Konsentrasi';
            return view('admin/perkuliahan/konsentrasi', $data);
        } else {
            return redirect()->to('/login');
        }
    }
}