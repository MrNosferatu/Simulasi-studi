<?php

namespace App\Models;

use CodeIgniter\Model;

class FakultasModel extends Model
{
    protected $table = 'fakultas';
    protected $primaryKey = 'kode_fakultas';
    protected $allowedFields = ['nama','kode_fakultas'];
    protected $returnType = 'array';
}