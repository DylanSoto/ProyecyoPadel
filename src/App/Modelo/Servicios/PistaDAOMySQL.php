<?php

namespace App\Modelo\Servicios;

use App\Horarios\Execptions\HoraNoValidaException;
use App\Modelo\Excepciones\ActualizarPistasException;
use App\Modelo\Excepciones\PistaNoEncontradaException;
use App\Servicios\Pista;
use PDO;

require_once __DIR__ . "/../../../datosConexionBD.php";
require_once __DIR__ . "/../../../datosConfiguracion.php";

class PistaDAOMySQL extends PistaDAO
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
     * @throws HoraNoValidaException
     * @throws PistaNoEncontradaException
     */
    public function leerPista(int $idPista): ?Pista
    {
        $query = "SELECT * FROM pista WHERE IDPISTA= ?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $idPista);
        $sentencia->execute();

        if (($fila = $sentencia->fetch())) {
            return new Pista(
                $fila['IDPISTA'],
                $fila['PRECIO'],
                $fila['LUZ'],
                $fila['PRECIOLUZ'],
                $fila['TIPOPISTA'],
                $fila['CUBIERTA']
            );
        } else {
            throw new PistaNoEncontradaException("La pista no existe en la base de datos.");
        }
    }

    public function modificarPista(Pista $pista): ?Pista
    {
        $query = "UPDATE pista SET PRECIO=:precio, LUZ=:luz, PRECIOLUZ=:precioLuz, 
                 TIPOPISTA=:tipoPista, CUBIERTA=:cubierta WHERE IDPISTA=:idPista";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindValue("precio", $pista->getPrecio());
        $sentencia->bindValue("luz", $pista->isLuz());
        $sentencia->bindValue("precioLuz", $pista->getPrecioLuz());
        $sentencia->bindValue("tipoPista", $pista->getTipoPista());
        $sentencia->bindValue("cubierta", $pista->isCubierta());

        $resultado = $sentencia->execute();

        if ($resultado) {
            return $pista;
        } else {
            return null;
        }
    }

    /**
     * @throws ActualizarPistasException
     */
    public function modificarTodasLasPistas(array $elementosAModificar)
    {
        $query = "UPDATE pista SET ";

        if (isset($elementosAModificar['precio'])) {
            $query .= "PRECIO=:precio,";
        }
        if (isset($elementosAModificar['luz'])) {
            $query .= "LUZ=:luz,";
        }
        if (isset($elementosAModificar['precioLuz'])) {
            $query .= "PRECIOLUZ=:precioLuz,";
        }
        if (isset($elementosAModificar['tipoPista'])) {
            $query .= "TIPOPISTA=:tipoPista,";
        }
        if (isset($elementosAModificar['cubierta'])) {
            $query .= "CUBIERTA=:cubierta,";
        }

        $query = substr($query, 0, -1);
        $sentencia = $this->getConexion()->prepare($query);

        if (isset($elementosAModificar['precio'])) {
            $sentencia->bindParam("precio", $elementosAModificar['precio']);
        }
        if (isset($elementosAModificar['luz'])) {
            $sentencia->bindParam("luz", $elementosAModificar['luz']);
        }
        if (isset($elementosAModificar['precioLuz'])) {
            $sentencia->bindParam("precioLuz", $elementosAModificar['precioLuz']);
        }
        if (isset($elementosAModificar['tipoPista'])) {
            $sentencia->bindParam("tipoPista", $elementosAModificar['tipoPista']);
        }
        if (isset($elementosAModificar['cubierta'])) {
            $sentencia->bindParam("cubierta", $elementosAModificar['cubierta']);
        }

        try {
            $sentencia->execute();
        } catch (\PDOException $e) {
            throw new ActualizarPistasException("No se han podido actualizar las pistas");
        }
    }


    /**
     * @throws HoraNoValidaException
     * @throws PistaNoEncontradaException
     */
    public function borrarPistaPorId(int $idPista): ?Pista
    {
        try {
            $pista = $this->leerPista($idPista);
        } catch (PistaNoEncontradaException $e) {
            throw new  PistaNoEncontradaException("No existe esa pista a borrar");
        }

        $query = "DELETE FROM pista WHERE IDPISTA=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $idPista);
        $resultado = $sentencia->execute();

        if ($resultado) {
            return $pista;
        } else {
            return null;
        }
    }

    /**
     * @throws HoraNoValidaException
     * @throws PistaNoEncontradaException
     */
    public function borrarPista(Pista $pista): ?Pista
    {
        return $this->borrarPistaPorId($pista->getIdPista());
    }

    public function borrarTodasLasPistas(): bool
    {
        $sentencia = $this->getConexion()->query("TRUNCATE pista");
        return $sentencia->execute();
    }

    public function insertarPista(Pista $pista): ?Pista
    {
        $query = "INSERT INTO pista (IDPISTA, PRECIO, LUZ, PRECIOLUZ, TIPOPISTA, CUBIERTA) 
                  VALUES (:idPista, :precio, :luz, :precioLuz, :tipoPista, :cubierta)";

        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindValue("idPista", $pista->getIdPista());
        $sentencia->bindValue("precio", $pista->getPrecio());
        $sentencia->bindValue("luz", $pista->isLuz());
        $sentencia->bindValue("precioLuz", $pista->getPrecioLuz());
        $sentencia->bindValue("tipoPista", $pista->getTipoPista());
        $sentencia->bindValue("cubierta", $pista->isCubierta());

        $resultado = $sentencia->execute();

        if ($resultado) {
            return $pista;
        } else {
            return null;
        }
    }

    /**
     * @throws HoraNoValidaException
     */
    public function leerTodasLasPistas(): ?array
    {
        $resultado = $this->getConexion()->query("SELECT * FROM pista");
        $resultado->execute();
        $arrayResultados = $resultado->fetchAll();
        $arrayObjetos = [];
        foreach ($arrayResultados as $filaPista) {
            $arrayObjetos[] = $this->convertirArrayAPista($filaPista);
        }
        return $arrayObjetos;
    }

    /**
     * @throws HoraNoValidaException
     */
    public function obtenerRangoPistas(
        int $inicio,
        int $numeroResultados = NUMERODERESULTADOSPORPAGINA
    ): array {
        $resultado = $this->getConexion()->query("SELECT * FROM pista LIMIT $inicio, $numeroResultados");
        $resultado->execute();
        $arrayResultados = $resultado->fetchAll();
        $arrayObjetos = [];
        foreach ($arrayResultados as $filaPista) {
            $arrayObjetos[] = $this->convertirArrayAPista($filaPista);
        }
        return $arrayObjetos;
    }

    /**
     */
    public function convertirArrayAPista(
        array $datosPista
    ): ?Pista {
        return new Pista(
            $datosPista['IDPISTA'],
            $datosPista['PRECIO'],
            $datosPista['LUZ'],
            $datosPista['PRECIOLUZ'],
            $datosPista['TIPOPISTA'],
            $datosPista['CUBIERTA']
        );
    }

    public function existeIdPista(
        $idPista
    ): bool {
        $query = "SELECT * FROM pista WHERE IDPISTA=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $idPista);
        $sentencia->execute();

        return ($sentencia->execute());
    }
}