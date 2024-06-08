class BuscadorNuevosPedidos {
    constructor() {
        this.pedidos = []
        this.maxId = null;
        let css = tools.nuevoElemento("link","",{rel: "stylesheet",href:"/js/components/styles/seguimientoPedido.css"})
        document.head.appendChild(css);
    }

    async getPedidos() {
        let url = `${window.location.origin}/get_pedidos`;
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

    buscarMaxId() {
        this.maxId = this.pedidos[0].fields.id;
        this.pedidos.forEach(pedido => {
            if (pedido.fields.id > this.maxId) {
                this.maxId = pedido.fields.id;
            }
        });
    }

}