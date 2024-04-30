<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <title>Recuperar contraseña</title>
    <meta name="description" content="Aquí puedes recuperar tu cuenta en caso de que hayas olvidado tu contraseña">
    <link rel="stylesheet" href="css/style.css">
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
        <form name="form_forgot-password" action="/forgot-password" method="POST">
            <label for="mail">Correo electrónico</label>
            <input type="email" id="mail" name="email" required autofocus>
            <input type="submit" value="Enviar código" class="submit">
        </form>
    </main>
    <?php
        require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>