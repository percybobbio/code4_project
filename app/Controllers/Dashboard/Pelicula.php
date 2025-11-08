<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{
    public function test($id1, $id2)
    {
        echo 'Test method with ID1: ' . $id1 . ' and ID2: ' . $id2;
    }

    public function index()
    {
        $peliculaModel = new PeliculaModel();

        echo view('dashboard/pelicula/index',[
            'peliculas' => $peliculaModel->findAll()
        ]);
    }

    public function new()
    {
        //return redirect()->to('test');
        echo view('dashboard/pelicula/new', [
            'pelicula' => new PeliculaModel()
        ]);
    }

    public function show($id){
        $peliculaModel = new PeliculaModel();
        echo view('dashboard/pelicula/show',
         ['pelicula' => $peliculaModel->asObject()->find($id)]);
    }

    public function create(){
        $peliculaModel = new PeliculaModel();

        if ($this->validate('peliculas')) {
            $peliculaModel->save([
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion')
            ]);

        }else{
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }

        return redirect()->to('dashboard/pelicula')->with('mensaje', 'Película creada correctamente');
        
    }

    public function edit($id) {
        $peliculaModel = new PeliculaModel();

        echo view('dashboard/pelicula/edit',[
            'pelicula' => $peliculaModel->find($id)
        ]);
    }

    public function update($id) {
        $peliculaModel = new PeliculaModel();

        if ($this->validate('peliculas')) {
            $peliculaModel->update($id,[
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion')
            ]);
        }else{
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }


        //return redirect()->to('/dashboard/pelicula');
        return redirect()->to('dashboard/pelicula')->with('mensaje', 'Película actualizada correctamente');
    }

    public function delete($id){
        $peliculaModel = new PeliculaModel();
        $peliculaModel->delete($id);
        return redirect()->back()->with('mensaje', 'Película eliminada correctamente');
    }
}