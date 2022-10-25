<?php

namespace App\Personas;

use App\Horarios\HorarioMensual;
use App\Personas\Enum\LadoPreferido;
use App\Personas\Enum\ManoHabil;

include __DIR__."../../autoload.php";


class Pareja extends Jugador
{
    private Jugador $jugador1;
    private Jugador $jugador2;


    public function __construct(Jugador $jugador1, Jugador $jugador2)
    {
        $this->jugador1 = $jugador1;
        $this->jugador2 = $jugador2;
    }


    /**
     * @return Jugador
     */
    public function getJugador1(): Jugador
    {
        return $this->jugador1;
    }

    /**
     * @param Jugador $jugador1
     * @return Pareja
     */
    public function setJugador1(Jugador $jugador1): Pareja
    {
        $this->jugador1 = $jugador1;
        return $this;
    }

    /**
     * @return Jugador
     */
    public function getJugador2(): Jugador
    {
        return $this->jugador2;
    }

    /**
     * @param Jugador $jugador2
     * @return Pareja
     */
    public function setJugador2(Jugador $jugador2): Pareja
    {
        $this->jugador2 = $jugador2;
        return $this;
    }

    public function generarPareja():Pareja{
        return Pareja::__construct($this->jugador1, $this->jugador2);
    }
}