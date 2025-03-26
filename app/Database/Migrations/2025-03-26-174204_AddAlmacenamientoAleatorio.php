<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAlmacenamientoAleatorio extends Migration
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
            'num' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'unidadestandar' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
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

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('almacenamiento_aleatorio', true);
    }

    public function down()
    {
        $this->forge->dropTable('almacenamiento_aleatorio', true);
    }
}