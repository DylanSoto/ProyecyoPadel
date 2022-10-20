<?php

namespace App;

class Jugador extends Persona
{
    private $nivelJuego;
    private $manoHabil;
    private $ladoPreferido;
    private $horarioMensualPreferido;
    private $renovacionAutoHorario;
    private $indiceDeIrresponsabilidad;
    private $numFederacion;
    private $fisioAsociado;
    private $entrenadorPersonal;
    private $jugador;

    public function __construct(string $dni, string $nombre, string $apellidos, int $nivelJuego, ManoHabil $manoHabil, LadoPreferido $ladoPreferido, HorarioMensual $horarioMensualPreferido, int $indiceDeIrresponsabilidad, int $numFederacion, Fisioterapeuta $fisioAsociado, Entrenador $entrenadorPersonal, bool $jugador)
    {
        parent::__construct($dni, $nombre, $apellidos);
        $this->nivelJuego = $nivelJuego;
        $this->manoHabil = $manoHabil;
        $this->ladoPreferido = $ladoPreferido;
        $this->horarioMensualPreferido =$horarioMensualPreferido;
        $this->renovacionAutoHorario = true;
        $this->indiceDeIrresponsabilidad = $indiceDeIrresponsabilidad;
        $this->numFederacion = $numFederacion;
        $this->fisioAsociado = $fisioAsociado;
        $this->entrenadorPersonal = $entrenadorPersonal;
        $this->jugador = $jugador;
    }

    /**
     * @return int
     */
    public function getNivelJuego(): int
    {
        return $this->nivelJuego;
    }

    /**
     * @param int $nivelJuego
     */
    public function setNivelJuego(int $nivelJuego): void
    {
        $this->nivelJuego = $nivelJuego;
    }

    /**
     * @return ManoHabil
     */
    public function getManoHabil(): ManoHabil
    {
        return $this->manoHabil;
    }

    /**
     * @param ManoHabil $manoHabil
     */
    public function setManoHabil(ManoHabil $manoHabil): void
    {
        $this->manoHabil = $manoHabil;
    }

    /**
     * @return LadoPreferido
     */
    public function getLadoPreferido(): LadoPreferido
    {
        return $this->ladoPreferido;
    }

    /**
     * @param LadoPreferido $ladoPreferido
     */
    public function setLadoPreferido(LadoPreferido $ladoPreferido): void
    {
        $this->ladoPreferido = $ladoPreferido;
    }

    /**
     * @return HorarioMensual
     */
    public function getHorarioMensualPreferido(): HorarioMensual
    {
        return $this->horarioMensualPreferido;
    }

    /**
     * @param HorarioMensual $horarioMensualPreferido
     */
    public function setHorarioMensualPreferido(HorarioMensual $horarioMensualPreferido): void
    {
        $this->horarioMensualPreferido = $horarioMensualPreferido;
    }

    /**
     * @return bool
     */
    public function isRenovacionAutoHorario(): bool
    {
        return $this->renovacionAutoHorario;
    }

    /**
     * @param bool $renovacionAutoHorario
     */
    public function setRenovacionAutoHorario(bool $renovacionAutoHorario): void
    {
        $this->renovacionAutoHorario = $renovacionAutoHorario;
    }

    /**
     * @return int
     */
    public function getIndiceDeIrresponsabilidad(): int
    {
        return $this->indiceDeIrresponsabilidad;
    }

    /**
     * @param int $indiceDeIrresponsabilidad
     */
    public function setIndiceDeIrresponsabilidad(int $indiceDeIrresponsabilidad): void
    {
        $this->indiceDeIrresponsabilidad = $indiceDeIrresponsabilidad;
    }

    /**
     * @return int
     */
    public function getNumFederacion(): int
    {
        return $this->numFederacion;
    }

    /**
     * @param int $numFederacion
     */
    public function setNumFederacion(int $numFederacion): void
    {
        $this->numFederacion = $numFederacion;
    }

    /**
     * @return Fisioterapeuta
     */
    public function getFisioAsociado(): Fisioterapeuta
    {
        return $this->fisioAsociado;
    }

    /**
     * @param Fisioterapeuta $fisioAsociado
     */
    public function setFisioAsociado(Fisioterapeuta $fisioAsociado): void
    {
        $this->fisioAsociado = $fisioAsociado;
    }

    /**
     * @return Entrenador
     */
    public function getEntrenadorPersonal(): Entrenador
    {
        return $this->entrenadorPersonal;
    }

    /**
     * @param Entrenador $entrenadorPersonal
     */
    public function setEntrenadorPersonal(Entrenador $entrenadorPersonal): void
    {
        $this->entrenadorPersonal = $entrenadorPersonal;
    }

    /**
     * @return bool
     */
    public function isJugador(): bool
    {
        return $this->jugador;
    }

    /**
     * @param bool $jugador
     */
    public function setJugador(bool $jugador): void
    {
        $this->jugador = $jugador;
    }

    /*public function generarHorarioPreferido(bool $renovacion):Jugador{
        return ;
    }*/

}