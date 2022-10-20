<?php

namespace App;

class Fisioterapeuta extends Empleado
{
    private $clienteVIP;

    public function __construct(string $nombre, string $apellidos, string $dni, string $direccion, string $cuentaCorriente, string $numSegSocial, Jugador $clienteVIP)
    {
        parent::__construct($nombre, $apellidos, $dni, $direccion, $cuentaCorriente, $numSegSocial);
        $this->clienteVIP = $clienteVIP;
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
}