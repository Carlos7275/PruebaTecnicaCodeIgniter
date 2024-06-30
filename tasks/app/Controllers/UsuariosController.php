<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GenerosModel;
use App\Models\UsuariosModel;
use App\Utils\UtilImage;
use App\Utils\UtilMessage;
use App\Utils\Utils;

class UsuariosController extends BaseController
{
    private UsuariosModel $_usuariosModel;
    private GenerosModel $_generosModel;
    public function __construct()
    {
        $this->_usuariosModel = new UsuariosModel();
        $this->_generosModel = new GenerosModel();
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
        return redirect()->to("/login");
    }

    public function usuarios()
    {
        return view("usuarios/usuarios");
    }
    public function configuracionUsuario()
    {
        $data["generos"] = $this->_generosModel->buscarTodos();
        return view("configuracion-usuario/configuracion-usuario", $data);
    }

    public function editarUsuario($id)
    {

        $usuario = session("usuario");


        $rules =
            [
                'email' => 'required|valid_email',
                'nombres' => 'required',
                'apellidos' => 'required',
                'id_genero' => "required",
                'fechanacimiento' => 'required',
            ];


        $input = $this->getRequestInput($this->request);
        if ($usuario['id_rol'] == 1) {
            if (isset($input["id_rol"]))
                $rules['id_rol'] = 'required';
            else
            if (isset($input["estatus"]))
                $rules['estatus'] = 'required';
        } else {
            if (isset($input["id_rol"]))
                unset($usuario["id_rol"]);

            if (isset($input["estatus"]))
                unset($usuario["estatus"]);
        }

        if (isset($input["foto"])) {
            $urlImagen = UtilImage::insertarImagen($input["foto"], "usuarios");
            $input["foto"] = $urlImagen;
        }


        $this->_usuariosModel->actualizar($id, $input);
      return  $this->getResponse(UtilMessage::success("Se edito la información del usuario"));
    }
}
