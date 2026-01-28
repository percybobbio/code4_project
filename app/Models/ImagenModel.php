<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagenModel extends Model
{
    protected $table            = 'imagenes';
    protected $returnType       = 'object';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['imagen', 'extension', 'data'];

    public function getPeliculasById($id){
        $this->select("p.*");
        $this->join("pelicula_imagen pi", "pi.imagen_id = imagenes.id");
        $this->join("peliculas p", "p.id = pi.pelicula_id");
        $this->where("imagenes.id", $id);
        return $this->findAll();
    }
}
