<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProductos extends Migration
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
            'nom' => [
                'type'       => 'VARCHAR',
                'constraint' => 25,
                'null'       => false,
            ],
            'descripcion' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'existencias' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'precio' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'imagen' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'caracteristicas' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'tam' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'tampantalla' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'id_marca' => [
                'type'       => 'SMALLINT',
                'constraint' => 6,
                'unsigned'   => true,
            ],
            'id_estado' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
            ],
            'id_color' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'id_categoria' => [
                'type'       => 'SMALLINT',
                'constraint' => 6,
                'unsigned'   => true,
            ],
            'id_garantia' => [
                'type'       => 'SMALLINT',
                'constraint' => 6,
                'unsigned'   => true,
            ],
            'id_almacenamiento' => [
                'type'       => 'SMALLINT',
                'constraint' => 6,
                'unsigned'   => true,
                'null'       => true,
            ],
            'id_ram' => [
                'type'       => 'SMALLINT',
                'constraint' => 6,
                'unsigned'   => true,
                'null'       => true,
            ],
            'id_sistema_operativo' => [
                'type'       => 'SMALLINT',
                'constraint' => 6,
                'unsigned'   => true,
                'null'       => true,
            ],
            'id_resolucion' => [
                'type'       => 'SMALLINT',
                'constraint' => 6,
                'unsigned'   => true,
                'null'       => true,
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
        
        $this->forge->addForeignKey('id_marca', 'marca', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_estado', 'estado_producto', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_color', 'color', 'id_color', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_categoria', 'categoria', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_garantia', 'garantia', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_almacenamiento', 'almacenamiento', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_ram', 'almacenamiento_aleatorio', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_sistema_operativo', 'sistema_operativo', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_resolucion', 'resolucion', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('productos', true);
    }

    public function down()
    {
        $this->forge->dropTable('productos', true);
    }
}
