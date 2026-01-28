<?php

namespace App\Database\Seeds;

use App\Models\PeliculaModel;
use App\Models\CategoriaModel;
use CodeIgniter\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    public function run()
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();

        /*
        $categorias = $categoriaModel->limit(7)->findAll();

        foreach ($categorias as $index => $categoria) {
            $this->db->table('peliculas')->insert([
                'titulo' => 'Película ' . ($index + 1),
                'descripcion' => 'Descripción de la película ' . ($index + 1),
                'categoria_id' => $categoria['id']
            ]);
        }

        */

        $peliculaModel->where('id>=', 1)->delete();

        $peliculas = [
            [
                'titulo' => 'Inception',
                'descripcion' => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'categoria_id' => 2
            ],
            [
                'titulo' => 'The Matrix',
                'descripcion' => 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.',
                'categoria_id' => 3
            ],
            [
                'titulo' => 'Interstellar',
                'descripcion' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.',
                'categoria_id' => 4
            ],
            [
                'titulo' => 'The Dark Knight',
                'descripcion' => 'When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham.',
                'categoria_id' => 9
            ],
            [
                'titulo' => 'Pulp Fiction',
                'descripcion' => 'The lives of two mob hitmen, a boxer, a gangster\'s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.',
                'categoria_id' => 11
            ]
        ];

        foreach ($peliculas as $pelicula){
            $this->db->table('peliculas')->insert($pelicula);
        }
    }
}
