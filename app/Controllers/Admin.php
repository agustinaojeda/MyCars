<?php

namespace App\Controllers;

use App\Models\AlquilerModel;

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
}