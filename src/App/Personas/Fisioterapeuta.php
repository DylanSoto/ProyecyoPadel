<?php

namespace App\Personas;

include __DIR__."../../autoload.php";


class Fisioterapeuta extends Empleado
{
    private Jugador $clienteVIP;
    private int $numColegiado;

    public function __construct(string $nombre, string $apellidos, string $dni, string $direccion, string $cuentaCorriente, string $numSegSocial, Jugador $clienteVIP, int $numColegiado)
    {
        parent::__construct($nombre, $apellidos, $dni, $direccion, $cuentaCorriente, $numSegSocial);
        $this->clienteVIP = $clienteVIP;
        $this->numColegiado = $numColegiado;
    }

    /**
     * @return Jugador
     */
    public function getClienteVIP(): Jugador
    {
        return $this->clienteVIP;
    }

    /**
     * @param Jugador $clienteVIP
     */
    public function setClienteVIP(Jugador $clienteVIP): void
    {
        $this->clienteVIP = $clienteVIP;
    }

    /**
     * @return int
     */
    public function getNumColegiado(): int
    {
        return $this->numColegiado;
    }

    /**
     * @param int $numColegiado
     */
    public function setNumColegiado(int $numColegiado): void
    {
        $this->numColegiado = $numColegiado;
    }


}