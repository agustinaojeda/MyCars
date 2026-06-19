<?php

namespace App\Controllers;

class Usuario extends BaseController
{
    public function index()
    {
        session();
        $vehiculoModel = new \App\Models\VehiculoModel();
        $vehiculos = $vehiculoModel->mostrarVehiculosDisponibles();
        $ultimosPorCategoria = [];
        if (!empty($vehiculos)) {
            foreach ($vehiculos as $v) {
                $cat = strtolower($v['categoriaVehiculo']);
                if (!isset($ultimosPorCategoria[$cat])) {
                    $ultimosPorCategoria[$cat] = $v;
                }
            }
        }

        $data['vehiculos'] = $vehiculos;
        $data['ultimosPorCategoria'] = $ultimosPorCategoria;

        return view('index', $data);
    }
}
