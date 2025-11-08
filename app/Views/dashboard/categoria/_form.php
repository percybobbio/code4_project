<label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" placeholder="Titulo" required value="<?= old('titulo', $categoria->titulo) ?>"><br><br>

        <button type="submit"><?= $op ?></button>