<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFactura extends Migration
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
            'fecha' => [
                'type' => 'TIMESTAMP',
                'null' => false,
            ],
            'valortl' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'metodopago' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
            ],
            'Estado_facturaId_Estado_factura' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'null'       => false,
            ],
            'Pedidoid' => [
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

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('Estado_facturaId_Estado_factura', 'Estado_factura', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('Pedidoid', 'Pedido', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('factura', true);
    }

    public function down()
    {
        $this->forge->dropTable('factura', true);
    }
}
