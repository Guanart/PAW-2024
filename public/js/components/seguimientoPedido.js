class SeguimientoPedido {
    constructor(articulo) {
        this.articulo = articulo;
        this.estado = null;
        this.info_pedido = null;
        this.idPedido = this.articulo.id;
        let contenedor = this.articulo.querySelector("div.seguimientoPedido");
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

        this.consulta_automatica = setInterval(async () => {
            await this.actualizar();
        }, 10000);
    }

    async getEstado() {
        const url = `${window.location.origin}/estado_pedido?id=${encodeURIComponent(this.idPedido)}`;
        try {
            const response = await fetch(url, {
                mode: 'no-cors'
            });
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
            if (estadoActual === "entregado") {
                // ESTO HACE QUE NO SE MUESTRE CUANDO UN PEDIDO TIENE ESTADO ENTREGADO
                document.querySelector('main').removeChild(this.articulo);
                clearInterval(this.consulta_automatica);
            } else {
                console.log("Cambiando estado del pedido " + this.idPedido + "...");
                this.info_pedido.className = "seguimientoPedido-" + estadoActual;
                this.info_pedido.textContent = "Estado: " + estadoActual.toUpperCase();
                this.estado = estadoActual;
                if (estadoActual === "despachado") {
                    this.notifyUser();
                }
            }
        }
    }

    notifyUser() {
        // Vibrar
        if (window.navigator.vibrate) {
            window.navigator.vibrate([200, 100, 200]);
        }
        
        // Reproducir sonido
        const audio = new Audio('/assets/sounds/notification.wav');
        audio.play().catch(error => {
            console.error("Error al reproducir el sonido de notificación:", error);
        })
    }
}
