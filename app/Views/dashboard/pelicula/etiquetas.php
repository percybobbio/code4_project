<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('contenido') ?>
<form action="" method="post">
    <label for="categoria_id">Categoría</label>
    <select name="categoria_id" id="categoria_id">
        <option value=""></option>
        <?php foreach ($categorias as $c): ?>
            <option <?= ($c->id == $categoria_id) ? 'selected' : '' ?> value="<?= $c->id ?>"><?= $c->titulo ?></option>
        <?php endforeach; ?>
    </select>

    <label for="etiqueta_id">Etiqueta</label>
    <select name="etiqueta_id" id="etiqueta_id">
        <option value=""></option>
        <?php foreach ($etiquetas as $e): ?>
            <option value="<?= $e->id ?>"><?= $e->titulo ?></option>
        <?php endforeach; ?>
    </select>
    
    <button type="submit" id="send">Enviar</button>

</form>

<script>
    function disabledButton(){
        if(document.querySelector('#etiqueta_id').value == ''){
            document.querySelector('#send').setAttribute('disabled', 'true');
        }else{
            document.querySelector('#send').removeAttribute('disabled');
        }
    }

    document.querySelector('#categoria_id').onchange = function(){
        window.location.href = '<?= route_to('pelicula.etiquetas', $pelicula->id) ?>?categoria_id=' + this.value;
    }

    document.querySelector('#etiqueta_id').onchange = function(){
        disabledButton();
    }

    disabledButton();
</script>
<?= $this->endSection() ?>