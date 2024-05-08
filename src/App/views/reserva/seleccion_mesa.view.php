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

            <label for="texto">Mesas a reservar</label>
            <input type="text" id="texto" name="texto">

            <div class="table-select">
            </div>


            <input type="submit" value="Hacer reserva" class="submit">
        </form>
        <a href="./local.html" class="left_arrow">Volver</a>
    </main>

    <?php
        require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>
</html>
