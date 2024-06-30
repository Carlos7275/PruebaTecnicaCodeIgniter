<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GenerosModel;
use App\Utils\UtilMessage;

class GenerosController extends BaseController
{
    private  GenerosModel $_generosModel;

    public function __construct()
    {
        $this->_generosModel = new GenerosModel();
    }
    public function obtenerGeneros()
    {
        $data = $this->_generosModel->buscarTodos();
        return $this->getResponse(UtilMessage::success($data));
    }

    public function obtenerGenero($id)
    {
        $data = $this->_generosModel->buscarPorId($id);

        if ($data)
            return $this->getResponse(UtilMessage::success($data));
        return $this->getResponse(UtilMessage::notFound(), UtilMessage::getStatus());
    }
}
