<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modulo de dashboard</title>
</head>
<body>
    <p>hola Mundo</p>
    <?= $this->renderSection('header')?>
    <?= view('/partials/_session') ?>
    <?= session('key') ?>
    <?= $this->renderSection('contenido') ?>
</body>
</html>