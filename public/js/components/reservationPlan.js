class ReservationPlan {
    constructor(pContenedor) {
        let contenedor = pContenedor.tagName ? pContenedor : document.querySelector(pContenedor);

        if (!contenedor) {
            console.error("Elemento HTML para generar el plan no encontrado");
            return;
        }

        const elementosMesa = document.querySelectorAll('.mesa');
        this.agregarListeners(elementosMesa);

        let css = document.createElement('link');
        css.rel = 'stylesheet';
        css.href = '/js/components/styles/reservationPlan.css';
        document.head.appendChild(css);

        this.fechaSeleccionada = null;
        this.horarioSeleccionado = null;

        this.fechaYHora();

        // Actualizar cada 10 segundos
        setInterval(() => {
            if (this.fechaSeleccionada && this.horarioSeleccionado) {
                this.buscarReservas();
            }
        }, 10000);
    }

    async buscarReservas() {
        const inputLocal = document.querySelector('input.inputLocalReserva');
        const idLocal = inputLocal.value.toLowerCase();
        const url = `${window.location.origin}/reservas_mesa?idLocal=${idLocal}&fecha=${this.fechaSeleccionada}&hora=${this.horarioSeleccionado}`;
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error('Ocurrió un error al obtener los datos');
            }
            const datosReservas = await response.json();
            const time = new Date(`${this.fechaSeleccionada}T${this.horarioSeleccionado}`);
            this.actualizarEstadoMesas(datosReservas, time);
        } catch (error) {
            console.error('Error al obtener los datos del endpoint:', error);
        }
    }

    fechaYHora() {
        const selectHorario = document.querySelector('.select-hora');
        const inputFecha = document.querySelector('.input-fecha');

        selectHorario.addEventListener('change', () => {
            this.horarioSeleccionado = selectHorario.value;
            if (this.fechaSeleccionada) {
                this.buscarReservas();
            }
        });

        inputFecha.addEventListener('change', () => {
            this.fechaSeleccionada = inputFecha.value;
            if (this.horarioSeleccionado) {
                this.buscarReservas();
            }
        });
    }

    agregarListeners(elementosMesa) {
        let inputTexto = document.getElementById('texto');

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
                    return;
                }

                const grupoG = elementoClickeado.closest('g');
                if (grupoG && grupoG.id) {
                    inputTexto.value = grupoG.id;
                    console.log("mesa " + grupoG.id + " clickeada");
                } else {
                    console.log('El elemento clickeado no está dentro de un <g> con ID.');
                }
            });
        });
    }

    actualizarEstadoMesas(datosReservas, timeIn) {
        let inputTexto = document.getElementById('texto');
        let mesasReservadasId = this.encontrarReservaPorNumero(datosReservas, timeIn);
        const elementosMesa = document.querySelectorAll('.mesa');

        elementosMesa.forEach(elemento => {
            const mesaId = elemento.closest('g').id;
            if (mesasReservadasId.includes(mesaId)) {
                elemento.classList.add('reservada');
                elemento.closest('g').classList.add('reservada');
                if (elemento.classList.contains("mesaSeleccionada")) {
                    elemento.classList.remove("mesaSeleccionada");
                    inputTexto.value = "";
                }
            } else {
                elemento.classList.remove('reservada');
                elemento.closest('g').classList.remove('reservada');
            }
        });
    }

    encontrarReservaPorNumero(datosReservas, timeIn) {
        let mesasReservadasId = [];
        if (datosReservas && datosReservas.mesasReservadas) {
            for (const reserva of datosReservas.mesasReservadas) {
                mesasReservadasId.push(reserva.mesa);
            }
        }
        return mesasReservadasId;
    }
}