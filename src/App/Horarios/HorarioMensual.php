<?php

namespace App\Horarios;

include __DIR__."../../autoload.php";

use App\Personas\Jugador;

class HorarioMensual extends HorarioDiario
{
    private int $mes;
    private int $anyo;
    private HorarioDiario $horariosDiarios;

    public function __construct(int $horaInicio, int $horaFin, bool $disponibilidad, Jugador $socioReservado, \DateTime $fecha, \DateTime $horaApertura, \DateTime $horaCierre, int $duracionIntervalos, array $intervalosDia, int $mes, int $anyo, HorarioDiario $horarioDiario)
    {
        parent::__construct($horaInicio, $horaFin, $disponibilidad, $socioReservado, $fecha, $horaApertura, $horaCierre, $duracionIntervalos, $intervalosDia);
        $this->mes = $mes;
        $this->anyo = $anyo;
        $this->horariosDiarios = $horarioDiario;
    }

    /**
     * @return int
     */
    public function getMes(): int
    {
        return $this->mes;
    }

    /**
     * @param int $mes
     */
    public function setMes(int $mes): void
    {
        $this->mes = $mes;
    }

    /**
     * @return int
     */
    public function getAnyo(): int
    {
        return $this->anyo;
    }

    /**
     * @param int $anyo
     */
    public function setAnyo(int $anyo): void
    {
        $this->anyo = $anyo;
    }

    /**
     * @return HorarioDiario
     */
    public function getHorariosDiarios(): HorarioDiario
    {
        return $this->horariosDiarios;
    }

    /**
     * @param HorarioDiario $horariosDiarios
     */
    public function setHorariosDiarios(HorarioDiario $horariosDiarios): void
    {
        $this->horariosDiarios = $horariosDiarios;
    }

    /*public function generarHorarios()?HorarioMensual{
        return ;
    }*/

    /* public function devolverNumHoras():int{
        return ;
    }*/
}