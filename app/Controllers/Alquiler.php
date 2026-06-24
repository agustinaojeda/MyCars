<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlquilerModel;
use App\Models\VehiculoModel;

class Alquiler extends BaseController
{
    protected $alquilerModel;
    protected $vehiculoModel;

    public function __construct()
    {
        $this->alquilerModel = new AlquilerModel();
        $this->vehiculoModel = new VehiculoModel();
    }

    public function nuevo($idVehiculo)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')
                ->with('error', 'Debe iniciar sesión para reservar un vehículo.');
        }

        $vehiculo = $this->vehiculoModel->find($idVehiculo);

        if (!$vehiculo) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('reserva', [
            'vehiculo' => $vehiculo
        ]);
    }

    public function guardar()
{
    $rules = [
    'idVehiculo' => [
        'rules' => 'required|integer',
        'errors' => [
            'required' => 'El vehículo es obligatorio.',
            'integer'  => 'El vehículo no es válido.'
        ]
    ],

    'fechaDesde' => [
        'rules' => 'required',
        'errors' => [
            'required' => 'Debe seleccionar una fecha.'
        ]
    ],

    'cantDias' => [
        'rules' => 'required|integer|greater_than[0]',
        'errors' => [
            'required' => 'Debe ingresar la cantidad de días.',
            'integer'  => 'Debe ser un número.',
            'greater_than' => 'Debe ser mayor a 0.'
        ]
    ],

    'nombreConductor' => [
        'rules' => 'required|min_length[3]|max_length[100]|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
        'errors' => [
            'required' => 'El nombre es obligatorio.',
            'min_length' => 'Debe tener al menos 3 caracteres.',
            'max_length' => 'No puede superar 100 caracteres.',
            'regex_match' => 'Solo se permiten letras.'
        ]
    ],

    'formaPago' => [
        'rules' => 'required',
        'errors' => [
            'required' => 'Debe seleccionar una forma de pago.'
        ]
    ]
];
    if (!$this->validate($rules)) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }
    $vehiculo = $this->vehiculoModel->find(
        $this->request->getPost('idVehiculo')
    );
     if (!$vehiculo) {
        return redirect()->back()
            ->with('error', 'Vehículo no encontrado.');
    }

    if ($this->request->getPost('fechaDesde') < date('Y-m-d')) {
        return redirect()->back()
            ->withInput()
            ->with('errors', [
                'fechaDesde' => 'La fecha no puede ser anterior a hoy.'
            ]);
    }

    $fechaDesde = $this->request->getPost('fechaDesde');
    $cantDias   = $this->request->getPost('cantDias');

    $fechaHasta = date(
        'Y-m-d',
        strtotime($fechaDesde . ' + ' . $cantDias . ' days')
    );

    $cruce = $this->alquilerModel->obtenerCruceFechas(
    $vehiculo['idVehiculo'],
    $fechaDesde,
    $fechaHasta
);

    if ($cruce)
    {
        return redirect()->back()
            ->withInput()
            ->with(
                'error',
                'El vehículo ya está reservado desde '
                . date('d/m/Y', strtotime($cruce['fechaDesdeAlquiler']))
                . ' hasta '
                . date('d/m/Y', strtotime($cruce['fechaHastaAlquiler']))
            );
    }

    $datos = [
        'idClienteAlquiler'  => session()->get('idUsuario'),
        'idVehiculoAlquiler' => $this->request->getPost('idVehiculo'),
        'fechaDesdeAlquiler' => $this->request->getPost('fechaDesde'),
        'cantDiasAlquiler'   => $this->request->getPost('cantDias'),
        'nombreConductor'    => $this->request->getPost('nombreConductor'),
        'formaPago'          => $this->request->getPost('formaPago')
    ];

    $resultado = $this->alquilerModel->registrarAlquiler($datos);

    if ($resultado) {
    return redirect()->to('categoria/' . strtolower($vehiculo['categoriaVehiculo']))
        ->with(
            'mensaje',
            'La reserva fue enviada correctamente. Quedará pendiente hasta que sea aprobada por un administrador.'
        );
}
    
    return redirect()->back()
        ->with('error', 'No se pudo registrar la reserva.');
}
public function misReservas()
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login');
    }

    $datos['reservas'] = $this->alquilerModel
                              ->obtenerReservasCliente(session()->get('idUsuario'));

    return view('mis_reservas', $datos);
}
}
