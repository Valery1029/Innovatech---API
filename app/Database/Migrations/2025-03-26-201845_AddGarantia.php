<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGarantia extends Migration
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
            'numero_mes_año' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'mes_año' => [
                'type'       => 'BIT',
                'constraint' => 1,
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
        $this->forge->createTable('garantia', true);
    }

    public function down()
    {
        $this->forge->dropTable('garantia', true);
    }
}
