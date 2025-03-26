<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddModelosRol extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Modelosid' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => false,
            ],
            'Rolid' => [
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

        $this->forge->addKey(['Modelosid', 'Rolid'], true);
        $this->forge->addForeignKey('Modelosid', 'modelos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('Rolid', 'rol', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('modelos_rol', true);
    }

    public function down()
    {
        $this->forge->dropTable('modelos_rol', true);
    }
}
