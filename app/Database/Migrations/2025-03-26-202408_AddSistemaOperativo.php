<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSistemaOperativo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'SMALLINT',
                'constraint'     => 6,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'version' => [
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
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('sistema_operativo', true);
    }

    public function down()
    {
        $this->forge->dropTable('sistema_operativo', true);
    }
}