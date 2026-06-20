<?php

namespace App\Models;

use CodeIgniter\Model;

class AlquilerModel extends Model
{
    protected $table            = 'alquileres';
    protected $primaryKey       = 'idAlquiler';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idClienteAlquiler','idVehiculoAlquiler','fechaDesdeAlquiler','cantDiasAlquiler','fechaHastaAlquiler','estadoAlquiler', 'nombreConductor',
    'formaPago'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;

    public function registrarAlquiler(array $datos)
    {
        $datos['estadoAlquiler'] = 'activo';

        $fechaDesde = new \DateTime($datos['fechaDesdeAlquiler']);
        $fechaDesde->modify('+' . $datos['cantDiasAlquiler'] . ' days');
        $datos['fechaHastaAlquiler'] = $fechaDesde->format('Y-m-d');

        $this->db->transStart();

        $this->insert($datos);

        $this->db->table('vehiculo')
                 ->where('idVehiculo', $datos['idVehiculoAlquiler'])
                 ->update(['disponibleVehiculo' => 0]);

        $this->db->transComplete();

        return $this->db->transStatus();
    }

    public function registrarDevolucion($idAlquiler)
    {
        $alquiler = $this->find($idAlquiler);
        if (!$alquiler) return false;

        $this->db->transStart();

        $this->update($idAlquiler, ['estadoAlquiler' => 'finalizado']);

        $this->db->table('vehiculo')
                 ->where('idVehiculo', $alquiler['idVehiculoAlquiler'])
                 ->update(['disponibleVehiculo' => 1]);

        $this->db->transComplete();

        return $this->db->transStatus();
    }

    public function obtenerClientesPorVehiculo($idVehiculo)
    {
        return $this->select('usuario.nombreUsuario, usuario.emailUsuario, usuario.telefonoUsuario, alquileres.fechaDesdeAlquiler, alquileres.cantDiasAlquiler, alquileres.estadoAlquiler')
                    ->join('usuario', 'alquileres.idClienteAlquiler = usuario.idUsuario')
                    ->where('alquileres.idVehiculoAlquiler', $idVehiculo)
                    ->findAll();
    }

    public function obtenerVehiculosPorCliente($idCliente)
    {
        return $this->select('vehiculo.marcaVehiculo, vehiculo.modeloVehiculo, vehiculo.categoriaVehiculo, alquileres.fechaDesdeAlquiler, alquileres.cantDiasAlquiler, alquileres.estadoAlquiler')
                    ->join('vehiculo', 'alquileres.idVehiculoAlquiler = vehiculo.idVehiculo')
                    ->where('alquileres.idClienteAlquiler', $idCliente)
                    ->findAll();
    }

    public function obtenerVehiculosAlquiladosActualmente()
    {
        return $this->select('alquileres.idAlquiler, vehiculo.marcaVehiculo, vehiculo.modeloVehiculo, vehiculo.precioAlqVehiculo, usuario.nombreUsuario, usuario.telefonoUsuario, alquileres.fechaDesdeAlquiler, alquileres.fechaHastaAlquiler')
                    ->join('vehiculo', 'alquileres.idVehiculoAlquiler = vehiculo.idVehiculo')
                    ->join('usuario', 'alquileres.idClienteAlquiler = usuario.idUsuario')
                    ->where('alquileres.estadoAlquiler', 'Activo')
                    ->findAll();
    }

        // Función para obtener las reservas pendientes cruzando datos con usuarios y vehículos
    public function obtenerReservasPendientes()
    {
        return $this->select('alquileres.*, usuario.nombreUsuario, usuario.emailUsuario, vehiculo.marcaVehiculo, vehiculo.modeloVehiculo, vehiculo.imagenVehiculo')
                    ->join('usuario', 'alquileres.idClienteAlquiler = usuario.idUsuario')
                    ->join('vehiculo', 'alquileres.idVehiculoAlquiler = vehiculo.idVehiculo')
                    ->where('alquileres.estadoAlquiler', 'pendiente')
                    ->findAll();
    }

    // Función para que el administrador apruebe la reserva
    public function aprobarReserva($idAlquiler)
    {
        // Cambiamos el estado de pendiente a activo
        return $this->update($idAlquiler, ['estadoAlquiler' => 'activo']);
    }
}