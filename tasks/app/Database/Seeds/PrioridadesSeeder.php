<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrioridadesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ["id" => 1, "descripcion" => "Muy baja"],
            ["id" => 2, "descripcion" => "Baja"],
            ["id" => 3, "descripcion" => "Media"],
            ["id" => 4, "descripcion" => "Alta"],
            ["id" => 5, "descripcion" => "Muy Importante"]
        ];

        $this->db->table('prioridades')->insertBatch($data);
    }
}
