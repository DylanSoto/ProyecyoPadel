<?php

namespace App\Modelo\Servicios;

use App\Horarios\Execptions\HoraNoValidaException;
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
                $fila['CUBIERTA'],
                $fila['DISPONIBLE'],
                $fila['RESERVASPISTAMENSUALES'],
            );
        } else {
            throw new PistaNoEncontradaException("La pista no existe en la base de datos.");
        }
    }

    public function modificarPista(Pista $pista): ?Pista
    {
        $query = "UPDATE pista SET PRECIO=:precio, LUZ=:luz, PRECIOLUZ=:precioLuz, 
                 TIPOPISTA=:tipoPista, CUBIERTA=:cubierta, DISPONIBLE=:disponible,
                 RESERVASPISTAMENSUALES=:reservasPistaMensuales WHERE IDPISTA=:idPista";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindValue("precio", $pista->getPrecio());
        $sentencia->bindValue("luz", $pista->getLuz());
        $sentencia->bindValue("precioLuz", $pista->getPrecioLuz());
        $sentencia->bindValue("tipoPista", $pista->getTipoPista());
        $sentencia->bindValue("cubierta", $pista->getCubierta());
        $sentencia->bindValue("disponible", $pista->getDisponible());
        $sentencia->bindValue("reservasPistasMensuales", $pista->getReservasPistasMensual());

        $resultado = $sentencia->execute();

        if ($resultado) {
            return $pista;
        } else {
            return null;
        }
    }

    public function modificarTodasLasPistas(array $elementosAModificar)
    {
        $query = "UPDATE pista SET ";
    }
}