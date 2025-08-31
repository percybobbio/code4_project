<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Pelicula</title>
</head>
<body>
    <form action="/pelicula/update/<?= $pelicula['id'] ?>" method="post">
        <?= view('pelicula/_form', ['op' => 'Actualizar Película'])?>
    </form>
</body>
</html>