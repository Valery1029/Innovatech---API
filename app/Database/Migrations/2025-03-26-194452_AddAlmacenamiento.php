<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAlmacenamiento extends Migration
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
        $this->forge->createTable('almacenamiento', true);
    }

    public function down()
    {
        $this->forge->dropTable('almacenamiento', true);
    }
}
