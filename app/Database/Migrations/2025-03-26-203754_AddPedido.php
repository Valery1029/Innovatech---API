<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
class AddPedido extends Migration
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
                'type'    => 'TIMESTAMP',
                'null'    => false,
            ],
            'valortl' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'UsuarioId_usuario' => [
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
        $this->forge->addForeignKey('UsuarioId_usuario', 'usuario', 'id_usuario', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('pedido', true);
    }

    public function down()
    {
        $this->forge->dropTable('pedido', true);
    }
}
