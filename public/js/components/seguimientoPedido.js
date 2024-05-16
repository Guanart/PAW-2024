class SeguimientoPedido {
    constructor(pContenedor) {
        this.estado = null;
        this.info_pedido = null;
        this.idPedido = pContenedor.id;
        let contenedor = pContenedor.querySelector("div.seguimientoPedido");
        if (!contenedor) {
            console.error("Elemento HTML para generar el seguimientoPedido no encontrado");
            return;
        }
        this.inicializar(contenedor);
    }
    
    async inicializar(contenedor) {
        this.estado = await this.getEstado();
        let clase = "seguimientoPedido-" + this.estado;
        this.info_pedido = tools.nuevoElemento("h4", "Estado: " + this.estado.toUpperCase(), {class:clase});
        contenedor.appendChild(this.info_pedido);

        setInterval(async () => {
            await this.actualizar();
        }, 10000);
    }

    async getEstado() {
        const url = 'http://localhost:8888/estado_pedido?id=' + encodeURIComponent(this.idPedido);
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

    async actualizar() {
        console.log("Actualización pedido " + this.idPedido + ": Comprobando estado...");
        let estadoActual = await this.getEstado();
        console.log("El último estado del pedido " + this.idPedido + " es: " + this.estado);
        console.log("El estado consultado del pedido " + this.idPedido + " es: " + estadoActual);
        if (estadoActual !== this.estado) {
            console.log("Cambiando estado del pedido " + this.idPedido + "...");
            this.info_pedido.className = "seguimientoPedido-" + estadoActual;
            this.info_pedido.textContent = "Estado: " + estadoActual.toUpperCase();
            this.estado = estadoActual;
        }
    }
}
