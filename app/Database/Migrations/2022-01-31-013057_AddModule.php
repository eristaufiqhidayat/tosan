<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddModule extends Migration
{
    public function up()
    {
        // Users

        $fields = [
            'id_menu'          => ['type' => 'int', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'id_module'        => ['type' => 'int', 'constraint' => 5],
            'path' => ['type' => 'varchar', 'constraint' => 50],
            'menu' => ['type' => 'varchar', 'constraint' => 50],
            'icon' => ['type' => 'varchar', 'constraint' => 50, 'DEFAULT' => NULL],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey('id_menu', true);
        $this->forge->createTable('tbl_menu', true);

        $fields = [
            'id_module'          => ['type' => 'int', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'nama_module' => ['type' => 'varchar', 'constraint' => 50],
            'icon' => ['type' => 'varchar', 'constraint' => 50, 'DEFAULT' => NULL],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey('id_module', true);
        $this->forge->createTable('tbl_module', true);
    }

    //--------------------------------------------------------------------

    public function down()
    {
        // drop constraints first to prevent errors

    }
}
