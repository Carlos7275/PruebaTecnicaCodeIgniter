<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Roles extends Migration
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
        $this->forge->addPrimaryKey("id", "PK_IDROL");
        $this->forge->createTable("roles");
    }

    public function down()
    {
        $this->forge->dropTable("roles");
    }
}
