<?php

namespace App\Controllers;

use App\Models\AlquilerModel;
use App\Models\UsuarioModel;

class Admin extends BaseController
{
    // Muestra el panel principal
    public function panel()
    {
        return view('Admin/dashboard');
    }

    // Carga la pantalla de reservas pendientes
    public function reservasPendientes()
    {
        $alquilerModel = new AlquilerModel();

        $datos['reservas'] = $alquilerModel->obtenerReservasPendientes();

        return view('Admin/reservas_pendientes', $datos);
    }

    // Acción que se ejecuta al presionar el botón "Aprobar"
    public function confirmarReserva($idAlquiler)
    {
        $alquilerModel = new AlquilerModel();
        $alquilerModel->aprobarReserva($idAlquiler);

        // Redirige de vuelta a la pantalla con un mensaje de éxito
        return redirect()->to(base_url('admin/reservas-pendientes'))->with('mensaje', 'Reserva aprobada y activada con éxito.');
    }

    // Carga la pantalla con la vista detallada de la reserva
    public function detalleReserva($idAlquiler)
    {
        $alquilerModel = new AlquilerModel();

        $datos['reserva'] = $alquilerModel->obtenerDetalleReserva($idAlquiler);

        // Si por alguna razón escriben un ID falso en la URL, los devolvemos al panel
        if (!$datos['reserva']) {
            return redirect()->to(base_url('admin/reservas-pendientes'));
        }

        return view('Admin/detalle_reserva', $datos);
    }

    // Acción que se ejecuta al presionar "Rechazar"
    public function rechazarReserva($idAlquiler)
    {
        $alquilerModel = new AlquilerModel();
        $alquilerModel->rechazarReserva($idAlquiler);

        // Redirige de vuelta al listado
        return redirect()->to(base_url('admin/reservas-pendientes'))->with('mensaje', 'Reserva rechazada y cancelada.');
    }

    // Carga la pantalla para registrar devoluciones
    public function devoluciones()
    {
        $alquilerModel = new AlquilerModel();
        $datos['alquileres'] = $alquilerModel->obtenerAlquileresActivos();

        return view('Admin/registrar_devolucion', $datos);
    }

    // Acción que se ejecuta al presionar "Finalizar Alquiler"
    public function confirmarDevolucion($idAlquiler)
    {
        $alquilerModel = new AlquilerModel();

        // Usamos la función que tus compañeras ya habían dejado armada en el modelo
        $alquilerModel->registrarDevolucion($idAlquiler);

        return redirect()->to(base_url('admin/devoluciones'))->with('mensaje', 'Devolución registrada con éxito. El vehículo vuelve a estar disponible en el catálogo.');
    }

    // Carga el reporte de los alquileres que están actualmente activos
    public function reporteActivos()
    {
        $alquilerModel = new AlquilerModel();
        $datos['alquileres'] = $alquilerModel->obtenerVehiculosAlquiladosActualmente();

        return view('Admin/reporte_activos', $datos);
    }

    public function gestionarUsuarios()
    {
        $usuarioModel = new UsuarioModel();
        $usuarios['usuarios'] = $usuarioModel->mostrarUsuariosActivos();

        return view('Admin/gestionar_usuarios', $usuarios);
    }

    public function bajaLogica($id)
    {
        $usuarioModel = new UsuarioModel();

        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            return redirect()->back()->with('mensaje', 'Error: El usuario no existe.');
        }

        $datosActualizar = [
            'activoUsuario' => 0
        ];

        $usuarioModel->update($id, $datosActualizar);

        return redirect()->back()->with('mensaje', '¡Usuario dado de baja con éxito de forma segura!');
    }

    public function editar($id)
    {
        $usuarioModel = new UsuarioModel();

        $data['usuario'] = $usuarioModel->find($id);

        if (!$data['usuario']) {
            return redirect()->to(base_url('admin/usuarios'))->with('mensaje', 'El usuario no existe.');
        }

        return view('admin/editar_usuario', $data);
    }

    public function actualizar($id)
    {
        $usuarioModel = new UsuarioModel();

        $reglas = [
            'nombreUsuario' => 'required|min_length[6]',
            'emailUsuario'  => "required|valid_email|is_unique[usuario.emailUsuario,idUsuario,{$id}]",
            'rolUsuario'    => 'required|in_list[cliente,admin]'
        ];

        $nuevaPassword = $this->request->getPost('passwordUsuario');
        if (!empty($nuevaPassword)) {
            $reglas['passwordUsuario'] = 'min_length[6]';
        }

        $mensajes = [
            'nombreUsuario' => [
                'required'   => 'El nombre y apellido es obligatorio.',
                'min_length' => 'El nombre debe tener al menos 6 caracteres.'
            ],
            'emailUsuario' => [
                'required'    => 'El correo electrónico es obligatorio.',
                'valid_email' => 'Por favor, ingresá un correo electrónico válido.',
                'is_unique'   => 'Este correo electrónico ya está registrado por otro usuario.'
            ],
            'rolUsuario' => [
                'required' => 'Debes seleccionar un rol válido.',
                'in_list'  => 'El rol seleccionado no es válido.'
            ],
            'passwordUsuario' => [
                'min_length' => 'La nueva contraseña debe tener al menos 6 caracteres.'
            ]
        ];

        if (!$this->validate($reglas, $mensajes)) {
            return redirect()->back()->withInput();
        }

        $datosActualizar = [
            'nombreUsuario'   => $this->request->getPost('nombreUsuario'),
            'emailUsuario'    => $this->request->getPost('emailUsuario'),
            'telefonoUsuario' => $this->request->getPost('telefonoUsuario'),
            'rolUsuario'      => $this->request->getPost('rolUsuario'),
        ];

        if (!empty($nuevaPassword)) {
            $datosActualizar['passwordUsuario'] = password_hash($nuevaPassword, PASSWORD_DEFAULT);
        }

        $usuarioModel->update($id, $datosActualizar);

        return redirect()->to(base_url('admin/gestionar-usuarios'))->with('mensaje', '¡Datos del usuario modificados con éxito!');
    }
}
