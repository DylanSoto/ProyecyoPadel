<?php

namespace Vistas\Personas;

use App\Personas\Persona;
use Vistas\Plantilla\Plantilla;

class PersonaVista
{
    private Plantilla $html;

    public function __construct(string $titulo)
    {
        $html=new Plantilla("Datos Personales");

    }

    public function imprimirDatosPersona(Persona $persona):string{

        $salida=$this->html->generarTodaLaPagina();
        return $salida;
    }

    /**
     * @return Plantilla
     */
    public function getHtml(): Plantilla
    {
        return $this->html;
    }

    /**
     * @param Plantilla $html
     */
    public function setHtml(Plantilla $html): void
    {
        $this->html = $html;
    }

    public function  _toString():string
    {
        return $this->html->generarHead("Hola").$this->html->generarHeader();
    }
}