<?php

namespace Controlador\Personas;

use App\Personas\Persona;
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
        if(password_verify($pass, $persona->getContrasenya())){
            echo "ole";
        }else{
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

    public function login(){
        echo "Este es el login";
    }

}