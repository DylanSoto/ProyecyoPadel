<?php

namespace App\Controlador\Servicios;

use App\Modelo\Servicios\PistaDao;

class PistaControlador
{
    private PistaDao $modelo;
    private PistaVista $vista;

    public function __construct()
    {
        $this->modelo = new pistaDAOMySQL();
        //$this->vista = new pistaVista();
    }

    public function index():void{
        $vista = new PistaVista("Índice");
        $vista->mostrarPagina();
    }

    public function mostrarTodasLasPistas():void{
        echo json_encode($this->modelo->leerTodasLasPistas(), JSON_PRETTY_PRINT);
    }

    public function mostrarDatosPista($idPista):void{
        echo json_encode($this->modelo->leerPista($idPista), JSON_PRETTY_PRINT);
    }

//    private function generarHorarioMensual(){
//
//    }




}