<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <title>Pedido registrado</title>
    <meta name="description" content="Confirmación de que el pedido fue registrado">
    <link rel="stylesheet" href="../styles/style.css">
</head>
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
        <h2>Pedido registrado!</h2>
        <a href="../" class="link"><p>Volver al inicio</p></a>
    </main>
    <?php
        require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>
</html>
