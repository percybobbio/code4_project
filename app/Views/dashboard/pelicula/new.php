<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('contenido') ?>
    <form action="/dashboard/pelicula/create" method="post">
        <?= view('dashboard/pelicula/_form', ['op' => 'Crear Película'])?>
    </form>
<?= $this->endSection() ?>

