<label for="titulo">Título:</label>
<input type="text" id="titulo" name="titulo" placeholder="Titulo" required value="<?= old('titulo', $pelicula->titulo) ?>"><br><br>

<label for="categoria_id">Categoria</label>
<select name="categoria_id" id="categoria_id">
    <option value=""></option>
    <?php foreach ($categorias as $c): ?>
        <option <?= $c->id == old('categoria_id', $pelicula->categoria_id) ? 'selected' : '' ?> value="<?= $c->id ?>"><?= $c->titulo ?></option>
    <?php endforeach; ?>
</select><br><br>
<label for="descripcion">Descripción:</label>
<textarea id="descripcion" name="descripcion" placeholder="Descripcion" required>
            <?= old('descripcion', $pelicula->descripcion) ?>
        </textarea><br><br>

<button type="submit"><?= $op ?></button>