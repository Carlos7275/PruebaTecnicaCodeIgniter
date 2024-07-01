<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tareas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nombretarea' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'descripcion' => [
                'type' => 'TEXT'
            ],
            'fechaentrega' => [
                'type' => 'DATETIME'
            ],
            'idprioridad' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'idtarea' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'id_usuario' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'estatus' => [
                'type' => 'CHAR',
                'constraint' => 1
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => null
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => null,
                'on update' => 'CURRENT_TIMESTAMP'
            ]


        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idprioridad', 'prioridades', 'id',);
        $this->forge->createTable('tareas');
    }

    public function down()
    {
        $this->forge->dropTable('tareas');
    }
}
