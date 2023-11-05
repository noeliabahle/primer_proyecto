<?php
namespace App\Controllers;

use App\Models\Producto_model;
Use App\Models\Usuarios_model;
use App\Models\Ventas_cabecera_model;
use App\Models\Ventas_detalle_model;
use App\Models\Categoria_model;
use CodeIgniter\Controller;

class CategoriasController extends Controller {

    public function __construct()
    {
        helper(['url', 'form', 'html']);
        //$db = \Config\Database::connect();
        // En el controlador
        $Categoria_model = new Categoria_model();
        $data['categorias'] = $Categoria_model->orderBy('id', 'DESC')->findAll();
    }

    //mostrar los productos en lista
    public function index()
    {
        
        $Categoria_model = new Categoria_model();
        $data['categorias'] = $Categoria_model->orderBy('id', 'DESC')->findAll();

        $data['titulo'] = 'CRUD Categorías';
        echo view('Front\head_view', $data);
        echo view('Front\nav_view');
        echo view('back\categorias\categorias_view', $data);
        echo view('Front\footer_view');
    }

    public function vistaEditarCategoria($id = null) {

        $data['titulo'] = 'Editar categoría';
        $Categoria_model = new Categoria_model();
        $data['categoria'] = $Categoria_model->where('id', $id)->first();
     

        echo view('front\head_view', $data);
        echo view('front\nav_view');
        echo view('back\categorias\editar_categoria_view', $data);
        echo view('front\footer_view.php');
    }

    public function editarCategoria($id = null) {
        $rules = [
            'descripcion' => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required' => 'A {field} debes colocar una descripción de al menos 3 letras.',
                ],
            ],
        ];
        $Categoria_model = new Categoria_model();

        if ($this->validate($rules)) {
            $data = [
                'descripcion' => $this->request->getVar('descripcion'),
            ];

            $Categoria_model->update($id, $data);
             session()->setFlashdata('success', 'Categoria editada con éxito');
            return $this->response->redirect(site_url('/crud_categorias'));
        } else {

            $data['titulo'] = 'Error en editar categoría';
            
            $data['categoria'] = $Categoria_model->where('id', $id)->first();
        

            echo view('front\head_view', $data);
            echo view('front\nav_view');
            echo view('back\categorias\editar_categoria_view',[
                'validation' => $this->validator,
                'categoria' => $Categoria_model->where('id', $id)->first(),
            ]);
            echo view('front\footer_view.php');
        }
    }

    public function eliminarCategoria($id = null) {
        $Categoria_model = new Categoria_model();
        $data = [
                    'categoria_eliminada' => "SI"
                ];
        $Categoria_model->update($id, $data);
        session()->setFlashdata('success', 'Categoria eliminado con éxito');
        return $this->response->redirect(site_url('/crud_categorias'));
    }
    public function restaurarCategoria($id = null) {
        $Categoria_model = new Categoria_model();
        $data = [
                    'categoria_eliminada' => "NO"
                ];
        $Categoria_model->update($id, $data);
        session()->setFlashdata('success', 'Categoria resaturada con éxito');
        return $this->response->redirect(site_url('/crud_categorias'));
    }
    
    public function crearcategoria() {
        $data['titulo'] = 'Crear categoría';
        echo view('front\head_view', $data);
        echo view('front\nav_view');
        echo view('back\categorias\crear_categoria_view');
        echo view('front\footer_view.php');
    }

    public function alta_categoria() {
        $rules = [
        'descripcion' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Debes proporcionar una descripción.',
                'min_length' => 'La descripción debe tener al menos 3 letras.',
            ],
        ],
    ];

    $Categoria_model = new Categoria_model();

    if ($this->validate($rules)) {
        $data = [
            'descripcion' => $this->request->getVar('descripcion'),
        ];

        $Categoria_model->insert($data);
        session()->setFlashdata('success', 'Categoria creada con éxito');
        return $this->response->redirect(site_url('/crud_categorias'));
    } else {
        $data['titulo'] = 'Error en crear categoría';

        echo view('front\head_view', $data);
        echo view('front\nav_view');
        echo view('back\categorias\crear_categoria_view', [
            'validation' => $this->validator,
        ]);
        echo view('front\footer_view.php');
    }
}



    public function vista_categoria_eliminados() {
        $Categoria_model = new Categoria_model();
        $data['categorias'] = $Categoria_model->orderBy('id', 'DESC')->findAll();

        $data['titulo'] = 'Categorías eliminadas';
        echo view('front\head_view', $data);
        echo view('front\nav_view');
        echo view('back\categorias\categorias_eliminadas_view', $data);
        echo view('front\footer_view.php');
    }

} 