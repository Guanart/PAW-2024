<?php require "layout/head.view.php"; ?>
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
        <?php require 'layout/nav.view.php'; ?>
    </header>
    <main class="menu">
        <section>
            <H2>Hamburguesas</H2>
            <article class="armar_pedido">
                <picture>
                    <source srcset="../images/foto-hamburguesa-5-L.png" media="(min-width: 1024px)">
                    <source srcset="../images/foto-hamburguesa-5-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                    <source srcset="../images/foto-hamburguesa-5-S.png" media="(max-width: 480px)">
                    <img src="../images/foto-hamburguesa-5-L.png" >
                </picture>
                <h3>Combo 1</h3>
                <p>$9,99</p>
            </article>
            <article class="armar_pedido">
                <picture>
                    <source srcset="./images/foto-hamburguesa-2-L.png" media="(min-width: 1024px)">
                    <source srcset="./images/foto-hamburguesa-2-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                    <source srcset="./images/foto-hamburguesa-2-S.png" media="(max-width: 480px)">
                    <img src="./images/foto-hamburguesa-2-L.png" >
                </picture>
                <h3>Combo 2</h3>
                <p>$9,99</p>
            </article>
            <article class="armar_pedido">
                <picture>
                    <source srcset="./images/foto-hamburguesa-3-L.png" media="(min-width: 1024px)">
                    <source srcset="./images/foto-hamburguesa-3-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                    <source srcset="./images/foto-hamburguesa-3-S.png" media="(max-width: 480px)">
                    <img src="./images/foto-hamburguesa-3-L.png" >
                </picture>
                <h3>Combo 3</h3>
                <p>$9,99</p>
            </article>
            <article class="armar_pedido">
                <picture>
                    <source srcset="./images/foto-hamburguesa-4-L.png" media="(min-width: 1024px)">
                    <source srcset="./images/foto-hamburguesa-4-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                    <source srcset="./images/foto-hamburguesa-4-S.png" media="(max-width: 480px)">
                    <img src="./images/foto-hamburguesa-4-L.png" >
                </picture>
                <h3>Combo 4</h3>
                <p>$9,99</p>
            </article>
        </section>
        <section>
            <h2>Acompañamientos</h2>
            <article class="armar_pedido">
                <picture>
                    <source srcset="./images/foto-hamburguesa-5-L.png" media="(min-width: 1024px)">
                    <source srcset="./images/foto-hamburguesa-5-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                    <source srcset="./images/foto-hamburguesa-5-S.png" media="(max-width: 480px)">
                    <img src="./images/foto-hamburguesa-5-L.png" >
                </picture>
                <h3>Combo 5</h3>
                <p>$9,99</p>
            </article>
            <article class="armar_pedido">
                <picture>
                    <source srcset="../images/foto-bebida-2-L.png" media="(min-width: 1024px)">
                    <source srcset="../images/foto-bebida-2-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                    <source srcset="../images/foto-bebida-2-S.png" media="(max-width: 480px)">
                    <img src="../images/foto-bebida-2-L.png" >
                </picture>
                <h3>Combo 6</h3>
                <p>$9,99</p>
            </article>
            <article class="armar_pedido">
                <picture>
                    <source srcset="./images/foto-bebida-1-L.png" media="(min-width: 1024px)">
                    <source srcset="./images/foto-bebida-1-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                    <source srcset="./images/foto-bebida-1-S.png" media="(max-width: 480px)">
                    <img src="./images/foto-hamburguesa-1-L.png" >
                </picture>
                <h3>Combo 7</h3>
                <p>$9,99</p>
            </article>
        </section>
        <a href="./pedido/hacer_pedido.html" class="button">Hacer pedido</a>
    </main>
    <?php require 'layout/footer.view.php' ?>
</body>

</html>