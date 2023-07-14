<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminLoginModel;

class dashboardController extends BaseController
{
    function index()
    {
        $data['title'] = 'Dashboard';
        return view('admin/dashboard', $data);
    }
    function fakultas()
    {
        $fakultasModel = new \App\Models\FakultasModel();
        $data['fakultas'] = $fakultasModel->findAll();
        $data['title'] = 'Fakultas';
        return view('admin/perkuliahan/fakultas', $data);
    }
    function prodi()
    {
        $fakultasModel = new \App\Models\FakultasModel();
        $data['fakultas'] = $fakultasModel->findAll();
        $prodiModel = new \App\Models\ProdiModel();
        $data['prodi'] = $prodiModel->findAll();
        $data['title'] = 'Program Studi';
        return view('admin/perkuliahan/prodi', $data);
    }
    function matakuliah()
    {
        $prodiModel = new \App\Models\ProdiModel();
        $data['prodi'] = $prodiModel->findAll();
        $matakuliahModel = new \App\Models\matakuliahModel();
        $data['matakuliah'] = $matakuliahModel->findAll();
        $data['title'] = 'Matakuliah';
        return view('admin/perkuliahan/matakuliah', $data);
    }
}