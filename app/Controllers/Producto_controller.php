<?php

namespace App\Controllers;

use App\Models\Producto_model;
use App\Models\Categoria_model;
use App\Config\Database;

class Producto_controller extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form', 'html']);
    }

    public function index()
    {
        $Producto_model = new Producto_model();

        $data['productos'] = $Producto_model->orderBy('id', 'DESC')->findAll();
        $Categoria_model = new Categoria_model();
        $data['categorias'] = $Categoria_model->orderBy('id', 'DESC')->findAll();

        $data['titulo'] = 'Crud_productos';
        echo view('front\head_view', $data);
        echo view('front\nav_view');
        echo view('back\productos\crud_productos', $data);
        echo view('front\footer_view.php');
    }

    public function vista_productos_eliminados() {
        $Producto_model = new Producto_model();
        $data['productos'] = $Producto_model->orderBy('id', 'DESC')->findAll();
        //$Categoria_model = new Categoria_model();
        //$data['categorias'] = $Categoria_model->orderBy('id_categoria', 'DESC')->findAll();
        $data['titulo'] = 'Productos Eliminados';

        echo view('front\head_view', $data);
        echo view('front\nav_view');
        echo view('back\productos\productoInactivo', $data);
        echo view('front\footer_view.php');
    }

        public function crearproducto()
    {
        $Producto_model = new Producto_model();
        $data['obj'] = $Producto_model->orderBy('id', 'DESC')->findAll();

        $Categoria_model = new Categoria_model();
        $data['categorias'] = $Categoria_model->orderBy('id', 'DESC')->findAll();

        $data['titulo'] = 'Alta producto';
        echo view('front\head_view', $data);
        echo view('front\nav_view');
        echo view('back\productos\productoLista', $data);
        echo view('front\footer_view.php');
    }

    public function vistaEditarProducto($id = null) {

        $Producto_model = new Producto_model();
        
        $data['titulo'] = 'Editar producto';
        $Categoria_model = new Categoria_model();
        
        $data['categorias'] = $Categoria_model->orderBy('id', 'DESC')->findAll();
        //$id= $this->request->getPostGet('id');
        //$data['producto'] = $Producto_model->where('id', $id)->first();
        $data['old'] = $Producto_model->where('id', $id)->first();
        //dd($data['old']['categoria_id ']);
        $data['categoria_producto'] = $Categoria_model->where('id', $data['old']['categoria_id'])->first();
        //dd($data);
        echo view('front\head_view', $data);
        echo view('front\nav_view');
        echo view('back\productos\modificarProd', $data);
        echo view('front\footer_view.php');
    }
    public function eliminarProducto($id = null) {
        $producto = new Producto_model();
        $data = [
                    'eliminado' => "SI"
                ];
        $producto->update($id, $data);
        session()->setFlashdata('success', 'Producto eliminado correctamente');
        return $this->response->redirect(site_url('/crud'));
    }
    public function restaurarProducto($id = null) {
        $producto = new Producto_model();
        $data = [
                    'eliminado' => "NO"
                ];
        $producto->update($id, $data);
       session()->setFlashdata('success', 'Producto habilitado correctamente');
        return $this->response->redirect(site_url('/crud'));
    }

    

  public function alta_producto()
{
    $Categoria_model = new Categoria_model();
    $data['categorias'] = $Categoria_model->orderBy('id', 'DESC')->findAll();

    // Define el título de la página
    $data['titulo'] = 'Título de la Página'; // Reemplaza con el título deseado

    // Validación del formulario
    $input = $this->validate([
        'categoria_id' => 'required',
        'stock' => 'required',
        'nombreProd' => 'required',
        'precio' => 'required',
        'precio_venta' => 'required',
        'stock_min' => 'required',
        'imagen' => 'uploaded[imagen]|mime_in[imagen,image/jpg,image/jpeg,image/png]|max_size[imagen,1024]',
    ],
    [
        'categoria_id' => [
            "required" => "Debe seleccionar una categoría",
            "is_not_unique" => "La categoría seleccionada no es válida",
        ],

        'stock' => [
            "required" => "Debe ingresar cantidad del producto"
        ],
        'nombreProd' => ["required" => "Debe ingresar nombre del producto"],
        'precio' => ["required" => "Debe ingresar precio"],
        'precio_venta' => ["required" => "Debe ingresar precio mínimo"],
        'stock_min' => ["required" => "Debe ingresar cantidad mínima"],
        'imagen' => [
            'uploaded' => 'Debe cargar una imagen.',
            'mime_in' => 'La imagen debe ser de tipo JPG o PNG.',
            'max_size' => 'La imagen no debe superar 1MB en tamaño.',
        ],
    ]);

    if (!$input) {
        echo view('front/head_view', $data);
        echo view('front/nav_view');
        echo view('back/productos/productoLista', [
            'validation' => $this->validator
        ]);
        echo view('front/footer_view');
     } else {
        // Procesar la carga de la imagen
        $img = $this->request->getFile('imagen');

        // Verificar si el archivo es válido y no ha sido movido
        if ($img->isValid() && !$img->hasMoved()) {
            $nombre_aleatorio = $img->getRandomName();
            $img->move(ROOTPATH.'assets/uploads', $nombre_aleatorio);

            // Crear un array de datos para insertar en la base de datos
            $producto_data = [
                'categoria_id' => $this->request->getVar('categoria_id'),
                'stock' => $this->request->getVar('stock'),
                'nombreProd' => $this->request->getVar('nombreProd'),
                'imagen' => $img->getName(),
                'precio' => $this->request->getVar('precio'),
                'precio_venta' => $this->request->getVar('precio_venta'),
                'stock_min' => $this->request->getVar('stock_min'),
                'eliminado' => 'NO',
            ];
            // Insertar los datos del producto en la base de datos
            $producto = new Producto_Model();
            $producto->insert($producto_data);

            session()->setFlashdata('success', 'Producto creado correctamente');
            return $this->response->redirect(site_url('/crud'));
       } else {
        $data['error'] = 'Error al cargar la imagen. Asegúrese de seleccionar un archivo válido.';
        echo view('front/head_view', $data);
        echo view('front/nav_view');
        echo view('back/productos/productoLista', [
            'validation' => $this->validator
        ]);
        echo view('front/footer_view');
    }

   }
}


    
    public function editarProducto($id = null)
{
    $producto = new Producto_model();
    $prod_item = $producto->find($id);
    $old_img_name = $prod_item['imagen'];

    $file = $this->request->getFile('imagen');

    if ($file->isValid() && !$file->hasMoved()) {
        if (file_exists(ROOTPATH.'assets\uploads' . $old_img_name)) {
            unlink("assets/uploads/" . $old_img_name);
        }
        $imageName = $file->getRandomName();
        $file->move(ROOTPATH.'assets\uploads', $imageName);
    } else {
        $imageName = $old_img_name;
    }

    $data = [
        'categoria_id' => $this->request->getPost('categoria_id'),
        'stock' => $this->request->getPost('stock'),
        'nombreProd' => $this->request->getPost('nombreProd'),
        'imagen' => $imageName,
        'precio' => $this->request->getPost('precio'),
        'precio_venta' => $this->request->getPost('precio_venta'),
    ];

    $producto->update($id, $data);


    session()->setFlashdata('success', 'Producto modificado correctamente');

    return redirect()->to(site_url('/crud'));
}
}

   


    

    
