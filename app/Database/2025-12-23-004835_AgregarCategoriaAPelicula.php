<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarCategoriaAPelicula extends Migration
{
    public function up()
    {

        
        // PRIMERO: Cambiar motor a InnoDB (obligatorio para FK)
        $this->db->query("ALTER TABLE peliculas ENGINE=InnoDB;");
        $this->db->query("ALTER TABLE categorias ENGINE=InnoDB;");

        // Agregar columna
        $this->forge->addColumn('peliculas', [
            'categoria_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
                'after' => 'descripcion',
            ],
        ]);

        // Agregar índice antes de la FK
        $this->forge->addKey('categoria_id');

        // Agregar FK
        $this->forge->addForeignKey(
            'categoria_id',
            'categorias',
            'id',
            'CASCADE',
            'SET NULL',
            'fk_peliculas_categoria'
        );
    }

    public function down()
    {
        //$this->forge->dropForeignKey('peliculas', 'fk_peliculas_categoria');
        $this->forge->dropColumn('peliculas', 'categoria_id');
    }
}
