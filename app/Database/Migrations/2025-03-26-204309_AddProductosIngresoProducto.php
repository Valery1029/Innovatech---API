<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProductosIngresoProducto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ProductosId_Producto' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => false,
            ],
            'Ingreso_productoid_ingreso' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => false,
            ],
            'cantidad' => [
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

        $this->forge->addPrimaryKey(['ProductosId_Producto', 'Ingreso_productoid_ingreso']);
        $this->forge->addForeignKey('ProductosId_Producto', 'productos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('Ingreso_productoid_ingreso', 'ingreso_producto', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('productos_ingreso_producto');
    }

    public function down()
    {
        $this->forge->dropTable('productos_ingreso_producto');
    }
}