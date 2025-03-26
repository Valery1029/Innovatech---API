<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPermisosModelosRol extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Permisosid' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => false,
            ],
            'Modelos_RolModelosid' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => false,
            ],
            'Modelos_RolRolid' => [
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

        $this->forge->addKey(['Permisosid', 'Modelos_RolModelosid', 'Modelos_RolRolid'], true);
        $this->forge->addForeignKey('Permisosid', 'permisos', 'id', 'CASCADE', 'CASCADE', 'fk_perm_model');
        $this->forge->addForeignKey(['Modelos_RolModelosid', 'Modelos_RolRolid'], 'modelos_rol', ['Modelosid', 'Rolid'], 'CASCADE', 'CASCADE', 'fk_mod_rol');
        
        $this->forge->createTable('permisos_modelos_rol', true);
    }

    public function down()
    {
        $this->forge->dropTable('permisos_modelos_rol', true);
    }
}
