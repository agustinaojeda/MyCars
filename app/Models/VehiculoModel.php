<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiculoModel extends Model
{
    protected $table            = 'vehiculo';
    protected $primaryKey       = 'idVehiculo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['marcaVehiculo', 'modeloVehiculo', 'anioVehiculo', 'nroPlazasVehiculo', 'motorVehiculo', 'kilometrajeVehiculo', 'precioAlqVehiculo', 'imagenVehiculo', 'disponibleVehiculo', 'activoVehiculo', 'categoriaVehiculo', 'deleted_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    //recibe un array con los datos y la imagen
    public function crearVehiculo(array $datos, $archivoImagen)
    {
        if ($archivoImagen && $archivoImagen->isValid() && !$archivoImagen->hasMoved()) {

            $nombreAleatorio = $archivoImagen->getRandomName();

            $archivoImagen->move(FCPATH . 'assets/images', $nombreAleatorio);

            $datos['imagenVehiculo'] = $nombreAleatorio;
        } else {
            return false;
        }

        $datos['disponibleVehiculo'] = 1; 
        $datos['activoVehiculo']     = 1; 
        
        return $this->insert($datos);
    }

    public function eliminarVehiculo($idVehiculo) //lo deja como inactivo
    {
        $datosBaja = [
            'activoVehiculo' => 0,
            'deleted_at'     => date('Y-m-d H:i:s') 
        ];

        return $this->update($idVehiculo, $datosBaja);
    }

    public function mostrarVehiculosDisponibles(){
        return $this->where('activoVehiculo', 1)->where('disponibleVehiculo', 1)->findAll();
    }

    public function mostrarVehiculosActivos(){
        return $this->where('activoVehiculo', 1)->findAll();
    }
}
