<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

/**
 * @property \CodeIgniter\HTTP\IncomingRequest $request
 */
class Categoria extends ResourceController{
    protected $modelName = 'App\Models\CategoriaModel';

    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $categoria = $this->model->find($id);
        
        if (!$categoria) {
            return $this->failNotFound('Categoría no encontrada');
        }
        
        return $this->respond($categoria);
    }

    public function create()
    {
        $data = $this->request->getJSON(true) ?: [
            'titulo' => $this->request->getVar('titulo'),
        ];

        if (!$this->validate('categorias')) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $id = $this->model->insert($data);

        if ($id === false) {
            return $this->failServerError('Error al crear la categoría');
        }

        return $this->respondCreated(['id' => $id]);
    }

    public function update($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Categoría no encontrada');
        }

        $data = $this->request->getJSON(true) ?: [
            'titulo' => $this->request->getVar('titulo'),
        ];

        if (!$this->validate('categorias')) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $updated = $this->model->update($id, $data);

        if ($updated === false) {
            return $this->failServerError('Error al actualizar la categoría');
        }

        return $this->respond(['status' => 'updated']);
    }

    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Categoría no encontrada');
        }

        if ($this->model->delete($id)) {
            return $this->respondDeleted(['status' => 'deleted']);
        }
        
        return $this->failServerError('Error al eliminar la categoría');
    }
}