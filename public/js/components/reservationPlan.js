class ReservationPlan {
    // URL del archivo SVG
    urlSVG = '/../../images/svg/PlanoSucursalA.svg';
    
    constructor(pContenedor) {
        // Conseguir nodo del plano
        let contenedor = pContenedor.tagName
            ? pContenedor
            : document.querySelector(pContenedor);

        if (!contenedor) {
            console.error("Elemento HTML para generar el menu no encontrado");
            return;
        }
        // Cargar el archivo de estilos (CSS)
        let css = tools.nuevoElemento('link', '', {
            rel: 'stylesheet',
            href: '/js/components/styles/reservationPlan.css'
        });
        document.head.appendChild(css);

        // Llamar a la función para cargar el contenido del archivo SVG
        this.cargarSVG(contenedor);
    }

    // Función para cargar el contenido del archivo SVG desde una URL
    async cargarSVG(contenedor) {
        try {
            // Realiza la solicitud para cargar el archivo SVG
            const response = await fetch(this.urlSVG);

            // Verifica si la solicitud fue exitosa
            if (!response.ok) {
                throw new Error('No se pudo cargar el archivo SVG');
            }

            // Convierte la respuesta en texto
            const svgText = await response.text();

            // Usar DOMParser para analizar la cadena SVG y crear un nodo DOM
            const parser = new DOMParser();
            const doc = parser.parseFromString(svgText, 'image/svg+xml');

            // Obtener el elemento SVG
            const svgNode = doc.documentElement;

            contenedor.appendChild(svgNode);

            const elementosMesa = document.querySelectorAll('.mesa');
            console.log(elementosMesa);
            this.agregarListeners(elementosMesa)

        } catch (error) {
            console.error('Error al cargar el archivo SVG:', error);
        }
    }

    agregarListeners(elementosMesa) {
        const inputTexto = document.getElementById('texto');
        const mesasSeleccionadas = new Set();
        // Itera sobre cada elemento de la clase 'mesa' y agrega un eventListener de 'click'
        elementosMesa.forEach(elemento => {
            elemento.addEventListener('click', function (event) {
                // Usamos evento.target para obtener el elemento que se ha hecho click
                const elementoClickeado = event.target;

                if (elementoClickeado.classList.contains("mesaSeleccionada")) {
                    event.target.classList.remove("mesaSeleccionada");
                } else {
                    event.target.classList.add("mesaSeleccionada");
                }

                // Usamos closest() para subir en el árbol DOM hasta el <g> más cercano
                const grupoG = elementoClickeado.closest('g');

                // Verifica que el grupo <g> tiene un ID y extrae el ID
                if (grupoG && grupoG.id) {
                    const idMesa = grupoG.id;

                    // Si el ID ya está en el conjunto, lo elimina; de lo contrario, lo agrega
                    if (mesasSeleccionadas.has(idMesa)) {
                        mesasSeleccionadas.delete(idMesa);
                    } else {
                        mesasSeleccionadas.add(idMesa);
                    }

                    // Actualiza el campo de texto con los IDs de las mesas seleccionadas
                    inputTexto.value = Array.from(mesasSeleccionadas).join(', ');
                } else {
                    console.log('El elemento clickeado no está dentro de un <g> con ID.');
                }
            });
        });
    }

}