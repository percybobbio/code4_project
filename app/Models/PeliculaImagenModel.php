<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaImagenModel extends Model
{
    protected $table            = 'pelicula_imagen';
    protected $allowedFields    = ['imagen_id', 'pelicula_id'];
}
