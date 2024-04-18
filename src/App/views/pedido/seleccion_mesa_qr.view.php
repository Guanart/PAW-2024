<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Ingresa tu mesa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <meta name="description" content="Página para ingresar el código de mesa">
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
        <h2>
            Escanea el codigo QR de tu mesa!
        </h2>
        <form id="formulario">
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