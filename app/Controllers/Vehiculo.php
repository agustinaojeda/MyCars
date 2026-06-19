<?php


namespace App\Controllers;


use App\Models\VehiculoModel;


class Vehiculo extends BaseController
{
    public function categoria(string $categoria)
    {
        $vehiculoModel = new VehiculoModel();
        $query = $vehiculoModel
            ->where('categoriaVehiculo', $categoria)
            ->where('activoVehiculo', 1);

        $marca = $this->request->getGet('marca');
        $precio = $this->request->getGet('precio');
        $capacidad = $this->request->getGet('capacidad');

        if (!empty($marca)) {
            $query->where('marcaVehiculo', $marca);
        }

        if (!empty($precio)) {
            $query->where('precioAlqVehiculo <=', $precio);
        }

        if (!empty($capacidad)) {
            $query->where('nroPlazasVehiculo', $capacidad);
        }


        //$data['categoria'] = $categoria;
        //$data['vehiculos'] = $query->findAll();

        $categorias = [
            'suv',
            'deportivo',
            'sedan',
            'compacto'
        ];

        $indice = array_search($categoria, $categorias);

        $data = [
            'categoria' => $categoria,
            'vehiculos' => $query->findAll(),
            'anterior' => ($indice == 0)
                ? $categorias[count($categorias) - 1]
                : $categorias[$indice - 1],
            'siguiente' => ($indice == count($categorias) - 1)
                ? $categorias[0]
                : $categorias[$indice + 1]
        ];
        return view('categoria', $data);
    }
    
}
