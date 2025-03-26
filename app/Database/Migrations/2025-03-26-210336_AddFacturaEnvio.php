<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFacturaEnvio extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'FacturaId_Factura' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => false,
            ],
            'EnvioId_Envio' => [
                'type'       => 'INT',
                'constraint' => 10,
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

        $this->forge->addKey(['FacturaId_Factura', 'EnvioId_Envio'], true);
        $this->forge->addForeignKey('FacturaId_Factura', 'factura', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('EnvioId_Envio', 'envio', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('factura_envio', true);
    }

    public function down()
    {
        $this->forge->dropTable('factura_envio', true);
    }
}
