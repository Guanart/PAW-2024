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
        <h3 class="titulo1">Elija las mesas a reservar</h3>
        <form name="form_seleccion_mesa" action="fin_reserva" method="post">
            <select class="select-hora" name="horario">
                <option value="09:00">09:00</option>
                <option value="10:30">10:30</option>
                <option value="12:00">12:00</option>
                <option value="13:30">13:30</option>
                <option value="15:00">15:00</option>
                <option value="16:30">16:30</option>
                <option value="18:00">18:00</option>
                <option value="19:30">19:30</option>
                <option value="21:00">21:00</option>
                <option value="22:30">22:30</option>
            </select>
            <label for="fecha">Seleccione un día:</label>
            <input type="date" class="input-fecha" name="fecha">
            <label for="nombres">Nombre de los reservantes:</label>
            <input type="text" id="nombres" name="nombres">


            <label for="localInput" class="labelLocalReserva">Mesa a reservar</label>
            <input type="text" id="localInput" name="localInput" class="inputLocalReserva" value="<?php echo htmlspecialchars($local); ?>">

            <label for="mesaInput" class="labelMesaReserva">Mesa a reservar</label>
            <input type="text" id="mesaInput" name="mesaInput" class="inputMesaReserva">
            <?php require __DIR__ . '/PlanoSucursalA.svg'?>
        


            <input type="submit" value="Hacer reserva" class="submit">
        </form>
        <a href="./local.html" class="left_arrow">Volver</a>
    </main>

    <?php
        require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>
</html>
