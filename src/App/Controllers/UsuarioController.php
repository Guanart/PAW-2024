<?php

namespace Paw\App\Controllers;

class UsuarioController extends Controller
{
    public function login() {
        $title = "Login";
        view('usuario/login', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function register() {
        $title = "Register";
        view('usuario/register', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function forgotPassword() {
        $title = "forgotPassword";
        view('usuario/forgot-password', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

    public function verificationCode(){
        $title = "verificationCode";
        view('usuario/verification-code', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }
    
}