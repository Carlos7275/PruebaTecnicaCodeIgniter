<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GenerosModel;
use App\Models\PrioridadesModel;
use App\Models\UsuariosModel;
use App\Utils\UtilImage;
use App\Utils\UtilMessage;
use App\Utils\Utils;

class PrioridadesController extends BaseController
{
    private PrioridadesModel $_prioridadesModel;
    public function __construct()
    {
        $this->_prioridadesModel = new PrioridadesModel();
    }

    public function obtenerPrioridades()
    {
        return $this->getResponse($this->_prioridadesModel->buscarTodos());
    }
}
