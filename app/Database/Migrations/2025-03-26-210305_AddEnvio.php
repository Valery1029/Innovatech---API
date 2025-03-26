<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEnvio extends Migration
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
            'direccion' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'fecha' => [
                'type'    => 'TIMESTAMP',
                'null'    => false,
            ],
            'estado_envio_id' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'null'       => false,
            ],
            'usuario_id' => [
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
        $this->forge->addForeignKey('estado_envio_id', 'estado_envio', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('usuario_id', 'usuario', 'id_usuario', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('envio', true);
    }

    public function down()
    {
        $this->forge->dropTable('envio', true);
    }
}
