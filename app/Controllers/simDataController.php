<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class simDataController extends BaseController
{
    public function matakuliah_store()
    {
        $dataMatakuliah = array(
            'nama' => $this->request->getPost('nama'),
            'sks' => $this->request->getPost('sks'),
            'sifat' => $this->request->getPost('sifat'),
            'nilai_minimal' => $this->request->getPost('nilai_minimal'),
            'semester' => $this->request->getPost('semester')
        );
        $modelMatakuliah = new \App\Models\matakuliahModel();
        $modelMatakuliah->insert($dataMatakuliah);

        // Get the ID of the last inserted row
        $kode_matakuliah = $modelMatakuliah->insertID();

        // Insert a new record into the konsentrasi_matakuliah table for each selected checkbox
        if (isset($_POST['konsentrasi'])) {
            $konsentrasi = $_POST['konsentrasi'];
            foreach ($konsentrasi as $kode_konsentrasi) {
                $dataKonsentrasi = array(
                    'kode_matakuliah' => $kode_matakuliah,
                    'kode_konsentrasi' => $kode_konsentrasi
                );
                $model = new \App\Models\konsentrasiMatakuliahModel();
                $model->insert($dataKonsentrasi);
            }
        }
        // $data = $modelMatakuliah->findAll();
        // return $this->response->setJSON($data);
        return redirect()->to('/data/matakuliah/table/update');
    }

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

        // Insert a new record into the konsentrasi_matakuliah table for each selected checkbox
        if ($this->request->getPost('sifat') ==3 ) {
            $konsentrasi = $this->request->getPost('konsentrasi');
            $model = new \App\Models\konsentrasiMatakuliahModel();
            $model->where('kode_matakuliah', $id)->delete();
            foreach ($konsentrasi as $kode_konsentrasi) {
                $dataKonsentrasi = array(
                    'kode_matakuliah' => $id,
                    'kode_konsentrasi' => $kode_konsentrasi
                );
                $model->insert($dataKonsentrasi);
            }
        } else {
            $model = new \App\Models\konsentrasiMatakuliahModel();
            $model->where('kode_matakuliah', $id)->delete();
        }
        // $data = $model->findAll();
        // return $this->response->setJSON($data);
        return redirect()->to('/data/matakuliah/table/update');
    }

    public function matakuliah_delete()
    {
        $id = $this->request->getPost('id');
        $model = new \App\Models\matakuliahModel();
        $model->delete($id);
        // $data = $model->findAll();
        // return $this->response->setJSON($data);
        return redirect()->to('/data/matakuliah/table/update');

    }

    public function konsentrasi_store()
    {
        $id = $this->request->getPost('id');
        $data = array(
            'nama' => $this->request->getPost('nama'),
        );
        $model = new \App\Models\KonsentrasiModel();
        $model->insert($data);
        // return redirect()->back();
        return redirect()->to('/data/matakuliah/table/update');

    }
    public function konsentrasi_update()
    {
        $id = $this->request->getPost('id');
        $data = array(
            'nama' => $this->request->getPost('nama'),
        );
        $model = new \App\Models\KonsentrasiModel();
        $model->update($id, $data);
        $data = $model->findAll();
        // return $this->response->setJSON($data);
        return redirect()->to('/data/matakuliah/table/update');

        // return redirect()->back();
    }
    public function konsentrasi_delete()
    {
        $id = $this->request->getPost('id');
        $model = new \App\Models\KonsentrasiModel();
        $model->delete($id);
        $data = $model->findAll();
        // return $this->response->setJSON($data);
        return redirect()->to('/data/matakuliah/table/update');

    }
    public function konsentrasi_matakuliah_store()
    {
        $data = array(
            'kode_matakuliah' => $this->request->getPost('kode_matakuliah'),
            'kode_konsentrasi' => $this->request->getPost('kode_konsentrasi')
        );
        $model = new \App\Models\KonsentrasiMatakuliahModel();
        $model->insert($data);
        // return redirect()->back();
        return redirect()->to('/data/matakuliah/table/update');

    }
    function table_update_matakuliah()
    {
        $matakuliahModel = new \App\Models\matakuliahModel();
        $data['matakuliah'] = $matakuliahModel->select('matakuliah.*, konsentrasi.nama as nama_konsentrasi')
            ->join('matakuliah_konsentrasi', 'matakuliah_konsentrasi.kode_matakuliah = matakuliah.kode_matakuliah', 'left')
            ->join('konsentrasi', 'konsentrasi.kode_konsentrasi = matakuliah_konsentrasi.kode_konsentrasi', 'left')
            // ->groupBy('matakuliah.kode_matakuliah')
            ->findAll();

        $konsentrasiModel = new \App\Models\konsentrasiModel();
        $data['konsentrasi'] = $konsentrasiModel->findAll();
        return $this->response->setJSON($data);
    }
}