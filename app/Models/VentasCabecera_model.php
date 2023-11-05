<?php
namespace App\Models;
use CodeIgniter\Model;

class VentasCabecera_model extends Model
{
    protected $table = 'ventas_cabecera';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fecha','usuarios_id', 'total_venta'];
}