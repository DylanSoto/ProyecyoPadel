<?php

namespace App\Controlador\Personas;

use App\Modelo\Excepciones\ActualizarPersonasException;
use App\Modelo\Excepciones\ParametrosDePersonaIncorrectosException;
use App\Modelo\Excepciones\PersonaNoEncontradaException;
use App\Modelo\Personas\PersonaDAO;
use App\Modelo\Personas\PersonaDAOMySQL;
use App\Personas\Persona;
use App\Vistas\Personas\PersonaVista;

class PersonaControlador
{
    private PersonaDAO $modelo;
    private PersonaVista $vista;

    public function __construct()
    {
        $this->modelo = new personaDAOMySQL();
        //$this->vista = new personaVista();
    }

    public function recibirDatosLogin(): void
    {
        if (isset($_POST['email']) && isset($_POST['contrasenya'])) {
            $this->comprobarUsuarioWeb($_POST['email'], $_POST['contrasenya']);
        } else {
            echo "Parámetros de login incorrectos.";
        }
    }

    public function cerrarSesion():void
    {
        session_destroy();
        header("refresh:0;url=/");
    }

    public function comprobarUsuarioWeb($correoUsuario, $pass): void
    {
        $persona = $this->modelo->leerPersonaPorEmail($correoUsuario);
        if (password_verify($pass, $persona->getContrasenya())) {
            session_start();
            $_SESSION['logeado'] = true;
            $_SESSION['usuario'] = $this->modelo->leerPersonaPorEmail($correoUsuario)->getNombre();
            setcookie("apodo", "mike", time()+3600);
            echo "<a href='/'>Volver al inicio</a>";
        } else {
            echo "que va que va";
        }
    }

    public function crear(): void
    {
        $pasarCifrado = password_hash("1234", PASSWORD_DEFAULT);
        $personaMod = new  Persona(
            "44111555H", "Javier", "Azpeleta", "javieraz@gmail.com", "$pasarCifrado", "987654123"
        );
        $this->modelo->insertarPersona($personaMod);
    }

    public function login(): void
    {
        echo "Este es el login";
    }

    public function index(): void
    {
        $vista = new PersonaVista("Indíce");
        $vista->mostrarPagina();
    }

    public function mostrar($dni): void
    {
        if (isset($dni)) {
            try {
                $this->mostrarDatosPersonasAPI($dni);
            } catch (PersonaNoEncontradaException $e) {
                //TODO implement respuesta http
                echo "No existe la persona buscada" . $e->getMessage();
            }
        } else {
            $this->mostrarTodasLasPersonasAPI();
        }
    }

    private function mostrarTodasLasPersonasAPI(): void
    {
        echo json_encode($this->modelo->leerTodasPersonas(), JSON_PRETTY_PRINT);
    }

    /**
     * @throws PersonaNoEncontradaException
     */
    private function mostrarDatosPersonasAPI($dni): void
    {
        echo json_encode($this->modelo->leerPersona($dni), JSON_PRETTY_PRINT);
    }

    /**
     * @throws ParametrosDePersonaIncorrectosException
     */
    public function guardar(): void
    {
        $respuestaControlPersona = $this->comprobarDatosPersonaCorrectos('post');
        if (is_bool($respuestaControlPersona)) {
            $persona = new Persona(
                $_POST['dni'],
                $_POST['nombre'],
                $_POST['apellidos'],
                $_POST['correoelectronico'],
                password_hash($_POST['contrasenya'], PASSWORD_DEFAULT)
            );
            if (isset($_POST['telefono'])) {
                $persona->setTelefono($_POST['telefono']);
            }
            $this->modelo->insertarPersona($persona);
        } else {
            $mensajeError = "Se han producido errores en los siguientes campos<br>";
            foreach ($respuestaControlPersona as $error) {
                $mensajeError .= "Error en el parámetro $error <br>";
            }
            throw new ParametrosDePersonaIncorrectosException($mensajeError);
        }
        header("refresh:0;url=/");
    }

    private function comprobarDatosPersonaCorrectos($metodo): array|bool
    {
        $arrayFallos = [];
        if ($metodo === 'post') {
            if (!isset($_POST['dni'])) {
                $arrayFallos[] = 'dni';
            }
            if (!isset($_POST['nombre'])) {
                $arrayFallos[] = 'nombre';
            }
            if (!isset($_POST['apellidos'])) {
                $arrayFallos[] = 'apellidos';
            }
            if (!isset($_POST['email'])) {
                $arrayFallos[] = 'email';
            }
            if (!isset($_POST['contrasenya'])) {
                $arrayFallos[] = 'contrasenya';
            }
        }
        if (count($arrayFallos) > 0) {
            return $arrayFallos;
        } else {
            return true;
        }
    }

    public function borrar($dni): void
    {
        if (isset($dni)) {
            try {
                $this->modelo->borrarPersonaPorDNI($dni);
            } catch (PersonaNoEncontradaException $e) {
                header("Persona no encontrada", true, 500);
            }
        } else {
            $this->modelo->borrarTodasLasPersonas();
        }
    }

    public function modificar($dni): void
    {
        parse_str(file_get_contents("php://input"), $put_vars);
        if (isset($dni)) {
            try {
                $persona = $this->modelo->leerPersona($dni);
            } catch (PersonaNoEncontradaException $e) {
                header("Persona no encontrada", true, 404);
                die;
            }
            if (isset($put_vars['dni'])) {
                if ($this->modelo->existeDNI($put_vars['dni'])) {
                    header("El DNI introducido ya existe.", true, 204);
                    die;
                } else {
                    $persona->setDNI($put_vars['dni']);
                }
            }
            if (isset($put_vars['nombre'])) {
                $persona->setNombre($put_vars['nombre']);
            }
            if (isset($put_vars['apellidos'])) {
                $persona->setApellidos($put_vars['apellidos']);
            }
            if (isset($put_vars['telefono'])) {
                $persona->setTelefono($put_vars['telefono']);
            }
            if (isset($put_vars['contrasenya'])) {
                $persona->setContrasenya(password_hash($put_vars['contrasenya'], PASSWORD_DEFAULT));
            }
            if (isset($put_vars['email'])) {
                if ($this->modelo->existeEmail($put_vars['email'])) {
                    header("El email introducido ya existe.", true, 204);
                    die;
                } else {
                    $persona->setEmail($put_vars['email']);
                }
            }
            $this->modelo->modificarPersona($persona);
        } else {
            try {
                $this->modelo->modificarTodasLasPersonas($put_vars);
            } catch (ActualizarPersonasException $e) {
                header($e->getMessage(), true, 204);
            }
        }
    }
}