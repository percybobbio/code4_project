<label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" placeholder="Titulo" required value="<?= $pelicula['titulo'] ?>"><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" placeholder="Descripcion" required>
            <?= $pelicula['descripcion'] ?>
        </textarea><br><br>

        <button type="submit"><?= $op ?></button>