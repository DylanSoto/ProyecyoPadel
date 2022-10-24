<?php

//    use \App\Persona;
    namespace App;
    use App\Personas\Enum\LadoPreferido;
    use App\Personas\Enum\ManoHabil;
    use App\Personas\Jugador;
    use App\Personas\Persona;

    include_once("App/Personas/Persona.php");
    include_once("App/Personas/Jugador.php");
    include_once("App/Personas/Enum/ManoHabil.php");
    include_once("App/Personas/Enum/LadoPreferido.php");


    $persona = new Persona('12345678A', 'Javier', 'Gonzalez');

    var_dump($persona);

    echo "<br>";
    echo "<br>";

    $jugador = new Jugador('45931348A',
        'Rocio',
        'Gutierrez',
        1,
        ManoHabil::zurdo,
        LadoPreferido::izquierdo);

    var_dump($jugador);