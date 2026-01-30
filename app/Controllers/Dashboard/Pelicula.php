<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
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

        //uso de la funcion privada para generar una imagen de prueba
        //$this->generar_imagen();
        //$this->asignar_imagen();

        $data = [
            // Traemos películas con su categoría asociada
            'peliculas' => $peliculaModel
                ->select('peliculas.*, categorias.titulo as categoria')
                ->join('categorias', 'categorias.id = peliculas.categoria_id')
                ->findAll(),
        ];

        echo view('dashboard/pelicula/index', $data);
    }

    public function new()
    {
        $categoriaModel = new CategoriaModel();

        //return redirect()->to('test');
        echo view('dashboard/pelicula/new', [
            'pelicula' => new PeliculaModel(),
            'categorias' => $categoriaModel->find()
        ]);
    }

    public function show($id)
    {
        $peliculaModel = new PeliculaModel();
        $imagenModel = new ImagenModel();

        //var_dump($peliculaModel->getImagesById($id));
        //var_dump($imagenModel->getPeliculasById(2));

        echo view(
            'dashboard/pelicula/show',
            [
                'pelicula' => $peliculaModel->asObject()->find($id),
                'imagenes' => $peliculaModel->getImagesById($id),
                'etiquetas' => $peliculaModel->getEtiquetasById($id)
            ]
        );
    }

    public function create()
    {
        $peliculaModel = new PeliculaModel();

        if ($this->validate('peliculas')) {
            $peliculaModel->save([
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }

        return redirect()->to('dashboard/pelicula')->with('mensaje', 'Película creada correctamente');
    }

    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();

        echo view('dashboard/pelicula/edit', [
            'pelicula' => $peliculaModel->find($id),
            'categorias' => $categoriaModel->find()
        ]);
    }

    public function update($id)
    {
        $peliculaModel = new PeliculaModel();

        if ($this->validate('peliculas')) {
            $peliculaModel->update($id, [
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ]);

            // Llamada a la función privada para subir la imagen
            $this->subir_imagen($id);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }


        //return redirect()->to('/dashboard/pelicula');
        return redirect()->to('dashboard/pelicula')->with('mensaje', 'Película actualizada correctamente');
    }

    public function delete($id)
    {
        $peliculaModel = new PeliculaModel();
        $peliculaModel->delete($id);
        return redirect()->back()->with('mensaje', 'Película eliminada correctamente');
    }

    public function etiquetas($id)
    {
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        $peliculaModel = new PeliculaModel();

        $etiquetas = [];

        if ($this->request->getGet('categoria_id')) {
            $etiquetas = $etiquetaModel->where('categoria_id', $this->request->getGet('categoria_id'))->findAll();
        }

        echo view('dashboard/pelicula/etiquetas', [
            'pelicula' => $peliculaModel->find($id),
            'categorias' => $categoriaModel->findAll(),
            'categoria_id' => $this->request->getGet('categoria_id'),
            'etiquetas' => $etiquetas
        ]);
    }

    public function etiquetas_post($id)
    {
        // Aquí iría la lógica para manejar el envío del formulario de etiquetas
        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();
        $etiquetaId = $this->request->getPost('etiqueta_id');
        $peliculaId = $id;
        $peliculaEtiqueta = $peliculaEtiquetaModel
            ->where('etiqueta_id', $etiquetaId)
            ->where('pelicula_id', $peliculaId)
            ->first();

        if (!$peliculaEtiqueta) {
            $peliculaEtiquetaModel->insert([
                'pelicula_id' => $peliculaId,
                'etiqueta_id' => $etiquetaId
            ]);
        }

        return redirect()->back()->with('mensaje', 'Etiqueta asignada correctamente');
    }

    public function etiqueta_delete($id, $etiqueta_id)
    {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta
            ->where('pelicula_id', $id)
            ->where('etiqueta_id', $etiqueta_id)
            ->delete();

        return $this->response->setJSON(['message' => 'Etiqueta eliminada correctamente']);
    }

    private function subir_imagen($peliculaId)
    {
        // Lógica para subir una imagen y asociarla a la película
        $imagefile = $this->request->getFile('imagen');
        if ($imagefile->isValid()) {
            $validated = $this->validate([
                'imagen' => 'uploaded[imagen]|max_size[imagen,4096]|is_image[imagen]|mime_in[imagen,image/jpg,image/jpeg,image/png]'
            ]);

            if ($validated) {
                $imagenNombre = $imagefile->getRandomName();
                $imagefile->move('../public/uploads/peliculas', $imagenNombre);

                $imagenModel = new ImagenModel();
                $imagenId = $imagenModel->insert([
                    'imagen' => $imagenNombre,
                    'extension' => $imagefile->getClientExtension(),
                    'data' => 'Descripción de la imagen'
                ]);

                $peliculaImagenModel = new PeliculaImagenModel();;
                $peliculaImagenModel->insert([
                    'imagen_id' => $imagenId,
                    'pelicula_id' => $peliculaId
                ]);
            }

            return $this->validator->listErrors();
        }
    }

    public function borrar_imagen($imagenId){
        $imagenModel = new ImagenModel();
        $peliculaImagenModel = new PeliculaImagenModel();

        $imagen =$imagenModel->find($imagenId);

        if($imagen == null){
            return redirect()->back()->with('error', 'La imagen no existe');
        }

        $imageRuta = FCPATH . 'uploads/peliculas/' . $imagen->imagen;
        unlink($imageRuta);
        
        $peliculaImagenModel->where('imagen_id', $imagenId)->delete();
        $imagenModel->delete($imagenId);

        return redirect()->back()->with('mensaje', 'Imagen eliminada correctamente');
    }

    public function descargar_imagen($imagenId){
        $imagenModel = new ImagenModel();
        $imagen = $imagenModel->find($imagenId);

        if($imagen == null){
            return redirect()->back()->with('error', 'La imagen no existe');
        }

        //Usamos response porque ya tenemos la respuesta preparada para descargas, se pasa el parametro null para indicar que no tenemos data extra
        return $this->response->download(FCPATH . 'uploads/peliculas/' . $imagen->imagen , null)->setFileName('imagen.' . $imagen->extension);
    }
}
