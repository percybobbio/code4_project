<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('contenido') ?>
    <h1><?= $pelicula->titulo ?></h1>
    <p><?= $pelicula->descripcion ?></p>

    <h3>Imágenes</h3>
    <ul>
        <?php foreach($imagenes as $i) : ?>
            <li>
                <img src="<?= base_url('uploads/peliculas/' . $i->imagen) ?>" alt="Imagen de <?= $pelicula->titulo ?>" width="200">
                <form action="<?= route_to('pelicula.borrar_imagen', $i->id) ?>" method="post">
                    <button type="submit">Borrar</button>

                </form>

                <!--Cambiamos a get para descargar la imagen pues se desea leer la informacion-->
                <form action="<?= route_to('pelicula.descargar_imagen', $i->id) ?>" method="get">
                    <button type="submit">Descargar</button>

                </form>
            </li>
        <?php endforeach; ?>

    </ul>

    <h3>Etiquetas</h3>
    <ul>
        <?php foreach($etiquetas as $e) : ?>
            
                <button data-url="<?= route_to('pelicula.etiqueta.delete', $pelicula->id, $e->id) ?>" class="delete_etiqueta" type="submit"><?= $e->titulo ?></button>

        <?php endforeach; ?>

    </ul>

    <script>
        document.querySelectorAll('.delete_etiqueta').forEach((b)=>{
           b.onclick = function(){
            fetch(this.getAttribute('data-url'), {
                method: 'POST'
            }).then(res => res.json())
            .then(res => {
                window.location.reload();
                console.log(res)
            })
                } 
                
        });
    </script>
<?= $this->endSection() ?>