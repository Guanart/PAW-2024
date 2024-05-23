class BuscadorPedidosDOM {
    constructor() {
        let css = tools.nuevoElemento("link","",{rel: "stylesheet",href:"/js/components/styles/seguimientoPedido.css"})
        document.head.appendChild(css);
    }

    buscarPedidos() {
        return document.querySelectorAll("article.pedido");
    }
}