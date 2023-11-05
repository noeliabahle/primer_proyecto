<?php
namespace App\Models;
use CodeIgniter\Model;
class Producto_Model extends Model
{
	protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombreProd','imagen', 'categoria_id','precio','precio_venta','stock','stock_min','eliminado'];
    
    public function sacar_del_stock($id, $cantidad_que_saco) {
        $producto = new Producto_model();

        //$producto->find($id)['stock'] - $cantidad_que_saco;
        $aux = $producto->where('id', $id)->first();
        $nuevo_stock = $aux['stock'] - $cantidad_que_saco;
        $data = [

            'stock' => $nuevo_stock,
            
        ];

        $producto->update($id, $data);
        
    }
   }
