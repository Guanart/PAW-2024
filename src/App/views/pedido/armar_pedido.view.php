<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Armar pedido</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <meta name="description" content="Aqui puedes elegir los platos para tu pedido">
    <link rel="stylesheet" href="css/style.css">
</head>

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
            require __DIR__ . '/../layout/footer.view.php';
        ?>
    </header>

    <main>
        <h2 class="h2_index">Arme su pedido</h2>
        <form name="form_armar_pedido" action="armar_pedido.php" method="post">
            <section>
                <h3>Hamburguesas</h3>
                <article class="armar_pedido">
                    <picture>
                        <source srcset="../images/foto-hamburguesa-2-L.png" media="(min-width: 1024px)">
                        <source srcset="../images/foto-hamburguesa-2-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                        <source srcset="../images/foto-hamburguesa-2-S.png" media="(max-width: 480px)">
                        <img src="../images/foto-hamburguesa-2-L.png" >
                    </picture>
                    <h4>Hamburguesa 1</h4>
                    <p>Descripción 1</p>
                    <label for="cant_hamburguesa1">
                        Cantidad:<input id="cant_hamburguesa1" name="cant_hamburguesa1" type="number" value="0" min="0" max="20" step="1.0">
                    </label>
                    
                </article>

                <article class="armar_pedido">
                    <picture>
                        <source srcset="../images/foto-hamburguesa-3-L.png" media="(min-width: 1024px)">
                        <source srcset="../images/foto-hamburguesa-3-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                        <source srcset="../images/foto-hamburguesa-3-S.png" media="(max-width: 480px)">
                        <img src="../images/foto-hamburguesa-3-L.png" >
                    </picture>
                    <h4>Hamburguesa 2</h4>
                    <p>Descripción 2</p>
                    <label for="cant_hamburguesa2">
                        Cantidad:<input id="cant_hamburguesa2" name="cant_hamburguesa2" type="number" value="0" min="0" max="20" step="1.0">
                    </label>
                    
                </article>

                <article class="armar_pedido">
                    <picture>
                        <source srcset="../images/foto-hamburguesa-4-L.png" media="(min-width: 1024px)">
                        <source srcset="../images/foto-hamburguesa-4-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                        <source srcset="../images/foto-hamburguesa-4-S.png" media="(max-width: 480px)">
                        <img src="../images/foto-hamburguesa-4-L.png" >
                    </picture>
                    <h4>Hamburguesa 3</h4>
                    <p>Descripción 3</p>
                    <label for="cant_hamburguesa3">
                        Cantidad:<input id="cant_hamburguesa3" name="cant_hamburguesa3" type="number" value="0" min="0" max="20" step="1.0">
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
                        <img src="../images/foto-hamburguesa-5-L.png" >
                    </picture>
                    <h4>Otro producto 1</h4>
                    <p>Descripción 1</p>
                    <label for="cant_otroproducto1">
                        Cantidad: <input id="cant_otroproducto1" name="cant_otroproducto1" type="number" value="0" min="0" max="20" step="1.0">
                    </label>
                </article>

                <article class="armar_pedido">
                    <picture>
                        <source srcset="../images/foto-bebida-2-L.png" media="(min-width: 1024px)">
                        <source srcset="../images/foto-bebida-2-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                        <source srcset="../images/foto-bebida-2-S.png" media="(max-width: 480px)">
                        <img src="../images/foto-bebida-2-L.png" >
                    </picture>
                    <h4>Otro producto 2</h4>
                    <p>Descripción 2</p>
                    <label for="cant_otroproducto2">
                        Cantidad: <input id="cant_otroproducto2" name="cant_otroproducto2" type="number" value="0" min="0" max="20" step="1.0">
                    </label>
                </article>

                <article class="armar_pedido">
                    <picture>
                        <source srcset="../images/foto-bebida-1-L.png" media="(min-width: 1024px)">
                        <source srcset="../images/foto-bebida-1-M.png" media="(min-width: 481px) and (max-width: 1023px)"> 
                        <source srcset="../images/foto-bebida-1-S.png" media="(max-width: 480px)">
                        <img src="../images/foto-bebida-1-L.png" >
                    </picture>
                    <h4>Otro producto 3</h4>
                    <p>Descripción 3</p>
                    <label for="cant_otroproducto3">
                        Cantidad: <input id="cant_otroproducto3" name="cant_otroproducto3" type="number" value="0" min="0" max="20" step="1.0">
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