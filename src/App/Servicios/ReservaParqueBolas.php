<?php

namespace App\Servicios;

use DateTime;

class ReservaParqueBolas
{
    private DateTime $fecha;
    private int $numHoras;
    private array $clientes;
    private float $costeHora;

    /**
     * @param string $fecha
     * @param int $numHoras
     * @param array $clientes
     * @param float $costeHora
     */
    public function __construct(string $fecha, int $numHoras, array $clientes, float $costeHora)
    {
        $this->fecha = $this->setFecha($fecha);
        $this->numHoras = $numHoras;
        $this->clientes = $clientes;
        $this->costeHora = $costeHora;
    }

    /**
     * @return string
     */
    public function getFecha(): string
    {
        return date_format($this->fecha, "d-m-y");
    }

    /**
     * @param string $fecha
     */
    public function setFecha(string $fecha): DateTime
    {
        $this->fecha = DateTime::createFromFormat("d-m-Y", $fecha);
        return $this->fecha;
    }

    /**
     * @return int
     */
    public function getNumHoras(): int
    {
        return $this->numHoras;
    }

    /**
     * @param int $numHoras
     */
    public function setNumHoras(int $numHoras): void
    {
        $this->numHoras = $numHoras;
    }

    /**
     * @return array
     */
    public function getClientes(): array
    {
        return $this->clientes;
    }

    /**
     * @param array $clientes
     */
    public function setClientes(array $clientes): void
    {
        $this->clientes = $clientes;
    }

    /**
     * @return float
     */
    public function getCosteHora(): float
    {
        return $this->costeHora;
    }

    /**
     * @param float $costeHora
     */
    public function setCosteHora(float $costeHora): void
    {
        $this->costeHora = $costeHora;
    }


}