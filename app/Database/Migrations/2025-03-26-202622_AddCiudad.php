<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCiudad extends Migration
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
            'departamentoid' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
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
        $this->forge->addForeignKey('departamentoid', 'departamento', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ciudad', true);
    }

    public function down()
    {
        $this->forge->dropTable('ciudad', true);
    }
}
