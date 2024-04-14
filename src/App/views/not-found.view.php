<?= require __DIR__ . "/layout/head.html" ?>
<body>
    <header>
        <h1>
            <a href="./">
                <picture>
                    <source srcset="./images/Logo(Light).svg" media="(min-width: 600px)">
                    <img alt="pawpower" src="./images/Logo(Light).svg">
                </picture>
            </a>
        </h1>
        <?php
        require 'layout/nav.view.php';
        ?>
    </header>
    <main>
        <h2>
            Bienvenido a PawPower!
        </h2>
        <p>
            Error, pagina no encontrada!
        </p>
    </main>
    
    <?= require 'layout/footer' ?>
</body>

</html>