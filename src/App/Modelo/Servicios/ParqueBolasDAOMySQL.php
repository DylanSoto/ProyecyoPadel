<?php

namespace App\Modelo\Servicios;

use App\Modelo\Excepciones\ReservaNoEncontradaException;
use App\Servicios\ReservaParqueBolas;
use DateTime;
use PDO;

require_once __DIR__ . "/../../../datosConexionBD.php";
require_once __DIR__ . "/../../../datosConfiguracion.php";

class ParqueBolasDAOMySQL extends ParqueBolasDAO
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
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }

    public function insertarReserva(ReservaParqueBolas $reservaParqueBolas): ?ReservaParqueBolas
    {
        $query = "INSERT INTO reservaParqueBolas (FECHA, NUMHORAS, CLIENTES, COSTEHORA) 
                        VALUES (:fecha, :numHoras, :clientes, :costeHora)";

        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindValue("fecha", $reservaParqueBolas->getFecha());
        $sentencia->bindValue("numHoras", $reservaParqueBolas->getNumHoras());
        $sentencia->bindValue("clientes", $reservaParqueBolas->getClientes());
        $sentencia->bindValue("costeHora", $reservaParqueBolas->getCosteHora());

        $resultado = $sentencia->execute();

        if ($resultado) {
            return $reservaParqueBolas;
        } else {
            return null;
        }
    }

    /**
     * @throws ReservaNoEncontradaException
     */
    public
    function borrarReserva(
        ReservaParqueBolas $reservaParqueBolas
    ): ?ReservaParqueBolas {
        return $this->borrarReservaPorFecha($reservaParqueBolas->setFecha($reservaParqueBolas->getFecha()));
    }

    public
    function borrarTodasLasReservas(): bool
    {
        $sentencia = $this->getConexion()->query("TRUNCATE reservaParqueBolas");
        return $sentencia->execute();
    }

    /**
     * @throws ReservaNoEncontradaException
     */
    public
    function borrarReservaPorFecha(
        DateTime $fecha
    ): ?ReservaParqueBolas {
        try {
            $reserva = $this->leerReserva($fecha);
        } catch (ReservaNoEncontradaException) {
            throw new ReservaNoEncontradaException("No existe esa reserva a borrar.");
        }

        $query = "DELETE FROM persona WHERE FECHA=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $fecha);
        $resultado = $sentencia->execute();

        if ($resultado) {
            return $reserva;
        } else {
            return null;
        }
    }

    /**
     * @throws ReservaNoEncontradaException
     */
    public
    function leerReserva(
        DateTime $fecha
    ): ?ReservaParqueBolas {
        $query = "SELECT * FROM reservaParqueBolas WHERE FECHA= ?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1, $fecha);
        $sentencia->execute();

        if (($fila = $sentencia->fetch())) {
            return new ReservaParqueBolas(
                $fila['fecha'],
                $fila['numHoras'],
                $fila['clientes'],
                $fila['costeHora'],
            );
        } else {
            throw new ReservaNoEncontradaException("La reserva no existe en la base de datos.");
        }
    }

    public
    function leerTodasReservas(): array
    {
        $resultado = $this->getConexion()->query("SELECT * FROM reservaParqueBolas");
        $resultado->execute();
        $arrayResultados = $resultado->fetchAll();
        $arrayObjetos = [];
        foreach ($arrayResultados as $filaReserva) {
            $arrayObjetos[] = $this->convertirArrayAReserva($filaReserva);
        }
        return $arrayObjetos;
    }

    private function convertirArrayAReserva(array $datosReserva): ?ReservaParqueBolas
    {
        return new ReservaParqueBolas(
            $datosReserva['FECHA'], $datosReserva['NUMHORAS'],
            $datosReserva['CLIENTES'], $datosReserva['COSTEHORA']
        );
    }
}