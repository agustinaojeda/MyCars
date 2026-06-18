<?php

namespace App\Controllers;

class Usuario extends BaseController
{
    public function index()
    {
        session();
        $vehiculoModel = new \App\Models\VehiculoModel();
        $data['vehiculos'] = $vehiculoModel->mostrarVehiculosDisponibles();
        return view('index',$data);
    }
}
