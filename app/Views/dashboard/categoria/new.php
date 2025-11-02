<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('contenido') ?>
<?= view('partials/_form-error') ?>
    <form action="/dashboard/categoria/create" method="post">
        <?= view('dashboard/categoria/_form', ['op' => 'Crear Categoría'])?>
    </form>
<?= $this->endSection() ?>


