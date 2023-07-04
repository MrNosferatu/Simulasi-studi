<?php

namespace App\Models;

use CodeIgniter\Model;

class konsentrasiModel extends Model
{
    protected $table = 'konsentrasi';
    protected $primaryKey = 'kode_konsentrasi';
    protected $allowedFields = ['nama', 'sks_minimal'];
    protected $returnType = 'array';
}