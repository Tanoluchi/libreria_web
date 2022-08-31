<?php

namespace App\Models;

use CodeIgniter\Model;

class Direccion extends Model
{
    protected $table      = 'direcciones';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['calle', 'numero', 'codigoPostal', 'localidad', 'provincia', 'activo'];
}