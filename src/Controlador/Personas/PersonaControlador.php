<?php

namespace Controlador\Personas;

use App\Personas\Persona;
use Modelo\Excepciones\ParametrosDePersonaIncorrectosException;
use Modelo\Excepciones\PersonaNoEncontradaException;
use Modelo\Personas\PersonaDAO;
use Modelo\Personas\PersonaDAOMySQL;
use Vistas\Personas\PersonaVista;

class PersonaControlador
{
    private PersonaDAO $modelo;
    private PersonaVista $vista;

    /**
     * @param PersonaDAO $modelo
     * @param PersonaVista $vista
     */
    public function __construct()
    {
        $this->modelo = new personaDAOMySQL();
        //$this->vista = new personaVista();
    }

    public function comprobarUsuarioWeb($correoUsuario, $pass)
    {
        $persona = $this->modelo->leerPersonaPorEmail($correoUsuario);
        if (password_verify($pass, $persona->getContrasenya())) {
            echo "ole";
        } else {
            echo "que va que va";
        }
    }

    public function crear()
    {
        $pasarCifrado = password_hash("1234", PASSWORD_DEFAULT);
        $personaMod = new  Persona(
            "44111555H", "Javier", "Azpeleta", "javieraz@gmail.com", "$pasarCifrado", "987654123"
        );
        $this->modelo->insertarPersona($personaMod);
    }

    public function login()
    {
        echo "Este es el login";
    }

    public function mostrar($dni)
    {
        if (isset($dni)) {
            try {
                $this->mostrarDatosPersonasAPI($dni);
            } catch (PersonaNoEncontradaException $e) {
                //TODO implement respuesta http
                echo "No existe la persona buscada", $e->getMessage();
            }
        } else {
            $this->mostrarTodasLasPersonasAPI();
        }
    }

    private function mostrarTodasLasPersonasAPI(): void
    {
        echo json_encode($this->modelo->leerTodasPersonas(), JSON_PRETTY_PRINT);
    }

    private function mostrarDatosPersonasAPI($dni): void
    {
        echo json_encode($this->modelo->leerPersona($dni), JSON_PRETTY_PRINT);
    }

    /**
     * @throws ParametrosDePersonaIncorrectosException
     */
    public function guardar()
    {
        $respuestaControlPersona = $this->comprobarDatosPersonaCorrectos('post');
        if (is_bool($respuestaControlPersona)) {
            $persona = new Persona(
                $_POST['dni'],
                $_POST['nombre'],
                $_POST['apellidos'],
                $_POST['email'],
                $_POST['contrasenya']
            );
            if (isset($_POST['telefono'])) {
                $persona->setTelefono($_POST['telefono']);
            }
            $this->modelo->insertarPersona($persona);
        } else {
            $mensajeError = "Se han producido errores en los siguientes campos<br />";
            foreach ($respuestaControlPersona as $error) {
                $mensajeError .= "Error en el parámetro $error<br />";
            }
            throw new ParametrosDePersonaIncorrectosException($mensajeError);
        }
    }

    private function comprobarDatosPersonaCorrectos($metodo): array|bool
    {
        $arrayFallos = [];
        if ($metodo == 'post') {
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

    public function borrar()
    {
        echo "Estas intentando borrar";
    }

    public function modificar()
    {
        echo "Estas intentando modificar";
    }
}