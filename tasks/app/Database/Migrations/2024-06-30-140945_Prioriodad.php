<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Prioriodad extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                'type' => "INT",
                'auto_increment' => true,
                'unsigned' => true,
                'primaryKey' => true,

            ],
            "descripcion" => [
                "type" => "VARCHAR",
                "constraint" => 100
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('prioridades');
    }

    public function down()
    {
        $this->forge->dropTable('prioriodades');
    }
}
