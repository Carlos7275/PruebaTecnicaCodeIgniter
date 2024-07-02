<?php

namespace App\Models;

use CodeIgniter\Model;

class TareasModel extends BaseModel
{
    protected $DBGroup          = 'default';
    protected $table            = 'tareas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["nombretarea", "descripcion", "fechaentrega", "id_usuario", "idprioridad", "estatus"];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * Obtiene el total de tareas del usuario especifico
     * @param int $idusuario
     * @return array
     * @created Carlos Fernando Sandoval Lizarraga
     */
    public function obtenerTotalActividades($idusuario)
    {
        $builder = $this->db->table("tareas");
        $builder->where("id_usuario", $idusuario);
        return $builder->countAllResults(false);
    }

    /**
     * Obtiene las tareas retrasadas
     * @param int $idusuario
     * @return array
     * @created Carlos Fernando Sandoval Lizarraga
     */
    public function obtenerTareasRetrasadas($idusuario)
    {
        $builder = $this->db->table("tareas");
        $builder->where("id_usuario=", $idusuario);
        $builder->where("estatus !=", "C");
        $builder->where("fechaentrega <", date('Y-m-d'));

        $query = $builder->get();
        return count($query->getResult());
    }
}
