<?php

namespace App\Modelo\Servicios;

use App\Servicios\Pista;

interface InterfazPista
{
    public function insertarPista(Pista $pista): ?Pista;

    public function modificarPista(Pista $pista): ?Pista;

    public function modificarTodasLasPistas(array $elementosAModificar);

    public function borrarPista(Pista $pista): ?Pista;

    public function borrarTodasLasPistas(): bool;

    public function borrarPistaPorId(int $id): ?Pista;

    public function leerPista(int $id): ?Pista;

    public function leerTodasLasPistas(): ?array;

    public function obtenerRangoPistas(int $inicio, int $numeroResultados = NUMERODERESULTADOSPORPAGINA): array;

    public function existeIdPista(int $idPista): bool;
}