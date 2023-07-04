<?php

namespace App\Models;

use CodeIgniter\Model;

class konsentrasiMatakuliahModel extends Model
{
    protected $table = 'matakuliah_konsentrasi';
    protected $allowedFields = ['kode_matakuliah', 'kode_konsentrasi'];
    protected $returnType = 'array';
}