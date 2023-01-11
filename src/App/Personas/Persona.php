<?php

namespace App\Personas;

use App\Log\LogFactorty;
use Monolog\Logger;

class Persona implements \JsonSerializable
{
    private string $dni;
    private string $nombre;
    private string $apellidos;
    private string $telefono;
    private string $email;
    private string $contrasenya;

    private Logger $log;

    public function __construct(
        string $dni,
        string $nombre,
        string $apellidos,
        string $email,
        string $contrasenya,
        string $telefono = ''
    ) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->contrasenya = $contrasenya;

        $this->log = LogFactorty::getLoger();
    }


    public function setDNI(string $dni): Persona
    {
        $this->dni = $dni;
        return $this;
    }

    public function getDNI(): string
    {
        return $this->dni;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Persona
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): Persona
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    public function getTelefono(): string
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
    public function getContrasenya(): string
    {
        return $this->contrasenya;
    }

    /**
     * @param string $contrasenya
     */
    public function setContrasenya(string $contrasenya): void
    {
        $this->contrasenya = $contrasenya;
    }

    public function __toString(): string
    {
        return $this->nombre . " " . $this->apellidos . " " . $this->dni;
    }

    public function jsonSerialize(): array
    {
        return [
            'dni' => $this->dni,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'telefono' => $this->telefono,
            'email' => $this->email
        ];
    }

    public function __serialize(): array
    {
        return [
            'dni' => $this->dni,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'contrasenya' => $this->contrasenya
        ];
    }
}