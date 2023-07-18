<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class simulasiController extends BaseController
{
    public function index()
    {
        $fakultasModel = new \App\Models\FakultasModel();
        $data['fakultas'] = $fakultasModel->findAll();
        $data['title'] = 'Simulasi'; 

        return view('simulasi', $data);
    }
    public function getData()
    {
        $kode_fakultas = $this->request->getGet('kode_fakultas');

        // Query the database to get the data
        $prodiModel = new \App\Models\ProdiModel();
        $data = $prodiModel->where('kode_fakultas', $kode_fakultas)->findAll();
        return $this->response->setJSON($data);
    }
    public function getProdi()
    {
        $kode_prodi = $this->request->getGet('kode_prodi');

        // Query the database to get the data
        $prodiModel = new \App\Models\ProdiModel();
        $data = $prodiModel->where('kode_prodi', $kode_prodi)->findAll();
        return $this->response->setJSON($data);
    }
    public function getSemester()
    {
        $kode_prodi = $this->request->getGet('kode_prodi');
    
        // Query the database to get the data
        $db = \Config\Database::connect();
        $builder = $db->table('matakuliah');
        $builder->select('matakuliah.*, konsentrasi.nama as nama_konsentrasi');
        $builder->join('matakuliah_konsentrasi', 'matakuliah_konsentrasi.kode_matakuliah = matakuliah.kode_matakuliah', 'left');
        $builder->join('konsentrasi', 'konsentrasi.kode_konsentrasi = matakuliah_konsentrasi.kode_konsentrasi', 'left');
        $builder->where('matakuliah.kode_prodi', $kode_prodi);
        $data = $builder->get()->getResultArray();
    
        // Perform a right join to get any konsentrasi records that were not joined
        $builder = $db->table('konsentrasi');
        $builder->select('matakuliah.*, konsentrasi.nama as nama_konsentrasi');
        $builder->join('matakuliah_konsentrasi', 'matakuliah_konsentrasi.kode_konsentrasi = konsentrasi.kode_konsentrasi', 'left');
        $builder->join('matakuliah', 'matakuliah.kode_matakuliah = matakuliah_konsentrasi.kode_matakuliah', 'left');
        $builder->where('matakuliah.kode_prodi', $kode_prodi);
        $builder->where('matakuliah_konsentrasi.kode_matakuliah', null, false);
        $extraData = $builder->get()->getResultArray();
    
        // Merge the two result sets
        $data = array_merge($data, $extraData);
    
        return $this->response->setJSON($data);
    }
    public function getKonsentrasi()
    {
        $kode_prodi = $this->request->getGet('kode_prodi');
    
        // Query the database to get the data
        $db = \Config\Database::connect();
        $builder = $db->table('matakuliah');
        $builder->select('matakuliah.*, konsentrasi.nama as nama_konsentrasi');
        $builder->join('matakuliah_konsentrasi', 'matakuliah_konsentrasi.kode_matakuliah = matakuliah.kode_matakuliah', 'left');
        $builder->join('konsentrasi', 'konsentrasi.kode_konsentrasi = matakuliah_konsentrasi.kode_konsentrasi', 'left');
        $builder->where('matakuliah.kode_prodi', $kode_prodi);
        $data = $builder->get()->getResultArray();
    
        // Perform a right join to get any konsentrasi records that were not joined
        $builder = $db->table('konsentrasi');
        $builder->select('matakuliah.*, konsentrasi.nama as nama_konsentrasi, konsentrasi.kode_konsentrasi');
        $builder->join('matakuliah_konsentrasi', 'matakuliah_konsentrasi.kode_konsentrasi = konsentrasi.kode_konsentrasi', 'left');
        $builder->join('matakuliah', 'matakuliah.kode_matakuliah = matakuliah_konsentrasi.kode_matakuliah', 'left');
        $builder->where('matakuliah.kode_prodi', $kode_prodi);
        $builder->where('matakuliah_konsentrasi.kode_matakuliah', null, false);
        $extraData = $builder->get()->getResultArray();
        // Merge the two result sets
        $data = array_merge($data, $extraData);
    
        return $this->response->setJSON($data);
    }
    public function getProdiKonsentrasi()
    {
        $kode_prodi = $this->request->getGet('kode_prodi');

        // Query the database to get the data
        $prodiModel = new \App\Models\konsentrasiModel();
        $data = $prodiModel->where('kode_prodi', $kode_prodi)->findAll();
        return $this->response->setJSON($data);
    }
}