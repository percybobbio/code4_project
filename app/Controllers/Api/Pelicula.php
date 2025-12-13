<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

/**
 * @property \CodeIgniter\HTTP\IncomingRequest $request
 */
class Pelicula extends ResourceController{
    protected $modelName = 'App\Models\PeliculaModel';

    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $pelicula = $this->model->find($id);
        
        if (!$pelicula) {
            return $this->failNotFound('Película no encontrada');
        }
        
        return $this->respond($pelicula);
    }

    public function create()
    {
        $data = $this->request->getJSON(true) ?: [
            'titulo' => $this->request->getVar('titulo'),
            'descripcion' => $this->request->getVar('descripcion'),
        ];

        if (!$this->validate('peliculas')) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $id = $this->model->insert($data);

        if ($id === false) {
            return $this->failServerError('Error al crear la película');
        }

        return $this->respondCreated(['id' => $id]);
    }

    public function update($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Película no encontrada');
        }

        $data = $this->request->getJSON(true) ?: [
            'titulo' => $this->request->getVar('titulo'),
            'descripcion' => $this->request->getVar('descripcion'),
        ];

        if (!$this->validate('peliculas')) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $updated = $this->model->update($id, $data);

        if ($updated === false) {
            return $this->failServerError('Error al actualizar la película');
        }

        return $this->respond(['status' => 'updated']);
    }

    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Película no encontrada');
        }

        if ($this->model->delete($id)) {
            return $this->respondDeleted(['status' => 'deleted']);
        }
        
        return $this->failServerError('Error al eliminar la película');
    }
}