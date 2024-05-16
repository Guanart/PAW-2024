/*
ESTE CODIGO SIMPLEMENTE ERA UNA PRUEBA DE GENERACION DE JSONS PARA LAS RESERVAS 
.
.
.
.
.
*/
class Local {
    constructor(nombre) {
        this.nombre = nombre;
        this.pisos = [];
    }

    agregarPiso(piso) {
        if (!this.pisos.includes(piso)) {
            this.pisos.push(piso);
        }
    }

    agregarMesa(mesa, piso) {
        if (this.pisos.includes(piso)) {
            piso.agregarMesa(mesa);
        }
    }

    agregarReserva(mesa, piso, horaInicio, horaFin) {
        if (this.pisos.includes(piso)) {
            piso.agregarReserva(mesa, horaInicio, horaFin);
        }
    }

    obtenerMesasOcupadas(horaInicio, horaFin) {
        let mesasOcupadas = [];
        this.pisos.forEach(piso => {
            const mesasOcupadasPiso = piso.obtenerMesasOcupadas(horaInicio, horaFin);
            if (mesasOcupadasPiso.length !== 0) {
                mesasOcupadas = mesasOcupadas.concat(mesasOcupadasPiso);
            }
        });
        return mesasOcupadas;
    }
}

class Piso {
    constructor(nombre) {
        this.nombre = nombre;
        this.mesas = [];
    }

    agregarMesa(mesa) {
        this.mesas.push(mesa);
    }

    obtenerMesasOcupadas(horaInicio, horaFin) {
        const mesasOcupadas = this.mesas.filter(mesa => !mesa.estaDisponible(horaInicio, horaFin));
        return mesasOcupadas;
    }

    agregarReserva(mesa, horaInicio, horaFin) {
        if (this.mesas.includes(mesa)) {
            mesa.addReserva(horaInicio, horaFin);
        }
    }
}

class Mesa {
    constructor(numero) {
        this.numero = numero;
        this.reservas = [];
    }

    estaDisponible(horaInicio, horaFin) {
        let libre = true
        this.reservas.forEach(reserva => {
            if (reserva.seSuperpone(horaInicio, horaFin)) {
                libre = false;
            }
        });
        return libre
    }

    addReserva(horaInicio, horaFin) {
        if (this.estaDisponible(horaInicio, horaFin)) {
            const nuevaReserva = new Reserva(horaInicio, horaFin);
            this.reservas.push(nuevaReserva);
        }
    }
}

class Reserva {
    constructor(horaInicio, horaFin) {
        this.horaInicio = horaInicio;
        this.horaFin = horaFin;
    }

    seSuperpone(horaInicio, horaFin) {
        return (horaInicio >= this.horaInicio && horaInicio < this.horaFin) ||
               (horaFin > this.horaInicio && horaFin <= this.horaFin);
    }
}

function formatearJSON(jsonString) {
    const objeto = JSON.parse(jsonString);
    // Iteramos sobre los pisos
    objeto.pisos.forEach(piso => {
        // Si la propiedad 'mesas' no es un arreglo, la convertimos en un arreglo
        if (!Array.isArray(piso.mesas)) {
            piso.mesas = [piso.mesas];
        }
        // Iteramos sobre las mesas del piso
        piso.mesas.forEach(mesa => {
            // Si la propiedad 'reservas' no es un arreglo, la convertimos en un arreglo vacío
            if (!Array.isArray(mesa.reservas)) {
                mesa.reservas = [];
            } else {
                // Iteramos sobre las reservas de la mesa y convertimos las fechas a cadenas legibles
                mesa.reservas.forEach(reserva => {
                    reserva.horaInicio = new Date(reserva.horaInicio).toISOString();
                    reserva.horaFin = new Date(reserva.horaFin).toISOString();
                });
            }
        });
    });
    return JSON.stringify(objeto, null, 4);
}


const local = new Local("Mi Local");

// Agregar mesas al restaurante
const piso1 = new Piso("Piso-1");
const piso2 = new Piso("Piso-2");

local.agregarPiso(piso1);
local.agregarPiso(piso2);

const mesa1 = new Mesa("mesa-262");
const mesa2 = new Mesa("mesa-342");
const mesa3 = new Mesa("mesa-261");

const mesa4 = new Mesa("mesa-161");
const mesa5 = new Mesa("mesa-121");
const mesa6 = new Mesa("mesa-122");

local.agregarMesa(mesa1, piso2);
local.agregarMesa(mesa2, piso2);
local.agregarMesa(mesa3, piso2);
local.agregarMesa(mesa4, piso1);
local.agregarMesa(mesa5, piso1);
local.agregarMesa(mesa6, piso1);

// Agregar reserva
const fechaInicio = new Date(2024, 4, 13, 10, 30, 0); //10:30 a.m. del 13 del 4 de 2024.
const fechaFin = new Date(2024, 4, 13, 12, 0, 0); //11:30 a.m. del 13 del 4 de 2024.

const fechaInicio2 = new Date(2024, 4, 13, 12, 0, 0); //10:30 a.m. del 13 del 4 de 2024.
const fechaFin2 = new Date(2024, 4, 13, 13, 30, 0); //11:30 a.m. del 13 del 4 de 2024.

local.agregarReserva(mesa1, piso2, fechaInicio, fechaFin);
local.agregarReserva(mesa2, piso2, fechaInicio, fechaFin);
local.agregarReserva(mesa3, piso2, fechaInicio, fechaFin);

local.agregarReserva(mesa4, piso1, fechaInicio2, fechaFin2);
local.agregarReserva(mesa5, piso1, fechaInicio2, fechaFin2);
local.agregarReserva(mesa6, piso1, fechaInicio2, fechaFin2);

const jsonString = JSON.stringify(local);
const jsonFormateado = formatearJSON(jsonString);
console.log(jsonFormateado);

/*
console.log("-----------------------------------------");

const mesasOcupadas = local.obtenerMesasOcupadas(fechaInicio, fechaFin);
const json = JSON.stringify(mesasOcupadas);
*/