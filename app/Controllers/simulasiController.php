<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class simulasiController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Simulasi Rencana Studi';

        return view('index', $data);
    }
    public function simulasi()
    {
        $matakuliahModel = new \App\Models\matakuliahModel();
        $data['fakultas'] = $matakuliahModel->findAll();
        $data['title'] = 'Simulasi';

        return view('simulasi', $data);
    }
    public function getSemester()
    {
       // Query the database to get the data
       $matakuliahModel = new \App\Models\matakuliahModel();
       $matakuliahData = $matakuliahModel->join('matakuliah_konsentrasi', 'matakuliah.kode_matakuliah = matakuliah_konsentrasi.kode_matakuliah', 'left')->findAll();
       
       $konsentrasiModel = new \App\Models\konsentrasiModel();
       $konsentrasiData = $konsentrasiModel->join('matakuliah_konsentrasi', 'konsentrasi.kode_konsentrasi = matakuliah_konsentrasi.kode_konsentrasi', 'left')->findAll();
   
       // Merge the data from the two queries
       $data = array_merge($matakuliahData, $konsentrasiData);
   
       return $this->response->setJSON($data);   
    }
    public function getKonsentrasi()
    {
       // Query the database to get the data
       $konsentrasiModel = new \App\Models\konsentrasiModel();
       $data = $konsentrasiModel->findAll();
       return $this->response->setJSON($data);
    }
}