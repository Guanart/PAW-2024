class Turnero extends BuscadorNuevosPedidos {
    constructor() {
        super();
        this.buscarPedidos();
    }

    async buscarPedidos() {
        this.pedidos = await this.getPedidos();
        if (this.pedidos.length !== 0) {
            this.buscarMaxId();
            this.crearArticulos();
            this.seguirEstadoPedidos();
        }
        setInterval(async () => {
            await this.actualizar();
        }, 10000);
    }  

    crearArticulos() {
        let main = document.querySelector("main");
        this.articles = [];
        this.pedidos.forEach(pedido => {
            const num_pedido = tools.nuevoElemento("h4", "Pedido " + pedido.id_pedido);
            const lista_productos = tools.nuevoElemento("ul", "");
            pedido.productos.forEach(producto => {
                            const li = tools.nuevoElemento("li", producto.nombre)
                            lista_productos.appendChild(li);
                        });
            const seguimientoPedido = tools.nuevoElemento("div", "", {class: "seguimientoPedido"});
            const article = tools.nuevoElemento("article", "", {class: "pedido", id: pedido.id_pedido});
            article.appendChild(num_pedido);
            article.appendChild(lista_productos);
            article.appendChild(seguimientoPedido);
            this.articles.push(article);
            main.appendChild(article);
        });
    }

    seguirEstadoPedidos() {
        this.articles.forEach((articulo) => {
            new SeguimientoPedido(articulo);
        });
    }

    async actualizar() {
        this.pedidos = await this.getPedidos();
        if (this.pedidos.length !== 0) {
            this.buscarMaxId();
            this.crearArticulos();
            this.seguirEstadoPedidos();
        }
    }
}