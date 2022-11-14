<?php

namespace Modelo\Personas;

use App\Personas\Persona;

require_once __DIR__ . "../../../datosConexionBD.php";
require_once __DIR__ . "../../../datosConfiguracion.php";

class PersonaDAOMySQL extends PersonaDAO
{
    public function __construct()
    {
        $this->setConexion(new \PDO("mysql:host=" . HOSTBD . ";dbname=" . NOMBREBD, USUARIOBD, PASSBD));

        $this->getConexion()->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function leerPersona(string $dni): ?Persona
    {
        $query = "SELECT * FROM persona WHERE DNI= ?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $dni);
        $sentencia->execute();
        $fila = $sentencia->fetch();
        return new Persona(
            $fila['DNI'],
            $fila['NOMBRE'],
            $fila['APELLIDOS'],
            $fila['TELEFONO'],
            $fila['EMAIL'],
            $fila['PASS']
        );
    }

    public function modificarPersona(Persona $persona): ?Persona
    {
        $query = "UPDATE persona SET NOMBRE=:nombre, APELLIDOS=:apellidos,
                   TELEFONO=:telefono, EMAIL=:email, CONTRASENYA=:password
                   WHERE DNI=:dni";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindValue("nombre", $persona->getNombre());
        $sentencia->bindValue("apellidos", $persona->getApellidos());
        $sentencia->bindValue("telefono", $persona->getTelefono());
        $sentencia->bindValue("email", $persona->getEmail());
        $sentencia->bindValue("pass", $persona->getContrasenya());
        $sentencia->bindValue("dni", $persona->getDNI());

        $resultado = $sentencia->execute();

        if ($resultado) {
            return $persona;
        } else {
            return null;
        }
    }

    public function borrarPersonaPorDNI(string $dni): ?Persona
    {
        $persona = $this->leerPersona($dni);
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
            $query = "INSERT INTO persona (DNI, NOMBRE, APELLIDOS, TELEFONO, EMAIL, CONTRASENYA) VALUES (:dni, :nombre, :apellidos, NULL, :email, :pass)";

            $sentencia = $this->getConexion()->prepare($query);
            $sentencia->bindValue("dni", $persona->getDNI());
            $sentencia->bindValue("nombre", $persona->getNombre());
            $sentencia->bindValue("apellidos", $persona->getApellidos());
            $sentencia->bindValue("email", $persona->getEmail());
            $sentencia->bindValue("pass", $persona->getContrasenya());
        } else {
            $query = "INSERT INTO persona (DNI, NOMBRE, APELLIDOS, TELEFONO, EMAIL, CONTRASENYA) VALUES (:dni, :nombre, :apellidos, :telefono, :email, :pass)";

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
        if ($datosPersona['TELEFONO']==NULL){
            $datosPersona['TELEFONO']='';
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
        $sentencia->bindParam(1,$email);

        if($sentencia->execute()){
            $resultado = $sentencia->fetch();
            return $this->convertirArrayAPersona($resultado);
        } else {
            return null;
        }

    }
}