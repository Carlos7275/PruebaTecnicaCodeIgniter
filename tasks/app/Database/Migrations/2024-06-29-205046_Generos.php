<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Generos extends Migration
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
        $this->forge->addPrimaryKey("id", "PK_IDGENERO");
        $this->forge->createTable("generos");
    }

    public function down()
    {
        $this->forge->dropTable("generos");
    }
}
