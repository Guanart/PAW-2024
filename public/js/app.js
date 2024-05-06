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
                let carousell = new Carousell();
            });
        }

        //Inicializar la funcionalidad Menu
        document.addEventListener("DOMContentLoaded", () => {
            tools.cargarScript("dragAndDrop", "js/components/dragAndDrop.js", () => {
                let dropArea = new dragAndDrop("div.drop-area");
            });
        });
    }
}

    let app = new appPAW();