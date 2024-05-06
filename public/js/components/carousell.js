class Carousell {
    constructor(){
        let principal = document.querySelector(".principal");
        let principalCarousell = document.querySelector(".principal_carousell");
        let images = principalCarousell.querySelectorAll("article");
        let css = tools.nuevoElemento("link","",{rel: "stylesheet",href:"/js/components/styles/carousell.css"})
            document.head.appendChild(css);
        
        let index = 1;
////////////////////////////////////
        let prevButton = tools.nuevoElemento("button", "anterior", []);
        principal.appendChild(prevButton);

        let nextButton = tools.nuevoElemento("button", "posterior", []);
        principal.appendChild(nextButton);

        prevButton.addEventListener("click", () => {
            let vwDeTrancision = this.medidaPantalla();
            let percentage = index * vwDeTrancision;
            index--;
            if (index < 0){
                index = images.length - 1; // Establecer el índice al último elemento
                principalCarousell.style.transform = "translateX(" + (index * -vwDeTrancision) + "vw)";
            } else {
                principalCarousell.style.transform = "translateX(" + (index * -vwDeTrancision) + "vw)";
            }
            clearTimeout(intervalo);
        });
        

        
        nextButton.addEventListener("click", () => {
            let vwDeTrancision = this.medidaPantalla();
            let percentage = index * -vwDeTrancision;
            index++;
            if (index > images.length){
                index = 1;
                principalCarousell.style.transform = "translateX(" + 0 + "vw)";
            } else
                principalCarousell.style.transform = "translateX(" + percentage + "vw)";
            clearTimeout(intervalo);
        });
        
////////////////////////////////////
        
        intervalo = setInterval (() => {
            let vwDeTrancision = this.medidaPantalla();
            let percentage = index * -vwDeTrancision;
            index++;
            if (index > images.length){
                index = 0;
            } else
                principalCarousell.style.transform = "translateX(" + percentage + "vw)";
            
        }, 6000);
    }

    medidaPantalla(){
        let anchoPantalla = window.innerWidth;
        if (anchoPantalla >= 1080) {
            return 62
        } else if (anchoPantalla < 1080){
            return 82
        }
    }
}