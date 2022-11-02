<?php

namespace App\Personas;

class Persona
{
    private string $dni;
    private string $nombre;
    private string $apellidos;
    private string $telefono;
    private string $email;
    private string $password;

    
    public function __construct(
        string $dni,
        string $nombre,
        string $apellidos,
        string $email,
        string $password,
        string $telefono = null
    ) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->password = $password;
    }


    public function setDNI(string $dni): Persona
    {
        $this->dni = $dni;
        return $this;
    }

    public function getDNI() :string
    {
        return $this->dni;
    }

    public function getNombre():string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Persona
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getApellidos():string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): Persona
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    public function getTelefono():string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): Persona
    {
        $this->telefono = $telefono;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}