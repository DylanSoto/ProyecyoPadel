<?php


//    use \App\Persona;

namespace App;

use App\Controlador\Personas\PersonaControlador;
use App\Controlador\Servicios\PistaControlador;
use App\Controlador\Servicios\ReservaParqueBolasControlador;
use App\Modelo\Servicios\ParqueBolasDAO;
use App\Modelo\Servicios\ParqueBolasDAOMySQL;
use App\Personas\Persona;
use App\Servicios\ReservaParqueBolas;
use App\Vistas\LandingVista;
use App\Vistas\LoginVista;
use App\Vistas\Servicios\ParqueBolasVista;

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

$persona1 = new Persona('45931347A', "Adios", "Como Tamos", "comotamos3@gmail.com", "12354", "956789425");
$clientes = [];
$clientes[0] = $persona1;
$reserva2 = new ReservaParqueBolas("31-10-2021", 6, $clientes, 2.5);

$reservasArray = [];
//$reservasArray[0] = $reserva1;
$reservasArray[1] = $reserva2;


$sql = new ParqueBolasDAOMySQL();
//$sql->insertarReserva($reserva2);
var_dump($sql->leerTodasReservas());

$vista = new ParqueBolasVista();
$vista-> generarCostesReservas($reservasArray);

$router = new Router();

$router->guardarRutas('get', '/', [LandingVista::class, "mostrarPagina"]);
$router->guardarRutas('get', '/login', [LoginVista::class, "mostrarLogin"]);
$router->guardarRutas('post', '/logear', [PersonaControlador::class, "recibirDatosLogin"]);
$router->guardarRutas('get', '/api/persona', [PersonaControlador::class, "mostrar"]);
$router->guardarRutas('post', '/api/persona', [PersonaControlador::class, "guardar"]);
$router->guardarRutas('delete', '/api/persona', [PersonaControlador::class, "borrar"]);
$router->guardarRutas('put', '/api/persona', [PistaControlador::class, "modificar"]);

$router->guardarRutas('get', '/api/pistas', [PistaControlador::class, "mostrar"]);
$router->guardarRutas('post', '/api/pistas', [PistaControlador::class, "guardar"]);
$router->guardarRutas('delete', '/api/pistas', [PistaControlador::class, "borrar"]);
$router->guardarRutas('put', '/api/pistas', [PistaControlador::class, "modificar"]);

//ReservaParqueBolas
$router->guardarRutas('get', '/parquebolas', [ReservaParqueBolasControlador::class, "mostrar"]);
$router->guardarRutas('post', '/parquebolas', [ReservaParqueBolasControlador::class, "guardar"]);
$router->guardarRutas('delete', '/parquebolas', [ReservaParqueBolasControlador::class, "borrar"]);

$router->resolverRuta($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
