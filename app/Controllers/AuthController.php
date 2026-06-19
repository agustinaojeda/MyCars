<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class AuthController extends BaseController
{
    protected $usuarioModel;
    protected $helpers = ['form'];

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

        $email = $this->request->getPost('emailUsuario');
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

    public function registro()
    {
        return view('registro');
    }

    public function verificarRegistro()
    {
        $reglas = [
            'nombre' => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'El nombre y apellido es obligatorio.',
                    'min_length' => 'El nombre debe tener al menos 6 caracteres.'
                ]
            ],
            'direccion' => [
                'rules'  => 'required|min_length[10]',
                'errors' => [
                    'required'   => 'La dirección es obligatoria.',
                    'min_length' => 'La dirección debe tener al menos 10 caracteres.'
                ]
            ],
            'telefono' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'El teléfono es obligatorio.'
                ]
            ],
            'emailUsuario' => [
                'rules'  => 'required|valid_email|is_unique[usuario.emailUsuario]|min_length[10]',
                'errors' => [
                    'required'    => 'El correo electrónico es obligatorio.',
                    'valid_email' => 'Por favor, ingresa un correo válido.',
                    'is_unique'   => 'Este correo electrónico ya se encuentra registrado.',
                    'min_length'  => 'El correo electrónico es demasiado corto.'
                ]
            ],
            'passwordUsuario' => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'La contraseña es obligatoria.',
                    'min_length' => 'La contraseña debe tener al menos 6 caracteres.'
                ]
            ]
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput();
        }

        $datosUsuario = [
            'nombreUsuario'   => $this->request->getPost('nombre'),
            'direccionUsuario' => $this->request->getPost('direccion'),
            'telefonoUsuario' => $this->request->getPost('telefono'),
            'emailUsuario'    => $this->request->getPost('emailUsuario'),
            'passwordUsuario' => $this->request->getPost('passwordUsuario'),
            'activoUsuario' => 1,
        ];

        $this->usuarioModel->registrarUsuario($datosUsuario);

        return redirect()->to(base_url('/login'))->with('mensaje', '¡Cuenta creada con éxito! Ya puedes iniciar sesión.');
    }

    private function redireccionarSegunRol($rol)
    {
        if ($rol == 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->to(base_url('vehiculos'));
    }
}
