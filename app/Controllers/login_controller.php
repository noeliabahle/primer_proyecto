<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\usuario_model;

class Login_controller extends BaseController
{
    public function index()
    {
        helper(['form','url']);
      
        $dato['titulo'] = 'login';
        echo view('front/head_view', $dato);
        echo view('front/navbar_view');
        echo view('back/usuario/login');
        echo view('front/footer_view');
    }

    public function auth()
    {
        $session = session();
        $model = new usuario_model();
        
        // Traemos los datos del formulario
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('pass');

        // Validación para asegurarse de que ambos campos estén completos
        if (empty($email) || empty($password)) {
            session()->setFlashdata('success', 'Debes ingresar correo y contraseña');
            return redirect()->to('/login');
        }

        $data = $model->where('email', $email)->first();
        if ($data) {
            $pass = $data['pass'];
            $ba = $data['baja'];
            
            if ($ba == 'SI') {
                $session->setFlashdata('success', 'Usuario dado de baja');
                return redirect()->to('/login');
            }

            // Se verifican los datos ingresados para iniciar sesión, si cumple la verificación inicia la sesión
            $verify_pass = password_verify($password, $pass);

            if ($verify_pass) {
                $ses_data = [
                    'id_usuario' => $data['id_usuario'],
                    'nombre' => $data['nombre'],
                    'apellido' => $data['apellido'],
                    'email' => $data['email'],
                    'usuario' => $data['usuario'],
                    'perfil_id' => $data['perfil_id'],
                    'logged_in'  => TRUE
                ];

                // Se se cumple la verificación inicia la sesión
                $session->set($ses_data);

                session()->setFlashdata('success', 'Bienvenido!');
                return redirect()->to('/');
            } else {
                // No pasó la validación de la contraseña
                $session->setFlashdata('success', 'Contraseña Incorrecta');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('success', 'No Existe el Email o es Incorrecto');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
