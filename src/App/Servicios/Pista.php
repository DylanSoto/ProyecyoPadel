<?php

namespace App\Servicios;


use App\Servicios\Enum\TipoPista;

class Pista implements \JsonSerializable
{
    private int $idPista;
    private float $precio;
    private bool $luz;
    private float $precioLuz;
    private TipoPista $tipoPista;
    private bool $cubierta;
    private bool $disponible;
    private array $reservasPistaMensual;

    public function __construct($idPista, $precio, $luz, $precioLuz, $tipoPista, $cubierta)
    {
        $this->idPista = $idPista;
        $this->precio = $precio;
        $this->luz = $luz;
        $this->precioLuz = $precioLuz;
        $this->tipoPista = $tipoPista;
        $this->cubierta = $cubierta;
        $this->disponible = true;
    }

    /**
     * @return int
     */
    public function getIdPista(): int
    {
        return $this->idPista;
    }

    /**
     * @param int $idPista
     */
    public function setIdPista(int $idPista): void
    {
        $this->idPista = $idPista;
    }

    /**
     * @return float
     */
    public function getPrecio(): float
    {
        return $this->precio;
    }

    /**
     * @param float $precio
     */
    public function setPrecio(float $precio): void
    {
        $this->precio = $precio;
    }

    /**
     * @return bool
     */
    public function isLuz(): bool
    {
        return $this->luz;
    }

    /**
     * @param bool $luz
     */
    public function setLuz(bool $luz): void
    {
        $this->luz = $luz;
    }

    /**
     * @return float
     */
    public function getPrecioLuz(): float
    {
        return $this->precioLuz;
    }

    /**
     * @param float $precioLuz
     */
    public function setPrecioLuz(float $precioLuz): void
    {
        $this->precioLuz = $precioLuz;
    }

    /**
     * @return TipoPista
     */
    public function getTipoPista(): TipoPista
    {
        return $this->tipoPista;
    }

    /**
     * @param TipoPista $tipoPista
     */
    public function setTipoPista(TipoPista $tipoPista): void
    {
        $this->tipoPista = $tipoPista;
    }

    /**
     * @return bool
     */
    public function isCubierta(): bool
    {
        return $this->cubierta;
    }

    /**
     * @param bool $cubierta
     */
    public function setCubierta(bool $cubierta): void
    {
        $this->cubierta = $cubierta;
    }

    /**
     * @return bool
     */
    public function isDisponible(): bool
    {
        return $this->disponible;
    }

    /**
     * @param bool $disponible
     */
    public function setDisponible(bool $disponible): void
    {
        $this->disponible = $disponible;
    }

    /**
     * @return array
     */
    public function getReservasPistaMensual(): array
    {
        return $this->reservasPistaMensual;
    }

    /**
     * @param array $reservasPistaMensual
     */
    public function setReservasPistaMensual(array $reservasPistaMensual): void
    {
        $this->reservasPistaMensual = $reservasPistaMensual;
    }



    public function generarHorarioMensual(): Pista
    {
        //TODO implmentar generador de Horarios
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'idPista' => $this->idPista,
            'precio' => $this->precio,
            'luz' => $this->luz,
            'precioLuz ' => $this->precioLuz,
            'tipoPista' => $this->tipoPista,
            'cubierta' => $this->cubierta,
            'disponible' => $this->disponible
        ];
    }

    public function __serialize(): array
    {
        return [
            'idPista' => $this->idPista,
            'precio' => $this->precio,
            'luz' => $this->luz,
            'precioLuz ' => $this->precioLuz,
            'tipoPista' => $this->tipoPista,
            'cubierta' => $this->cubierta,
            'disponible' => $this->disponible
        ];
    }

}