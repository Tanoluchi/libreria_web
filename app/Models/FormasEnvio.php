<?php

namespace App\Models;

use CodeIgniter\Model;

class FormasEnvio extends Model
{
    protected $table      = 'formasenvio';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nombre', 'precio', 'activo'];
}