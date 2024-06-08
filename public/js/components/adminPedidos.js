class AdminPedidos extends BuscadorNuevosPedidos {
    constructor() {
        super();
        this.estados = {
            "llevar": null,
            "delivery": null,
            "mesa": null
        };
        this.buscarEstadosPosibles();
    }

    async buscarEstadosPosibles() {
        this.estados["llevar"] = await this.getEstados("llevar");
        this.estados["delivery"] = await this.getEstados("delivery");
        this.estados["mesa"] = await this.getEstados("mesa");
        console.log(this.estados);
        this.buscarPedidos();
    }

    async getEstados(tipo) {
        let url = `${window.location.origin}/estados?tipo=${tipo}`;
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

    async postEstado(id, estado) {
        let url = `${window.location.origin}/estado_pedido`;
        let datos = {
            id: id,
            estado: estado
        };
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {'Content-type': 'application/json'},
                body: JSON.stringify(datos)
            });

            if (!response.ok) {
                throw new Error('Error al cambiar el estado. ' + response.json);
            }

            const data = await response.json();
            if (data.hasOwnProperty('error')) {
                throw new Error("Error llega de data: " + data.error);
            }

            return data;
        } catch (error) {
            console.error("Hubo un error al obtener el cambiar el estado del pedido:", error);
            return null;
        }
    }

    async buscarPedidos() {
        this.pedidos = await this.getPedidos();
        if (this.pedidos.length !== 0) {
            this.buscarMaxId();
            this.crearArticulos();
        }
        setInterval(async () => {
            await this.actualizar();
        }, 10000);
    }  

    crearArticulos() {
        let main = document.querySelector("main");
        this.articles = [];
        this.pedidos.forEach(pedido => {
            //const num_pedido = tools.nuevoElemento("h4", "Pedido " + pedido.id_pedido);
            //const num_usuario = tools.nuevoElemento("h4", "Usario " + pedido.id_usuario);
            //const lista_productos = tools.nuevoElemento("ul", "");
            const num_pedido = tools.nuevoElemento("h4", "Pedido " + pedido.fields.id);
            const num_usuario = tools.nuevoElemento("h4", "Usuario " + pedido.fields.id_usuario);
            const lista_productos = tools.nuevoElemento("ul", "");

            pedido.productos.forEach(producto => {
                            //const li = tools.nuevoElemento("li", producto.nombre);
                            //lista_productos.appendChild(li);

                            const pedidoArticle = tools.nuevoElemento("article", "");
                            const nombre = tools.nuevoElemento("p", producto.producto.fields.nombre);
                            const descripcion = tools.nuevoElemento("p", producto.producto.fields.descripcion);
                            const cantidad = tools.nuevoElemento("p", "Cantidad: " + producto.cantidad);
                            pedidoArticle.appendChild(nombre);
                            pedidoArticle.appendChild(descripcion);
                            pedidoArticle.appendChild(cantidad);
                            console.log(pedidoArticle);
                            const li = tools.nuevoElemento("li","");
                            li.appendChild(pedidoArticle);
                            lista_productos.appendChild(li);
                        });


            //const estado_pedido = tools.nuevoElemento("h4", "aceptado", {class: "estado"});
            const estado_pedido = tools.nuevoElemento("h4", pedido.fields.estado, {class: "estado"});
            // const siguiente_estado = this.estados[pedido.fields.tipo][1];       
            const estados = this.estados[pedido.fields.tipo];
            const siguiente_estado = estados[estados.indexOf(pedido.fields.estado) + 1];
            
            
            const boton_estado = tools.nuevoElemento("button", "Pasar estado a: " + siguiente_estado);

            // AGREGAR EVENT LISTENER AL BOTON
            boton_estado.addEventListener("click", async (event) => {
                let article = event.target.parentNode;
                let elemento_estado = article.querySelector(".estado");
                let tipo_pedido = article.classList[1];

                let index_anteult_estado = this.estados[tipo_pedido].length - 2;
                let indice_estado = this.estados[tipo_pedido].indexOf(elemento_estado.innerText);

                if (indice_estado !== index_anteult_estado) {
                    elemento_estado.innerText = this.estados[tipo_pedido][indice_estado+1]
                    event.target.innerText = "Pasar estado a: " + this.estados[tipo_pedido][indice_estado+2]
                } else {
                    let main = article.parentNode;
                    main.removeChild(article);
                }

                let post = await this.postEstado(article.id, this.estados[tipo_pedido][indice_estado+1]);
                console.log(post);
            })

            //const article = tools.nuevoElemento("article", "", {class: "pedido " + pedido.tipo , id: pedido.id_pedido});
            const article = tools.nuevoElemento("article", "", {class: "pedido " + pedido.fields.tipo , id: pedido.fields.id});
            article.appendChild(num_pedido);
            article.appendChild(num_usuario);
            article.appendChild(lista_productos);
            article.appendChild(estado_pedido);
            article.appendChild(boton_estado);
            this.articles.push(article)
            main.appendChild(article);
        });
    }

    async actualizar() {
        this.pedidos = await this.getPedidos();
        if (this.pedidos.length !== 0) {
            this.buscarMaxId();
            this.crearArticulos();
        }
    }
}