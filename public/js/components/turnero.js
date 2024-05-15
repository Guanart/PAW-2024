class turnero {
    constructor(pContenedor) {
        this.estado = null;
        this.info_pedido = null;

        this.contenedor = pContenedor.tagName
        ? pContenedor
        : document.querySelector(pContenedor);

        if (!this.contenedor) {
            console.error("Elemento HTML para generar el turnero no encontrado");
            return;
        }

        let css = tools.nuevoElemento("link","",{rel: "stylesheet",href:"/js/components/styles/turnero.css"})
        document.head.appendChild(css);

        this.inicializar();
        /*
        var estado = null;
        let idPedido = 123;
        let elemento = tools.nuevoElemento("h4", "Cargando...");
        contenedor.appendChild(elemento);

        this.obtenerYActualizarEstado(idPedido, estado, elemento);
        // Falta ver como actualizar el estado
        setInterval(() => {
            this.obtenerYActualizarEstado(idPedido, estado, elemento);
        }, 10000);
        */

        /*
        const promesaEstado = this.obtenerEstadoPedido(123);
        promesaEstado.then(estado => {
            let clase = "turnero-" + estado
            let info_pedido = tools.nuevoElemento("h4", estado, {class:clase});
            contenedor.appendChild(info_pedido);
        }).catch(error => {
            console.error("Hubo un error al obtener el estado del pedido fuera de la función:", error);
        });
        */
    }
    
    async inicializar(contenedor) {
        let idPedido = 123;
        this.estado = await this.getEstado(idPedido);
        let clase = "turnero-" + this.estado;
        this.info_pedido = tools.nuevoElemento("h4", "Estado: " + this.estado.toUpperCase(), {class:clase});
        this.contenedor.appendChild(this.info_pedido);

        setInterval(async () => {
            await this.actualizar(idPedido);
        }, 10000);
    }

    async getEstado(idPedido) {
        const url = 'http://localhost:8888/estado_pedido?id=' + encodeURIComponent(idPedido);
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error('Error al obtener el estado del pedido. ' + response.json);
            }
            const data = await response.json();
            if (data.hasOwnProperty('error')) {
                throw new Error("Error llega de data: " + data.error);
            }
            return data.estado;
        } catch (error) {
            console.error("Hubo un error al obtener el estado del pedido:", error);
            return null;
        }
    }

    async actualizar(idPedido) {
        console.log("Actualización: Comprobando estado...");
        let estadoActual = await this.getEstado(idPedido);
        console.log("El último estado es: " + this.estado);
        console.log("El estado consultado es: " + estadoActual);
        if (estadoActual !== this.estado) {
            console.log("Cambiando estado...");
            this.contenedor.removeChild(this.info_pedido);
            this.info_pedido.className = "turnero-" + estadoActual;
            this.info_pedido.textContent = "Estado: " + estadoActual.toUpperCase();
            this.contenedor.appendChild(this.info_pedido);
            this.estado = estadoActual;
        }
    }

    /*
    obtenerYActualizarEstado(idPedido, estadoAnterior, elemento) {
        this.obtenerEstadoPedido(idPedido)
            .then(estado => {
                console.log("actualizando");
                if (estado !== estadoAnterior) {
                    console.log("estado diferente");
                    console.log("Estado: " + estado);
                    console.log("EstadoAnterior: " + estadoAnterior);
                    let clase = "turnero-" + estado;
                    elemento.className = clase;
                    elemento.textContent = estado;
                    estadoAnterior = estado;
                }
                console.log("");
            })
            .catch(error => {
                console.error("Hubo un error al obtener el estado del pedido fuera de la función:", error);
            });
    }
    */
}