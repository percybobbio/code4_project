<?= $this->extend('/Layouts/dashboard') ?>

<?= $this->section('header') ?>
    <h1>Listado de categorias</h1>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
    <a href="/dashboard/categoria/new">Crear</a>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categorias as $key => $p) : ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= $p['titulo'] ?></td>
                    <td>
                        <a href="/dashboard/categoria/show/<?= $p['id'] ?>">Ver</a>
                        <a href="/dashboard/categoria/edit/<?= $p['id'] ?>">Editar</a>
                        <form action="/dashboard/categoria/delete/<?= $p['id'] ?>" method="post">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?= $this->endSection() ?>
