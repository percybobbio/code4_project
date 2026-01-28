<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('contenido') ?>
        <a href="<?= route_to('test', 5, 10) ?>">Test</a>
    <a href="/dashboard/pelicula/new">Crear</a>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($peliculas as $key => $p) : ?>
                <tr>
                    <td><?= $p->id ?></td>
                    <td><?= $p->titulo ?></td>
                    <td><?= $p->descripcion ?></td>
                    <td><?= $p->categoria ?></td>
                    <td>
                        <a href="/dashboard/pelicula/show/<?= $p->id ?>">Ver</a>
                        <a href="/dashboard/pelicula/edit/<?= $p->id ?>">Editar</a>
                        <a href="<?= route_to('pelicula.etiquetas', $p->id) ?>">Etiqueta</a>
                        <form action="/dashboard/pelicula/delete/<?= $p->id ?>" method="post">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?= $this->endSection() ?>