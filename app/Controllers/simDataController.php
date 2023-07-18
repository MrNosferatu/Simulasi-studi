<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class simDataController extends BaseController
{
    public function index()
    {
        $fakultasModel = new \App\Models\FakultasModel();
        $prodiModel = new \App\Models\ProdiModel();
        $matakuliahModel = new \App\Models\matakuliahModel();
        $konsentrasiModel = new \App\Models\KonsentrasiModel();
        $data['fakultas'] = $fakultasModel->findAll();
        $data['prodi'] = $prodiModel->findAll();
        $data['matakuliah'] = $matakuliahModel->findAll();
        $data['konsentrasi'] = $konsentrasiModel->findAll();
        $data['title'] = 'Simulasi';

        return view('admin/data/form', $data);
    }

    public function fakultas_store()
    {
        $data = array(
            'nama' => $this->request->getPost('nama')
        );
        $model = new \App\Models\FakultasModel();
        $model->insert($data);
        $data = $model->findAll();
        return $this->response->setJSON($data);
    }
    public function fakultas_update()
    {
        $id = $this->request->getPost('id');
        $data = array(
            'nama' => $this->request->getPost('nama')
        );
        $model = new \App\Models\FakultasModel();
        $model->update($id, $data);
        $data = $model->findAll();
        return $this->response->setJSON($data);
        // return redirect()->back();
    }

    public function fakultas_delete()
    {
        $id = $this->request->getPost('id');
        $model = new \App\Models\FakultasModel();
        $model->delete($id);
        $data = $model->findAll();
        return $this->response->setJSON($data);
    }
    public function prodi_store()
    {
        $data = array(
            'nama' => $this->request->getPost('nama'),
            'sks_minimal' => $this->request->getPost('sks_minimal'),
            'nilai_d_maksimal' => $this->request->getPost('nilai_d_maksimal'),
            'kode_fakultas' => $this->request->getPost('kode_fakultas')
        );
        $model = new \App\Models\ProdiModel();
        $model->insert($data);
        $data = $model->findAll();
        return $this->response->setJSON($data);
    }
    public function prodi_update()
    {
        $id = $this->request->getPost('id');
        $data = array(
            'nama' => $this->request->getPost('nama'),
            'sks_minimal' => $this->request->getPost('sks_minimal'),
            'nilai_d_maksimal' => $this->request->getPost('nilai_d_maksimal'),
            'ipk_minimal' => $this->request->getPost('ipk_minimal')
        );
        $model = new \App\Models\ProdiModel();
        $model->update($id, $data);
        $data = $model->findAll();
        return $this->response->setJSON($data);
        // return redirect()->back();
    }

    public function prodi_delete()
    {
        $id = $this->request->getPost('id');
        $model = new \App\Models\ProdiModel();
        $model->delete($id);
        $data = $model->findAll();
        return $this->response->setJSON($data);
    }
    public function matakuliah_store()
    {
        $data = array(
            'kode_prodi' => $this->request->getPost('kode_prodi'),
            'nama' => $this->request->getPost('nama'),
            'sks' => $this->request->getPost('sks'),
            'sifat' => $this->request->getPost('sifat'),
            'nilai_minimal' => $this->request->getPost('nilai_minimal'),
            'semester' => $this->request->getPost('semester')
        );
        $model = new \App\Models\matakuliahModel();
        $model->insert($data);
        return $this->response->setJSON($data);    }

    public function matakuliah_update()
    {
        $id = $this->request->getPost('id');
        $data = array(
            'nama' => $this->request->getPost('nama'),
            'sks' => $this->request->getPost('sks'),
            'sifat' => $this->request->getPost('sifat'),
            'nilai_minimal' => $this->request->getPost('nilai_minimal'),
            'semester' => $this->request->getPost('semester')
        );
        $model = new \App\Models\matakuliahModel();
        $model->update($id, $data);
        $data = $model->findAll();
        return $this->response->setJSON($data);
        // return redirect()->back();
    }

    public function matakuliah_delete()
    {
        $id = $this->request->getPost('id');
        $model = new \App\Models\matakuliahModel();
        $model->delete($id);
        $data = $model->findAll();
        return $this->response->setJSON($data);
    }

    public function konsentrasi_store()
    {
        $id = $this->request->getPost('id');
        $data = array(
            'nama' => $this->request->getPost('nama'),
            'sks_minimal' => $this->request->getPost('sks_minimal')
        );
        $model = new \App\Models\KonsentrasiModel();
        $model->insert($data);
        return redirect()->back();
    }

    public function konsentrasi_matakuliah_store()
    {
        $data = array(
            'kode_matakuliah' => $this->request->getPost('kode_matakuliah'),
            'kode_konsentrasi' => $this->request->getPost('kode_konsentrasi')
        );
        $model = new \App\Models\KonsentrasiMatakuliahModel();
        $model->insert($data);
        return redirect()->back();
    }
}