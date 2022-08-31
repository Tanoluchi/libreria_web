<?php

namespace App\Models;

use CodeIgniter\Model;

class Rol extends Model
{
    protected $table      = 'roles';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id', 'nombre', 'descripcion', 'activo'];

}