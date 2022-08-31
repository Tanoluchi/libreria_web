<?php

namespace App\Models;

use CodeIgniter\Model;

class Contacto extends Model
{
    protected $table      = 'contacto';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id', 'nombre', 'email', 'mensaje', 'resuelto'];
}