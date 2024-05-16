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

        if (currentUrl === "/alta-plato") {
            //Inicializar la funcionalidad Drag and Drop
            document.addEventListener("DOMContentLoaded", () => {
                tools.cargarScript("dragAndDrop", "js/components/dragAndDrop.js", () => {
                    let dropArea = new dragAndDrop("div.drop-area",1);
                });
            });
        }

        if (currentUrl === "/seleccion_mesa") {
            //<img alt="plano" class="plano" src="../images/svg/PlanoSucursalA.svg">
            //
            document.addEventListener("DOMContentLoaded", () => {
                tools.cargarScript("ReservationPlan", "js/components/reservationPlan.js", () => {
                    let plan = new ReservationPlan("svg.plan");
                });
            });
        }
        
        if (currentUrl === "/tus_pedidos") {
            //Inicializar la funcionalidad seguimientoPedidos
            document.addEventListener("DOMContentLoaded", () => {
                tools.cargarScript("SeguimientoPedido", "js/components/SeguimientoPedido.js", () => {
                    tools.cargarScript("buscadorPedidos", "js/components/buscadorPedidos.js", () => {
                        let buscador = new BuscadorPedidos(false);
                    });
                });
            });
        }

        if (currentUrl === "/turnero") {
            //Inicializar la funcionalidad Turnero
            document.addEventListener("DOMContentLoaded", () => {
                tools.cargarScript("SeguimientoPedido", "js/components/SeguimientoPedido.js", () => {
                    tools.cargarScript("buscadorPedidos", "js/components/buscadorPedidos.js", () => {
                        let buscador = new BuscadorPedidos(true);
                    });
                });
            });
        }
    }
}

    let app = new appPAW();