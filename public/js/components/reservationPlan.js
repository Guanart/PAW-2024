class reservationPlan {
    constructor(pContenedor) {
        // Conseguir nodo NAV
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

        // URL del archivo SVG
        const urlSVG = '/../../images/svg/PlanoSucursalA.svg'; // Reemplaza con la URL de tu archivo SVG

        // Función para cargar el contenido del archivo SVG desde una URL
        async function cargarSVG() {
            try {
                // Realiza la solicitud para cargar el archivo SVG
                const response = await fetch(urlSVG);

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
                agregarListeners(elementosMesa)

            } catch (error) {
                console.error('Error al cargar el archivo SVG:', error);
            }
        }

        // Llamar a la función para cargar el contenido del archivo SVG
        cargarSVG();

        function agregarListeners(elementosMesa) {
        // Itera sobre cada elemento de la clase 'mesa' y agrega un eventListener de 'click'
            elementosMesa.forEach(elemento => {
                elemento.addEventListener('click', function(evento) {
                    // Usamos evento.target para obtener el elemento que se ha hecho clic
                    const elementoClicado = evento.target;
            
                    // Usamos closest() para subir en el árbol DOM hasta el <g> más cercano
                    const grupoG = elementoClicado.closest('g');
            
                    // Verifica que el grupo <g> tiene un ID y extrae el ID
                    if (grupoG && grupoG.id) {
                        const idMesa = grupoG.id;
                        console.log(`ID de la mesa clicada: ${idMesa}`);
            
                        // Realiza la acción deseada con el ID de la mesa
                        // Por ejemplo, podrías hacer algo con el ID aquí
                    } else {
                        console.log('El elemento clicado no está dentro de un <g> con ID.');
                    }
                });
            });
        } 
    }
}