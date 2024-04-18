<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Elegir local</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <meta name="description" content="Aqui puedes elegir el local en el que vas a retirar el pedido">
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

    <main class="main_elegir_local">
        <form name="form_elegir_local" action="elegir_local.php" method="post">
            <legend>Elegí el local</legend>
            <fieldset>
                <input id="input_moreno" name="localidad" type="radio" value="Moreno">
                <label for="input_moreno">Moreno</label>
                <input id="input_rodriguez" name="localidad" type="radio" value="Rodríguez">
                <label for="input_rodriguez">Rodríguez</label>
                <input id="input_lujan" name="localidad" type="radio" value="Luján">
                <label for="input_lujan">Luján</label>
                <input id="input_chivilcoy" name="localidad" type="radio" value="Chivilcoy">
                <label for="input_chivilcoy">Chivilcoy</label>
                <input class="submit" type="submit" value="Siguiente">
            </fieldset>
        </form>
    </main>

    <?php
        require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>