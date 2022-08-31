<?php

namespace App\Models;

use CodeIgniter\Model;

class MetodosPago extends Model
{
    protected $table      = 'metodospago';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nombre', 'activo'];
}