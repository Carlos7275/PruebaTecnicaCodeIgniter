<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GenerosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ["id" => 1, "descripcion" => "Masculino"],
            ["id" => 2, "descripcion" => "Femenino"],
            ["id" => 3, "descripcion" => "Prefiero no decirlo"]
        ];

        $this->db->table('generos')->insertBatch($data);
    }
}
