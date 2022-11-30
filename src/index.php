<?php


//    use \App\Persona;

namespace App;

use App\Controlador\Personas\PersonaControlador;
use App\Modelo\Personas\PersonaDAOMongoDB;
use App\Personas\Persona;
use App\Vistas\LandingVista;
use App\Vistas\LoginVista;

include __DIR__ . "/vendor/autoload.php";

//echo "<pre>";
//
//var_dump($_SERVER);
//echo "</pre>";


$mongodb = new PersonaDAOMongoDB();

$persona = new Persona('45931348A', "Hola", "Como Tamos", "comotamos@gmail.com", "12354", "956789425");
$mongodb->insertarPersona($persona);
var_dump($mongodb->leerTodasPersonas());


$router = new Router();
$router->guardarRutas('get', '/', function () {
    echo "Estoy en el index.";
});

//$router->guardarRutas('get','/', [PersonaControlador::class,"index"]);

$router->guardarRutas('get', '/', [LandingVista::class, "mostrarPagina"]);
$router->guardarRutas('get', '/login', [LoginVista::class, "mostrarLogin"]);
$router->guardarRutas('post', '/logear', [PersonaControlador::class, "recibirDatosLogin"]);
$router->guardarRutas('get', '/api/persona', [PersonaControlador::class, "mostrar"]);
$router->guardarRutas('post', '/api/persona', [PersonaControlador::class, "guardar"]);
$router->guardarRutas('delete', '/api/persona', [PersonaControlador::class, "borrar"]);
$router->guardarRutas('put', '/api/persona', [PersonaControlador::class, "modificar"]);


//$router->resolverRuta($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);
