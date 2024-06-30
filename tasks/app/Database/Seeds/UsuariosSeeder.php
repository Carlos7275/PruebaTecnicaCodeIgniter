<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'email' => 'admin@admin.com',
            'password' => password_hash('admin1234', PASSWORD_BCRYPT),
            'nombres' => 'Carlos Fernando',
            'apellidos' => 'Sandoval Lizárraga',
            'id_rol' => 1,
            'fechanacimiento' => '2001/02/14',
            'id_genero' => 3
        ];

        $this->db->table('usuarios')->insertBatch($data);
    }
}
