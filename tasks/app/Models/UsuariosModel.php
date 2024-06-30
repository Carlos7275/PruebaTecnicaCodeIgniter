<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo de Usuarios con BaseModel que contiene todas las operaciones de un crud reutilizables en cualquier modelo
 */

class UsuariosModel extends BaseModel
{
    protected $DBGroup          = 'default';
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'email',
        'password',
        'nombres',
        'apellidos',
        'id_genero',
        'fechanacimiento',
        'foto',
        'id_rol',
        'estatus'
    ];

    /**
     * Iniciar Sesión en el Sistema
     * @param $email Correo
     * @param $password Contraseña
     */
    public function iniciarSesion($email, $password)
    {
        $usuario = $this->where('email', $email)->first();
        if ($usuario) {
            if (password_verify($password, $usuario["password"])) {
                unset($usuario["password"]);
                return $usuario;
            }
        }
        return null;
    }
}
