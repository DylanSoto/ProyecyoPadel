<?php

namespace App\Controlador\Servicios;

use App\Modelo\Excepciones\ReservaNoEncontradaException;
use App\Modelo\Excepciones\ParametrosDeReservaIncorrectosException;
use App\Modelo\Servicios\ParqueBolasDAO;
use App\Modelo\Servicios\ParqueBolasDAOMySQL;
use App\Servicios\ReservaParqueBolas;
use App\Vistas\Servicios\ParqueBolasVista;

class ReservaParqueBolasControlador
{

    private ParqueBolasDAO $modelo;
    private ParqueBolasVista $vista;

    public function __construct()
    {
        $this->modelo = new parqueBolasDAOMySQL();
    }

    public function mostrar($fecha): void
    {
        if (isset($fecha)) {
            try {
                $this->mostrarDatosReserva($fecha);
            } catch (ReservaNoEncontradaException $e) {
                echo "No existe la reserva buscada" . $e->getMessage();
            }
        } else {
            $this->mostrarTodasLasReservas();
        }
    }

    public function mostrarTodasLasReservas(): void
    {
        echo json_encode($this->modelo->leerTodasReservas(), JSON_PRETTY_PRINT);
    }

    /**
     * @throws ReservaNoEncontradaException
     */
    public function mostrarDatosReserva($fecha): void
    {
        echo json_encode($this->modelo->leerReserva($fecha), JSON_PRETTY_PRINT);
    }

    /**
     * @throws ParametrosDeReservaIncorrectosException
     */
    public function guardar(): void
    {
        $respuestaControlReserva = $this->comprobarDatosReservaCorrectos('post');
        if (is_bool($respuestaControlReserva)) {
            $reserva = new ReservaParqueBolas(
                $_POST['fecha'],
                $_POST['numHoras'],
                $_POST['clientes'],
                $_POST['costeHora'],
            );
            $this->modelo->insertarReserva($reserva);
        } else {
            $mensajeError = "Se han producido errores en los siguientes campos<br>";
            foreach ($respuestaControlReserva as $error) {
                $mensajeError .= "Error en el parámetro $error <br>";
            }
            throw new ParametrosDeReservaIncorrectosException($mensajeError);
        }
    }

    public function comprobarDatosReservaCorrectos($metodo): array|bool
    {
        $arrayFallos = [];
        if ($metodo === 'post') {
            if (!isset($_POST['fecha'])) {
                $arrayFallos[] = 'fecha';
            }
            if (!isset($_POST['numHoras'])) {
                $arrayFallos[] = 'numHoras';
            }
            if (!isset($_POST['clientes'])) {
                $arrayFallos[] = 'clientes';
            }
            if (!isset($_POST['costeHora'])) {
                $arrayFallos[] = 'costeHora';
            }
        }
        if (count($arrayFallos) > 0) {
            return $arrayFallos;
        } else {
            return true;
        }
    }

    public function borrar($fecha): void
    {
        if (isset($fecha)) {
            try {
                $this->modelo->borrarReservaPorFecha($fecha);
            } catch (ReservaNoEncontradaException) {
                header("Reserva no encontrada", true, 500);
            }
        } else {
            $this->modelo->borrarTodasLasReservas();
        }
    }

    public function calcularCostePorPersona():array
    {
        //TODO this
    }
}