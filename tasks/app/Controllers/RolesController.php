<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Utils\UtilMessage;
use CodeIgniter\HTTP\ResponseInterface;

class RolesController extends BaseController
{
    private RolesModel $_rolesModel;
    public function __construct()
    {
        $this->_rolesModel = new RolesModel();
    }
    public function obtenerRoles()
    {
        return $this->getResponse(UtilMessage::success($this->_rolesModel->buscarTodos()));
    }
}
