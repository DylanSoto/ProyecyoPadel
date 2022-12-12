<?php

namespace App\Controlador\Servicios;

use App\Modelo\Servicios\PistaDAO;
use App\Servicios\Pista;

class PistaControlador
{
    private PistaDAO $modelo;
    private PistaVista $vista;

    public function __construct()
    {
        $this->modelo = new pistaDAOMySQL();
        //$this->vista = new pistaVista();
    }

    public function index(): void
    {
        $vista = new PistaVista("Índice");
        $vista->mostrarPagina();
    }

    public function mostrarTodasLasPistas(): void
    {
        echo json_encode($this->modelo->leerTodasLasPistas(), JSON_PRETTY_PRINT);
    }

    public function mostrarDatosPista($idPista): void
    {
        echo json_encode($this->modelo->leerPista(), JSON_PRETTY_PRINT);
    }

    public function mostrar($idPista): void
    {
        if (isset($idPista)) {
            try {
                $this->mostrarDatosPista($idPista);
            } catch (PistaNoEncontradaException $e) {
                echo "No existe la pista buscada" . $e->getMessage();
            }
        } else {
            $this->mostrarTodasLasPistas();
        }
    }

    public function guardar(): void
    {
        $respuestaControlPista = $this->comprobarDatosPistaCorrectos('post');
        if (is_bool($respuestaControlPista)) {
            $pista = new Pista(
                $_POST['idPista'],
                $_POST['precio'],
                $_POST['luz'],
                $_POST['precioLuz'],
                $_POST['tipoPista'],
                $_POST['cubierta'],
                $_POST['disponible'],
                $_POST['reservasPistaMensuales'],
            );
            $this->modelo->insertarPista($pista);
        } else {
            $mensajeError = "Se han producido errores en los siguientes campos<br>";
            foreach ($respuestaControlPista as $error) {
                $mensajeError .= "Error en el parámetro $error <br>";
            }
            throw new ParametrosDePistaIncorrectosException($mensajeError);
        }
    }

    private function comprobarDatosPistaCorrectos($metodo): array|bool
    {
        $arrayFallos = [];
        if ($metodo === 'post') {
            if (!isset($_POST['idPista'])) {
                $arrayFallos[] = 'idPista';
            }
            if (!isset($_POST['precio'])) {
                $arrayFallos[] = 'precio';
            }
            if (!isset($_POST['luz'])) {
                $arrayFallos[] = 'luz';
            }
            if (!isset($_POST['precioLuz'])) {
                $arrayFallos[] = 'precioLuz';
            }
            if (!isset($_POST['tipoPista'])) {
                $arrayFallos[] = 'tipoPista';
            }
            if (!isset($_POST['cubierta'])) {
                $arrayFallos[] = 'cubierta';
            }
            if (!isset($_POST['disponible'])) {
                $arrayFallos[] = 'disponible';
            }
            if (!isset($_POST['reservasPistaMensuales'])) {
                $arrayFallos[] = 'reservasPistaMensuales';
            }
        }
        if (count($arrayFallos) > 0) {
            return $arrayFallos;
        } else {
            return true;
        }
    }

    public function borrar($idPista):void{
        if (isset($idPista)){
            try {
                $this->modelo->borrarPistaPorId($idPista);
            }catch (PistaNoEncontradaException $e){
                header("Pista no encontrada", true, 500);
            }
        }else{
            $this->modelo->borrarTodasLasPistas();
        }
    }

    public function modificar($idPista): void
    {
        parse_str(file_get_contents("php://input"), $put_vars);
        if (isset($idPista)) {
            try {
                $pista = $this->modelo->leerPista($idPista);
            } catch (PistaNoEncontradaException $e) {
                header("Pista no encontrada", true, 404);
                die;
            }
            if (isset($put_vars['idPista'])) {
                if ($this->modelo->existeIdPista($put_vars['idPista'])) {
                    header("El ID introducido ya existe.", true, 204);
                    die;
                } else {
                    $pista->setIdPista($put_vars['idPista']);
                }
            }
            if (isset($put_vars['precio'])) {
                $pista->setPrecio($put_vars['precio']);
            }
            if (isset($put_vars['luz'])) {
                $pista->setLuz($put_vars['luz']);
            }
            if (isset($put_vars['precioLuz'])) {
                $pista->setPrecioLuz($put_vars['precioLuz']);
            }
            if (isset($put_vars['tipoPista'])) {
                $pista->setTipoPista($put_vars['tipoPista']);
            }
            if (isset($put_vars['cubierta'])) {
                $pista->setCubierta($put_vars['cubierta']);
            }
            if (isset($put_vars['disponible'])) {
                $pista->setDisponible($put_vars['disponible']);
            }
            if (isset($put_vars['reservasPistaMenusales'])) {
                $pista->setReservasPistasMensual($put_vars['reservasPistaMenusales']);
            }
            $this->modelo->modificarPista($pista);
        } else {
            try {
                $this->modelo->modificarTodasLasPistas($put_vars);
            } catch (ActualizarPistasException $e) {
                header($e->getMessage(), true, 204);
            }
        }
    }

//    private function generarHorarioMensual(){
//
//    }


}