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
        this.prevButton = tools.nuevoElemento("button", "<", {class: "botonCarousell"});
        this.principal.appendChild(this.prevButton);

        this.nextButton = tools.nuevoElemento("button", ">", {class: "botonCarousell"});
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
            this.tipos["transitionX"](this.principal, this.principalCarousell, this.images, this.index, this.prevButton, this.nextButton);
        }
    }

    transitionScaleCarousell (principal, principalCarousell, images, index, prevButton, nextButton) {
        prevButton.style.display = "none";
        nextButton.style.display = "none";
        
        images.forEach(image => {
            image.style.width = "10vw";
            image.style.transform = "scale(0.5)";
            image.style.heigth = "auto"
        })
        images.
        images.forEach(image0 => {
            image0.addEventListener("click", () => {
                images.forEach(image1 => {
                    image1.style.transform = "scale(0.2)";
                    image1.style.width = "10vw";
                    image1.style.heigth = "auto"
                })
                image0.style.width = "30vw";
                image0.style.transform ="scale(1.2)";
            })
        })
    }

    transitionOpacityCarousell (principal, principalCarousell, images, index, prevButton, nextButton) {
        console.log(images);
        images.forEach(image => {
            image.classList.add("desaparecerOpacidad");
        });
        images[0].classList.remove("desaparecerOpacidad");
        images[0].classList.add("aparecerOpacidad");
        index = 0;
        prevButton.addEventListener("click", () => {
            images[index].classList.remove("aparecerOpacidad");
            images[index].classList.add("desaparecerOpacidad");
            
            index--;
            if (index < 0){
                index = images.length - 1; // Establecer el índice al último elemento
                images[index].classList.remove("desaparecerOpacidad");
                images[index].classList.add("aparecerOpacidad");
            } else {
                images[index].classList.remove("desaparecerOpacidad");
                images[index].classList.add("aparecerOpacidad");

            }
            clearTimeout(intervalo);
        });
        
        nextButton.addEventListener("click", () => {
            images[index].classList.remove("aparecerOpacidad");
            images[index].classList.add("desaparecerOpacidad");
            index++;
            if (index > images.length-1){
                index = 0;
                images[index].classList.remove("desaparecerOpacidad");
                images[index].classList.add("aparecerOpacidad");
                
            } else
                images[index].classList.remove("desaparecerOpacidad");
                images[index].classList.add("aparecerOpacidad");
                
            clearTimeout(intervalo);
        });
        
        let intervalo = null;

        intervalo = setInterval (() => {
            images[index].classList.remove("aparecerOpacidad");
            images[index].classList.add("desaparecerOpacidad");
            index++;
            if (index > images.length-1){
                index = 0
                images[index].classList.remove("desaparecerOpacidad");
                images[index].classList.add("aparecerOpacidad");

            } else
                images[index].classList.remove("desaparecerOpacidad");
                images[index].classList.add("aparecerOpacidad");
        }, 6000);
    }

    transitionXCarousell (principal, principalCarousell, images, index, prevButton, nextButton){
        function medidaPantalla() {
            let anchoPantalla = window.innerWidth;
            if (anchoPantalla >= 1080) {
                return 62
            } else if (anchoPantalla < 1080){
                return 82
            }
        }
        prevButton.addEventListener("click", () => {
            let vwDeTrancision = medidaPantalla();
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
            let vwDeTrancision = medidaPantalla();
            let percentage = index * -vwDeTrancision;
            index++;
            if (index > images.length){
                index = 1;
                principalCarousell.style.transform = "translateX(" + 0 + "vw)";
            } else
                principalCarousell.style.transform = "translateX(" + percentage + "vw)";
            clearTimeout(intervalo);
        });
        let intervalo = null;
        
        intervalo = setInterval (() => {
            let vwDeTrancision = medidaPantalla();
            let percentage = index * -vwDeTrancision;
            index++;
            if (index > images.length){
                index = 0;
            } else
            principalCarousell.style.transform = "translateX(" + percentage + "vw)";
            
        }, 6000);
    }

    
}