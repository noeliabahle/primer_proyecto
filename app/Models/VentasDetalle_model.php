<?php
namespace App\Models;
use CodeIgniter\Model;

class VentasDetalle_model extends Model
{
	protected $table = 'ventas_detalle';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ventas_id','productos_id', 'cantidad','precio','total'];
}