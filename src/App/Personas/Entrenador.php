<?php

namespace App\Personas;

class Entrenador extends Empleado
{
    private int $nivelEntrenador;
    private int $numFederacion;
    private Jugador $pupilo;

    public function __construct(string $nombre, string $apellidos, string $dni, string $direccion, string $cuentaCorriente, string $numSegSocial, int $nivelEntrenador, int $numFederacion, Jugador $pupilo)
    {
        parent::__construct($nombre, $apellidos, $dni, $direccion, $cuentaCorriente, $numSegSocial);
        $this->nivelEntrenador = $nivelEntrenador;
        $this->numFederacion = $numFederacion;
        $this->pupilo = $pupilo;
    }

    /**
     * @return int
     */
    public function getNivelEntrenador(): int
    {
        return $this->nivelEntrenador;
    }

    /**
     * @param int $nivelEntrenador
     */
    public function setNivelEntrenador(int $nivelEntrenador): void
    {
        $this->nivelEntrenador = $nivelEntrenador;
    }

    /**
     * @return int
     */
    public function getNumFederacion(): int
    {
        return $this->numFederacion;
    }

    /**
     * @param int $numFederacion
     */
    public function setNumFederacion(int $numFederacion): void
    {
        $this->numFederacion = $numFederacion;
    }

    /**
     * @return Jugador
     */
    public function getPupilo(): Jugador
    {
        return $this->pupilo;
    }

    /**
     * @param Jugador $pupilo
     */
    public function setPupilo(Jugador $pupilo): void
    {
        $this->pupilo = $pupilo;
    }


}