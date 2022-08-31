<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['dni', 'nombre', 'apellido', 'email', 'telefono', 'id_direccion', 'id_rol', 'password', 'activo'];
}