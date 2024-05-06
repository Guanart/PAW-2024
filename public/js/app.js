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
    }
}

    let app = new appPAW();