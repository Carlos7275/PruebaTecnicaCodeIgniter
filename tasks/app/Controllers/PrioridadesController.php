<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PrioridadesModel;
use App\Utils\UtilMessage;

class PrioridadesController extends BaseController
{
    private PrioridadesModel $_prioridadesModel;
    public function __construct()
    {
        $this->_prioridadesModel = new PrioridadesModel();
    }

    public function obtenerPrioridades()
    {
        return $this->getResponse(UtilMessage::success($this->_prioridadesModel->buscarTodos()));
    }
}
