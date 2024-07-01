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
     * @return array|null; Regresa el array de usuarios o null
     */
    public function iniciarSesion($email, $password)
    {
        $usuario = $this->where('email', $email,)->where("estatus", 1)->first();
        if ($usuario) {
            if (password_verify($password, $usuario["password"])) {
                unset($usuario["password"]);
                return $usuario;
            }
        }
        return null;
    }
    /**
     * Cambia el estatus de un usuario a activo o inactivo
     * @param $id id del usuario a cambiar el estatus
     * @return string|null Activo , inactivo o nulo si no existe
     */
    public function cambiarEstatus($id)
    {
        $usuario = $this->where('id', $id)->first();
        if ($usuario) {
            $estatusNumerico = ($usuario["estatus"] == 1) ? 0 : 1;
            $estatus = ($usuario["estatus"] == 1) ? "Inactivo" : "Activo";
            $this->update($id, ['estatus' => $estatusNumerico]);
            return $estatus;
        }
        return null;
    }
}
