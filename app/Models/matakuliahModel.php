<?php

namespace App\Models;

use CodeIgniter\Model;

class matakuliahModel extends Model
{
    protected $table = 'matakuliah';
    protected $primaryKey = 'kode_matakuliah';
    protected $allowedFields = ['nama', 'sks', 'sifat', 'nilai_minimal', 'semester', 'kode_prodi'];
    protected $returnType = 'array';
}