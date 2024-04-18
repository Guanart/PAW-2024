<?php require __DIR__ . "/layout/head.html" ?>
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
            Ups! Parece haber un error.
        </h2>
        <p>
            (500) - Error interno.
        </p>
    </main>
    
    <?php require 'layout/footer.view.php' ?>
</body>

</html>