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
        <h3 class="titulo1">Llene los datos de su reserva</h3>
        <h3> (Sede <?= $local ?>) <h3>
        <form name="form_local" action="seleccion_mesa" method="post">
            <fieldset>
                <legend>Horarios Disponibles</legend>
                <input type="radio" id="hora1" name="horario" value="9:00">
                <label for="hora1">9:00 AM</label>
                <input type="radio" id="hora2" name="horario" value="9:30">
                <label for="hora2">9:30 AM</label>
                <input type="radio" id="hora3" name="horario" value="10:00">
                <label for="hora3">10:00 PM</label>
                <!-- Agregar más opciones de horario según sea necesario -->
            </fieldset>
            <label for="fecha">Seleccione un día:</label>
            <input type="date" id="fecha" name="fecha">
            <label for="texto">Nombre de los reservantes:</label>
            <input type="text" id="texto" name="texto">
            <input type="submit" value="Siguiente" class="submit"> <!-- BACKEND: Redireccionar a /reserva/seleccion_mesa -->
        </form>
    </main>

    <?php
        require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>