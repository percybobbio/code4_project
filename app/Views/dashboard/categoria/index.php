<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
</head>
<body>
    <h1>Listado de categorias</h1>

    <?= view('/partials/_session') ?>
    <?= session('key') ?>

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
</body>
</html>