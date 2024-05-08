class Carousell {
    constructor(tipo){
        // se inicializan variables
        this.principal = document.querySelector(".principal");
        this.principalCarousell = document.querySelector(".principal_carousell");
        this.images = this.principalCarousell.querySelectorAll("article");
        console.log(this.images);
        var css = tools.nuevoElemento("link","",{rel: "stylesheet",href:"/js/components/styles/carousell.css"})
            document.head.appendChild(css);
        this.index = 1;
        this.prevButton = tools.nuevoElemento("button", "anterior", []);
        this.principal.appendChild(this.prevButton);

        this.nextButton = tools.nuevoElemento("button", "posterior", []);
        this.principal.appendChild(this.nextButton);
        this.tipos = { //Creo un diccionario para elegir entre distintos tipos de transiciones
            "transitionX" : this.transitionXCarousell,
            "transitionOpacity" : this.transitionOpacityCarousell,
            "transitionScale" : this.transitionScaleCarousell
        };
        if (this.tipos[tipo]) {
            this.tipos[tipo](this.principal, this.principalCarousell, this.images, this.index, this.prevButton, this.nextButton);
        } else {
            console.error(`El tipo ${tipo} no es válido.`);
        }
    }

    transitionScaleCarousell () {}

    transitionOpacityCarousell (principal, principalCarousell, images, index, prevButton, nextButton) {
        console.log(images);
        images.forEach(image => {
            image.style.opacity = 0;
            image.style.display = "none";
        });
        images[0].style.opacity = 1;
        images[0].style.display = "flex";
        index = 0;
        prevButton.addEventListener("click", () => {
            images[index].style.opacity = 0;
            setTimeout(()=>{},500);
            images[index].style.display = "none";
            index--;
            if (index < 0){
                index = images.length - 1; // Establecer el índice al último elemento
                images[index].style.opacity = 1;
                setTimeout(()=>{},500);
                images[index].style.display = "flex";
            } else {
                images[index].style.opacity = 1;
                setTimeout(()=>{},500);
                images[index].style.display = "flex";
            }
            clearTimeout(intervalo);
        });
        
        nextButton.addEventListener("click", () => {
            images[index].style.opacity = 0;
            setTimeout(()=>{},500);
            images[index].style.display = "none";
            index++;
            if (index > images.length-1){
                index = 0;
                images[index].style.opacity = 1;
                setTimeout(()=>{},500);
                images[index].style.display = "flex";
            } else
                images[index].style.opacity = 1;
                setTimeout(()=>{},500);
                images[index].style.display = "flex";
            clearTimeout(intervalo);
        });
        
        let intervalo = null;

        intervalo = setInterval (() => {
            images[index].style.opacity = 0;
            setTimeout(()=>{},500);
            images[index].style.display = "none"; 
            index++;
            if (index > images.length-1){
                index = 0
                images[index].style.opacity = 1;
                setTimeout(()=>{},500);
                images[index].style.display = "flex"; 
            } else
                images[index].style.opacity = 1;
                setTimeout(()=>{},500);
                images[index].style.display = "flex"; 
        }, 6000);
    }

    transitionXCarousell (){
        this.prevButton.addEventListener("click", () => {
            let vwDeTrancision = this.medidaPantalla();
            this.index--;
            if (this.index < 0){
                this.index = this.images.length - 1; // Establecer el índice al último elemento
                this.principalCarousell.style.transform = "translateX(" + (this.index * -vwDeTrancision) + "vw)";
            } else {
                this.principalCarousell.style.transform = "translateX(" + (this.index * -vwDeTrancision) + "vw)";
            }
            clearTimeout(intervalo);
        });
        
        this.nextButton.addEventListener("click", () => {
            let vwDeTrancision = this.medidaPantalla();
            let percentage = this.index * -vwDeTrancision;
            this.index++;
            if (this.index > this.images.length){
                this.index = 1;
                this.principalCarousell.style.transform = "translateX(" + 0 + "vw)";
            } else
                this.principalCarousell.style.transform = "translateX(" + percentage + "vw)";
            clearTimeout(intervalo);
        });
        
        intervalo = setInterval (() => {
            let vwDeTrancision = this.medidaPantalla();
            let percentage = this.index * -vwDeTrancision;
            this.index++;
            if (this.index > this.images.length){
                this.index = 0;
            } else
            this.principalCarousell.style.transform = "translateX(" + percentage + "vw)";
            
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