<?php

namespace App\Utils;

class UtilImage
{
    const ruta = "../public/assets/imagenes/";

    /**
     * Crea la carpeta especifica
     * @param string $folder Carpeta a crear
     * @author Carlos Fernando Sandoval Lizárraga

     * @created 2024-06-29
     */
    static function  crearCarpetaImagenes($folder)
    {
        if (!file_exists(self::ruta . $folder))
            mkdir(self::ruta . $folder);
    }
    /**
     * Convierte una cadena Base64 en un archivo y lo guarda en una carpeta especificada.
     * @author Carlos Fernando Sandoval Lizárraga
     * @param string $base64_image_string Cadena Base64 del archivo a guardar.
     * @param string $folder Carpeta donde se guardará el archivo.
     * @return string Ruta del archivo creado o false si falla.
     * @created 2024-06-29
     */
    static public function insertarImagen($base64_image_string, $folder)
    {
        list($data, $base64_image_string) = explode(';', $base64_image_string);
        list(, $extension) = explode('/', $data);
        $output_file_with_extension = uniqid() . '.' . $extension;
        list(, $imageData)      = explode(',', $base64_image_string);
        self::crearCarpetaImagenes($folder);
        file_put_contents(self::ruta . "/" . $folder . "/" . $output_file_with_extension, base64_decode($imageData));

        return "/assets/imagenes/" . $folder . "/" . $output_file_with_extension;
    }
    /**
     * Elimina un archivo del servidor
     * @param string $path Ruta del archivo a eliminar
     * @author Carlos Fernando Sandoval Lizárraga
     * @created 2024-06-29
     */
    static public function eliminarImagen($path)
    {
        unlink($path);
    }
}
