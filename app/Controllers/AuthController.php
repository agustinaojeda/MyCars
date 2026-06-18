<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class AuthController extends BaseController
{
    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    public function login()
    {
        if (session()->has('isLoggedIn')) {
            return $this->redireccionarSegunRol(session()->get('rolUsuario'));
        }

        return view('login');
    }

    public function verificar()
    {

        $email    = $this->request->getPost('emailUsuario');
        $password = $this->request->getPost('passwordUsuario');

        $usuario = $this->usuarioModel->verificarLogin($email, $password);

        if ($usuario) {
            $sessionData = [
                'idUsuario'    => $usuario['idUsuario'],
                'nombreUsuario' => $usuario['nombreUsuario'],
                'emailUsuario' => $usuario['emailUsuario'],
                'rolUsuario'   => $usuario['rolUsuario'],
                'isLoggedIn'   => true
            ];

            session()->set($sessionData);

            return $this->redireccionarSegunRol($usuario['rolUsuario']);
        } else {
            return redirect()->back()->with('error', 'El email o la contraseña son incorrectos.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    private function redireccionarSegunRol($rol)
    {
        if ($rol == 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->to(base_url('vehiculos'));
    }
}
