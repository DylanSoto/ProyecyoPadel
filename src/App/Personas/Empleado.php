<?php

namespace App\Personas;

include __DIR__."../../autoload.php";


class Empleado extends Persona
{
    private string $direccion;
    private string $cuentaCorriente;
    private string $numSegSocial;
    private string $precioPorHora;
    private string $horario;
    private string $disponible;
    private string $salario;

    public function __construct(string $nombre, string $apellidos, string $dni, string $direccion, string $cuentaCorriente, string $numSegSocial){
        parent::__construct($dni, $nombre, $apellidos);
        $this->direccion = $direccion;
        $this->cuentaCorriente = $cuentaCorriente;
        $this->numSegSocial = $numSegSocial;
        $this->disponible = true;
    }

    public function getDireccion(): string
    {
        return $this->direccion;
    }


    public function setDireccion(string $direccion)
    {
        $this->direccion = $direccion;
    }


    public function getCuentaCorriente(): string
    {
        return $this->cuentaCorriente;
    }

    public function setCuentaCorriente(string $cuentaCorriente)
    {
        $this->cuentaCorriente = $cuentaCorriente;
    }


    public function getNumSegSocial(): string
    {
        return $this->numSegSocial;
    }


    public function setNumSegSocial(string $numSegSocial)
    {
        $this->numSegSocial = $numSegSocial;
    }


    public function getPrecioPorHora()
    {
        return $this->precioPorHora;
    }


    public function setPrecioPorHora($precioPorHora)
    {
        $this->precioPorHora = $precioPorHora;
    }


    public function getHorario()
    {
        return $this->horario;
    }

    public function setHorario($horario)
    {
        $this->horario = $horario;
    }


    public function isDisponible(): bool
    {
        return $this->disponible;
    }


    public function setDisponible(bool $disponible)
    {
        $this->disponible = $disponible;
    }

    public function setSalario(){
        return $this->salario;
    }

    public function calcularSalario():float{
        $this->salario = 1 * $this->precioPorHora;
        return $this->salario;
    }

    /*public function generarHorarioMes():Empleado{
        return ;
    }*/
}