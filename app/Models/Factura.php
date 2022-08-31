<?php

namespace App\Models;

use CodeIgniter\Model;

class Factura extends Model
{
    protected $table      = 'facturas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    // protected $useTimestamps = true;
    // protected $createdField = 'fecha';
    protected $allowedFields = ['id_usuario', 'id_envio', 'id_pago', 'importe_total', 'activo'];
}