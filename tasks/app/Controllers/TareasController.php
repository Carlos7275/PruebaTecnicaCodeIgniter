<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TareasModel;
use App\Utils\UtilMessage;
use App\Utils\Utils;

class TareasController extends BaseController
{
    private TareasModel $_tareasModel;
    public function __construct()
    {
        $this->_tareasModel = new TareasModel();
    }

    public function tareas()
    {
        return view("/tareas/tareas");
    }
    /**
     * Crea una tarea del usuario logueado
     */
    public function crearTarea()
    {
        $usuario = session("usuario");

        $input = $this->getRequestInput($this->request);

        $rules = [
            'nombretarea' => 'required|string',
            'descripcion' => 'required|string',
            'fechaentrega' => 'required|Date|trim|valid_date',
            'idprioridad' => "required|numeric",
        ];

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                UtilMessage::Validation(
                    Utils::ConvertirErroresALinea($this->validator->getErrors())
                ),
                UtilMessage::getStatus()
            );
        }
        $input["id_usuario"] = $usuario["id"]; //Sacamos el id del usuario de acuerdo a la sesión

        $this->_tareasModel->crear($input);
        return $this->getResponse(UtilMessage::success("Se registro la tarea con exito"));
    }
    /**
     * Modifica una tarea del usuario
     * @param $id id de la tarea a modificar
     */
    public function editarTarea($id)
    {

        $input = $this->getRequestInput($this->request);

        $rules = [
            'nombretarea' => 'required|string',
            'descripcion' => 'required|string',
            'fechaentrega' => 'required|Date|trim|valid_date',
            'idprioridad' => "required|numeric",
            'estatus' => "required|string"
        ];

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                UtilMessage::Validation(
                    Utils::ConvertirErroresALinea($this->validator->getErrors())
                ),
                UtilMessage::getStatus()
            );
        }

        $this->_tareasModel->actualizar($id, $input);
        return $this->getResponse(UtilMessage::success("Se modifico la tarea con exito"));
    }
    /**
     * Listado de tareas paginadas
     */
    public function paginar()
    {
        $usuario = session("usuario");
        $input = $this->getRequestInput($this->request);

        $uniones = [[
            "tabla" => "prioridades",
            "condicion" => "prioridades.id=tareas.idprioridad"
        ]];

        $filtrosBusqueda = [
            [
                "columna" => "tareas.id",
                "tipo_dato" => "int",
                "operador" => "="
            ],
            [
                "columna" => "tareas.nombretarea",
                "tipo_dato" => "string",
                "operador" => "string"
            ],
            [
                "columna" => "tareas.descripcion",
                "tipo_dato" => "string",
                "operador" => "="
            ],
            [
                "columna" => "prioridades.descripcion",
                "tipo_dato" => "string",
                "operador" => "="
            ]


        ];
        $filtrosEspeciales = [
            [
                "columna" => "idprioridad",
                "tipo_dato" => "int",
                "operador" => "=",
                'valorIgnorado' => -1,
                'valor' => $input["idPrioridad"] ?? -1
            ],
            [
                "columna" => "estatus",
                "tipo_dato" => "string",
                "operador" => "=",
                'valorIgnorado' => "-1",
                'valor' => $input["estatus"] ?? "-1"
            ],
            [
                "columna" => "tareas.fechaentrega",
                "tipo_dato" => "date",
                "operador" => ">=",
                'valorIgnorado' => null,
                'valor' => $input["fechaInicial"] ?? null
            ],
            [
                "columna" => "tareas.fechaentrega",
                "tipo_dato" => "date",
                "operador" => "<=",
                'valorIgnorado' => null,
                'valor' => $input["fechaFinal"] ?? null
            ],
            [
                "columna" => "tareas.id_usuario",
                "tipo_dato" => "int",
                "operador" => "=",
                'valorIgnorado' => null,
                'valor' => $usuario["id"]
            ]
        ];

        $resultado = $this->_tareasModel->paginar($input["busqueda"] ?? null, $input["pagina"] ?? 1, $input["limite"] ?? 20, "tareas.id,nombretarea,tareas.descripcion,fechaentrega,idprioridad,prioridades.descripcion as prioridad,estatus,created_at,updated_at", $uniones, null, $filtrosBusqueda, $filtrosEspeciales);
        return $this->getResponse(UtilMessage::success($resultado));
    }
    /**
     * Elimina una tarea especifica del usuario
     * @param $id id del usuario
     * @return array
     */
    public function eliminarTarea($id)
    {
        $data = $this->_tareasModel->eliminar($id);
        if ($data)
            return $this->getResponse(UtilMessage::success("Se elimino la tarea  con id {$id}"));
        return $this->getResponse(UtilMessage::notFound(), UtilMessage::getStatus());
    }

    /**
     * Obtiene total de tareas de acuerdo al usuario logueado
     */
    public function obtenerTotalTareas()
    {
        $usuario = session("usuario");
        $resultado = $this->_tareasModel->obtenerTotalActividades($usuario["id"]);
        return $this->getResponse(UtilMessage::success($resultado));
    }

    /**
     * Obtiene las tareas retrasadas de acuerdo al usuario logueado
     */
    public function obtenerTareasRetrasadas()
    {
        $usuario = session("usuario");
        $resultado = $this->_tareasModel->obtenerTareasRetrasadas($usuario["id"]);
        return $this->getResponse(UtilMessage::success($resultado));
    }
}
