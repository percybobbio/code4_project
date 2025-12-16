<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use CodeIgniter\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categoriaModel = new CategoriaModel();

        //Para reiniciar la tabla y el contador de IDs
        //$categoriaModel->truncate();

        $categoriaModel->where('id>=', 1)->delete();

        $categorias = [
            ['titulo' => 'Acción'],
            ['titulo' => 'Comedia'],
            ['titulo' => 'Drama'],
            ['titulo' => 'Terror'],
            ['titulo' => 'Ciencia Ficción'],
            ['titulo' => 'Romance'],
            ['titulo' => 'Aventura'],
            ['titulo' => 'Animación'],
            ['titulo' => 'Documental'],
            ['titulo' => 'Fantasía']
        ];

        foreach ($categorias as $categoria) {
            $this->db->table('categorias')->insert($categoria);
        }
    }
}
