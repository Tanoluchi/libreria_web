<?php

namespace App\Models;

use CodeIgniter\Model;

class Producto extends Model
{
    protected $table      = 'productos';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_categoria', 'nombre', 'autor', 'descripcion', 'precio', 'stock', 'imagen', 'destacado', 'activo'];
}