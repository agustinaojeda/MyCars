<?php

namespace App\Controllers;

use App\Models\AlquilerModel;
use App\Models\UsuarioModel;
use App\Models\VehiculoModel;

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
            return redirect()->to(base_url('admin/gestionar-usuarios'))->with('mensaje', 'El usuario no existe.');
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

    public function gestionarVehiculos()
    {
        $vehiculoModel = new VehiculoModel();
        $data['vehiculos'] =  $vehiculoModel->mostrarVehiculosActivos();

        return view('Admin/gestionar_vehiculos', $data);
    }

    public function actualizarVehiculo($id)
    {
        $vehiculoModel = new VehiculoModel();
        $vehiculo = $vehiculoModel->find($id);

        if (!$vehiculo) {
            return redirect()->back()->with('mensaje', 'El vehículo no existe.');
        }

        $reglas = [
            'marcaVehiculo'      => 'required|min_length[2]',
            'modeloVehiculo'     => 'required',
            'anioVehiculo'       => 'required|exact_length[4]|greater_than[1900]',
            'precioAlqVehiculo'  => 'required|numeric|greater_than[0]',
            'kilometrajeVehiculo' => 'required|numeric|greater_than[0]',
            'motorVehiculo'     => 'required'
        ];

        $mensajes = [
            'marcaVehiculo'  => ['required' => 'La marca es obligatoria.', 'min_length' => 'Marca inválida.'],
            'modeloVehiculo' => ['required' => 'El modelo es obligatorio.'],
            'anioVehiculo'   => ['required' => 'El año es obligatorio.', 'exact_length' => 'Debe tener 4 dígitos.','greater_than' => 'El año del vehículo debe ser mayor a 1900.'],
            'precioAlqVehiculo' => ['required' => 'El precio es obligatorio.', 'numeric' => 'Debe ser un número válido.','greater_than' => 'El precio de alquiler debe ser mayor a $0.'],
            'kilometrajeVehiculo' => ['required' => 'El kilometraje es obligatorio.', 'numeric' => 'Debe ser un número válido.','greater_than' => 'El kilometraje debe ser mayor a 0.'],
            'motorVehiculo' => ['required' => 'El tipo de motor es obligatorio.']
        ];

        $file = $this->request->getFile('imagenVehiculo');
        if ($file && $file->isValid()) {
            $reglas['imagenVehiculo'] = 'uploaded[imagenVehiculo]|max_size[imagenVehiculo,2048]|is_image[imagenVehiculo]';
            $mensajes['imagenVehiculo'] = [
                'max_size' => 'La imagen es muy pesada (Máximo 2MB).',
                'is_image' => 'El archivo seleccionado debe ser una imagen válida.'
            ];
        }

        if (!$this->validate($reglas, $mensajes)) {
            return redirect()->back()->withInput();
        }

        $datosActualizar = [
            'marcaVehiculo'       => $this->request->getPost('marcaVehiculo'),
            'modeloVehiculo'      => $this->request->getPost('modeloVehiculo'),
            'categoriaVehiculo'   => $this->request->getPost('categoriaVehiculo'),
            'anioVehiculo'        => $this->request->getPost('anioVehiculo'),
            'motorVehiculo'       => $this->request->getPost('motorVehiculo'),
            'kilometrajeVehiculo' => $this->request->getPost('kilometrajeVehiculo'),
            'precioAlqVehiculo'   => $this->request->getPost('precioAlqVehiculo'),
        ];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $nuevoNombre = $file->getRandomName();
            $file->move(FCPATH . 'assets/images', $nuevoNombre);

            $datosActualizar['imagenVehiculo'] = $nuevoNombre;
        }

        $vehiculoModel->update($id, $datosActualizar);

        return redirect()->to(base_url('admin/gestionar-vehiculos'))->with('mensaje', '¡Vehículo modificado correctamente!');
    }

    public function bajaLogicaVehiculo($id)
    {
        $vehiculoModel = new VehiculoModel();

        $datosBaja = ['activoVehiculo' => 0];

        $vehiculoModel->update($id, $datosBaja);

        return redirect()->to(base_url('admin/gestionar-vehiculos'))->with('mensaje', 'El vehículo fue dado de baja exitosamente.');
    }

    public function editarVehiculo($id)
    {
        $vehiculoModel = new VehiculoModel();

        $data['vehiculo'] = $vehiculoModel->find($id);

        if (!$data['vehiculo']) {
            return redirect()->to(base_url('admin/gestionar-vehiculos'))->with('mensaje', 'El vehículo no existe.');
        }

        return view('admin/editar_vehiculo', $data);
    }

    public function crearVehiculo(){
        return view('admin/crear-vehiculo');
    }
}
