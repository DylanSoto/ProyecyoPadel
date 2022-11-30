<?php

namespace App\Vistas;

use App\Vistas\Plantillas\Plantilla;

class LandingVista
{
    private Plantilla $html;

    public function __construct()
    {
        session_start();
        if ($_SESSION['logeado']){
            $this->html = new Plantilla("Cobra Padel", menu: ['Inicio'=>'/','Log-Out'=>'/logout','Pistas'=>'/pistas'],
                encabezadoPrincipal: "Cobra Pádel",
                descripcionPrincipal: "Si amas el pádel este es tu lugar, bienvenido");
        }else{
            $this->html = new Plantilla("Cobra Padel", menu: ['Inicio'=>'/','Log-In'=>'/login','Pistas'=>'/pistas'],
                encabezadoPrincipal: "Cobra Pádel",
                descripcionPrincipal: "Si amas el pádel este es tu lugar, bienvenido");
        }

        $this->html->generarTestimonio();
        $this->html->generarServicios();
        $this->html->generarPrecios();
        $this->html->generarEmpleados();
    }

    public function mostrarPagina():void{
        session_start();
        echo $this->html->generarWebCompleta();
    }


}