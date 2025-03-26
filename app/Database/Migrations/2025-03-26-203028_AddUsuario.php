<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsuario extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_usuario' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'primer_nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'segundo_nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'primer_apellido' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'segundo_apellido' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'documento' => [
                'type'       => 'BIGINT',
                'null'       => false,
            ],
            'correo' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'unique'     => true,
            ],
            'telefono1' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => false,
            ],
            'telefono2' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => true,
            ],
            'direccion' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'usuario' => [
                'type'       => 'VARCHAR',
                'constraint' => 70,
                'null'       => false,
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'tipo_documento_id' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'null'       => false,
            ],
            'ciudad_id' => [
                'type'       => 'SMALLINT',
                'constraint' => 6,
                'unsigned'   => true,
                'null'       => false,
            ],
            'rol_id' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'null'       => false,
            ],
            'estado_usuario_id' => [
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

        $this->forge->addKey('id_usuario', true);
        $this->forge->addForeignKey('tipo_documento_id', 'tipo_documento', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('ciudad_id', 'ciudad', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('rol_id', 'rol', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('estado_usuario_id', 'estado_usuario', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('usuario', true);
    }

    public function down()
    {
        $this->forge->dropTable('usuario', true);
    }
}
