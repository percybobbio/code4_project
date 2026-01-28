<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('contenido') ?>
        <a href="<?= route_to('test', 5, 10) ?>">Test</a>
    <a href="/dashboard/etiqueta/new">Crear</a>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Categoría</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($etiquetas as $key => $e) : ?>
                <tr>
                    <td><?= $e->id ?></td>
                    <td><?= $e->titulo ?></td>
                    <td><?= $e->categoria_id ?></td>
                    <td>
                        <a href="/dashboard/etiqueta/show/<?= $e->id ?>">Ver</a>
                        <a href="/dashboard/etiqueta/edit/<?= $e->id ?>">Editar</a>
                        <form action="/dashboard/etiqueta/delete/<?= $e->id ?>" method="post">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?= $this->endSection() ?>