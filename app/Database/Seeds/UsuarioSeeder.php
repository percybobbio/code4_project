<?php

namespace App\Database\Seeds;

use App\Models\UsuarioModel;
use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        //
         $usuarioModel = new UsuarioModel();
        
        $usuarioModel->insert([
            'usuario'    => 'admin',
            'email'      => 'admin@gmail.com',
            'contrasena' => $usuarioModel->contrasenaHash('13245'),
            'tipo'       => 'admin',
        ]);
    }
}
