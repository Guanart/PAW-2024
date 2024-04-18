<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <title>Verificar cuenta</title>
    <meta name="description" content="Aquí debes ingresar el codigo de verificación, para recuperar tu cuenta">
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
        <section class="informacion">
            <p>Código de verificación enviado a {{ email }}. Ingresa al link que te hemos enviado para restablecer tu
                contraseña.</p>
        </section>
    </main>
    <?php
        require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>