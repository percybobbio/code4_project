<?= $this->extend('/Layouts/web') ?>
<?= $this->section('contenido') ?>

<?= view('partials/_form-error') ?>
    
<form action="<?= route_to('usuario.login_post') ?>" method="post">
    <label for="email">Usuario/Email</label>
    <input type="text" name="email" id="email">

    <label for="contrasena">Contraseña</label>
    <input type="text" name="contrasena" id="contrasena">

    <button type="submit">Iniciar sesión</button>
</form>
<?= $this->endSection() ?>