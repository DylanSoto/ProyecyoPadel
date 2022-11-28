<?php

namespace Vistas;

use Vistas\Plantillas\Plantilla;

class LandingVista
{
    private Plantilla $html;

    public function __construct(){
        session_start();
        if ($_SESSION['logeado']){

        }
    }

    public function index(){
        $this->html->generarTodaLaPagina();
    }
}