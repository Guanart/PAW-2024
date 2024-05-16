class BuscadorPedidos {
    constructor(consultar_nuevos) {
        let css = tools.nuevoElemento("link", "", {rel: "stylesheet", href: "/js/components/styles/seguimientoPedido.css"});
        document.head.appendChild(css);

        if (consultar_nuevos) {
            // Si consultar_nuevos es true, entonces se consultaran todo el tiempo por nuevos pedidos
            console.log("Entro en actualizar siempre");
            this.inicializar();
        } else {
            // Si consultar_nuevos es false, entonces solo mostrarán los pedidos (articles) que estén en el document (los que trajo el php)
            console.log("Entro en queryselectorall article");
            this.articles = document.querySelectorAll("article");
            this.seguirPedidos();
        }
    }

    seguirPedidos() {
        this.articles.forEach((articulo) => {
            new SeguimientoPedido(articulo);
        });
    }

    async inicializar() {
        this.maxId = null;
        this.pedidos = await this.getPedidos();

        if (this.pedidos.length !== 0) {
            this.buscarMaxId();
            this.crearArticulos();
            this.seguirPedidos();
        }
        setInterval(async () => {
            await this.actualizar();
        }, 10000);
    }

    buscarMaxId() {
        this.maxId = this.pedidos[0].id_pedido;
        this.pedidos.forEach(pedido => {
            if (pedido.id_pedido > this.maxId) {
                this.maxId = pedido.id_pedido;
            }
        });
    }

    crearArticulos() {
        let main = document.querySelector("main");
        this.articles = [];
        this.pedidos.forEach(pedido => {
            const article = document.createElement("article");
            article.id = pedido.id_pedido;
            const h4 = document.createElement("h4");
            h4.textContent = "Pedido #" + pedido.id_pedido;
            article.appendChild(h4);
            const ul = document.createElement("ul");
            pedido.productos.forEach(producto => {
                const li = document.createElement("li");
                li.textContent = producto.nombre;
                ul.appendChild(li);
            });
            article.appendChild(ul);
            const seguimientoPedido = document.createElement("div");
            seguimientoPedido.className = "seguimientoPedido";
            article.appendChild(seguimientoPedido);
            this.articles.push(article)
            main.appendChild(article);
        });
    }

    async actualizar() {
        this.pedidos = await this.getPedidos();
        if (this.pedidos.length !== 0) {
            this.buscarMaxId();
            this.crearArticulos();
            this.seguirPedidos();
        }
    }

    async getPedidos() {
        let url = 'http://localhost:8888/get_pedidos';
        if (this.maxId) {
            url = url + '?id=' + encodeURIComponent(this.maxId);
        }
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error('Error al obtener el estado del pedido. ' + response.json);
            }

            const data = await response.json();
            if (data.hasOwnProperty('error')) {
                throw new Error("Error llega de data: " + data.error);
            }

            return data;
        } catch (error) {
            console.error("Hubo un error al obtener el estado del pedido:", error);
            return null;
        }
    }
}