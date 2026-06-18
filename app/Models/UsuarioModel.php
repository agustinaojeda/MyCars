<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuario';
    protected $primaryKey       = 'idUsuario';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['emailUsuario', 'passwordUsuario', 'rolUsuario', 'nombreUsuario', 'fechaAltaUsuario', 'telefonoUsuario', 'direccionUsuario','activoUsuario'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'fechaAltaUsuario';
    protected $updatedField  = '';
    protected $deletedField  = '';

    public function registrarUsuario(array $datos)
    {
        $datos['passwordUsuario'] = password_hash($datos['passwordUsuario'], PASSWORD_DEFAULT);

        $datos['rolUsuario']       = 'cliente';

        return $this->insert($datos);
    }

    public function verificarLogin($email, $password)
    {
        $usuario = $this->where('emailUsuario', $email)
            ->first();

        if ($usuario && password_verify($password, $usuario['passwordUsuario'])) {
            unset($usuario['passwordUsuario']);
            return $usuario;
        }

        return null; 
    }

}
