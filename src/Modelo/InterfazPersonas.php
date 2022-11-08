<?php

namespace Modelo;

use App\Personas\Persona;

interface InterfazPersonas
{
    public function insertarPersona(Persona $persona):?Persona;
    public function modificarPersona(Persona $persona):?Persona;
    public function borrarPersona(Persona $persona):?Persona;
    public function borrarPersonaPorDNI(string $dni):?Persona;
    public function leerPersona(string $dni):?Persona;

    public function leerTodasPersonas():array;
    public function obtenerPersonasSinTelefono():array;
    public function obtenerPersonasPorNombre(string $nombre):array;
    public function obtenerPersonasPorApellido(string $apellido):array;
    public function obtenerRangoPersonas(int $inicio, int $numeroResultados=NUMERODERESULTADOSPORPAGINA):array;
}