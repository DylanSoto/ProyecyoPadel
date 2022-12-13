<?php

namespace App\Modelo\Servicios;

use App\Servicios\Pista;

class PistaDAO implements InterfazPista
{
    private $conexion;

    public function getConexion()
    {
        return $this->conexion;
    }

    public function setConexion($conexion): PistaDAO
    {
        $this->conexion = $conexion;
        return $this;
    }

    public function insertarPista(Pista $pista): ?Pista
    {
        // TODO: Implement insertarPista() method.
    }

    public function modificarPista(Pista $pista): ?Pista
    {
        // TODO: Implement modificarPista() method.
    }

    public function borrarPista(Pista $pista): ?Pista
    {
        // TODO: Implement borrarPista() method.
    }

    public function borrarPistaPorId(int $idPista): ?Pista
    {
        // TODO: Implement borrarPistaPorId() method.
    }

    public function leerPista(int $idPista): ?Pista
    {
        // TODO: Implement leerPista() method.
    }

    public function leerTodasLasPistas(): ?array
    {
        // TODO: Implement leerTodasLasPistas() method.
    }

    public function obtenerRangoPistas(int $inicio, int $numeroResultados = NUMERODERESULTADOSPORPAGINA): array
    {
        //TODO: Implement obtenerRangoPersona() method.
    }

    public function modificarTodasLasPistas(array $elementosAModificar)
    {
        // TODO: Implement modificarTodasLasPistas() method.
    }
}