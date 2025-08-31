<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
</head>
<body>
    <h1>Listado de peliculas</h1>

    <a href="/pelicula/new">Crear</a>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($peliculas as $key => $p) : ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= $p['titulo'] ?></td>
                    <td><?= $p['descripcion'] ?></td>
                    <td>
                        <a href="/pelicula/show/<?= $p['id'] ?>">Ver</a>
                        <a href="/pelicula/edit/<?= $p['id'] ?>">Editar</a>
                        <form action="/pelicula/delete/<?= $p['id'] ?>" method="post">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>