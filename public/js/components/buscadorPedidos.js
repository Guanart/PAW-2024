class BuscadorPedidos {
    constructor() {
        let css = tools.nuevoElemento("link", "", {rel: "stylesheet", href: "/js/components/styles/seguimientoPedido.css"});
        document.head.appendChild(css);

        this.articles = document.querySelectorAll("article");
    }

    seguirPedidos() {
        this.articles.forEach((articulo) => {
            new SeguimientoPedido(articulo);
        });
    }
}
