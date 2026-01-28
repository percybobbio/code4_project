<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;

class Etiqueta extends BaseController
{
   
    public function index()
    {
        $etiquetaModel = new EtiquetaModel();
    

        $data = [
            // Traemos películas con su categoría asociada
            'etiquetas' => $etiquetaModel
                ->select('etiquetas.*, categorias.titulo as categoria')
                ->join('categorias', 'categorias.id = etiquetas.categoria_id')
                ->findAll(),
        ];

        echo view('dashboard/etiqueta/index', $data);
    }

    public function new()
    {
        $categoriaModel = new CategoriaModel();

        //return redirect()->to('test');
        echo view('dashboard/etiqueta/new', [
            'etiqueta' => new EtiquetaModel(),
            'categorias' => $categoriaModel->find()
        ]);
    }

    public function show($id){
        $etiquetaModel = new EtiquetaModel();

        echo view('dashboard/etiqueta/show',
         [
            'etiqueta' => $etiquetaModel->find($id),
         ]);
    }

    public function create(){
        $etiquetaModel = new EtiquetaModel();

        if ($this->validate('etiquetas')) {
            $etiquetaModel->save([
                'titulo' => $this->request->getPost('titulo'),
                'categoria_id' => $this->request->getPost('categoria_id')
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
        $etiquetaModel = new EtiquetaModel();
        $categoriaModel = new CategoriaModel();

        echo view('dashboard/etiqueta/edit',[
            'etiqueta' => $etiquetaModel->find($id),
            'categorias' => $categoriaModel->find()
        ]);
    }

    public function update($id) {
        $etiquetaModel = new EtiquetaModel();

        if ($this->validate('etiquetas')) {
            $etiquetaModel->update($id,[
                'titulo' => $this->request->getPost('titulo'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ]);
        }else{
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }


        //return redirect()->to('/dashboard/pelicula');
        return redirect()->to('dashboard/etiqueta')->with('mensaje', 'Etiqueta actualizada correctamente');
    }

    public function delete($id){
        $etiquetaModel = new EtiquetaModel();
        $etiquetaModel->delete($id);
        return redirect()->back()->with('mensaje', 'Etiqueta eliminada correctamente');
    }

    
}