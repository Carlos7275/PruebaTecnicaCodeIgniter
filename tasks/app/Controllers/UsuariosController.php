<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Utils\UtilMessage;
use App\Utils\Utils;

class UsuariosController extends BaseController
{
    private UsuariosModel $_usuariosModel;

    public function __construct()
    {
        $this->_usuariosModel = new UsuariosModel();
    }

    /**
     * Iniciar Sesion en el sistema 
     */
    public function iniciarSesion()
    {
        $request = $this->getRequestInput($this->request);

        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                UtilMessage::Validation(
                    Utils::ConvertirErroresALinea($this->validator->getErrors())
                ),
                UtilMessage::getStatus()
            );
        }

        $usuario = $this->_usuariosModel->iniciarSesion($input["email"], $input["password"]);
        if ($usuario) {
            $session =  session();
            $session->set("usuario", $usuario);

            return $this->getResponse(UtilMessage::success($usuario), UtilMessage::getStatus());
        }
        return $this->getResponse(UtilMessage::Forbidden(), UtilMessage::getStatus());
    }

    public function cerrarSesion()
    {
        $session = session();
        // Destruir la sesión
        if ($session->has('usuario')) {
            $session->destroy();
        }
        // Redireccionar al login
        return redirect()->to(site_url('login'));
    }
}
