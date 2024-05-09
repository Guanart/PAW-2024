
<?php require __DIR__ . "/../layout/head.view.php"; ?>
<body>
    <header>
        <h1>
            <a href="../">
                <picture>
                    <source srcset="../images/Logo(Light).svg" media="(min-width: 600px)">
                    <img alt="pawpower" src="../images/Logo(Light).svg">
                </picture>
            </a>
        </h1>
        <?php
        require __DIR__ . '/../layout/nav.view.php';
        ?>
    </header>

    <main>
        <section>
            <?php if ($mostrarPost) : ?>
                <h3><?= $mensaje ?></h3>
            <?php endif ?>
            <form name="form_ingresar_direccion" action="/ingresar_direccion" method="post">
                <label for="localidad">Localidad</label>
                <!-- <input id="localidad" name="localidad" type="com" required> -->
                <select name="localidad" id="localidad">
                    <option value="">--Elija una localidad--</option>
                    <option value="Lujan">Luján</option>
                    <option value="Moreno">Moreno</option>
                    <option value="Chivilcoy">Chivilcoy</option>
                    <option value="Gral. Rodriguez">Gral. Rodriguez</option>
                    <option value="Otro">Otro</option>
                </select>
                <label for="calle">Calle</label>
                <input id="calle" name="calle" type="text" required>
                <label for="altura">Altura</label>
                <input id="altura" name="altura" type="number" required>
                <label for="departamento">Departamento</label>
                <input id="departamento" name="departamento" type="number">
                <label for="descripcion">Descripcion de la ubicación</label>
                <input type="text" id="descripcion" name="descripcion">
                <input type="submit" class="submit">
            </form>
        </section>
    </main>

    <?php
    require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>