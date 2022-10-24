<?php

namespace App\Horarios;

use App\Personas\Jugador;

class Intervalo
{
    private \DateTime $horaInicio;
    private \DateTime $horaFin;
    private bool $disponibilidad;
    private Jugador $socioReservado;

    public function __construct(\DateTime $horaInicio, \DateTime $horaFin)
    {
        $this->horaInicio = $horaInicio;
        $this->horaFin = $horaFin;
        $this->disponibilidad = true;
    }

    /**
     * @return int
     */
    public function getHoraInicio(): \DateTime
    {
        return $this->horaInicio;
    }

    /**
     * @param int $horaInicio
     */
    public function setHoraInicio(\DateTime $horaInicio): void
    {
        $this->horaInicio = $horaInicio;
    }

    /**
     * @return int
     */
    public function getHoraFin(): \DateTime
    {
        return $this->horaFin;
    }

    /**
     * @param int $horaFin
     */
    public function setHoraFin(\DateTime $horaFin): void
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