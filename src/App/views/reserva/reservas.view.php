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
        <?php require __DIR__ . "/../layout/nav.view.php"; ?>
    </header>
    <main>
        <h2>Reserva en alguno de nuestros locales!</h2>
        <section>
            <article class="overflow_hidden informacion">
                <h3>Moreno</h3>
                <picture>
                    <source srcset="../images/local1-L.png" media="(min-width: 1024px)">
                    <source srcset="../images/local1-M.png" media="(min-width: 481px) and (max-width: 1023px)">
                    <source srcset="../images/local1-S.png" media="(max-width: 480px)">
                    <img src="../images/local1-L.png" id="imagen-local-moreno" alt="local de Moreno">
                </picture>
                <a href="local?local=moreno" class="link">Hacer Reserva</a>
                <a href="#" rel="external" target="_blank" class="link">Direcciones</a>    
            </article>
            <article class="overflow_hidden informacion">
                <h3>Gral. Rodriguez</h3>
                <picture>
                    <source srcset="../images/local2-L.png" media="(min-width: 1024px)">
                    <source srcset="../images/local2-M.png" media="(min-width: 481px) and (max-width: 1023px)">
                    <source srcset="../images/local2-S.png" media="(max-width: 480px)">
                    <img src="../images/local1-L.png" id="imagen-local-moreno" alt="local de Moreno">
                </picture>
                <a href="local?local=rodriguez" class="link">Hacer Reserva</a>
                <a href="#" rel="external" target="_blank" class="link">Direcciones</a>  
            </article>
            <article class="overflow_hidden informacion">
                <h3>Luján</h3>
                <picture>
                    <source srcset="../images/local3-L.png" media="(min-width: 1024px)">
                    <source srcset="../images/local3-M.png" media="(min-width: 481px) and (max-width: 1023px)">
                    <source srcset="../images/local3-S.png" media="(max-width: 480px)">
                    <img src="../images/local1-L.png" id="imagen-local-moreno" alt="local de Moreno">
                </picture>
                    <a href="local?local=lujan" class="link">Hacer Reserva</a>
                    <a href="#" rel="external" target="_blank" class="link">Direcciones</a>  
            </article>
            <article class="overflow_hidden informacion">
                <h3>Otro</h3>
                <picture>
                    <source srcset="../images/local4-L.png" media="(min-width: 1024px)">
                    <source srcset="../images/local4-M.png" media="(min-width: 481px) and (max-width: 1023px)">
                    <source srcset="../images/local4-S.png" media="(max-width: 480px)">
                    <img src="../images/local1-L.png" id="imagen-local-moreno" alt="local de Moreno">
                </picture>
                <a href="local?local=otro" class="link">Hacer Reserva</a>
                <a href="#" rel="external" target="_blank" class="link">Direcciones</a>  
            </article>
            <!-- Agrega más elementos según sea necesario -->
        </section>
    </main>
    <?php require __DIR__ . "/../layout/footer.view.php" ?>
</body>
</html>
