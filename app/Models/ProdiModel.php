<?php

namespace App\Models;

use CodeIgniter\Model;

class prodiModel extends Model
{
    protected $table = 'prodi';
    protected $primaryKey = 'kode_prodi';
    protected $allowedFields = ['nama', 'sks_minimal', 'nilai_d_maksimal', 'kode_fakultas'];
    protected $returnType = 'array';
}