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
}