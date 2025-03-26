<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPqrs extends Migration
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
            'descripcion' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'comentario_respuesta' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'tipo_pqrs_id' => [
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
            'estado_pqrs_id' => [
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

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('tipo_pqrs_id', 'tipo_pqrs', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('usuario_id', 'usuario', 'id_usuario', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('estado_pqrs_id', 'estado_pqrs', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('pqrs', true);
    }

    public function down()
    {
        $this->forge->dropTable('pqrs', true);
    }
}