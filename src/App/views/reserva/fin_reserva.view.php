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
        <h3 class="titulo1">Reserva registrada!</h3>
        <a href="../" class="link">Volver al inicio</a>
    </main>

    <?php
    require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>