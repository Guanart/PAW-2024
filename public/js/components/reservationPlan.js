class ReservationPlan {
    constructor(pContenedor) {
        let contenedor = pContenedor.tagName ? pContenedor : document.querySelector(pContenedor);

        if (!contenedor) {
            console.error("Elemento HTML para generar el plan no encontrado");
            return;
        }

        let css = document.createElement('link');
        css.rel = 'stylesheet';
        css.href = '/js/components/styles/reservationPlan.css';
        document.head.appendChild(css);

        const elementosMesa = document.querySelectorAll('.mesa');
        this.agregarListeners(elementosMesa);

        this.fechaSeleccionada = null;
        this.horarioSeleccionado = document.querySelector('.select-hora').value;

        this.listenersFechaYHora();

        // Actualizar cada 10 segundos
        setInterval(() => {
            if (this.fechaSeleccionada && this.horarioSeleccionado) {
                this.flujoActualizacion();
            }
        }, 10000);
    }

    async buscarReservas() {
        // Consigo el local al cual consultar
        const inputLocal = document.querySelector('input.inputLocalReserva');
        const idLocal = inputLocal.value.toLowerCase();

        // Hago la consulta al backend
        const url = `${window.location.origin}/reservas_mesa?local=${idLocal}&fecha=${this.fechaSeleccionada}&hora=${this.horarioSeleccionado}`;
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error('Ocurrió un error al obtener los datos');
            }
            const datosReservas = await response.json();
            // Retorno una lista de ID's de mesas reservadas en esa fecha, a esa hora
            return this.encontrarReservaPorNumero(datosReservas);
        } catch (error) {
            console.error('Error al obtener los datos del endpoint:', error);
        }
    }

    encontrarReservaPorNumero(datosReservas) {
        // Obtengo los id de las mesas reservadas a partir de la entrada
        let mesasReservadasId = [];
        if (datosReservas && Array.isArray(datosReservas)) {
            for (const reserva of datosReservas) {
                if (reserva.fields && reserva.fields.mesa) {
                    mesasReservadasId.push(reserva.fields.mesa);
                }
            }
        }
        return mesasReservadasId;
    }

    actualizarEstadoMesas(mesasReservadasId) {
        // Si la mesa ya esta reservada, no se hace nada, por mas clicks que se hagan
        let inputTexto = document.querySelector('input.inputMesaReserva');

        // Obtengo el id de todas las mesas reservadas en este intervalo
        const elementosMesa = document.querySelectorAll('.mesa');

        elementosMesa.forEach(elemento => {
            const mesaId = elemento.closest('g').id;

            // Si la mesa tiene un id que esta dentro de la lista de mesas reservadas...
            if (mesasReservadasId.includes(mesaId)) {

                // Le agrego la clase reservada a la mesa y al grupo (para aplicar estilos)
                elemento.classList.add('reservada');
                elemento.closest('g').classList.add('reservada');

                // En caso de ya estar seleccionada, le quito la clase y borro el id del input
                if (elemento.classList.contains("mesaSeleccionada")) {
                    elemento.classList.remove("mesaSeleccionada");
                    inputTexto.value = "";
                }
            } else {
                // Si no esta en la lista, se le quita la clase reservada
                elemento.classList.remove('reservada');
                elemento.closest('g').classList.remove('reservada');
            }
        });
    }

    async flujoActualizacion() {
        const mesasReservadasId = await this.buscarReservas();
        this.actualizarEstadoMesas(mesasReservadasId);
    }

    listenersFechaYHora() {
        const selectHorario = document.querySelector('.select-hora');
        const inputFecha = document.querySelector('.input-fecha');

        selectHorario.addEventListener('change', () => {
            this.horarioSeleccionado = selectHorario.value;
            if (this.fechaSeleccionada) {
                this.flujoActualizacion();
            }
        });

        inputFecha.addEventListener('change', () => {
            this.fechaSeleccionada = inputFecha.value;

            const hoy = new Date().toISOString().split('T')[0];

            const fechaSeleccionada = inputFecha.value;
            const ahora = new Date();
            const horaActual = `${ahora.getHours().toString().padStart(2, '0')}:${ahora.getMinutes().toString().padStart(2, '0')}`;

            // Reiniciar las opciones
            Array.from(selectHorario.options).forEach(option => {
                if (option.value) {
                    option.disabled = false;
                }
            });

            if (fechaSeleccionada === hoy) {
                Array.from(selectHorario.options).forEach(option => {
                    if (option.value && option.value <= horaActual) {
                        option.disabled = true;
                    }
                });
            }

            let primeraHoraValidaEncontrada = false;
            
            // Seleccionar la primera hora válida disponible
            Array.from(selectHorario.options).forEach(option => {
                if (!option.disabled && option.value) {
                    option.selected = true;
                    primeraHoraValidaEncontrada = true;
                    return false; // Romper el bucle una vez encontrada la primera opción válida
                }
            });

            // Si no hay ninguna hora válida, resetear el select
            if (!primeraHoraValidaEncontrada) {
                selectHorario.value = "";
            }

            if (this.horarioSeleccionado) {
                this.flujoActualizacion();
            }
        });
    }

    agregarListeners(elementosMesa) {
        // Recuperar el input oculto del form, en el que va el id de mesa a reservar
        let inputTexto = document.querySelector('input.inputMesaReserva');

        elementosMesa.forEach(elemento => {
            elemento.addEventListener('click', function (event) {
                const elementoClickeado = event.target;
                const grupoG = elementoClickeado.closest('g');

                // Si la mesa ya esta reservada, no se hace nada, por mas clicks que se hagan
                if (elementoClickeado.classList.contains("reservada")) {
                    return;
                }

                // Si es una mesa ya seleccionada, se le quita la seleccion al presionar click
                if (elementoClickeado.classList.contains("mesaSeleccionada")) {
                    event.target.classList.remove("mesaSeleccionada");

                // Si no estaba seleccionada, se la selecciona al presionar click
                } else {
                    event.target.classList.add("mesaSeleccionada");
                    // Se le quita la seleccion a cualquier mesa seleccionada anteriormente
                    inputTexto.value = grupoG.id;
                    elementosMesa.forEach(elemento => {
                        if (elemento !== event.target) {
                            elemento.classList.remove("mesaSeleccionada");
                        }
                    });
                }

                /*
                // Se inyecta el id de mesa en el form (el id esta en el g mas cercano)
                if (grupoG && grupoG.id) {
                    inputTexto.value = grupoG.id;
                } else {
                    console.error('El elemento clickeado no está dentro de un <g> con ID.');
                }
                */
            });
        });
    }
}