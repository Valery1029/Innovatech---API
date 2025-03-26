<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIngresoProducto extends Migration
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
            'factura' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'UsuarioId_usuario2' => [
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

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('UsuarioId_usuario2', 'usuario', 'id_usuario', 'CASCADE', 'CASCADE');

        $this->forge->createTable('ingreso_producto');
    }

    public function down()
    {
        $this->forge->dropTable('ingreso_producto');
    }
}