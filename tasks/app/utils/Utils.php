<?php

namespace App\Utils;

class Utils
{
    /**
     * Convierte los Errores en una Linea
     * @param array|object $json Aqui donde tendra los errores para las validaciones
     * @created Carlos Fernando Sandoval Lizarraga
     * @return string
     */
    static function ConvertirErroresALinea($json)
    {
        $errorString = '';

        // Recorrer el array y concatenar los mensajes
        foreach ($json as $error) {
            $errorString .= $error . ' ';
        }

        // Eliminar el último espacio en blanco
        $errorString = trim($errorString);

        return $errorString;
    }
}
