<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo base reutilizable
 */
class BaseModel extends Model
{
    protected $table;
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [];
    protected $useTimestamps = false;

    /**
     * Inserta un registro al modelo
     * @param array $data
     * @return bool 
     */
    public function crear(array $data)
    {
        return $this->insert($data);
    }

    /**
     * Busca un registro por medio del id
     * @param $id
     */
    public function buscarPorID($id)
    {
        return $this->find($id);
    }

    /**
     * Inserta un registro al modelo
     * @param  $id
     * @param array $data
     * @return bool 
     */
    public function actualizar($id, array $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Elimina un registro por medio del id
     * @param $id
     * @return bool
     */
    public function eliminar($id)
    {
        return $this->delete($id);
    }

    /**
     * Obtiene todos los registros del modelo
     */
    public function buscarTodos()
    {
        return $this->findAll();
    }

    /**
     * Paginar tabla con busqueda.....
     */
    public function paginar(
        $busqueda = null,
        $pagina = 1,
        $limiteElementos = 10,
        $selecciones = null,
        $uniones = null,
        $ordenes = null,
        $filtrosBusqueda = null,
        $filtrosEspeciales = null
    ) {
        $builder = $this->db->table($this->getTable());

        $totalRegistros = $builder->countAllResults(false);

        //Aplica las selección de campos establecidas
        $builder->select($selecciones);

        //leemos el array de las uniones de la tabla
        foreach ($uniones as $union)
            $builder->join($union['tabla'], $union['condicion'], $union['tipo'] ?? "inner");

        //Se aplicaran los filtros en caso de que existan
        if (!empty($busqueda) && isset($filtrosBusqueda)) {
            foreach ($filtrosBusqueda as $filtro)
                switch ($filtro["tipo_dato"]) {
                    case 'string':
                        $builder->orlike($filtro["columna"], $busqueda);
                        break;
                    case 'double':
                    case 'float':
                        $builder->orWhere($filtro["columna"] . $filtro["operador"], doubleval($busqueda));
                        break;
                    case 'date':
                        $builder->orWhere($filtro["columna"] . $filtro["operador"], date("d-m-Y", strtotime($busqueda)));
                        break;
                    default:
                        $builder->orWhere($filtro["columna"] . $filtro["operador"], $busqueda);
                        break;
                }
        }
        //Si existen los filtros especiales los aplicamos
        if (isset($filtrosEspeciales)) {
            foreach ($filtrosEspeciales as $filtroEspecial) {
                if (isset($filtroEspecial["valor"]) && $filtroEspecial["valor"] != $filtroEspecial["valorIgnorado"]) {
                    switch ($filtro["tipo_dato"]) {
                        case 'string':
                            $builder->like($filtro["columna"], $filtro["valor"]);
                            break;
                        case 'double':
                        case 'float':
                            $builder->where($filtro["columna"] . $filtro["operador"], doubleval($filtro["valor"]));
                            break;
                        case 'date':
                            $builder->where($filtro["columna"] . $filtro["operador"], $filtro["valor"]);
                            break;
                        default:
                            $builder->Where($filtro["columna"] . $filtro["operador"], $filtro["valor"]);
                            break;
                    }
                }
            }
        }

        //Aplica el ordenamiento en caso de que no este vacio
        if (isset($orden))
            foreach ($ordenes as $orden)
                $builder->orderBy($orden["campo"], $orden["direccion"]);

        $registros = $builder->limit($limiteElementos, ($pagina - 1) * $limiteElementos)
            ->get()
            ->getResult();

        $totalRegistrosFiltrados = count($registros);

        return [
            "busqueda", $busqueda,
            "filtrosBusqueda" => $filtrosBusqueda,
            "filtrosEspeciales" => $filtrosEspeciales,
            "datos" => $registros,
            "totalRegistros" => $totalRegistros,
            "totalRegistrosFiltrados" => $totalRegistrosFiltrados
        ];
    }
}
