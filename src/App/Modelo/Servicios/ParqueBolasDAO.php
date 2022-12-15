<?php

namespace App\Modelo\Servicios;

use App\Servicios\ReservaParqueBolas;
use DateTime;

class ParqueBolasDAO implements InterfazReservaParqueBolas
{
    private $conexion;

    public function getConexion()
    {
        return $this->conexion;
    }

    public function setConexion($conexion): ParqueBolasDAO
    {
        $this->conexion = $conexion;
        return $this;
    }

    public function insertarReserva(ReservaParqueBolas $reservaParqueBolas): ?ReservaParqueBolas
    {
        // TODO: Implement insertarReserva() method.
    }

    public function borrarReserva(ReservaParqueBolas $reservaParqueBolas): ?ReservaParqueBolas
    {
        // TODO: Implement borrarReserva() method.
    }

    public function borrarTodasLasReservas(): bool
    {
        // TODO: Implement borrarTodasLasReservas() method.
    }

    public function borrarReservaPorFecha(DateTime $fecha): ?ReservaParqueBolas
    {
        // TODO: Implement borrarReservaPorFecha() method.
    }

    public function leerReserva(DateTime $fecha): ?ReservaParqueBolas
    {
        // TODO: Implement leerReserva() method.
    }

    public function leerTodasReservas(): array
    {
        // TODO: Implement leerTodasReservas() method.
    }
}