<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <title>Seleccionar Mesa</title>
    <meta name="description" content="Esta página permite elegir la mesa de la reserva">
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
        <h3 class="titulo1">Llene los datos de su reserva</h3>
        <form name="form_seleccion_mesa" action="seleccion_mesa.php" method="post">
            <fieldset>
                <legend>Seleccione una mesa:</legend>
                <input type="radio" id="mesa1" name="mesa" value="1">
                <label for="mesa1">Mesa para 2</label>
                <input type="radio" id="mesa2" name="mesa" value="2">
                <label for="mesa2">Mesa para 4</label>
                <input type="radio" id="mesa3" name="mesa" value="3">
                <label for="mesa3">Mesa para 6</label>
                <!-- Agregar más opciones de mesa según sea necesario -->
            </fieldset>
            <input type="submit" value="Hacer reserva" class="submit">
        </form>
        <a href="./local.html" class="left_arrow">Volver</a>
    </main>

    <?php
        require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>
</html>
