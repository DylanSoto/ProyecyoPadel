<?php

    namespace App\Personas;

    use App\Horarios\HorarioDiario;
    use App\Horarios\Intervalo;
    use App\Personas\Enum\LadoPreferido;
    use App\Personas\Enum\ManoHabil;
    use App\Personas\Jugador;
    use App\Personas\Persona;

    include "autoload.php";

//    include_once("App/Personas/Persona.php");
//    include_once("App/Personas/Jugador.php");
//    include_once("App/Personas/Enum/ManoHabil.php");
//    include_once("App/Personas/Enum/LadoPreferido.php");
//    include_once ("App/Horarios/Intervalo.php");


/*    $jugador = new Jugador('45931348A',
        'Rocio',
        'Gutierrez',
        1,
        ManoHabil::zurdo,
        LadoPreferido::izquierdo);*/


/*    $intervalo = new Intervalo(8.00, 9.00);
    $intervalo2 = new Intervalo(9.00, 10.00);
    $intervalo3 = new Intervalo(10.00, 11.00);
    $array = [$intervalo, $intervalo2, $intervalo3];

    var_dump($intervalo);
    echo "<br>";
    echo "<br>";

    var_dump($intervalo2);
    echo "<br>";
    echo "<br>";

    var_dump($intervalo3);
    echo "<br>";
    echo "<br>";

    print_r($array);*/

    $inter = new Intervalo(9.00, 21);
    echo $inter;
