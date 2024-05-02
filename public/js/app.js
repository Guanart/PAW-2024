class appPAW {
    constructor() {
        //Inicializar la funcionalidad Menu
        document.addEventListener("DOMContentLoaded", () => {
        tools.cargarScript("menuHam", "js/components/menuHam.js", () => {
                let menu = new menuHam("nav");
            });
        });
    }
}

    let app = new appPAW();