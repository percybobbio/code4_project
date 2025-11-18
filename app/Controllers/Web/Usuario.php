<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;

class Usuario extends BaseController
{
    public function crear_usuario()
    {
        $usuarioModel = new UsuarioModel();

        $usuarioModel->insert(
            [
                'usuario'   => 'admin',
                'email'     => 'admin@gmail.com',
                'contrasena'=> $usuarioModel->contrasenaHash('13245')
            ]
        );
    }

    public function probar_contrasena()
    {
        $usuarioModel = new UsuarioModel();

        echo $usuarioModel->contrasenaVerificar('13245', '$2y$10$Y.dW82nRRKMWtm4KSZyhRuU2X62vNnaBfQ6Aehuv5eqowVfKaAIna');

        $usuario = $usuarioModel->where('usuario', 'admin')->first();

        if($usuarioModel->contrasenaVerificar('13245', $usuario->contrasena)){
            return 'Contraseña correcta';
        }else{
            return 'Contraseña incorrecta';
        }
    }

    public function login(){
        echo view('/web/usuario/login');
    }

    public function login_post(){
        $usuarioModel = new UsuarioModel();

        $email = $this->request->getPost('email');
        $contrasena = $this->request->getPost('contrasena');

        $usuario = $usuarioModel->select('id, usuario, email, contrasena, tipo')
                                ->orWhere('email', $email)
                                ->orWhere('usuario', $email)
                                ->first();
    
        if(!$usuario){
            return redirect()->back()->with('mensaje', 'Usuario y/o contraseña invalida');
        }

        if($usuarioModel->contrasenaVerificar($contrasena, $usuario->contrasena)){
            // Crear la sesión
            unset($usuario->contrasena);
            session()->set('usuario', $usuario);

            return redirect()->to('/dashboard/categoria')->with('mensaje', 'Bienvenid@ ' . $usuario->usuario);
        }

        return redirect()->back()->with('mensaje', 'Usuario y/o contraseña invalida');
    }

    public function register(){
        echo view('/web/usuario/register');
    }

    public function register_post(){
        $usuarioModel = new UsuarioModel();

        if($this->validate('usuarios')){
            $usuarioModel->insert([
                'usuario'   => $this->request->getPost('usuario'),
                'email'     => $this->request->getPost('email'),
                'contrasena'=> $usuarioModel->contrasenaHash($this->request->getPost('contrasena'))
            ]);

            return redirect()->to(route_to('usuario.login'))->with('mensaje', 'Usuario registrado correctamente. Por favor, inicie sesión.');
        }

        session()->setFlashdata(['validation' => $this->validator]);

        return redirect()->back()->withInput();
    }

    function logout(){
        session()->destroy();
        return redirect()->to(route_to('usuario.login'))->with('mensaje', 'Sesión cerrada correctamente');
    }
}