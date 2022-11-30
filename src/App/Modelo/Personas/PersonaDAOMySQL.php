<?php

namespace App\Modelo\Personas;

use App\Modelo\Excepciones\ActualizarPersonasException;
use App\Modelo\Excepciones\PersonaNoEncontradaException;
use App\Personas\Persona;
use PDO;

require_once __DIR__ . "/../../datosConexionBD.php";
require_once __DIR__ . "/../../datosConfiguracion.php";

class PersonaDAOMySQL extends PersonaDAO
{
    public function __construct()
    {
        $this->setConexion(
            new PDO(
                "mysql:host=" . HOSTBD .
                ";dbname=" . NOMBREBD, USUARIOBD, PASSBD
            )
        );

        $this->getConexion()->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );
    }

    /**
     * @throws PersonaNoEncontradaException
     */
    public function leerPersona(string $dni): ?Persona
    {
        $query = "SELECT * FROM persona WHERE DNI= ?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $dni);
        $sentencia->execute();

        if (($fila = $sentencia->fetch())) {
            if ($fila['TELEFONO'] == null) {
                return new Persona(
                    $fila['DNI'],
                    $fila['NOMBRE'],
                    $fila['APELLIDOS'],
                    $fila['EMAIL'],
                    $fila['CONTRASENYA']
                );
            } else {
                return new Persona(
                    $fila['DNI'],
                    $fila['NOMBRE'],
                    $fila['APELLIDOS'],
                    $fila['TELEFONO'],
                    $fila['EMAIL'],
                    $fila['CONTRASENYA']
                );
            }
        } else {
            throw new PersonaNoEncontradaException("La persona no existe en la base de datos.");
        }
    }

    public function modificarPersona(Persona $persona): ?Persona
    {
        $query = "UPDATE persona SET NOMBRE=:nombre, APELLIDOS=:apellidos,
                   TELEFONO=:telefono, EMAIL=:email, CONTRASENYA=:contrasenya
                   WHERE DNI=:dni";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindValue("nombre", $persona->getNombre());
        $sentencia->bindValue("apellidos", $persona->getApellidos());
        $sentencia->bindValue("telefono", $persona->getTelefono());
        $sentencia->bindValue("email", $persona->getEmail());
        $sentencia->bindValue("contrasenya", $persona->getContrasenya());
        $sentencia->bindValue("dni", $persona->getDNI());

        $resultado = $sentencia->execute();

        if ($resultado) {
            return $persona;
        } else {
            return null;
        }
    }

    /**
     * @throws ActualizarPersonasException
     */
    public function modificarTodasLasPersonas(array $elementosAModificar)
    {
        $query = "UPDATE persona SET ";

        if (isset($elementosAModificar['nombre'])) {
            $query .= "NOMBRE=:nombre,";
        }
        if (isset($elementosAModificar['apellidos'])) {
            $query .= "APELLIDOS=:apellidos,";
        }
        if (isset($elementosAModificar['telefono'])) {
            $query .= "TELEFONO=:telefono,";
        }
        if (isset($elementosAModificar['contrasenya'])) {
            $query .= "CONTRASENYA=:contrasenya,";
        }

        $query = substr($query, 0, -1);
        $sentencia = $this->getConexion()->prepare($query);

        if (isset($elementosAModificar['nombre'])) {
            $sentencia->bindParam("nombre", $elementosAModificar['nombre']);
        }
        if (isset($elementosAModificar['apellidos'])) {
            $sentencia->bindParam("apellidos", $elementosAModificar['apellidos']);
        }
        if (isset($elementosAModificar['telefono'])) {
            $sentencia->bindParam("telefono", $elementosAModificar['telefono']);
        }
        if (isset($elementosAModificar['contrasenya'])) {
            $passCifrada = password_hash($elementosAModificar['contrasenya'], PASSWORD_DEFAULT);
            $sentencia->bindParam("contrasenya", $passCifrada);
        }

        try {
            $sentencia->execute();
        } catch (\PDOException $e) {
            throw new ActualizarPersonasException("No se han podido actualizar las personas");
        }
    }

    /**
     * @throws PersonaNoEncontradaException
     */
    public function borrarPersonaPorDNI(string $dni): ?Persona
    {
        try {
            $persona = $this->leerPersona($dni);
        } catch (PersonaNoEncontradaException $e) {
            throw new PersonaNoEncontradaException("No existe esa persona a borrar.");
        }

        $query = "DELETE FROM persona WHERE DNI=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $dni);
        $resultado = $sentencia->execute();

        if ($resultado) {
            return $persona;
        } else {
            return null;
        }
    }

    /**
     * @throws PersonaNoEncontradaException
     */
    public function borrarPersona(Persona $persona): ?Persona
    {
        return $this->borrarPersonaPorDNI($persona->getDNI());
    }

    public function borrarTodasLasPersonas(): bool
    {
        $sentencia = $this->getConexion()->query("TRUNCATE persona");
        return $sentencia->execute();
    }

    public function insertarPersona(Persona $persona): ?Persona
    {
        if ($persona->getTelefono() === '') {
            $query = "INSERT INTO persona (DNI, NOMBRE, APELLIDOS, TELEFONO, EMAIL, CONTRASENYA) 
                        VALUES (:dni, :nombre, :apellidos, NULL, :email, :pass)";

            $sentencia = $this->getConexion()->prepare($query);
            $sentencia->bindValue("dni", $persona->getDNI());
            $sentencia->bindValue("nombre", $persona->getNombre());
            $sentencia->bindValue("apellidos", $persona->getApellidos());
            $sentencia->bindValue("email", $persona->getEmail());
            $sentencia->bindValue("pass", $persona->getContrasenya());
        } else {
            $query = "INSERT INTO persona (DNI, NOMBRE, APELLIDOS, TELEFONO, EMAIL, CONTRASENYA) 
                        VALUES (:dni, :nombre, :apellidos, :telefono, :email, :pass)";

            $sentencia = $this->getConexion()->prepare($query);
            $sentencia->bindValue("dni", $persona->getDNI());
            $sentencia->bindValue("nombre", $persona->getNombre());
            $sentencia->bindValue("apellidos", $persona->getApellidos());
            $sentencia->bindValue("telefono", $persona->getTelefono());
            $sentencia->bindValue("email", $persona->getEmail());
            $sentencia->bindValue("pass", $persona->getContrasenya());
        }
        $resultado = $sentencia->execute();

        if ($resultado) {
            return $persona;
        } else {
            return null;
        }
    }

    public function leerTodasPersonas(): array
    {
        $resultado = $this->getConexion()->query("SELECT * FROM persona");
        $resultado->execute();
        $arrayResultados = $resultado->fetchAll();
        $arrayObjetos = [];
        foreach ($arrayResultados as $filaPersona) {
            $arrayObjetos[] = $this->convertirArrayAPersona($filaPersona);
        }
        return $arrayObjetos;
    }

    public function obtenerRangoPersonas(int $inicio, int $numeroResultados = NUMERODERESULTADOSPORPAGINA): array
    {
        $resultado = $this->getConexion()->query("SELECT * FROM persona LIMIT $inicio, $numeroResultados");
        $resultado->execute();
        $arrayResultados = $resultado->fetchAll();
        $arrayObjetos = [];
        foreach ($arrayResultados as $filaPersona) {
            $arrayObjetos[] = $this->convertirArrayAPersona($filaPersona);
        }
        return $arrayObjetos;
    }

    private function convertirArrayAPersona(array $datosPersona): ?Persona
    {
        if ($datosPersona['TELEFONO'] == null) {
            $datosPersona['TELEFONO'] = '';
        }
        return new Persona(
            $datosPersona['DNI'], $datosPersona['NOMBRE'],
            $datosPersona['APELLIDOS'], $datosPersona['EMAIL'], $datosPersona['CONTRASENYA'], $datosPersona['TELEFONO']
        );
    }

    public function obtenerPersonasSinTelefono(): array
    {
        $query = "SELECT * FROM persona WHERE TELEFONO IS NULL";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->execute();
        $resultado = $sentencia;

        $arrayPersonas = false;

        if ($resultado) {
            foreach ($resultado as $informacionPersona) {
                $arrayPersonas[] = $this->convertirArrayAPersona($informacionPersona);
            }
        }

        return $arrayPersonas;
    }

    public function obtenerPersonasPorNombre(string $nombre): array
    {
        $query = "SELECT * FROM persona WHERE NOMBRE=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->execute();
        $resultado = $sentencia;

        $arrayPersonas = false;

        if ($resultado) {
            foreach ($resultado as $informacionPersona) {
                $arrayPersonas[] = $this->convertirArrayAPersona($informacionPersona);
            }
        }

        return $arrayPersonas;
    }

    public function obtenerPersonasPorApellido(string $apellido): array
    {
        $query = "SELECT * FROM persona WHERE APELLIDO=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->execute();
        $resultado = $sentencia;

        $arrayPersonas = false;

        if ($resultado) {
            foreach ($resultado as $informacionPersona) {
                $arrayPersonas[] = $this->convertirArrayAPersona($informacionPersona);
            }
        }

        return $arrayPersonas;
    }

    public function leerPersonaPorEmail(string $email): ?Persona
    {
        $query = "SELECT * FROM persona WHERE EMAIL=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $email);

        if ($sentencia->execute()) {
            $resultado = $sentencia->fetch();
            return $this->convertirArrayAPersona($resultado);
        } else {
            return null;
        }
    }

    public function existeDNI($dni): bool
    {
        $query = "SELECT * FROM persona WHERE DNI=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $dni);
        $sentencia->execute();

        return ($sentencia->execute());
    }

    public function existeEmail($email): bool
    {
        $query = "SELECT * FROM persona WHERE EMAIL=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $email);
        $sentencia->execute();

        return ($sentencia->execute());
    }
}