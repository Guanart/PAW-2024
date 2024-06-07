<?php

namespace Paw\App\Controllers;

use Paw\Core\Request;
use Paw\App\Repositories\ReservaRepository;
use Twig\Environment;

class ReservaController extends Controller
{
    private $twig;

    public function __construct(Environment $twig) {
        parent::__construct(ReservaRepository::class);
        $this->twig = $twig;
    }

    public function seleccionMesa(Request $request){
        $input = $request->get('local');
        $local = ucwords($input);
        $title = "Seleccion de Mesa";
        $_SESSION["reserva_local"] = $input;

        echo $this->twig->render('reserva/seleccion_mesa.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'local' => $local,
        ]);
    }

    public function reservasMesa(Request $request) {
        header('Content-Type: application/json');
        // 1. Recupera 
        $idLocal = $_GET['idLocal'];
        $fecha = $_GET['fecha'];
        $hora = $_GET['hora'];

    }

    public function agregarReserva(Request $request) {
        // dd($request->post());
        $data = [
            'id_usuario' => $request->user()->getId(),
            'mesa' => $request->post('idMesa'),
            'fecha' => $request->post('fecha'),
            'hora' => $request->post('hora'),
            'local' => $_SESSION["reserva_local"],
        ];

        // dd($data);die;
        $reserva = $this->repository->create($data);
        // dd($reserva);

        redirect(getenv('APP_URL') . "/fin_reserva");
        exit();
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

    public function local2(Request $request) {
        $input = $request->get('local');
        $local = ucwords($input);
        $title = $local;
        echo $this->twig->render('reserva/local2.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'local' => $local,
            'title' => $local,
        ]);
    }
}