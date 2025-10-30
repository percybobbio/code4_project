<?= $this->extend('/Layouts/dashboard') ?>

<?= $this->section('contenido') ?>
    <form action="/dashboard/categoria/update/<?= $categoria['id'] ?>" method="post">
        <?= view('dashboard/categoria/_form', ['op' => 'Actualizar Categoría'])?>
    </form>
<?= $this->endSection() ?>


