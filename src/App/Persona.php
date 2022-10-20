<?php

namespace App;

class Persona
{
    private $dni;
    private $nombre;
    private $apellidos;
    private $telefono;

    public function __construct(string $dni, string $nombre, string $apellidos){
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
    }
    public function setDNI(string $dni):Persona{
        $this->dni = $dni;
        return $this;
    }

    public function getDNI(){
        return $this->dni;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre(string $nombre):Persona{
        $this->nombre = $nombre;
        return $this;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos):Persona{
        $this->apellidos = $apellidos;
        return $this;
    }

    function getTelefono(){
        return $this->telefono;
    }

    public function setTelefono(string $telefono) :Persona{
        $this->telefono = $telefono;
        return $this;
    }


}