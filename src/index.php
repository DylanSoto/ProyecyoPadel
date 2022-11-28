<?php


//    use \App\Persona;

namespace App;

use Controlador\Personas\PersonaControlador;
use Vistas\LoginVista;
use Vistas\Plantillas\Plantilla;

include __DIR__ . "/autoload.php";

//echo "<pre>";
//
//var_dump($_SERVER);
//echo "</pre>";

$router = new Router();
$router->guardarRutas('get', '/', function () {
    echo "Estoy en el index.";
});

//$router->guardarRutas('get','/', [PersonaControlador::class,"index"]);


$router->guardarRutas('get','/api/persona', [PersonaControlador::class,"mostrar"]);
$router->guardarRutas('get','/login', [LoginVista::class,"mostrarLogin"]);
$router->guardarRutas('post','/logear', [PersonaControlador::class,"recibirDatosLogin"]);
$router->guardarRutas('post','/api/persona', [PersonaControlador::class,"guardar"]);
$router->guardarRutas('delete','/api/persona', [PersonaControlador::class,"borrar"]);
$router->guardarRutas('put','/api/persona', [PersonaControlador::class,"modificar"]);


$router->resolverRuta($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);
