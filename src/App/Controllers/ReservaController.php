<?php

namespace Paw\App\Controllers;

use Paw\Core\Request;
use Paw\App\Repositories\ReservaRepository;
use Twig\Environment;
use Paw\Core\Exceptions\InvalidValueFormatException;
use DateTime;

class ReservaController extends Controller
{
    private $twig;

    public function __construct(Environment $twig) {
        parent::__construct(ReservaRepository::class);
        $this->twig = $twig;
    }

    public function seleccionMesa(Request $request, $mensaje="") {
        $input = $request->get('local');
        $local = ucwords($input);
        $title = "Seleccion de Mesa";
        $_SESSION["reserva_local"] = $input;
        $variables = [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'local' => $local,
            "mensaje" => $mensaje,
        ];
        if ($request->isPost()) {
            $variables['mostrarMensaje'] = true;
        }
        echo $this->twig->render('reserva/seleccion_mesa.view.twig', $variables);
    }

    public function seleccionMesaFormulario(Request $request) {

        if (!$request->post('idMesa')) {
            $mensaje = "Debe ingresar una mesa";
            $this->seleccionMesa($request, $mensaje);
            return;
        }

        $dateTime = new DateTime("{$request->post('fecha')} {$request->post('hora')}");
        $formattedDateTime = $dateTime->format('Y-m-d H:i:s');

        $reservaPrevia = $this->repository->getByFechaMesaLocal($formattedDateTime, $request->post('idMesa'), $_SESSION["reserva_local"]);
        if ($reservaPrevia) {
            $mensaje = "Esa mesa ya se encuentra reservada para esa hora";
            $this->seleccionMesa($request, $mensaje);
            return;
        }
        
        $data = [
            'id_usuario' => $request->user()->getId(),
            'mesa' => $request->post('idMesa'),
            'fecha' =>  $formattedDateTime,
            'local' => $_SESSION["reserva_local"],
        ];
        try {
            $reserva = $this->repository->create($data);
            redirect(getenv('APP_URL') . "/fin_reserva");
            exit();
        } catch (InvalidValueFormatException $e) {
            $mensaje = $e->getMessage();
            $this->seleccionMesa($request, $mensaje);
        }
    }

    // Arreglar
    public function reservasMesa(Request $request) {
        $dateTime = new DateTime("{$request->get('fecha')} {$request->get('hora')}");
        $formattedDateTime = $dateTime->format('Y-m-d H:i:s');
        $local = $_SESSION["reserva_local"];
        $reservas = $this->repository->getByFechaLocal($formattedDateTime, $local);
        echo json_encode($reservas);
    }

    public function reservas() {
        $title = "Reservas";
        echo $this->twig->render('reserva/reservas.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function locales() {
        $title = "Locales";
        echo $this->twig->render('reserva/reservas.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function finReserva(){
        $title = "Fin de la Reserva";
        echo $this->twig->render('reserva/fin_reserva.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function local(Request $request) {
        $input = $request->get('local');
        $local = ucwords($input);
        $title = $local;
        echo $this->twig->render('reserva/local.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'local' => $local,
            'title' => $local,
        ]);
    }
}