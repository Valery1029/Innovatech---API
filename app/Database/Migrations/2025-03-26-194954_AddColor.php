<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColor extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_color' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type'       => 'VARCHAR',
                'constraint' => 25,
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);

        $this->forge->addPrimaryKey('id_color');
        $this->forge->createTable('color', true);
    }

    public function down()
    {
        $this->forge->dropTable('color', true);
    }
}
