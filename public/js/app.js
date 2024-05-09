class appPAW {
    constructor() {
        //Inicializar la funcionalidad Menu
        document.addEventListener("DOMContentLoaded", () => {
            tools.cargarScript("menuHam", "js/components/menuHam.js", () => {
                let menu = new menuHam("nav");
            });
        });
        let currentUrl = window.location.pathname;
        if (currentUrl === "/") {
            //Cargar el script solo en la página de inicio
            tools.cargarScript("Carousell", "js/components/carousell.js", () => {
                let carousell = new Carousell("transitionX");
            });
        }

        //Inicializar la funcionalidad Drag and Drop
        document.addEventListener("DOMContentLoaded", () => {
            tools.cargarScript("dragAndDrop", "js/components/dragAndDrop.js", () => {
                let dropArea = new dragAndDrop("div.drop-area",1);
            });
        });

        //<img alt="plano" class="plano" src="../images/svg/PlanoSucursalA.svg">
        //
        document.addEventListener("DOMContentLoaded", () => {
            tools.cargarScript("reservationPlan", "js/components/reservationPlan.js", () => {
                let plan = new reservationPlan("div.table-select");
            });
        });
    }
}

    let app = new appPAW();