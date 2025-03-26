<?php 

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOfertas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'descuento' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,0',
                'null'       => false
            ],
            'imagen' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false
            ],
            'fechaini' => [
                'type'    => 'DATETIME',
                'null'    => false, 
            ],
            'fechafin' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'descripcion' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ],
            'estado' => [
                'type'       => 'BIT',
                'constraint' => 1,
                'null'       => false
            ],
            'productos_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => false
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
        $this->forge->addForeignKey('productos_id', 'productos', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('ofertas');
    }

    public function down()
    {
        $this->forge->dropTable('ofertas');
    }
}
