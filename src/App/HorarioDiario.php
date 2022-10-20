<?php

namespace App;

use http\Encoding\Stream;

class HorarioDiario extends Intervalo
{
    private \DateTime $fecha;
    private float $horaApertura;
    private float $horaCierre;
    private int $duracionIntervalos;
    private array $intervalosDia;

    public function __construct(int $horaInicio, int $horaFin, bool $disponibilidad, Jugador $socioReservado, $fecha, $horaApertura, $horaCierre, $duracionIntervalos, $intervalosDia)
    {
        parent::__construct($horaInicio, $horaFin, $disponibilidad, $socioReservado);
        $this->fecha = $fecha;
        $this->horaApertura = $horaApertura;
        $this->horaCierre = $horaCierre;
        $this->duracionIntervalos = $duracionIntervalos;
        $this->intervalosDia = $intervalosDia;
    }

    /**
     * @return date
     */
    public function getFecha(): date
    {
        return $this->fecha;
    }

    /**
     * @param date $fecha
     */
    public function setFecha(date $fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return hora
     */
    public function getHoraApertura(): hora
    {
        return $this->horaApertura;
    }

    /**
     * @param hora $horaApertura
     */
    public function setHoraApertura(hora $horaApertura): void
    {
        $this->horaApertura = $horaApertura;
    }

    /**
     * @return hora
     */
    public function getHoraCierre(): hora
    {
        return $this->horaCierre;
    }

    /**
     * @param hora $horaCierre
     */
    public function setHoraCierre(hora $horaCierre): void
    {
        $this->horaCierre = $horaCierre;
    }

    /**
     * @return int
     */
    public function getDuracionIntervalos(): int
    {
        return $this->duracionIntervalos;
    }

    /**
     * @param int $duracionIntervalos
     */
    public function setDuracionIntervalos(int $duracionIntervalos): void
    {
        $this->duracionIntervalos = $duracionIntervalos;
    }

    /**
     * @return array
     */
    public function getIntervalosDia(): array
    {
        return $this->intervalosDia;
    }

    /**
     * @param array $intervalosDia
     */
    public function setIntervalosDia(array $intervalosDia): void
    {
        $this->intervalosDia = $intervalosDia;
    }

    /*public function generarIntervalo()?HorarioDiario{
        return ;
    }*/

    /*public function imprimirHorarioDiario() :String{
        return ;
    }*/
}