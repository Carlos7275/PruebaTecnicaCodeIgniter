<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'auto_increment' => true,
                'primaryKey' => true, 
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => '255',
                'unique' => true,
            ],
            'password' => [
                'type' => 'varchar',
                'constraint' => '255',
            ],
            'nombres' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'apellidos' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_genero' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'fechanacimiento' => [
                'type' => 'date',
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => '1000',
                'default' => 'assets/imagenes/usuarios/default.png',
            ],
            'id_rol' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 2,
            ],
            'estatus' => [
                'type' => 'INT',
                'default' => 1,
            ],
        ]);

        $this->forge->addKey('id', true); // Agregar clave primaria

        // Añadir claves foráneas
        $this->forge->addForeignKey('id_rol', 'roles', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('id_genero', 'generos', 'id', '', 'CASCADE');

        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        // Eliminar claves foráneas primero para evitar errores
        $this->forge->dropForeignKey('usuarios', 'usuarios_id_rol_fk');
        $this->forge->dropForeignKey('usuarios', 'usuarios_id_genero_fk');

        // Finalmente, eliminar la tabla
        $this->forge->dropTable('usuarios');
    }
}
