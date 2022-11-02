<?php

namespace App\Horarios;

use App\Horarios\Execptions\HoraNoValidaException;

include __DIR__ . "../../autoload.php";

class HorarioDiario extends Intervalo
{
    private \DateTime $fecha;
    private float $horaApertura;
    private float $horaCierre;
    private int $duracionIntervalos;
    private array $intervalosDia;

    /**
     * @throws HoraNoValidaException
     */
    public function __construct(float $horaInicio, float $horaFin, \DateTime $fecha, float $horaApertura, float $horaCierre, int $duracionIntervalos)
    {
        parent::__construct($horaInicio, $horaFin);
        $this->fecha = $fecha;
        if ($horaApertura<0 || $horaApertura>23) throw new HoraNoValidaException("Hora de Apertura no válida.");
        if ($horaCierre<0 || $horaCierre>23) throw new HoraNoValidaException("Hora de Cierre no válida.");
        if ($horaApertura>$horaCierre) throw new HoraNoValidaException("Hora de Apertura es mayor que la hora de Cierre.");
        if (Intervalo::calcularFinIntervalo($horaApertura, $duracionIntervalos)>$horaCierre) throw new HoraNoValidaException("Imposible crear un solo intervalo")
        if ($horaApertura-intval($horaApertura)>0.59) throw new HoraNoValidaException("Parte fraccionaria de la hora de apertura no válida");
        if ($horaCierre-intval($horaCierre)>0.59) throw new HoraNoValidaException("Parte fraccionaria de la hora de cierre no válida");
        $this->horaApertura = $horaApertura;
        $this->horaCierre = $horaCierre;
        $this->duracionIntervalos = $duracionIntervalos;
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

    public function generarIntervalo(): ?HorarioDiario
    {

    }

    public function imprimirHorarioDiario(): string
    {
        $horario = "";
        foreach ($this->getIntervalosDia() as $interv => $horas) {
            $horario .= $interv . " " . $horas;
        }
        return $horario;
    }
}