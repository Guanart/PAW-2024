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
        <h2>
            Escanea el codigo QR de tu mesa!
        </h2>
        <?php if ($mostrarPost) : ?>
                <h3><?= $mensaje ?></h3>
        <?php endif ?>
        <form id="formulario" method="post" action="/seleccion_mesa_qr">
            <label for="codigo">Código</label>
            <input type="text" id="codigo" placeholder="Escribe el código acá">
            <input type="submit" value="Confirmar" class="submit">
        </form>
    </main>
    <?php
    require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>