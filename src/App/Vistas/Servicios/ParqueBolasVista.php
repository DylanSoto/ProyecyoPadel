<?php

namespace App\Vistas\Servicios;

class ParqueBolasVista
{
    public function generarCostesReservas(array $reservas): void
    {
        echo "
            <h3>Costes de las reservas</h3>
            <div>";
             foreach ($reservas as $reserva => $cliente){
                echo $reserva ." -> ". $cliente;
             }
            echo "</div>";
    }

}