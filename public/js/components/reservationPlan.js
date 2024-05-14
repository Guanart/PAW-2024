//import datosReservas from './local.json';

/*
const datosReservas = {
    "nombre": "Mi Local",
    "pisos": [
        {
            "nombre": "Piso-1",
            "mesas": [
                {
                    "numero": "mesa-262",
                    "reservas": [
                        {
                            "horaInicio": "2024-05-13T13:30:00.000Z",
                            "horaFin": "2024-05-13T15:00:00.000Z"
                        }
                    ]
                },
                {
                    "numero": "mesa-342",
                    "reservas": [
                        {
                            "horaInicio": "2024-05-13T13:30:00.000Z",
                            "horaFin": "2024-05-13T15:00:00.000Z"
                        }
                    ]
                },
                {
                    "numero": 3,
                    "reservas": []
                }
            ]
        },
        {
            "nombre": "Piso-2",
            "mesas": [
                {
                    "numero": 4,
                    "reservas": []
                },
                {
                    "numero": 5,
                    "reservas": []
                },
                {
                    "numero": 6,
                    "reservas": []
                }
            ]
        }
    ]
}
*/


class ReservationPlan {
    // URL del archivo SVG
    urlSVG = '/../../images/svg/PlanoSucursalA.svg';
    
    constructor(pContenedor) {
        // Conseguir nodo del plano
        let contenedor = pContenedor.tagName
            ? pContenedor
            : document.querySelector(pContenedor);

        if (!contenedor) {
            console.error("Elemento HTML para generar el plan no encontrado");
            return;
        }

        const elementosMesa = document.querySelectorAll('.mesa');
        this.agregarListeners(elementosMesa)

        let css = tools.nuevoElemento('link', '', {
            rel: 'stylesheet',
            href: '/js/components/styles/reservationPlan.css'
        });
        document.head.appendChild(css);

        this.buscarReservas()
        .then(datosReservas => {
            this.fechaYHora(datosReservas);
        });
    }

    async buscarReservas() {
        return fetch('js/components/Local.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ocurrió un error al obtener los datos');
                }
                return response.json();
            })
            .catch(error => {
                console.error('Error al obtener el JSON:', error);
            });
    }

    fechaYHora(datosReservas) {
        let horarioSeleccionado = null;
        const selectHorario = document.querySelector('.select-hora');
        selectHorario.addEventListener('change', () => {
            horarioSeleccionado = selectHorario.value;
            if (this.fechaSeleccionada) {
                const time = new Date(this.fechaSeleccionada + 'T' + horarioSeleccionado);
                this.actualizarEstadoMesas(datosReservas, time);
            }
        });

        let fechaSeleccionada = null;
        const inputFecha = document.querySelector('.input-fecha');
        inputFecha.addEventListener('change', () => {
            this.fechaSeleccionada = inputFecha.value;
            if (horarioSeleccionado) {
                const time = new Date(this.fechaSeleccionada + 'T' + horarioSeleccionado);
                this.actualizarEstadoMesas(datosReservas, time);
            }
        });
    }
    

    agregarListeners(elementosMesa) {
        let inputTexto = document.getElementById('texto');
        let mesaSeleccionada = null;

        elementosMesa.forEach(elemento => {
            elemento.addEventListener('click', function (event) {
                const elementoClickeado = event.target;
                if (elementoClickeado.classList.contains("mesaSeleccionada")) {
                    event.target.classList.remove("mesaSeleccionada");
                } else {
                    event.target.classList.add("mesaSeleccionada");
                    elementosMesa.forEach(elemento => {
                        if (elemento !== event.target) {
                            elemento.classList.remove("mesaSeleccionada");
                        }
                    });
                }

                if (elementoClickeado.classList.contains("reservada")) {
                    return
                }

                const grupoG = elementoClickeado.closest('g');
                // Verifica que el grupo <g> tiene un ID y extrae el ID
                if (grupoG && grupoG.id) {
                    //const idMesa = grupoG.id;
                    mesaSeleccionada = grupoG.id;
                    inputTexto.value = mesaSeleccionada;
                    console.log("mesa " + grupoG.id + " clickeada")
                } else {
                    console.log('El elemento clickeado no está dentro de un <g> con ID.');
                }
            });
        });
    }

    actualizarEstadoMesas(datosReservas, TimeIn) {
        let inputTexto = document.getElementById('texto');
        let mesasReservadasId = this.encontrarReservaPorNumero(datosReservas, TimeIn);
        const elementosMesa = document.querySelectorAll('.mesa');
    
        elementosMesa.forEach(elemento => {
            const mesaId = elemento.closest('g').id;
            if (mesasReservadasId.includes(mesaId)) {
                elemento.classList.add('reservada');
                elemento.closest('g').classList.add('reservada'); // Agregar clase al elemento g
                if (elemento.classList.contains("mesaSeleccionada")) {
                    elemento.classList.remove("mesaSeleccionada"); 
                    inputTexto.value = "";
                }
            } else {
                elemento.classList.remove('reservada');
                elemento.closest('g').classList.remove('reservada'); // Remover clase del elemento g
            }
        });
    }

    encontrarReservaPorNumero(datosReservas, TimeIn) {
        let mesasReservadasId = [];
        // Itera sobre los datos de reserva para encontrar la reserva de la mesa específica
        for (const piso of datosReservas.pisos) {
            for (const mesa of piso.mesas) {
                for (const reserva of mesa.reservas) {
                    if (reserva.horaInicio == TimeIn.toISOString()) {
                        mesasReservadasId.push(mesa.numero)
                    }
                }
            }
        }
        // Devuelve null si no se encontró ninguna reserva
        return mesasReservadasId;
    }

}