<?php

namespace App;

class Pista extends HorarioMensual
{
    private $idPista;
    private $precio;
    private $luz;
    private $precioLuz;
    private $tipoPista;
    private $cubierta;
    private $disponible;
    private $reservasPistasMensual;

    public function __construct(int $horaInicio, int $horaFin, bool $disponibilidad, Jugador $socioReservado, date $fecha, hora $horaApertura, hora $horaCierre, int $duracionIntervalos, array $intervalosDia, int $mes, int $anyo, HorarioDiario $horarioDiario, int $idPista, float $precio, bool $luz, float $precioLuz, TipoPista $tipoPista, bool $cubierta, bool $disponible, array $reservasPistasMensual)
    {
        parent::__construct($horaInicio, $horaFin, $disponibilidad, $socioReservado, $fecha, $horaApertura, $horaCierre, $duracionIntervalos, $intervalosDia, $mes, $anyo, $horarioDiario);
        $this->idPista = $idPista;
        $this->precio = $precio;
        $this->luz = $luz;
        $this->precioLuz = $precioLuz;
        $this->tipoPista = $tipoPista;
        $this->cubierta = $cubierta;
        $this->disponible = $disponible;
        $this->reservasPistasMensual = $reservasPistasMensual;
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
    public function getReservasPistasMensual(): array
    {
        return $this->reservasPistasMensual;
    }

    /**
     * @param array $reservasPistasMensual
     */
    public function setReservasPistasMensual(array $reservasPistasMensual): void
    {
        $this->reservasPistasMensual = $reservasPistasMensual;
    }

    /*public function generarHorarioMes() : Pista{
        return ;
    }*/
}