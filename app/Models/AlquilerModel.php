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
        $datos['estadoAlquiler'] = 'pendiente';

        $fechaDesde = new \DateTime($datos['fechaDesdeAlquiler']);
        $fechaDesde->modify('+' . $datos['cantDiasAlquiler'] . ' days');
        $datos['fechaHastaAlquiler'] = $fechaDesde->format('Y-m-d');

        $this->db->transStart();

        $this->insert($datos);

        //$this->db->table('vehiculo')
                // ->where('idVehiculo', $datos['idVehiculoAlquiler'])
                // ->update(['disponibleVehiculo' => 0]);

        $this->db->transComplete();

        return $this->db->transStatus();
    }

    public function registrarDevolucion($idAlquiler)
    {
        $alquiler = $this->find($idAlquiler);

        if (!$alquiler) {
            return false;
        }

        return $this->update($idAlquiler, [
            'estadoAlquiler' => 'finalizado'
        ]);
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
                    ->where('alquileres.estadoAlquiler', 'activo')
                    ->findAll();
    }

        // Función para obtener las reservas pendientes cruzando datos con usuarios y vehículos
    public function obtenerReservasPendientes()
    {
        return $this->select('alquileres.*, alquileres.nombreConductor, usuario.nombreUsuario, usuario.emailUsuario, vehiculo.marcaVehiculo, vehiculo.modeloVehiculo, vehiculo.imagenVehiculo')
                    ->join('usuario', 'alquileres.idClienteAlquiler = usuario.idUsuario')
                    ->join('vehiculo', 'alquileres.idVehiculoAlquiler = vehiculo.idVehiculo')
                    ->where('alquileres.estadoAlquiler', 'pendiente')
                    ->findAll();
    }

    public function obtenerReservasCliente($idCliente)
    {
        return $this->select('alquileres.*, vehiculo.marcaVehiculo,
                            vehiculo.modeloVehiculo,
                            vehiculo.imagenVehiculo,
                            vehiculo.precioAlqVehiculo')
                    ->join('vehiculo', 'alquileres.idVehiculoAlquiler = vehiculo.idVehiculo')
                    ->where('alquileres.idClienteAlquiler', $idCliente)
                    ->orderBy('idAlquiler', 'DESC')
                    ->findAll();
    }

    // Función para que el administrador apruebe la reserva
    public function aprobarReserva($idAlquiler)
    {
        $alquiler = $this->find($idAlquiler);

        if (!$alquiler) {
            return false;
        }
        return $this->update($idAlquiler, [
            'estadoAlquiler' => 'activo'
        ]);

    }

    // Función para ver el detalle completo de un solo alquiler
    public function obtenerDetalleReserva($idAlquiler)
    {
        return $this->select('alquileres.*, usuario.nombreUsuario, usuario.emailUsuario, usuario.telefonoUsuario, usuario.direccionUsuario, vehiculo.marcaVehiculo, vehiculo.modeloVehiculo, vehiculo.anioVehiculo, vehiculo.imagenVehiculo, vehiculo.precioAlqVehiculo, vehiculo.motorVehiculo, vehiculo.nroPlazasVehiculo')
                    ->join('usuario', 'alquileres.idClienteAlquiler = usuario.idUsuario')
                    ->join('vehiculo', 'alquileres.idVehiculoAlquiler = vehiculo.idVehiculo')
                    ->where('alquileres.idAlquiler', $idAlquiler)
                    ->first(); // Usamos first() porque buscamos un registro único, no una lista
    }

    // Función para rechazar la reserva
    public function rechazarReserva($idAlquiler)
    {
        return $this->update($idAlquiler, ['estadoAlquiler' => 'cancelado']);
    }

    // Función para obtener los alquileres que están actualmente en curso
    public function obtenerAlquileresActivos()
    {
        return $this->select('alquileres.*, usuario.nombreUsuario, usuario.emailUsuario, vehiculo.marcaVehiculo, vehiculo.modeloVehiculo, vehiculo.imagenVehiculo')
                    ->join('usuario', 'alquileres.idClienteAlquiler = usuario.idUsuario')
                    ->join('vehiculo', 'alquileres.idVehiculoAlquiler = vehiculo.idVehiculo')
                    ->where('alquileres.estadoAlquiler', 'activo')
                    ->findAll();
    }

    public function existeCruceFechas($idVehiculo, $desde, $hasta)
{
    return $this->where('idVehiculoAlquiler', $idVehiculo)
                ->whereIn('estadoAlquiler', ['pendiente', 'activo'])
                ->groupStart()
                    ->where('fechaDesdeAlquiler <=', $hasta)
                    ->where('fechaHastaAlquiler >=', $desde)
                ->groupEnd()
                ->countAllResults() > 0;
}
public function obtenerCruceFechas($idVehiculo, $desde, $hasta)
{
    return $this->where('idVehiculoAlquiler', $idVehiculo)
                ->whereIn('estadoAlquiler', ['pendiente', 'activo'])
                ->groupStart()
                    ->where('fechaDesdeAlquiler <=', $hasta)
                    ->where('fechaHastaAlquiler >=', $desde)
                ->groupEnd()
                ->first();
}
}