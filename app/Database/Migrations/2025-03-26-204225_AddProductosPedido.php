<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProductosPedido extends Migration
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
            'PedidoId_Pedido' => [
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

        $this->forge->addPrimaryKey(['ProductosId_Producto', 'PedidoId_Pedido']);
        $this->forge->addForeignKey('ProductosId_Producto', 'productos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('PedidoId_Pedido', 'pedido', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('productos_pedido');
    }

    public function down()
    {
        $this->forge->dropTable('productos_pedido');
    }
}