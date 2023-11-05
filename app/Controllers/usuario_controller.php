<?php

namespace App\Controllers;

use App\Models\usuario_model;
use CodeIgniter\Controller;

class Usuario_controller extends Controller {

    public function __construct() {
        helper(['form', 'url']);
    }

    public function create() {
        $data['titulo'] = 'Registro';
        echo view('front/head_view', $data);
        echo view('front/navbar_view');
        echo view('back/usuario/registro');
        echo view('front/footer_view');
    }

    public function formValidation() {
        $input = $this->validate([
            'nombre' => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'usuario' => 'required|min_length[3]',
            'pass' => 'required|min_length[3]|max_length[10]'
        ],   
        [
        'nombre' => ["required" => "Debe ingresar Nombre"],
        'apellido' => ["required" => "Debe ingresar Apellido"],
        'email' => ["required" => "Debe ingresar Correo Electrónico"],
        'usuario' => ["required" => "Debe ingresar Usuario"],
        'pass' => ["required" => "Debe ingresar Contraseña"]
    ]);

        $formModel = new usuario_model();

        if (!$input) {
            $data['titulo'] = 'Crear Usuario';  // Cambio de título
            echo view('front/head_view', $data);
            echo view('front/navbar_view');
            echo view('back/usuario/registro', ['validation' => $this->validator]);
            echo view('front/footer_view');
        } else {
            $formModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'usuario' => $this->request->getVar('usuario'),
                'email' => $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT)
            ]);

            session()->setFlashdata('success', 'Usuario registrado con éxito');
            return redirect()->to('/');
        }
    }

      public function eliminarUsuario($id = null)
{
    $v_usuarioModel = new Usuarios_model();

    // Obtén el ID del usuario logueado desde la sesión
    $usuarioLogueadoId = session()->get('id');

    // Comprueba si el ID del usuario a eliminar es igual al ID del usuario logueado
    if ($id == $usuarioLogueadoId) {
        // Aquí puedes mostrar un mensaje de error o realizar otra acción apropiada
        session()->setFlashdata('success', 'No puedes eliminar tu propio usuario.');
        return redirect()->to(site_url('/crud_usuarios'));
    }

    // Si no es el usuario logueado, procede a realizar la eliminación
    $data = [
        'baja' => "SI"
    ];
    $v_usuarioModel->update($id, $data);
     session()->setFlashdata('success', 'Usuario eliminado con éxito');
    return $this->response->redirect(site_url('/crud_usuarios'));
}

  public function restaurarUsuario($id = null)
  {
    $v_usuarioModel = new Usuarios_model();
    $data = [
      'baja' => "NO"
    ];
    $v_usuarioModel->update($id, $data);
     session()->setFlashdata('success', 'Usuario restaurado con éxito');
    return $this->response->redirect(site_url('/crud_usuarios'));
  }
}