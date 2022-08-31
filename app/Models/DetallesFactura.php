<?php

namespace App\Models;

use CodeIgniter\Model;

class DetallesFactura extends Model
{
    protected $table      = 'detallesfactura';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_factura', 'id_producto', 'cantidad', 'subtotal', 'activo'];
}