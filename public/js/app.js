class appPAW {
    constructor() {
        const currentUrl = window.location.pathname;
        //Inicializar la funcionalidad Menu
        document.addEventListener("DOMContentLoaded", () => {
            tools.cargarScript("menuHam", "js/components/menuHam.js", () => {
                let menu = new menuHam("nav");
            });
        });

        if (currentUrl === "/") {
            //Cargar el script solo en la página de inicio
            tools.cargarScript("Carousell", "js/components/carousell.js", () => {
                let carousell = new Carousell("transitionX");
            });
        }

        else if (currentUrl === "/alta-plato") {
            //Inicializar la funcionalidad Drag and Drop
            document.addEventListener("DOMContentLoaded", () => {
                tools.cargarScript("dragAndDrop", "js/components/dragAndDrop.js", () => {
                    let dropArea = new dragAndDrop("div.drop-area",1);
                });
            });
        }

        else if (currentUrl === "/seleccion_mesa") {
            document.addEventListener("DOMContentLoaded", () => {
                tools.cargarScript("ReservationPlan", "js/components/reservationPlan.js", () => {
                    let plan = new ReservationPlan("svg.plan");
                });
            });
        }
        
        else if (currentUrl === "/tus_pedidos") {
            //Inicializar la funcionalidad seguimientoPedidos
            document.addEventListener("DOMContentLoaded", () => {
                tools.cargarScript("seguimientoPedido", "js/components/seguimientoPedido.js", () => {
                    tools.cargarScript("buscadorPedidosDOM", "js/components/buscadorPedidosDOM.js", () => {
                        let buscador = new BuscadorPedidosDOM();
                        let pedidos = buscador.buscarPedidos();
                        pedidos.forEach((pedido) => {
                            new SeguimientoPedido(pedido);
                        });
                    });
                });
            });
        }

        if (currentUrl === "/turnero") {
            //Inicializar la funcionalidad Turnero
            document.addEventListener("DOMContentLoaded", () => {
                tools.cargarScript("seguimientoPedido", "js/components/seguimientoPedido.js", () => {
                    tools.cargarScript("buscadorNuevosPedidos", "js/components/buscadorNuevosPedidos.js", () => {
                        tools.cargarScript("turnero", "js/components/turnero.js", () => {
                            let turnero = new Turnero();
                        })
                    });
                });
            });
        }

        if (currentUrl === "/gestion_pedidos") {
            //Inicializar la funcionalidad Turnero
            document.addEventListener("DOMContentLoaded", () => {
                tools.cargarScript("seguimientoPedido", "js/components/seguimientoPedido.js", () => {
                    tools.cargarScript("buscadorNuevosPedidos", "js/components/buscadorNuevosPedidos.js", () => {
                        tools.cargarScript("adminPedidos", "js/components/adminPedidos.js", () => {
                            let adminPedidos = new AdminPedidos();
                        })
                    });
                });
            });
        }
    }
}

let app = new appPAW();