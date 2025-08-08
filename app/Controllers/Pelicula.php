<?php

namespace App\Controllers;

class Pelicula extends BaseController
{
    public function index()
    {
        $data = [
            'nombreVariableVista' => 'Contenido',
            'nombreVariableVista2' => 'Contenido2',
            'nombreVariableVista3' => 5,
            'miArray' => [1,2,3,4,5]
        ];
        echo view('index', $data);
    }
}