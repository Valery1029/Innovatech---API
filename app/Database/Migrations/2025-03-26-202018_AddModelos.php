<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddModelos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'Ruta' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => false,
                'unique'     => true,
            ],
            'Descripción' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
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
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('modelos', true);
    }

    public function down()
    {
        $this->forge->dropTable('modelos', true);
    }
}