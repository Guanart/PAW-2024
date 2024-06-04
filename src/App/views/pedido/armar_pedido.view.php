<?php require __DIR__ . "/../layout/head.view.php"; ?>

<body>
    <header>
        <h1>
            <a href="../">
                <picture>
                    <source srcset="/images/Logo(Light).svg" media="(min-width: 600px)">
                    <img alt="pawpower" src="/images/Logo(Light).svg">
                </picture>
            </a>
        </h1>
        <?php
            require __DIR__ . '/../layout/nav.view.php';
        ?>
    </header>

    <main>
        <h2 class="h2_index">Arme su pedido</h2>
        <form name="form_armar_pedido" action="/armar_pedido" method="post">
            <section>
                <h3>Hamburguesas</h3>
                <article class="armar_pedido">
                    <picture>
                        <source srcset="../images/foto-hamburguesa-2-L.png" media="(min-width: 1024px)">
                        <source srcset="../images/foto-hamburguesa-2-M.png" media="(min-width: 481px) and (max-width: 1023px)">
                        <source srcset="../images/foto-hamburguesa-2-S.png" media="(max-width: 480px)">
                        <img src="../images/foto-hamburguesa-2-L.png">
                    </picture>
                    <h4>Hamburguesa 1</h4>
                    <p>Descripción 1</p>
                    <label for="hamburguesa1">
                        Cantidad:<input id="hamburguesa1" name="hamburguesa1" type="number" value="0" min="0" max="20" step="1.0">
                    </label>

                </article>

                <article class="armar_pedido">
                    <picture>
                        <source srcset="../images/foto-hamburguesa-3-L.png" media="(min-width: 1024px)">
                        <source srcset="../images/foto-hamburguesa-3-M.png" media="(min-width: 481px) and (max-width: 1023px)">
                        <source srcset="../images/foto-hamburguesa-3-S.png" media="(max-width: 480px)">
                        <img src="../images/foto-hamburguesa-3-L.png">
                    </picture>
                    <h4>Hamburguesa 2</h4>
                    <p>Descripción 2</p>
                    <label for="hamburguesa2">
                        Cantidad:<input id="hamburguesa2" name="hamburguesa2" type="number" value="0" min="0" max="20" step="1.0">
                    </label>

                </article>

                <article class="armar_pedido">
                    <picture>
                        <source srcset="../images/foto-hamburguesa-4-L.png" media="(min-width: 1024px)">
                        <source srcset="../images/foto-hamburguesa-4-M.png" media="(min-width: 481px) and (max-width: 1023px)">
                        <source srcset="../images/foto-hamburguesa-4-S.png" media="(max-width: 480px)">
                        <img src="../images/foto-hamburguesa-4-L.png">
                    </picture>
                    <h4>Hamburguesa 3</h4>
                    <p>Descripción 3</p>
                    <label for="hamburguesa3">
                        Cantidad:<input id="hamburguesa3" name="hamburguesa3" type="number" value="0" min="0" max="20" step="1.0">
                    </label>

                </article>
            </section>
            <section>
                <h3>Otros productos</h3>
                <article class="armar_pedido">
                    <picture>
                        <source srcset="../images/foto-hamburguesa-5-L.png" media="(min-width: 1024px)">
                        <source srcset="../images/foto-hamburguesa-5-M.png" media="(min-width: 481px) and (max-width: 1023px)">
                        <source srcset="../images/foto-hamburguesa-5-S.png" media="(max-width: 480px)">
                        <img src="../images/foto-hamburguesa-5-L.png">
                    </picture>
                    <h4>Otro producto 1</h4>
                    <p>Descripción 1</p>
                    <label for="otroproducto1">
                        Cantidad: <input id="otroproducto1" name="otroproducto1" type="number" value="0" min="0" max="20" step="1.0">
                    </label>
                </article>

                <article class="armar_pedido">
                    <picture>
                        <source srcset="../images/foto-bebida-2-L.png" media="(min-width: 1024px)">
                        <source srcset="../images/foto-bebida-2-M.png" media="(min-width: 481px) and (max-width: 1023px)">
                        <source srcset="../images/foto-bebida-2-S.png" media="(max-width: 480px)">
                        <img src="../images/foto-bebida-2-L.png">
                    </picture>
                    <h4>Otro producto 2</h4>
                    <p>Descripción 2</p>
                    <label for="otroproducto2">
                        Cantidad: <input id="otroproducto2" name="otroproducto2" type="number" value="0" min="0" max="20" step="1.0">
                    </label>
                </article>

                <article class="armar_pedido">
                    <picture>
                        <source srcset="../images/foto-bebida-1-L.png" media="(min-width: 1024px)">
                        <source srcset="../images/foto-bebida-1-M.png" media="(min-width: 481px) and (max-width: 1023px)">
                        <source srcset="../images/foto-bebida-1-S.png" media="(max-width: 480px)">
                        <img src="../images/foto-bebida-1-L.png">
                    </picture>
                    <h4>Otro producto 3</h4>
                    <p>Descripción 3</p>
                    <label for="otroproducto3">
                        Cantidad: <input id="otroproducto3" name="otroproducto3" type="number" value="0" min="0" max="20" step="1.0">
                    </label>
                </article>
            </section>

            <input class="submit" type="submit" id="boton_enviar" name="boton_enviar">
        </form>
    </main>
    <?php
    require __DIR__ . '/../layout/footer.view.php';
    ?>
</body>

</html>