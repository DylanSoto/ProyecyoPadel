<?php

namespace App\Personas;

use App\Horarios\HorarioMensual;
use App\Personas\Enum\LadoPreferido;
use App\Personas\Enum\ManoHabil;

include __DIR__."../../autoload.php";

class Jugador extends Persona
{
    private int $nivelJuego;
    private ManoHabil $manoHabil;
    private LadoPreferido $ladoPreferido;
    private HorarioMensual $horarioMensualPreferido;
    private bool $renovacionAutoHorario;
    private int $indiceDeIrresponsabilidad;
    private int $numFederacion;
    private Fisioterapeuta $fisioAsociado;
    private Entrenador $entrenadorPersonal;
    private bool $socio;

    public function __construct(string $dni, string $nombre, string $apellidos, string $email, string $password, int $nivelJuego, ManoHabil $manoHabil, LadoPreferido $ladoPreferido, HorarioMensual $horarioMensualPreferido, int $indiceDeIrresponsabilidad, int $numFederacion, Fisioterapeuta $fisioAsociado, Entrenador $entrenadorPersonal, bool $socio, string $telefono=null)
    {
        parent::__construct($dni, $nombre, $apellidos, $password, $email, $telefono);
        $this->nivelJuego = $nivelJuego;
        $this->manoHabil = $manoHabil;
        $this->ladoPreferido = $ladoPreferido;
        $this->horarioMensualPreferido =$horarioMensualPreferido;
        $this->renovacionAutoHorario = true;
        $this->indiceDeIrresponsabilidad = $indiceDeIrresponsabilidad;
        $this->numFederacion = $numFederacion;
        $this->fisioAsociado = $fisioAsociado;
        $this->entrenadorPersonal = $entrenadorPersonal;
        $this->socio = $socio;
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
    public function isSocio(): bool
    {
        return $this->socio;
    }

    /**
     * @param bool $socio
     */
    public function setSocio(bool $socio): void
    {
        $this->socio = $socio;
    }

    /*public function generarHorarioPreferido(bool $renovacion):Jugador{
        return ;
    }*/

}