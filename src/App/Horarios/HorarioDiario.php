<?php

namespace App\Horarios;


use App\Personas\Jugador;

class HorarioDiario extends Intervalo
{
    private \DateTime $fecha;
    private \DateTime $horaApertura;
    private \DateTime $horaCierre;
    private int $duracionIntervalos;
    private array $intervalosDia;

    public function __construct(int $horaInicio, int $horaFin, bool $disponibilidad, Jugador $socioReservado, \DateTime $fecha, \DateTime $horaApertura, \DateTime $horaCierre, int $duracionIntervalos, array $intervalosDia)
    {
        parent::__construct($horaInicio, $horaFin);
        $this->fecha = $fecha;
        $this->horaApertura = $horaApertura;
        $this->horaCierre = $horaCierre;
        $this->duracionIntervalos = $duracionIntervalos;
        $this->intervalosDia = $intervalosDia;
    }

    /**
     * @return \DateTime
     */
    public function getFecha(): \DateTime
    {
        return $this->fecha;
    }

    /**
     * @param \DateTime $fecha
     */
    public function setFecha(\DateTime $fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return \DateTime
     */
    public function getHoraApertura(): \DateTime
    {
        return $this->horaApertura;
    }

    /**
     * @param \DateTime $horaApertura
     */
    public function setHoraApertura(\DateTime $horaApertura): void
    {
        $this->horaApertura = $horaApertura;
    }

    /**
     * @return \DateTime
     */
    public function getHoraCierre(): \DateTime
    {
        return $this->horaCierre;
    }

    /**
     * @param \DateTime $horaCierre
     */
    public function setHoraCierre(\DateTime $horaCierre): void
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