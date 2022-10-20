<?php

namespace App;

class Pareja extends Jugador
{
    private Jugador $jugador1;
    private Jugador $jugador2;

    public function __construct(string $dni, string $nombre, string $apellidos, int $nivelJuego, ManoHabil $manoHabil, LadoPreferido $ladoPreferido, HorarioMensual $horarioMensualPreferido, int $indiceDeIrresponsabilidad, int $numFederacion, Fisioterapeuta $fisioAsociado, Entrenador $entrenadorPersonal, bool $jugador, $jugador1, $jugador2)
    {
        parent::__construct($dni, $nombre, $apellidos, $nivelJuego, $manoHabil, $ladoPreferido, $horarioMensualPreferido, $indiceDeIrresponsabilidad, $numFederacion, $fisioAsociado, $entrenadorPersonal, $jugador);
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