<?php


//    use \App\Persona;

namespace App;

use App\Controlador\Personas\PersonaControlador;
use App\Controlador\Servicios\PistaControlador;
use App\Personas\Persona;
use App\Vistas\LandingVista;
use App\Vistas\LoginVista;

session_start();

include __DIR__ . "/vendor/autoload.php";

//echo "<pre>";
//
//var_dump($_SERVER);
//echo "</pre>";


//$mongodb = new PersonaDAOMongoDB();
//
//$persona = new Persona('45931347A', "Adios", "Como Tamos", "comotamos3@gmail.com", "12354", "956789425");
//$mongodb->insertarPersona($persona);
////$mongodb->modificarPersona($persona);
//var_dump($mongodb->leerTodasPersonas());

//$pista = new Pista('1', 20, true, 21, TipoPista::Doble);
//$sql = new PistaDAOMySQL();
//$sql->insertarPista($pista);
//var_dump($sql->leerTodasLasPistas());

//ReservaParqueBolas

//$persona1 = new Persona('45931347A', "Adios", "Como Tamos", "comotamos3@gmail.com", "12354", "956789425");


$router = new Router();

$router->guardarRutas('get', '/', [LandingVista::class, "mostrarPagina"]);
$router->guardarRutas('get', '/login', [LoginVista::class, "mostrarLogin"]);
$router->guardarRutas('get', '/logout', [PersonaControlador::class, "cerrarSesion"]);
$router->guardarRutas('post', '/logear', [PersonaControlador::class, "recibirDatosLogin"]);
$router->guardarRutas('get', '/api/persona', [PersonaControlador::class, "mostrar"]);
$router->guardarRutas('post', '/api/persona', [PersonaControlador::class, "guardar"]);
$router->guardarRutas('delete', '/api/persona', [PersonaControlador::class, "borrar"]);
$router->guardarRutas('put', '/api/persona', [PistaControlador::class, "modificar"]);

$router->guardarRutas('get', '/api/pistas', [PistaControlador::class, "mostrar"]);
$router->guardarRutas('post', '/api/pistas', [PistaControlador::class, "guardar"]);
$router->guardarRutas('delete', '/api/pistas', [PistaControlador::class, "borrar"]);
$router->guardarRutas('put', '/api/pistas', [PistaControlador::class, "modificar"]);

$router->resolverRuta($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
