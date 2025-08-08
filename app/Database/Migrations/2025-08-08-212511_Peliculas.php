<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peliculas extends Migration
{
    //En el caso de up y down son para crear y revertir respectivamente 
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                //Para que no tome valores negativos
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],

            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],

            'descripcion' => [
                'type' => 'TEXT',
                'null' => TRUE,

            ]
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('peliculas');

    }

    public function down()
    {
        $this->forge->dropTable('peliculas');
    }
}
