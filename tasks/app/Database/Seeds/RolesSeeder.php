<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ["id" => 1, "descripcion" => "Administrador"],
            ["id" => 2, "descripcion" => "Usuario Normal"]
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}
