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
        $input = $this->getRequestInput($this->request);

        $uniones = [[
            "tabla" => "prioridades",
            "condicion" => "prioridades.id=tareas.idprioridad"
        ]];

        $filtrosBusqueda = [
            [
                "campo" => "tareas.id",
                "tipo_dato" => "int",
                "operador" => "="
            ],
            [
                "campo" => "tareas.nombretarea",
                "tipo_dato" => "string",
                "operador" => "string"
            ],
            [
                "campo" => "tareas.descripcion",
                "tipo_dato" => "string",
                "operador" => "="
            ],
            [
                "campo" => "prioridad.descripcion",
                "tipo_dato" => "string",
                "operador" => "="
            ]


        ];

        $filtrosEspeciales = [
            [
                "campo" => "prioridad.id",
                "tipo_dato" => "int",
                "operador" => "=",
                'comodin' => "-1",
                'valor' => $input["idprioridad"]
            ],
            [
                "campo" => "estatus",
                "tipo_dato" => "string",
                "operador" => "=",
                'comodin' => "-1",
                'valor' => $input["estatus"]
            ],
            [
                "campo" => "tareas.fecha",
                "tipo_dato" => "date",
                "operador" => ">=",
                'comodin' => null,
                'valor' => $input["fechaInicio"]
            ],
            [
                "campo" => "tareas.fecha",
                "tipo_dato" => "date",
                "operador" => "<=",
                'comodin' => null,
                'valor' => $input["fechaFinal"]
            ]
        ];
        $resultado = $this->_tareasModel->paginar($input["busqueda"] ?? null, $input["pagina"] ?? 1, $input["limitePagina"] ?? 20, "*", $uniones, null, $filtrosBusqueda, $filtrosEspeciales);
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
}
