class SeguimientoPedido {
    constructor(pContenedor) {
        this.estado = null;
        this.info_pedido = null;

        this.contenedor = pContenedor.querySelector("div.seguimientoPedido");

        if (!this.contenedor) {
            console.error("Elemento HTML para generar el seguimientoPedido no encontrado");
            return;
        }
        
        this.inicializar(pContenedor.id);
    }
    
    async inicializar(idPedido) {
        this.estado = await this.getEstado(idPedido);
        let clase = "seguimientoPedido-" + this.estado;
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
            this.info_pedido.className = "seguimientoPedido-" + estadoActual;
            this.info_pedido.textContent = "Estado: " + estadoActual.toUpperCase();
            this.contenedor.appendChild(this.info_pedido);
            this.estado = estadoActual;
        }
    }
}
