<?php

namespace App\Models;

use CodeIgniter\Model;

class Consulta extends Model
{
    protected $table      = 'consultas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id', 'nombre', 'email', 'mensaje', 'resuelto'];
}