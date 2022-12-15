<?php

namespace App\Modelo\Servicios;

use App\Servicios\ReservaParqueBolas;
use DateTime;

interface InterfazReservaParqueBolas
{
    public function insertarReserva(ReservaParqueBolas $reservaParqueBolas):?ReservaParqueBolas;
    public function borrarReserva(ReservaParqueBolas $reservaParqueBolas): ?ReservaParqueBolas;
    public function borrarTodasLasReservas():bool;
    public function borrarReservaPorFecha(DateTime $fecha):?ReservaParqueBolas;
    public function leerReserva(DateTime $fecha):?ReservaParqueBolas;
    public function leerTodasReservas():array;
}