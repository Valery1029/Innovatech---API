<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSalidaProducto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => false,
            ],
            'Fecha' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'Cantidad' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'Precio' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'facturaid' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => false,
            ],
            'Productosid' => [
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

        $this->forge->addPrimaryKey(['id', 'facturaid', 'Productosid']);
        $this->forge->addForeignKey('Productosid', 'productos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('facturaid', 'factura', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('salida_producto');
    }

    public function down()
    {
        $this->forge->dropTable('salida_producto');
    }
}