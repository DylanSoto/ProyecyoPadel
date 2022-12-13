<?php

namespace App\Vistas\Servicios;

use App\Vistas\Plantillas\Plantilla;

class PistaVista
{
    private Plantilla $html;

    public function __construct()
    {
        $this->html = new Plantilla(
            "Pistas", encabezadoPrincipal: "Gestión de Pistas",
            descripcionPrincipal: "bienvenido al apartado para la gestión de pistas"
        );
    }

    public function mostrarPagina(): void
    {
        echo $this->html->generarWebCompleta();
    }

}