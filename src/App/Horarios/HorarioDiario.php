<?php

namespace App\Horarios;

include __DIR__."../../autoload.php";

use App\Personas\Jugador;

class HorarioDiario extends Intervalo
{
    private \DateTime $fecha;
    private float $horaApertura;
    private float $horaCierre;
    private int $duracionIntervalos;
    private array $intervalosDia;

    public function __construct(float $horaInicio, float $horaFin, \DateTime $fecha, float $horaApertura, float $horaCierre)
    {
        parent::__construct($horaInicio, $horaFin);
        $this->fecha = $fecha;
        $this->horaApertura = $horaApertura;
        $this->horaCierre = $horaCierre;
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
     * @return float
     */
    public function getHoraApertura(): float
    {
        return $this->horaApertura;
    }

    /**
     * @param float $horaApertura
     */
    public function setHoraApertura(float $horaApertura): void
    {
        $this->horaApertura = $horaApertura;
    }

    /**
     * @return float
     */
    public function getHoraCierre(): float
    {
        return $this->horaCierre;
    }

    /**
     * @param float $horaCierre
     */
    public function setHoraCierre(float $horaCierre): void
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

    public function generarIntervalo():?HorarioDiario{
        return new HorarioDiario($this->getHoraInicio(), $this->getHoraFin(), $this->getFecha(), $this->getHoraApertura(), $this->getHoraCierre());
    }

    public function imprimirHorarioDiario() : string{
        $horario = "";
        foreach ($this->getIntervalosDia() as $interv => $horas){
            $horario.= $interv." ".$horas;
        }
        return $horario;
    }

}