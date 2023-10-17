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
}