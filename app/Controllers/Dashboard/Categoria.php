<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;

class Categoria extends BaseController
{
    public function index()
    {
        session()->set('key', 'value');
        $categoriaModel = new CategoriaModel();
        echo view('dashboard/categoria/index',[
            'categorias' => $categoriaModel->findAll()
        ]);
    }

    public function new()
    {
        var_dump(session()->get('key'));
        echo view('dashboard/categoria/new', [
            'categoria' => [
                'titulo' => ''
            ]
        ]);
    }

    public function show($id){
        $categoriaModel = new CategoriaModel();
        echo view('dashboard/categoria/show', ['categoria' => $categoriaModel->find($id)]);
    }

    public function create(){
        $categoriaModel = new CategoriaModel();

        if ($this->validate('categorias')) {
            $categoriaModel->save([
                'titulo' => $this->request->getPost('titulo'),
            ]);
        }else{
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }

        return redirect()->to('dashboard/categoria')->with('mensaje', 'Categoría creada correctamente');
    }

    public function edit($id) {
        $categoriaModel = new CategoriaModel();

        echo view('dashboard/categoria/edit',[
            'categoria' => $categoriaModel->find($id)
        ]);
    }

    public function update($id) {
        $categoriaModel = new CategoriaModel();

        if($this->validate('categorias')){
            $categoriaModel->update($id,[
                'titulo' => $this->request->getPost('titulo'),
            ]);
        }else{
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }

        return redirect()->to('dashboard/categoria')->with('mensaje', 'Categoría actualizada correctamente');
    }

    public function delete($id){
        $categoriaModel = new CategoriaModel();
        $categoriaModel->delete($id);

        session()->setFlashdata('mensaje', 'Categoría eliminada correctamente');
        return redirect()->back();
    }
}