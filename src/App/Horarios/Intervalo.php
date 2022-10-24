<?php

namespace App\Horarios;

use App\Personas\Jugador;

class Intervalo
{
    private float $horaInicio;
    private float $horaFin;
    private bool $disponibilidad;
    private Jugador $socioReservado;

    public function __construct(int $horaInicio, int $horaFin)
    {
        $this->horaInicio = $horaInicio;
        $this->horaFin = $horaFin;
        $this->disponibilidad = true;
    }

    /**
     * @return int
     */
    public function getHoraInicio(): int
    {
        return $this->horaInicio;
    }

    /**
     * @param int $horaInicio
     */
    public function setHoraInicio(int $horaInicio): void
    {
        $this->horaInicio = $horaInicio;
    }

    /**
     * @return int
     */
    public function getHoraFin(): int
    {
        return $this->horaFin;
    }

    /**
     * @param int $horaFin
     */
    public function setHoraFin(int $horaFin): void
    {
        $this->horaFin = $horaFin;
    }

    /**
     * @return bool
     */
    public function isDisponibilidad(): bool
    {
        return $this->disponibilidad;
    }

    /**
     * @param bool $disponibilidad
     */
    public function setDisponibilidad(bool $disponibilidad): void
    {
        $this->disponibilidad = $disponibilidad;
    }

    /**
     * @return Jugador
     */
    public function getSocioReservado(): Jugador
    {
        return $this->socioReservado;
    }

    /**
     * @param Jugador $socioReservado
     */
    public function setSocioReservado(Jugador $socioReservado): void
    {
        $this->socioReservado = $socioReservado;
    }

    /*public function reservarHorario(Jugador) : Intervalo{
         return ;
    }*/
}