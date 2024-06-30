<?php

namespace App\Utils;
//Clase Prefija para Mensajes

class UtilMessage
{
    static  private $code;
    static function Validation($data)
    {
        self::$code = 400;
        return ['message' => '¡Atencion!', 'data' => $data];
    }
    static function success($data)
    {
        self::$code = 200;
        return ['message' => '¡Operacion Exitosa!', 'data' => $data];
    }

    static function Forbidden()
    {
        self::$code = 401;
        return ['message' => '¡Atencion!', 'data' => '¡Acceso No Autorizado!'];
    }

    static function Observation($observation)
    {
        self::$code = 403;
        return ['message' => '¡Atencion!', 'data' => $observation];
    }
    static function Error($error)
    {
        self::$code = 500;
        return ['message' => '¡Hubo un Error!', 'data' => $error];
    }
    static function notFound()
    {
        self::$code = 404;
        return ['message' => '¡Atencion!', 'data' => '¡No se encontro el registro!'];
    }
    static function getStatus()
    {
        return self::$code;
    }
}
