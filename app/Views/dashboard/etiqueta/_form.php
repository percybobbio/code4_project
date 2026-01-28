<label for="titulo">Título:</label>
<input type="text" id="titulo" name="titulo" placeholder="Titulo" required value="<?= old('titulo', $etiqueta->titulo) ?>"><br><br>

<label for="categoria_id">Categoria</label>
<select name="categoria_id" id="categoria_id">
    <option value=""></option>
    <?php foreach ($categorias as $c): ?>
        <option <?= $c->id == old('categoria_id', $etiqueta->categoria_id) ? 'selected' : '' ?> value="<?= $c->id ?>"><?= $c->titulo ?></option>
    <?php endforeach; ?>
</select><br><br>

<button type="submit"><?= $op ?></button>